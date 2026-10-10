@extends('layouts.admin')

@section('title', 'Add Service Category')
@section('page-title', 'Add Service Category')
@section('page-subtitle', 'Create a new service category for the Services page')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.service-categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-6">
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Name <span class="text-pink-500">*</span></label>
                <input type="text" name="name" id="name" required value="{{ old('name') }}"
                       class="w-full rounded-xl border-gray-200 shadow-sm focus:border-pink-500 focus:ring-pink-500 p-3"
                       placeholder="e.g. Pelvic Pain">
                @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="short_description" class="block text-sm font-semibold text-gray-700 mb-2">Short description (optional)</label>
                <p class="text-xs text-gray-500 mb-2">Brief tagline for the category card. Supports formatting.</p>
                <x-quill-editor name="short_description" id="short_description" :value="old('short_description')" height="180px" />
                @error('short_description')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Full description (optional)</label>
                <p class="text-xs text-gray-500 mb-2">Detailed content for the category page. Shown below the hero.</p>
                <x-quill-editor name="description" id="description" :value="old('description')" height="320px" />
                @error('description')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Image (optional)</label>
                <input type="file" name="image" id="image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100">
                <p class="mt-1 text-xs text-gray-500">Recommended: landscape, max 2MB. Leave blank to use placeholder.</p>
                @error('image')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="card_color" class="block text-sm font-semibold text-gray-700 mb-2">Card accent color</label>
                    <select name="card_color" id="card_color" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-pink-500 focus:ring-pink-500 p-3">
                        <option value="pink" {{ old('card_color', 'pink') == 'pink' ? 'selected' : '' }}>Pink</option>
                        <option value="rose" {{ old('card_color') == 'rose' ? 'selected' : '' }}>Rose</option>
                        <option value="fuchsia" {{ old('card_color') == 'fuchsia' ? 'selected' : '' }}>Fuchsia</option>
                        <option value="teal" {{ old('card_color') == 'teal' ? 'selected' : '' }}>Teal</option>
                        <option value="purple" {{ old('card_color') == 'purple' ? 'selected' : '' }}>Purple</option>
                    </select>
                </div>
                <div>
                    <label for="sort_order" class="block text-sm font-semibold text-gray-700 mb-2">Sort order</label>
                    <input type="number" name="sort_order" id="sort_order" min="0" value="{{ old('sort_order', 0) }}"
                           class="w-full rounded-xl border-gray-200 shadow-sm focus:border-pink-500 focus:ring-pink-500 p-3">
                    @error('sort_order')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="flex items-start bg-gray-50 p-4 rounded-xl">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                       class="w-5 h-5 rounded border-gray-300 text-pink-600 focus:ring-pink-500 mt-0.5">
                <label for="is_active" class="ml-3 font-medium text-gray-900">Active (visible on Services page)</label>
            </div>
        </div>

        <div class="flex flex-wrap gap-3">
            <button type="submit" class="inline-flex items-center px-6 py-3 bg-pink-600 text-white font-medium rounded-xl hover:bg-pink-700 transition shadow-lg focus:ring-4 focus:ring-pink-200">
                Create Category
            </button>
            <a href="{{ route('admin.service-categories.index') }}" class="inline-flex items-center px-6 py-3 bg-white border border-gray-200 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
