@extends('layouts.admin')

@section('title', 'Create Content')
@section('page-title', 'Create New Content')
@section('page-subtitle', 'Add a new page, section, or dynamic content block')

@section('content')
<div class="max-w-7xl mx-auto">
    <form action="{{ route('admin.content.store') }}" method="POST" id="createContentForm">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Title & Content Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                            Title <span class="text-pink-500">*</span>
                        </label>
                        <input type="text" name="title" id="title" required 
                               value="{{ old('title') }}"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg placeholder-gray-400 transition-colors"
                               placeholder="e.g. About Us, Terms of Service...">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Meta Description / Summary -->
                    <div>
                        <label for="meta_description" class="block text-sm font-semibold text-gray-700 mb-2">
                            Meta Description / Summary
                            <span class="text-gray-400 font-normal ml-1">(Optional)</span>
                        </label>
                        <textarea name="meta_description" id="meta_description" rows="3" 
                                  class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 placeholder-gray-400 transition-colors resize-none" 
                                  placeholder="Brief summary for SEO or section description...">{{ old('meta_description') }}</textarea>
                        @error('meta_description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">
                            Content <span class="text-pink-500">*</span>
                        </label>
                        <x-quill-editor 
                            name="content" 
                            id="content" 
                            :value="old('content')" 
                            height="500px"
                            placeholder="Write your content here..."
                        />
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- SEO - Meta Title -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        SEO Settings
                    </h3>
                    <div>
                        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">
                            Meta Title
                        </label>
                        <input type="text" name="meta_title" id="meta_title" 
                               value="{{ old('meta_title') }}"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500"
                               placeholder="Custom title for search engines (defaults to Title)">
                        <p class="mt-1 text-xs text-gray-500">Leave blank to use the standard page title.</p>
                        @error('meta_title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Right Column: Settings -->
            <div class="space-y-6">
                <!-- Publish Action Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-24">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Publishing
                    </h3>
                    
                    <div class="space-y-4">
                        <!-- Content Type -->
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                Content Type <span class="text-pink-500">*</span>
                            </label>
                            <select name="type" id="type" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                                <option value="page" {{ old('type') == 'page' ? 'selected' : '' }}>Page</option>
                                <option value="section" {{ old('type') == 'section' ? 'selected' : '' }}>Section</option>
                                <option value="blog" {{ old('type') == 'blog' ? 'selected' : '' }}>Blog Block</option>
                            </select>
                            <p class="mt-1 text-xs text-gray-500">Pages verify unique URLs. Sections are for embedded content.</p>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Slug -->
                        <div>
                            <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                                Slug / Identifier <span class="text-pink-500">*</span>
                            </label>
                            <input type="text" name="slug" id="slug" required 
                                   value="{{ old('slug') }}"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 font-mono text-sm"
                                   placeholder="about-us">
                            <p class="mt-1 text-xs text-gray-500">Unique identifier for URL or retrieval.</p>
                            @error('slug')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Published Checkbox -->
                        <div class="flex items-start pt-2">
                            <div class="flex items-center h-5">
                                <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}
                                       class="w-4 h-4 rounded border-gray-300 text-pink-600 focus:ring-pink-500 transition-colors">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="is_published" class="font-medium text-gray-700">Publish Immediately</label>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-gray-100 flex flex-col gap-3">
                            <button type="submit" class="w-full bg-gradient-to-r from-pink-500 to-pink-600 text-white px-4 py-2.5 rounded-lg hover:from-pink-600 hover:to-pink-700 transition shadow-md font-medium flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                Save Content
                            </button>
                            <a href="{{ route('admin.content.index') }}" class="w-full bg-gray-100 text-gray-700 px-4 py-2.5 rounded-lg hover:bg-gray-200 transition font-medium text-center">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-generate slug from title
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');
        
        titleInput.addEventListener('keyup', function() {
            if (slugInput.dataset.manual === 'true') return;
            
            const slug = titleInput.value.toLowerCase()
                .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/--+/g, '-')
                .trim();
            slugInput.value = slug;
        });

        slugInput.addEventListener('change', function() {
            if (this.value) {
                this.dataset.manual = 'true';
            }
        });
    });
</script>
@endpush
