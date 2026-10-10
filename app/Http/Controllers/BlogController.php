<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;

class BlogController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = Post::published()->with(['author', 'category']);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $posts = $query->latest('published_at')->paginate(12)->withQueryString();
        $categories = Category::has('posts')->withCount('posts')->orderBy('name')->get();

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)
            ->published()
            ->with(['author', 'category', 'tags', 'images'])
            ->firstOrFail();

        $related = Post::published()
            ->where('id', '!=', $post->id)
            ->when($post->category_id, fn ($q) => $q->where('category_id', $post->category_id))
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('blog.show', compact('post', 'related'));
    }
}
