<?php
// ============================================================
// BranchController
// ============================================================
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::orderBy('sort_order')->get();
        return view('admin.branches.index', compact('branches'));
    }

    public function create()
    {
        return view('admin.branches.form', ['branch' => new Branch()]);
    }

    public function store(Request $request)
    {
        Branch::create($this->validated($request));
        return redirect()->route('admin.branches.index')
            ->with('success', __('admin.created_successfully'));
    }

    public function edit(Branch $branch)
    {
        return view('admin.branches.form', compact('branch'));
    }

    public function update(Request $request, Branch $branch)
    {
        $branch->update($this->validated($request));
        return redirect()->route('admin.branches.index')
            ->with('success', __('admin.updated_successfully'));
    }

    public function destroy(Branch $branch)
    {
        $branch->delete();
        return back()->with('success', __('admin.deleted_successfully'));
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'city_en'            => 'required|string|max:80',
            'city_ar'            => 'required|string|max:80',
            'country_en'         => 'required|string|max:80',
            'country_ar'         => 'required|string|max:80',
            'flag_emoji'         => 'required|string|max:10',
            'label_en'           => 'nullable|string|max:40',
            'label_ar'           => 'nullable|string|max:40',
            'address_en'         => 'required|string|max:200',
            'address_ar'         => 'required|string|max:200',
            'phone'              => 'nullable|string|max:30',
            'email'              => 'nullable|email|max:100',
            'working_hours_en'   => 'nullable|string|max:100',
            'working_hours_ar'   => 'nullable|string|max:100',
            'latitude'           => 'nullable|numeric',
            'longitude'          => 'nullable|numeric',
            'is_active'          => 'boolean',
            'sort_order'         => 'integer|min:0',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        return $data;
    }
}
