<?php
// ============================================================
// PortfolioController
// ============================================================
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $items = PortfolioItem::orderBy('sort_order')->get();
        return view('admin.portfolio.index', compact('items'));
    }

    public function create()
    {
        return view('admin.portfolio.form', ['item' => new PortfolioItem()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        if ($request->hasFile('image')) {
            $data['image'] = uploadImage('assets/admin/uploads', $request->image);
        }
        PortfolioItem::create($data);
        return redirect()->route('admin.portfolio.index')
            ->with('success', __('admin.created_successfully'));
    }

    public function edit(PortfolioItem $portfolio)
    {
        return view('admin.portfolio.form', ['item' => $portfolio]);
    }

    public function update(Request $request, PortfolioItem $portfolio)
    {
        $data = $this->validated($request);
        if ($request->hasFile('image')) {
           
            $data['image'] =  uploadImage('assets/admin/uploads', $request->image);
        }
        $portfolio->update($data);
        return redirect()->route('admin.portfolio.index')
            ->with('success', __('admin.updated_successfully'));
    }

    public function destroy(PortfolioItem $portfolio)
    {
       
        $portfolio->delete();
        return back()->with('success', __('admin.deleted_successfully'));
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title_en'       => 'required|string|max:150',
            'title_ar'       => 'required|string|max:150',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'image'          => 'nullable|image|max:3072',
            'category_en'    => 'required|string|max:60',
            'category_ar'    => 'required|string|max:60',
            'tags'           => 'nullable|string',
            'project_url'    => 'nullable|url|max:200',
            'github_url'     => 'nullable|url|max:200',
            'sort_order'     => 'integer|min:0',
            'is_active'      => 'boolean',
        ]);

        $data['tags']      = array_filter(array_map('trim', explode(',', $data['tags'] ?? '')));
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}