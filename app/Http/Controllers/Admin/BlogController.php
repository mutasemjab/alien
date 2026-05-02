<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Blog::orderByDesc('published_at')->paginate(20);
        return view('admin.blogs.index', compact('posts'));
    }

    public function create()
    {
        $post = new Blog();
        return view('admin.blogs.form', compact('post'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        if ($request->hasFile('image')) {
            $data['image'] = uploadImage('assets/admin/uploads', $request->file('image'));
        }
        if (empty($data['slug'])) {
            $data['slug'] = Blog::generateSlug($data['title_en']);
        }
        Blog::create($data);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post created successfully.');
    }

    public function edit(Blog $blog)
    {
        $post = $blog;
        return view('admin.blogs.form', compact('post'));
    }

    public function update(Request $request, Blog $blog)
    {
        $data = $this->validated($request);
        if ($request->hasFile('image')) {
            $data['image'] = uploadImage('assets/admin/uploads', $request->file('image'));
        }
        $blog->update($data);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title_en'      => 'required|string|max:200',
            'title_ar'      => 'nullable|string|max:200',
            'slug'          => 'nullable|string|max:200',
            'excerpt_en'    => 'nullable|string',
            'excerpt_ar'    => 'nullable|string',
            'body_en'       => 'nullable|string',
            'body_ar'       => 'nullable|string',
            'category_en'   => 'nullable|string|max:100',
            'category_ar'   => 'nullable|string|max:100',
            'tags'          => 'nullable|string',
            'author'        => 'nullable|string|max:100',
            'meta_title_en' => 'nullable|string|max:200',
            'meta_title_ar' => 'nullable|string|max:200',
            'meta_desc_en'  => 'nullable|string',
            'meta_desc_ar'  => 'nullable|string',
            'is_active'     => 'nullable',
            'published_at'  => 'nullable|date',
            'sort_order'    => 'nullable|integer',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if (!empty($data['tags'])) {
            $data['tags'] = array_values(array_filter(array_map('trim', explode(',', $data['tags']))));
        } else {
            $data['tags'] = [];
        }

        return $data;
    }
}
