<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPosition;
use Illuminate\Http\Request;

class JobPositionController extends Controller
{
    public function index()
    {
        $positions = JobPosition::orderBy('sort_order')->orderBy('id')->get();
        return view('admin.job-positions.index', compact('positions'));
    }

    public function create()
    {
        $position = new JobPosition();
        return view('admin.job-positions.form', compact('position'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        JobPosition::create($data);
        return redirect()->route('admin.job-positions.index')->with('success', 'Position created.');
    }

    public function edit(JobPosition $jobPosition)
    {
        $position = $jobPosition;
        return view('admin.job-positions.form', compact('position'));
    }

    public function update(Request $request, JobPosition $jobPosition)
    {
        $jobPosition->update($this->validated($request));
        return redirect()->route('admin.job-positions.index')->with('success', 'Position updated.');
    }

    public function destroy(JobPosition $jobPosition)
    {
        $jobPosition->delete();
        return redirect()->route('admin.job-positions.index')->with('success', 'Position deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title_en'          => 'required|string|max:200',
            'title_ar'          => 'nullable|string|max:200',
            'department_en'     => 'nullable|string|max:100',
            'department_ar'     => 'nullable|string|max:100',
            'location_en'       => 'nullable|string|max:100',
            'location_ar'       => 'nullable|string|max:100',
            'type'              => 'required|in:full-time,part-time,remote,hybrid,internship,contract',
            'description_en'    => 'nullable|string',
            'description_ar'    => 'nullable|string',
            'requirements_en'   => 'nullable|string',
            'requirements_ar'   => 'nullable|string',
            'is_active'         => 'nullable',
            'sort_order'        => 'nullable|integer',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        return $data;
    }
}
