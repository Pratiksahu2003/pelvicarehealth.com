@extends('layouts.admin')

@section('title', 'Blog Management')
@section('page-title', 'Blog Management')
@section('page-subtitle', 'Manage, create, and monitor your blog posts effectively.')

@section('content')
<div class="space-y-8">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Posts -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 relative overflow-hidden group">
            <div class="absolute right-0 top-0 h-full w-24 bg-gradient-to-l from-indigo-50 to-transparent opacity-50 group-hover:w-32 transition-all"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-indigo-50 rounded-xl text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                    </div>
                </div>
                <div>
                   <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Posts</p>
                   <h3 class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['total'] }}</h3>
                   <p class="text-xs text-indigo-600 mt-2 font-medium flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        All time content
                   </p>
                </div>
            </div>
        </div>

        <!-- Published -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 relative overflow-hidden group hover:border-emerald-100">
             <div class="absolute right-0 top-0 h-full w-24 bg-gradient-to-l from-emerald-50 to-transparent opacity-50 group-hover:w-32 transition-all"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                     <div class="p-3 bg-emerald-50 rounded-xl text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div>
                   <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Published</p>
                   <h3 class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['published'] }}</h3>
                    <p class="text-xs text-emerald-600 mt-2 font-medium flex items-center">
                        Active & Live
                   </p>
                </div>
            </div>
        </div>

        <!-- Drafts -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 relative overflow-hidden group hover:border-amber-100">
             <div class="absolute right-0 top-0 h-full w-24 bg-gradient-to-l from-amber-50 to-transparent opacity-50 group-hover:w-32 transition-all"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                     <div class="p-3 bg-amber-50 rounded-xl text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                </div>
                <div>
                   <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Drafts</p>
                   <h3 class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['draft'] }}</h3>
                    <p class="text-xs text-amber-600 mt-2 font-medium flex items-center">
                        Work in progress
                   </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200/60 overflow-hidden">
        
        <!-- Header & Actions -->
        <div class="p-5 border-b border-gray-100 bg-gray-50/30">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <h3 class="text-lg font-bold text-gray-900 heading-font">All Posts</h3>
                
                <a href="{{ route('admin.blog.create') }}" class="group inline-flex items-center px-5 py-2.5 bg-gray-900 text-white text-sm font-medium rounded-xl hover:bg-gray-800 transition-all duration-200 shadow-lg shadow-gray-900/20 focus:ring-4 focus:ring-gray-200">
                    <svg class="w-5 h-5 mr-2 transition-transform group-hover:rotate-90 duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Article
                </a>
            </div>

            <!-- Enhanced Filters -->
            <form method="GET" action="{{ route('admin.blog.index') }}" class="mt-6 grid grid-cols-1 md:grid-cols-12 gap-4">
                <div class="md:col-span-5 relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-pink-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           class="block w-full pl-10 pr-3 py-2.5 bg-white border border-gray-200 rounded-xl leading-5 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition-all duration-200 sm:text-sm" 
                           placeholder="Search by title...">
                </div>

                <div class="md:col-span-3">
                    <select name="category" class="block w-full py-2.5 pl-3 pr-10 bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 sm:text-sm transition-all">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-2">
                    <select name="status" class="block w-full py-2.5 pl-3 pr-10 bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 sm:text-sm transition-all">
                        <option value="">All Status</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>

                <div class="md:col-span-2 flex gap-2">
                    <button type="submit" class="flex-1 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 hover:text-gray-900 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm font-medium shadow-sm">
                        Apply
                    </button>
                    @if(request()->hasAny(['search', 'category', 'status']))
                    <a href="{{ route('admin.blog.index') }}" class="px-4 py-2.5 text-red-600 bg-red-50 hover:bg-red-100 rounded-xl transition-colors duration-200 text-sm font-medium flex items-center justify-center" title="Clear Filters">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Article</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Category</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Author</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($posts as $post)
                    <tr class="group hover:bg-purple-50/30 transition-colors duration-200">
                        <td class="px-6 py-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-16 w-24 relative rounded-lg overflow-hidden bg-gray-100 border border-gray-200 group-hover:border-purple-200 transition-colors">
                                    @if($post->featured_image)
                                    <img class="h-full w-full object-cover transform group-hover:scale-110 transition-transform duration-500" src="{{ media_url($post->featured_image) }}" alt="{{ $post->title }}">
                                    @else
                                    <div class="flex items-center justify-center h-full w-full text-gray-300">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    @endif
                                </div>
                                <div class="ml-4 max-w-sm">
                                    <div class="text-sm font-bold text-gray-900 group-hover:text-pink-600 transition-colors line-clamp-2">{{ $post->title }}</div>
                                    <div class="flex items-center gap-2 mt-1.5">
                                        <div class="flex items-center text-xs text-gray-500">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            {{ $post->created_at->format('M d, Y') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($post->category)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-100">
                                {{ $post->category->name }}
                            </span>
                            @else
                            <span class="text-gray-400 text-xs italic">Uncategorized</span>
                            @endif
                            
                            @if($post->tags->isNotEmpty())
                                <div class="flex flex-wrap gap-1 mt-2">
                                    @foreach($post->tags->take(2) as $tag)
                                        <span class="text-[10px] text-gray-500 bg-gray-100 px-1.5 py-0.5 rounded">#{{ $tag->name }}</span>
                                    @endforeach
                                    @if($post->tags->count() > 2)
                                        <span class="text-[10px] text-gray-400">+{{ $post->tags->count() - 2 }}</span>
                                    @endif
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-gradient-to-tr from-pink-400 to-orange-400 flex items-center justify-center text-white text-xs font-bold shadow-sm">
                                    {{ substr($post->author->name, 0, 1) }}
                                </div>
                                <div class="ml-2.5">
                                    <p class="text-sm font-medium text-gray-900">{{ $post->author->name }}</p>
                                    <p class="text-xs text-gray-500">{{ auth()->user()->id == $post->author->id ? '(You)' : '' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($post->is_published)
                                <div class="flex items-center">
                                    <div class="h-2.5 w-2.5 rounded-full bg-emerald-500 mr-2 animate-pulse"></div>
                                    <span class="text-sm text-emerald-700 font-medium">Published</span>
                                </div>
                            @else
                                <div class="flex items-center">
                                    <div class="h-2.5 w-2.5 rounded-full bg-amber-400 mr-2"></div>
                                    <span class="text-sm text-amber-700 font-medium">Draft</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.blog.show', $post->id) }}" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-all" title="View details">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                                <a href="{{ route('admin.blog.edit', $post->id) }}" class="p-2 text-indigo-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all" title="Edit post">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('admin.blog.destroy', $post->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Delete post">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <div class="bg-gray-50 rounded-full p-6 mb-4">
                                    <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">No posts found</h3>
                                <p class="text-gray-500 mb-6 max-w-sm mx-auto">Get started by creating your first blog post to share insights and updates.</p>
                                <a href="{{ route('admin.blog.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl shadow-sm text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition-all">
                                    Create Post
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($posts->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $posts->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
