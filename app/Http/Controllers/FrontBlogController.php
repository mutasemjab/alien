<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class FrontBlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::active()->published()->articles()->ordered();

        if ($request->filled('category')) {
            $query->where('category_en', $request->category);
        }

        $posts      = $query->paginate(9)->withQueryString();
        $categories = Blog::active()->published()->articles()
            ->whereNotNull('category_en')
            ->distinct()->pluck('category_en');

        return view('front.blogs.index', compact('posts', 'categories'));
    }

    public function show(string $slug)
    {
        $post = Blog::active()->published()->where('slug', $slug)->firstOrFail();

        // Landing pages get their own dedicated template
        if ($post->type === 'landing_page') {
            $related = Blog::active()->published()
                ->where('id', '!=', $post->id)
                ->where(function ($q) use ($post) {
                    $q->where('category_en', $post->category_en)
                      ->orWhere('type', 'landing_page');
                })
                ->articles()
                ->orderByDesc('published_at')
                ->take(3)
                ->get();

            return view('front.pages.show', compact('post', 'related'));
        }

        // Regular articles
        $related = Blog::active()->published()->articles()
            ->where('id', '!=', $post->id)
            ->where('category_en', $post->category_en)
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        return view('front.blogs.show', compact('post', 'related'));
    }
}
