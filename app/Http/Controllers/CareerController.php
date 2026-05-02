<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobPosition;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function apply(Request $request)
    {
        $request->validate([
            'full_name'     => 'required|string|max:120',
            'email'         => 'required|email|max:120',
            'phone'         => 'required|string|max:30',
            'position'      => 'required|string|max:200',
            'hear_about_us' => 'required|string|max:100',
            'cover_letter'  => 'nullable|string|max:3000',
            'resume'        => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $data = $request->only('full_name', 'email', 'phone', 'position', 'hear_about_us', 'cover_letter');

        // Try to link to a job position record
        $pos = JobPosition::active()->where('title_en', $request->position)->first();
        if ($pos) {
            $data['job_position_id'] = $pos->id;
        }

        // Handle resume upload
        if ($request->hasFile('resume')) {
            $dir = base_path('assets/admin/uploads/resumes');
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            $file     = $request->file('resume');
            $filename = 'resume_' . uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $filename);
            $data['resume'] = $filename;
        }

        JobApplication::create($data);

        return redirect()
            ->to(url()->previous() . '#careers')
            ->with('career_success', __('front.career_success'));
    }
}
