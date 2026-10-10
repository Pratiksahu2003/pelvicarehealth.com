@extends('layouts.admin')

@section('title', 'Edit Service Subcategory')
@section('page-title', 'Edit Service Subcategory')
@section('page-subtitle', 'Update: ' . $subcategory->name)

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.service-subcategories.update', $subcategory->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-6">
            <div>
                <label for="service_category_id" class="block text-sm font-semibold text-gray-700 mb-2">Category <span class="text-pink-500">*</span></label>
                <select name="service_category_id" id="service_category_id" required class="w-full rounded-xl border-gray-200 shadow-sm focus:border-pink-500 focus:ring-pink-500 p-3">
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('service_category_id', $subcategory->service_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('service_category_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Name <span class="text-pink-500">*</span></label>
                <input type="text" name="name" id="name" required value="{{ old('name', $subcategory->name) }}"
                       class="w-full rounded-xl border-gray-200 shadow-sm focus:border-pink-500 focus:ring-pink-500 p-3"
                       placeholder="e.g. Stress urinary incontinence">
                @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description (optional)</label>
                <p class="text-xs text-gray-500 mb-2">Detail about this treatment or condition. Supports headings, lists, and images.</p>
                <x-quill-editor name="description" id="description" :value="old('description', $subcategory->description)" height="320px" />
                @error('description')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Image (optional)</label>
                @if($subcategory->image)
                <div class="mb-3 flex items-center gap-4">
                    <img src="{{ media_url($subcategory->image) }}" alt="{{ $subcategory->name }}" class="h-24 w-32 object-cover rounded-lg border border-gray-200">
                    <span class="text-sm text-gray-500">Current image. Upload a new file to replace.</span>
                </div>
                @endif
                <input type="file" name="image" id="image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100">
                @error('image')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="sort_order" class="block text-sm font-semibold text-gray-700 mb-2">Sort order</label>
                    <input type="number" name="sort_order" id="sort_order" min="0" value="{{ old('sort_order', $subcategory->sort_order) }}"
                           class="w-full rounded-xl border-gray-200 shadow-sm focus:border-pink-500 focus:ring-pink-500 p-3">
                    @error('sort_order')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div class="flex items-end pb-3">
                    <div class="flex items-start bg-gray-50 p-4 rounded-xl w-full">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $subcategory->is_active) ? 'checked' : '' }}
                               class="w-5 h-5 rounded border-gray-300 text-pink-600 focus:ring-pink-500 mt-0.5">
                        <label for="is_active" class="ml-3 font-medium text-gray-900">Active (visible on site)</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap gap-3">
            <button type="submit" class="inline-flex items-center px-6 py-3 bg-pink-600 text-white font-medium rounded-xl hover:bg-pink-700 transition shadow-lg focus:ring-4 focus:ring-pink-200">
                Update Subcategory
            </button>
            <a href="{{ route('admin.service-subcategories.index') }}" class="inline-flex items-center px-6 py-3 bg-white border border-gray-200 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
