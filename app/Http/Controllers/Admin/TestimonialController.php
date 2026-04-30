<?php
// ============================================================
// TestimonialController
// ============================================================
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('sort_order')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.form', ['testimonial' => new Testimonial()]);
    }

    public function store(Request $request)
    {
        Testimonial::create($this->validated($request));
        return redirect()->route('admin.testimonials.index')
            ->with('success', __('admin.created_successfully'));
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.form', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $testimonial->update($this->validated($request));
        return redirect()->route('admin.testimonials.index')
            ->with('success', __('admin.updated_successfully'));
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return back()->with('success', __('admin.deleted_successfully'));
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'author_name_en' => 'required|string|max:100',
            'author_name_ar' => 'required|string|max:100',
            'author_role_en' => 'required|string|max:100',
            'author_role_ar' => 'required|string|max:100',
            'author_company' => 'required|string|max:100',
            'quote_en'       => 'required|string',
            'quote_ar'       => 'required|string',
            'rating'         => 'integer|min:1|max:5',
            'sort_order'     => 'integer|min:0',
            'is_active'      => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        return $data;
    }
}