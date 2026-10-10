@extends('layouts.admin')

@section('title', $post->title)
@section('page-title', 'View Blog Post')
@section('page-subtitle', 'Preview and manage post')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Post Header -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-2">
                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $post->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                    {{ $post->is_published ? 'Published' : 'Draft' }}
                </span>
                @if($post->category)
                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                    {{ $post->category->name }}
                </span>
                @endif
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.blog.edit', $post->id) }}" class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600 transition font-medium text-sm">
                    Edit Post
                </a>
                <form action="{{ route('admin.blog.destroy', $post->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this post?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition font-medium text-sm">
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>

        <div class="flex items-center text-sm text-gray-600 gap-4">
            <div class="flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                {{ $post->author->name }}
            </div>
            @if($post->published_at)
            <div class="flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                {{ $post->published_at->format('M d, Y') }}
            </div>
            @endif
        </div>

        @if($post->tags->count() > 0)
        <div class="mt-4 flex flex-wrap gap-2">
            @foreach($post->tags as $tag)
            <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                #{{ $tag->name }}
            </span>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Featured Image -->
    @if($post->featured_image)
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Featured Image</h3>
        <img src="{{ media_url($post->featured_image) }}" alt="{{ $post->title }}" 
             class="w-full rounded-lg shadow-lg">
    </div>
    @endif

    <!-- Excerpt -->
    @if($post->excerpt)
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-3">Excerpt</h3>
        <p class="text-gray-700 italic">{{ $post->excerpt }}</p>
    </div>
    @endif

    <!-- Content -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Content</h3>
        <div class="prose prose-pink max-w-none">
            {!! $post->content !!}
        </div>
    </div>

    <!-- Post Meta -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Post Information</h3>
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <dt class="text-sm font-medium text-gray-500">Slug</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $post->slug }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Created</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $post->created_at->format('M d, Y \a\t h:i A') }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $post->updated_at->format('M d, Y \a\t h:i A') }}</dd>
            </div>
            @if($post->published_at)
            <div>
                <dt class="text-sm font-medium text-gray-500">Published</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $post->published_at->format('M d, Y \a\t h:i A') }}</dd>
            </div>
            @endif
        </dl>
    </div>

    <!-- Actions -->
    <div class="flex items-center justify-between bg-white rounded-lg shadow p-6">
        <a href="{{ route('admin.blog.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2.5 rounded-lg hover:bg-gray-300 transition font-medium">
            Back to Posts
        </a>
        <a href="{{ route('admin.blog.edit', $post->id) }}" class="bg-gradient-to-r from-pink-500 to-pink-600 text-white px-6 py-2.5 rounded-lg hover:from-pink-600 hover:to-pink-700 transition shadow-md font-medium">
            Edit Post
        </a>
    </div>
</div>
@endsection
