@extends('layouts.app')

@section('title', $post->meta_title ?: $post->title . ' | Pelvicare Blog')
@section('meta_description', $post->meta_description ?: Str::limit(strip_tags($post->excerpt ?: $post->content), 160))
@section('meta_keywords', $post->meta_keywords)

@push('meta')
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $post->meta_title ?: $post->title }}">
    <meta property="og:description" content="{{ $post->meta_description ?: Str::limit(strip_tags($post->excerpt ?: $post->content), 160) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $post->og_image ? media_url($post->og_image) : ($post->featured_image ? media_url($post->featured_image) : asset('images/pelvicarehealth_logo.png')) }}">
    <meta property="article:published_time" content="{{ $post->published_at?->toIso8601String() }}">
    <meta property="article:author" content="{{ $post->author->name }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $post->meta_title ?: $post->title }}">
    <meta name="twitter:description" content="{{ $post->meta_description ?: Str::limit(strip_tags($post->excerpt ?: $post->content), 160) }}">
    <meta name="twitter:image" content="{{ $post->og_image ? media_url($post->og_image) : ($post->featured_image ? media_url($post->featured_image) : asset('images/pelvicarehealth_logo.png')) }}">
@endpush

@section('content')
    <!-- Breadcrumb -->
    <section class="bg-gray-50 border-b border-gray-100 py-3">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex flex-wrap items-center gap-2 text-sm text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-pink-600 transition">Home</a>
                <span>/</span>
                <a href="{{ route('blog.index') }}" class="hover:text-pink-600 transition">Blog</a>
                <span>/</span>
                <span class="text-gray-900 font-medium truncate max-w-[200px] sm:max-w-none">{{ $post->title }}</span>
            </nav>
        </div>
    </section>

    <article class="pb-16 bg-white">
        <header class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 md:pt-12">
            @if($post->category)
            <a href="{{ route('blog.index', ['category' => $post->category->id]) }}" class="inline-block text-sm font-semibold text-pink-600 uppercase tracking-wide mb-3">{{ $post->category->name }}</a>
            @endif
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold heading-font text-gray-900 mb-4 leading-tight">{{ $post->title }}</h1>
            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                <span>{{ $post->author->name }}</span>
                <time datetime="{{ $post->published_at?->toIso8601String() }}">{{ $post->published_at?->format('F j, Y') }}</time>
                @if($post->tags->isNotEmpty())
                <div class="flex flex-wrap gap-2">
                    @foreach($post->tags as $tag)
                    <span class="px-2 py-0.5 rounded-full bg-gray-100 text-gray-600 text-xs">{{ $tag->name }}</span>
                    @endforeach
                </div>
                @endif
            </div>
        </header>

        <!-- Featured image -->
        @if($post->featured_image)
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            <div class="rounded-2xl overflow-hidden shadow-lg aspect-video bg-gray-100">
                <img src="{{ media_url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
            </div>
        </div>
        @endif

        <!-- Content -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
            <div class="rich-content prose prose-lg prose-pink max-w-none prose-img:rounded-xl">
                {!! $post->content !!}
            </div>
        </div>

        <!-- Gallery (multiple photos) -->
        @if($post->images->isNotEmpty())
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-14">
            <h2 class="text-2xl font-bold heading-font text-gray-900 mb-6">Photos</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($post->images as $img)
                <div class="rounded-xl overflow-hidden border border-gray-100 shadow-sm aspect-square bg-gray-50">
                    <img src="{{ media_url($img->path) }}" alt="{{ $img->caption ?: 'Article image' }}" class="w-full h-full object-cover">
                    @if($img->caption)
                    <p class="p-2 text-sm text-gray-600 bg-white">{{ $img->caption }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Related articles -->
        @if($related->isNotEmpty())
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 pt-12 border-t border-gray-200">
            <h2 class="text-2xl font-bold heading-font text-gray-900 mb-6">Related Articles</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                @foreach($related as $rel)
                <a href="{{ route('blog.show', $rel->slug) }}" class="group block">
                    <div class="aspect-video rounded-xl overflow-hidden bg-gray-100 mb-3">
                        @if($rel->featured_image)
                        <img src="{{ media_url($rel->featured_image) }}" alt="{{ $rel->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                        <div class="w-full h-full flex items-center justify-center text-pink-300"><svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg></div>
                        @endif
                    </div>
                    <h3 class="font-bold text-gray-900 group-hover:text-pink-600 transition-colors line-clamp-2">{{ $rel->title }}</h3>
                    <time class="text-xs text-gray-500 mt-1 block">{{ $rel->published_at?->format('M j, Y') }}</time>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </article>

    <!-- CTA -->
    <section class="py-16 bg-gradient-to-r from-pink-500 to-pink-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold heading-font text-white mb-6">Need personalised care?</h2>
            <p class="text-xl text-pink-100 mb-8">Book a consultation with our pelvic health specialists.</p>
            <a href="{{ route('book-appointment') }}" class="inline-block bg-white text-pink-600 px-8 py-4 rounded-full font-semibold hover:bg-pink-50 transition shadow-xl">Book Appointment</a>
        </div>
    </section>
@endsection
