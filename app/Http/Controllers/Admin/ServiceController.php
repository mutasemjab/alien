<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.form', ['service' => new Service()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Service::create($data);
        return redirect()->route('admin.services.index')
            ->with('success', __('admin.created_successfully'));
    }

    public function edit(Service $service)
    {
        return view('admin.services.form', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $this->validated($request);
        $service->update($data);
        return redirect()->route('admin.services.index')
            ->with('success', __('admin.updated_successfully'));
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return back()->with('success', __('admin.deleted_successfully'));
    }

    public function reorder(Request $request)
    {
        foreach ($request->order as $index => $id) {
            Service::where('id', $id)->update(['sort_order' => $index]);
        }
        return response()->json(['ok' => true]);
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'icon'           => 'required|string|max:10',
            'title_en'       => 'required|string|max:100',
            'title_ar'       => 'required|string|max:100',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'tags'           => 'nullable|string',   // comma-separated
            'sort_order'     => 'integer|min:0',
            'is_active'      => 'boolean',
        ]);

        // Convert comma-separated tags to array
        $data['tags']      = array_filter(array_map('trim', explode(',', $data['tags'] ?? '')));
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
