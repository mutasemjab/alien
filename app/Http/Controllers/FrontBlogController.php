<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class FrontBlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::active()->published()->ordered();

        if ($request->filled('category')) {
            $query->where('category_en', $request->category);
        }

        $posts      = $query->paginate(9)->withQueryString();
        $categories = Blog::active()->published()
            ->whereNotNull('category_en')
            ->distinct()->pluck('category_en');

        return view('front.blogs.index', compact('posts', 'categories'));
    }

    public function show(string $slug)
    {
        $post = Blog::active()->published()->where('slug', $slug)->firstOrFail();

        $related = Blog::active()->published()
            ->where('id', '!=', $post->id)
            ->where('category_en', $post->category_en)
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        return view('front.blogs.show', compact('post', 'related'));
    }
}
