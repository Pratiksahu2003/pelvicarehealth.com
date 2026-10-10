@extends('layouts.admin')

@section('title', 'Content Management')
@section('page-title', 'Content Management')
@section('page-subtitle', 'Manage static pages and website sections')

@section('content')
<div class="space-y-6">
    <!-- Actions & Filters -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-5 mb-6">
            <h2 class="text-lg font-bold text-gray-900">All Content</h2>
            <a href="{{ route('admin.content.create') }}" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-pink-500 to-pink-600 text-white text-sm font-medium rounded-lg hover:from-pink-600 hover:to-pink-700 transition shadow-md focus:ring-4 focus:ring-pink-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Create New Content
            </a>
        </div>

        <form method="GET" action="{{ route('admin.content.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4">
            <!-- Search -->
            <div class="md:col-span-5 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-pink-500 focus:border-pink-500 sm:text-sm transition duration-150 ease-in-out" 
                       placeholder="Search by title or slug...">
            </div>

            <!-- Type Filter -->
            <div class="md:col-span-3">
                <select name="type" class="block w-full py-2.5 pl-3 pr-10 border border-gray-300 rounded-lg leading-5 bg-white focus:outline-none focus:ring-1 focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                    <option value="">All Types</option>
                    <option value="page" {{ request('type') == 'page' ? 'selected' : '' }}>Page</option>
                    <option value="section" {{ request('type') == 'section' ? 'selected' : '' }}>Section</option>
                    <option value="blog" {{ request('type') == 'blog' ? 'selected' : '' }}>Blog Post (Legacy)</option>
                </select>
            </div>

            <!-- Status Filter -->
            <div class="md:col-span-2">
                <select name="status" class="block w-full py-2.5 pl-3 pr-10 border border-gray-300 rounded-lg leading-5 bg-white focus:outline-none focus:ring-1 focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                    <option value="">All Status</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>

            <!-- Filter Actions -->
            <div class="md:col-span-2 flex gap-2">
                <button type="submit" class="flex-1 bg-gray-900 text-white px-4 py-2.5 rounded-lg hover:bg-gray-800 transition text-sm font-medium">
                    Filter
                </button>
                @if(request()->hasAny(['search', 'type', 'status']))
                <a href="{{ route('admin.content.index') }}" class="px-4 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition text-sm font-medium flex items-center justify-center">
                    Clear
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Content Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Title / Slug</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Type</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Last Updated</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm">
                    @forelse($contents as $content)
                    <tr class="group hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-gray-900 group-hover:text-pink-600 transition-colors">{{ $content->title }}</span>
                                <span class="text-xs text-gray-500 font-mono mt-1">/{{ $content->slug }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium 
                                {{ $content->type == 'page' ? 'bg-blue-100 text-blue-800' : 
                                   ($content->type == 'section' ? 'bg-gray-100 text-gray-800' : 'bg-purple-100 text-purple-800') }}">
                                {{ ucfirst($content->type) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-xs text-gray-900">{{ $content->updated_at->format('M d, Y') }}</div>
                            <div class="text-xs text-gray-500">by {{ $content->updater ? $content->updater->name : ($content->creator ? $content->creator->name : 'Unknown') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($content->is_published)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                    Published
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                    <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5"></span>
                                    Draft
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-3">
                                <a href="{{ route('admin.content.edit', $content->id) }}" class="text-indigo-600 hover:text-indigo-900 transition" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('admin.content.destroy', $content->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this content? This action cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 transition" title="Delete">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center max-w-md mx-auto">
                                <div class="bg-gray-50 rounded-full p-4 mb-4">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">No content found</h3>
                                <p class="text-gray-500 text-sm mb-6">Create pages and sections to manage your site's dynamic content.</p>
                                <a href="{{ route('admin.content.create') }}" class="bg-pink-600 text-white px-6 py-2.5 rounded-lg hover:bg-pink-700 transition font-medium shadow-md">
                                    Create Content
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($contents->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{ $contents->links() }}
        </div>
        @endif
    </div>
</div>

@if(session('success'))
<div class="fixed bottom-6 right-6 z-50 animate-fade-in-up" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
    <div class="bg-gray-900 text-white px-6 py-4 rounded-lg shadow-2xl flex items-center">
        <svg class="w-6 h-6 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <div>
            <h4 class="font-bold text-sm">Success</h4>
            <p class="text-sm opacity-90">{{ session('success') }}</p>
        </div>
        <button @click="show = false" class="ml-6 text-gray-400 hover:text-white">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>
</div>
@endif
@endsection
