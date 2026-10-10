@extends('layouts.admin')

@section('title', 'Edit Content')
@section('page-title', 'Edit Content')
@section('page-subtitle', 'Update page, section, or dynamic content block')

@section('content')
<div class="max-w-7xl mx-auto">
    <form action="{{ route('admin.content.update', $content->id) }}" method="POST" id="editContentForm">
        @csrf
        @method('PUT')
        
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
                               value="{{ old('title', $content->title) }}"
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
                                  placeholder="Brief summary for SEO or section description...">{{ old('meta_description', $content->meta_description) }}</textarea>
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
                            :value="old('content', $content->content)" 
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
                               value="{{ old('meta_title', $content->meta_title) }}"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500"
                               placeholder="Custom title for search engines">
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
                                <option value="page" {{ old('type', $content->type) == 'page' ? 'selected' : '' }}>Page</option>
                                <option value="section" {{ old('type', $content->type) == 'section' ? 'selected' : '' }}>Section</option>
                                <option value="blog" {{ old('type', $content->type) == 'blog' ? 'selected' : '' }}>Blog Block</option>
                            </select>
                            <p class="mt-1 text-xs text-gray-500">Caution: Changing type may affect how this content is displayed.</p>
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
                                   value="{{ old('slug', $content->slug) }}"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 font-mono text-sm"
                                   placeholder="about-us">
                            <p class="mt-1 text-xs text-gray-500">Unique identifier. Changing this may break existing links.</p>
                            @error('slug')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Published Checkbox -->
                        <div class="flex items-start pt-2">
                            <div class="flex items-center h-5">
                                <input type="checkbox" name="is_published" id="is_published" value="1" 
                                       {{ old('is_published', $content->is_published) ? 'checked' : '' }}
                                       class="w-4 h-4 rounded border-gray-300 text-pink-600 focus:ring-pink-500 transition-colors">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="is_published" class="font-medium text-gray-700">Published</label>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-gray-100 flex flex-col gap-3">
                            <button type="submit" class="w-full bg-gradient-to-r from-pink-500 to-pink-600 text-white px-4 py-2.5 rounded-lg hover:from-pink-600 hover:to-pink-700 transition shadow-md font-medium flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                Update Content
                            </button>
                            <a href="{{ route('admin.content.index') }}" class="w-full bg-gray-100 text-gray-700 px-4 py-2.5 rounded-lg hover:bg-gray-200 transition font-medium text-center">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Info Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                    <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Information</h4>
                    <dl class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <dt class="text-gray-500">Created At:</dt>
                            <dd class="text-gray-900 font-medium">{{ $content->created_at->format('M d, Y H:i') }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-500">Last Updated:</dt>
                            <dd class="text-gray-900 font-medium">{{ $content->updated_at->format('M d, Y H:i') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-generate slug (only if empty to avoid accidental overwrites)
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');
        
        // On edit, we typically don't auto-update slug unless explicitly cleared or requested
        // So we keep it simple here.
    });
</script>
@endpush
