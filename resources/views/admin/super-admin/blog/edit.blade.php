@extends('layouts.admin')

@section('title', 'Edit Blog Post')
@section('page-title', 'Edit Blog Post')
@section('page-subtitle', 'Refine and update your content.')

@section('content')
<div class="max-w-6xl mx-auto">
    <form action="{{ route('admin.blog.update', $post->id) }}" method="POST" enctype="multipart/form-data" id="editPostForm">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Title & Content Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-8">
                    <!-- Title -->
                    <div class="group">
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2 group-focus-within:text-pink-600 transition-colors">
                            Post Title <span class="text-pink-500">*</span>
                        </label>
                        <input type="text" name="title" id="title" required 
                               value="{{ old('title', $post->title) }}"
                               class="w-full rounded-xl border-gray-200 shadow-sm focus:border-pink-500 focus:ring-pink-500 focus:ring-2 text-xl font-medium placeholder-gray-300 transition-all p-4"
                               placeholder="Enter an engaging title...">
                        @error('title')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Excerpt -->
                    <div class="group">
                        <label for="excerpt" class="block text-sm font-semibold text-gray-700 mb-2 group-focus-within:text-pink-600 transition-colors">
                            Excerpt
                            <span class="text-gray-400 font-normal ml-1 text-xs">(SEO Summary)</span>
                        </label>
                        <textarea name="excerpt" id="excerpt" rows="3" 
                                  class="w-full rounded-xl border-gray-200 shadow-sm focus:border-pink-500 focus:ring-pink-500 focus:ring-2 placeholder-gray-300 transition-all p-4 resize-none text-gray-600 leading-relaxed" 
                                  placeholder="Brief summary for search results and cards...">{{ old('excerpt', $post->excerpt) }}</textarea>
                        <div class="flex justify-between mt-2">
                             <p class="text-xs text-gray-400">Ideally 150-160 characters for best SEO results.</p>
                             <p class="text-xs text-gray-400"><span id="excerpt-count">{{ strlen(old('excerpt', $post->excerpt)) }}</span>/160</p>
                        </div>
                        @error('excerpt')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- Content (TinyMCE) -->
                    <div class="group">
                        <label for="content" class="block text-sm font-semibold text-gray-700 mb-2 group-focus-within:text-pink-600 transition-colors">
                            Content <span class="text-pink-500">*</span>
                        </label>
                        <x-quill-editor name="content" id="content" :value="old('content', $post->content)" height="500px" />
                        @error('content')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Right Column: Settings & Meta -->
            <div class="space-y-6">
                <!-- Publish Action Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24 z-10">
                    <div class="flex items-center space-x-2 mb-6 border-b border-gray-50 pb-4">
                        <div class="p-2 bg-pink-50 rounded-lg text-pink-600">
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 heading-font">Publishing</h3>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="flex items-start bg-gray-50 p-4 rounded-xl">
                            <div class="flex items-center h-5">
                                <input type="checkbox" name="is_published" id="is_published" value="1" 
                                       {{ old('is_published', $post->is_published) ? 'checked' : '' }}
                                       class="w-5 h-5 rounded border-gray-300 text-pink-600 focus:ring-pink-500 transition-colors cursor-pointer">
                            </div>
                            <div class="ml-3">
                                <label for="is_published" class="font-semibold text-gray-900 cursor-pointer">Published</label>
                                <p class="text-xs text-gray-500 mt-1">Uncheck to revert to draft.</p>
                            </div>
                        </div>

                        @if($post->published_at)
                        <div class="text-xs text-gray-500 bg-gray-50 p-3 rounded-xl border border-gray-100 flex items-center justify-between">
                            <span>Originally published:</span>
                            <span class="font-bold text-gray-700">{{ $post->published_at->format('M d, Y') }}</span>
                        </div>
                        @endif

                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('admin.blog.index') }}" class="w-full bg-white border border-gray-200 text-gray-700 px-4 py-3 rounded-xl hover:bg-gray-50 hover:text-gray-900 transition font-medium text-center shadow-sm">
                                Cancel
                            </a>
                            <button type="submit" class="w-full bg-gray-900 text-white px-4 py-3 rounded-xl hover:bg-gray-800 transition shadow-lg shadow-gray-900/20 font-medium flex items-center justify-center">
                                Update
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Category & Tags Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center space-x-2 mb-6 border-b border-gray-50 pb-4">
                         <div class="p-2 bg-indigo-50 rounded-lg text-indigo-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 heading-font">Organization</h3>
                    </div>
                    
                    <div class="space-y-6">
                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                Category
                            </label>
                            <div class="relative">
                                <select name="category_id" id="category_id" 
                                        class="w-full rounded-xl border-gray-200 shadow-sm focus:border-pink-500 focus:ring-pink-500 appearance-none bg-white p-3 pr-10">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                            {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tags -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Tags
                            </label>
                            <div class="max-h-48 overflow-y-auto border border-gray-200 rounded-xl p-2 bg-gray-50 space-y-1 custom-scrollbar">
                                @if($tags->count() > 0)
                                    @foreach($tags as $tag)
                                    <label class="flex items-center group cursor-pointer hover:bg-white p-2 rounded-lg transition-all border border-transparent hover:border-gray-100 hover:shadow-sm">
                                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" 
                                               {{ in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())) ? 'checked' : '' }}
                                               class="w-4 h-4 rounded border-gray-300 text-pink-600 focus:ring-pink-500 transition-colors">
                                        <span class="ml-3 text-sm text-gray-600 group-hover:text-gray-900 font-medium transition">{{ $tag->name }}</span>
                                    </label>
                                    @endforeach
                                @else
                                    <p class="text-xs text-gray-400 text-center italic py-4">No tags available.</p>
                                @endif
                            </div>
                            <p class="text-[10px] text-gray-400 mt-2 text-right">Hold Ctrl/Cmd to select multiple</p>
                            @error('tags')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Featured Image Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center space-x-2 mb-6 border-b border-gray-50 pb-4">
                         <div class="p-2 bg-purple-50 rounded-lg text-purple-600">
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 heading-font">Featured Image</h3>
                    </div>
                    
                    <div class="space-y-4">
                        @if($post->featured_image)
                        <div id="current-image-container" class="relative group rounded-xl overflow-hidden shadow-sm aspect-video">
                            <img src="{{ media_url($post->featured_image) }}" alt="Current featured image" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-200">
                                <span class="text-white text-sm font-medium bg-black/50 px-3 py-1 rounded-full backdrop-blur-sm">Current Image</span>
                            </div>
                        </div>
                        @else
                        <div class="bg-gray-50 rounded-xl p-4 text-center text-xs text-gray-400 italic">
                            No image currently selected
                        </div>
                        @endif

                        <div class="relative group">
                            <div id="drop-zone" class="border-2 border-dashed border-gray-300 rounded-xl p-8 flex flex-col items-center justify-center bg-gray-50/50 hover:bg-gray-50 hover:border-pink-400 transition-all duration-300 cursor-pointer relative overflow-hidden h-32">
                                <input type="file" name="featured_image" id="featured_image" accept="image/*" 
                                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                       onchange="previewImage(event)">
                                
                                <div class="text-center transition-opacity duration-300" id="upload-placeholder">
                                    <p class="text-sm text-gray-700 font-semibold mb-1">Update Image</p>
                                    <p class="text-xs text-gray-500">Click or drop new file</p>
                                </div>
                                
                                <img id="preview" src="" alt="Preview" class="hidden absolute inset-0 w-full h-full object-cover rounded-xl z-0">
                                
                                <div id="preview-overlay" class="hidden absolute inset-0 bg-black/40 z-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <p class="text-white text-sm font-medium">Change Selection</p>
                                </div>
                            </div>
                        </div>
                        
                        <button type="button" id="remove-image" onclick="removeImage()" class="w-full hidden text-sm text-red-600 hover:text-white border border-red-200 hover:bg-red-600 rounded-xl py-2.5 transition-all duration-200">
                             Discard New Selection
                        </button>

                        @error('featured_image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Gallery Images -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center space-x-2 mb-6 border-b border-gray-50 pb-4">
                        <div class="p-2 bg-amber-50 rounded-lg text-amber-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 16a2 2 0 002-2v-2a2 2 0 00-2-2h-2M6 12h12"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 heading-font">Gallery Images</h3>
                    </div>
                    @if($post->images->isNotEmpty())
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-4">
                        @foreach($post->images as $img)
                        <div class="relative group rounded-xl overflow-hidden border border-gray-200 aspect-square">
                            <img src="{{ media_url($img->path) }}" alt="" class="w-full h-full object-cover">
                            <button type="button" onclick="deleteGalleryImage({{ $post->id }}, {{ $img->id }}, this)"
                                    class="absolute top-2 right-2 w-8 h-8 bg-red-500 text-white rounded-lg opacity-0 group-hover:opacity-100 transition flex items-center justify-center hover:bg-red-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    <p class="text-sm text-gray-600 mb-2">Add more images (optional). Multiple selection allowed.</p>
                    <input type="file" name="gallery_images[]" id="gallery_images" accept="image/*" multiple
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100">
                </div>

                <!-- SEO -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center space-x-2 mb-6 border-b border-gray-50 pb-4">
                        <div class="p-2 bg-emerald-50 rounded-lg text-emerald-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 heading-font">SEO</h3>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label for="meta_title" class="block text-sm font-semibold text-gray-700 mb-1">Meta title</label>
                            <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $post->meta_title) }}" maxlength="255"
                                   class="w-full rounded-xl border-gray-200 shadow-sm focus:border-pink-500 focus:ring-pink-500 p-3 text-sm"
                                   placeholder="Leave blank to use post title">
                        </div>
                        <div>
                            <label for="meta_description" class="block text-sm font-semibold text-gray-700 mb-1">Meta description</label>
                            <textarea name="meta_description" id="meta_description" rows="2" maxlength="512"
                                      class="w-full rounded-xl border-gray-200 shadow-sm focus:border-pink-500 focus:ring-pink-500 p-3 text-sm resize-none"
                                      placeholder="155–160 chars for search results">{{ old('meta_description', $post->meta_description) }}</textarea>
                        </div>
                        <div>
                            <label for="meta_keywords" class="block text-sm font-semibold text-gray-700 mb-1">Meta keywords (comma-separated)</label>
                            <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $post->meta_keywords) }}" maxlength="255"
                                   class="w-full rounded-xl border-gray-200 shadow-sm focus:border-pink-500 focus:ring-pink-500 p-3 text-sm"
                                   placeholder="e.g. pelvic health, women health">
                        </div>
                        <div>
                            <label for="og_image" class="block text-sm font-semibold text-gray-700 mb-1">OG image (social share)</label>
                            @if($post->og_image)
                            <div class="mb-2"><img src="{{ media_url($post->og_image) }}" alt="OG" class="h-16 w-auto object-cover rounded border"></div>
                            @endif
                            <input type="file" name="og_image" id="og_image" accept="image/*"
                                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-gray-100 file:text-gray-700">
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
        // Excerpt Counter
        const excerpt = document.getElementById('excerpt');
        const countDisplay = document.getElementById('excerpt-count');
        const updateCount = () => {
            if(excerpt) {
                countDisplay.textContent = excerpt.value.length;
                if(excerpt.value.length > 160) {
                    countDisplay.classList.add('text-red-500', 'font-bold');
                } else {
                    countDisplay.classList.remove('text-red-500', 'font-bold');
                }
            }
        };
        if(excerpt) {
            excerpt.addEventListener('input', updateCount);
            updateCount(); // Init
        }

        // Drag and Drop Effects
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('featured_image');
        if (dropZone && fileInput) {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
            });
            function preventDefaults(e) { e.preventDefault(); e.stopPropagation(); }
            ['dragenter', 'dragover'].forEach(eventName => { dropZone.addEventListener(eventName, () => dropZone.classList.add('border-pink-500', 'bg-pink-50'), false); });
            ['dragleave', 'drop'].forEach(eventName => { dropZone.addEventListener(eventName, () => dropZone.classList.remove('border-pink-500', 'bg-pink-50'), false); });
            dropZone.addEventListener('drop', function(e) {
                var files = e.dataTransfer.files;
                fileInput.files = files;
                previewImage({ target: { files: files } });
            }, false);
        }
    });

    // Image Preview Function
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview');
        const placeholder = document.getElementById('upload-placeholder');
        const removeBtn = document.getElementById('remove-image');
        const overlay = document.getElementById('preview-overlay');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
                removeBtn.classList.remove('hidden');
                overlay.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

    function removeImage() {
        const fileInput = document.getElementById('featured_image');
        const preview = document.getElementById('preview');
        const placeholder = document.getElementById('upload-placeholder');
        const removeBtn = document.getElementById('remove-image');
        const overlay = document.getElementById('preview-overlay');
        
        fileInput.value = '';
        preview.src = '';
        preview.classList.add('hidden');
        placeholder.classList.remove('hidden');
        removeBtn.classList.add('hidden');
        overlay.classList.add('hidden');
    }

    function deleteGalleryImage(postId, imageId, btn) {
        if (!confirm('Remove this image from the gallery?')) return;
        var csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        fetch('{{ url("admin/blog") }}/' + postId + '/images/' + imageId, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
        }).then(function(r) {
            if (r.ok) btn.closest('.relative.group').remove();
        });
    }
</script>
@endpush
