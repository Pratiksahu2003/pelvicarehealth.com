@extends('layouts.app')

@section('title', 'Blog & Articles - Pelvicare Women\'s Health Physiotherapy')
@section('meta_description', 'Informative articles on pelvic health, women\'s physiotherapy, and wellness. Expert insights from Pelvicare.')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-pink-50 via-white to-pink-100 py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold heading-font text-gray-900 text-center mb-4">
                Blog & Articles
            </h1>
            <p class="text-xl text-gray-700 text-center max-w-3xl mx-auto">
                Informative content on pelvic health, wellness, and women's physiotherapy
            </p>
        </div>
    </section>

    <!-- Filters & Grid -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($categories->isNotEmpty())
            <div class="flex flex-wrap gap-2 justify-center mb-10">
                <a href="{{ route('blog.index') }}" class="px-4 py-2 rounded-full text-sm font-medium transition {{ !request('category') ? 'bg-pink-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    All
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('blog.index', ['category' => $cat->id]) }}" class="px-4 py-2 rounded-full text-sm font-medium transition {{ request('category') == $cat->id ? 'bg-pink-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    {{ $cat->name }}
                </a>
                @endforeach
            </div>
            @endif

            @if($posts->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts as $post)
                <article class="group bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col">
                    <a href="{{ route('blog.show', $post->slug) }}" class="block overflow-hidden aspect-[16/10] bg-gray-100">
                        @if($post->featured_image)
                        <img src="{{ media_url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-pink-100 to-pink-50 text-pink-400">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        </div>
                        @endif
                    </a>
                    <div class="p-6 flex-1 flex flex-col">
                        @if($post->category)
                        <a href="{{ route('blog.index', ['category' => $post->category->id]) }}" class="inline-block text-xs font-semibold text-pink-600 uppercase tracking-wide mb-2">{{ $post->category->name }}</a>
                        @endif
                        <h2 class="text-xl font-bold heading-font text-gray-900 mb-2 line-clamp-2 group-hover:text-pink-600 transition-colors">
                            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                        </h2>
                        @if($post->excerpt)
                        <p class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-4 flex-1">{{ Str::limit(strip_tags($post->excerpt), 120) }}</p>
                        @else
                        <p class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-4 flex-1">{{ Str::limit(strip_tags($post->content), 120) }}</p>
                        @endif
                        <div class="flex items-center justify-between text-xs text-gray-500 pt-2 border-t border-gray-100">
                            <time datetime="{{ $post->published_at?->toIso8601String() }}">{{ $post->published_at?->format('M j, Y') }}</time>
                            <span class="text-pink-600 font-medium">Read more →</span>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            @if($posts->hasPages())
            <div class="mt-12 flex justify-center">{{ $posts->withQueryString()->links() }}</div>
            @endif
            @else
            <div class="text-center py-20 bg-gray-50 rounded-2xl border border-gray-200">
                <p class="text-xl text-gray-600">No articles yet. Check back soon.</p>
            </div>
            @endif
        </div>
    </section>
@endsection
