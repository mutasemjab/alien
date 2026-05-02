<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = JobApplication::with('jobPosition')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->paginate(20);
        return view('admin.job-applications.index', compact('applications'));
    }

    public function show(JobApplication $jobApplication)
    {
        return view('admin.job-applications.show', ['application' => $jobApplication]);
    }

    public function update(Request $request, JobApplication $jobApplication)
    {
        $request->validate([
            'status' => 'required|in:new,reviewing,shortlisted,rejected,hired',
            'notes'  => 'nullable|string',
        ]);
        $jobApplication->update($request->only('status', 'notes'));
        return back()->with('success', 'Application updated.');
    }

    public function destroy(JobApplication $jobApplication)
    {
        if ($jobApplication->resume) {
            @unlink(base_path('assets/admin/uploads/resumes/' . $jobApplication->resume));
        }
        $jobApplication->delete();
        return redirect()->route('admin.job-applications.index')->with('success', 'Application deleted.');
    }
}
