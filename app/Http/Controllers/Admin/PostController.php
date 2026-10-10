<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['author', 'category', 'tags']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_published', $request->status === 'published');
        }

        $posts = $query->latest()->paginate(20);
        $categories = Category::all();

        $stats = [
            'total' => Post::count(),
            'published' => Post::where('is_published', true)->count(),
            'draft' => Post::where('is_published', false)->count(),
        ];

        return view('admin.super-admin.blog.index', compact('posts', 'categories', 'stats'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.super-admin.blog.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required',
            'featured_image' => 'nullable|image|max:5120',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'is_published' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:512',
            'meta_keywords' => 'nullable|string|max:255',
            'og_image' => 'nullable|image|max:2048',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|max:5120',
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'is_published' => $request->has('is_published'),
            'author_id' => auth()->id(),
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ];

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('blog_images', 'public_html');
        }

        if ($request->hasFile('og_image')) {
            $data['og_image'] = $request->file('og_image')->store('blog_images/og', 'public_html');
        }

        if ($request->has('is_published') && $request->is_published) {
            $data['published_at'] = now();
        }

        $post = Post::create($data);

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $file) {
                $path = $file->store('blog_images/gallery', 'public_html');
                $post->images()->create(['path' => $path, 'sort_order' => $index]);
            }
        }

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('admin.blog.index')->with('success', 'Blog post created successfully.');
    }

    public function show($id)
    {
        $post = Post::with(['author', 'category', 'tags'])->findOrFail($id);
        return view('admin.super-admin.blog.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::with(['tags', 'images'])->findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.super-admin.blog.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required',
            'featured_image' => 'nullable|image|max:5120',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'is_published' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:512',
            'meta_keywords' => 'nullable|string|max:255',
            'og_image' => 'nullable|image|max:2048',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|max:5120',
        ]);

        $post = Post::findOrFail($id);
        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'is_published' => $request->has('is_published'),
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ];

        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                Storage::disk('public_html')->delete($post->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('blog_images', 'public_html');
        }

        if ($request->hasFile('og_image')) {
            if ($post->og_image) {
                Storage::disk('public_html')->delete($post->og_image);
            }
            $data['og_image'] = $request->file('og_image')->store('blog_images/og', 'public_html');
        }

        if ($request->has('is_published') && $request->is_published && !$post->published_at) {
            $data['published_at'] = now();
        }

        $post->update($data);

        if ($request->hasFile('gallery_images')) {
            $startOrder = $post->images()->max('sort_order') ?? -1;
            foreach ($request->file('gallery_images') as $index => $file) {
                $path = $file->store('blog_images/gallery', 'public_html');
                $post->images()->create(['path' => $path, 'sort_order' => $startOrder + 1 + $index]);
            }
        }

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync([]);
        }

        return redirect()->route('admin.blog.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroyPostImage(Request $request, $postId, $imageId)
    {
        $post = Post::findOrFail($postId);
        $image = $post->images()->findOrFail($imageId);
        Storage::disk('public_html')->delete($image->path);
        $image->delete();
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->featured_image) {
            Storage::disk('public_html')->delete($post->featured_image);
        }
        if ($post->og_image) {
            Storage::disk('public_html')->delete($post->og_image);
        }
        foreach ($post->images as $img) {
            Storage::disk('public_html')->delete($img->path);
        }

        $post->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Blog post deleted successfully.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:5120',
        ]);

        $path = $request->file('file')->store('blog_images/images', 'public_html');
        $url = media_url($path);

        return response()->json(['location' => $url]);
    }
}

