@extends('layouts.admin')

@section('title', 'Service Categories')
@section('page-title', 'Service Categories')
@section('page-subtitle', 'Manage service categories displayed on the Services page')

@section('content')
<div class="space-y-6">
    <!-- Tabs: Categories | Subcategories -->
    <div class="flex gap-2 border-b border-gray-200 pb-2">
        <a href="{{ route('admin.service-categories.index') }}" class="px-4 py-2 rounded-t-lg font-medium bg-pink-100 text-pink-700 border-b-2 border-pink-500 -mb-0.5">Categories</a>
        <a href="{{ route('admin.service-subcategories.index') }}" class="px-4 py-2 rounded-t-lg font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition">Subcategories</a>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200/60 overflow-hidden">
        <div class="p-5 border-b border-gray-100 bg-gray-50/30">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <h3 class="text-lg font-bold text-gray-900 heading-font">All Categories</h3>
                <a href="{{ route('admin.service-categories.create') }}" class="group inline-flex items-center px-5 py-2.5 bg-gray-900 text-white text-sm font-medium rounded-xl hover:bg-gray-800 transition-all duration-200 shadow-lg shadow-gray-900/20 focus:ring-4 focus:ring-gray-200">
                    <svg class="w-5 h-5 mr-2 transition-transform group-hover:rotate-90 duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Category
                </a>
            </div>

            <form method="GET" action="{{ route('admin.service-categories.index') }}" class="mt-6 grid grid-cols-1 md:grid-cols-12 gap-4">
                <div class="md:col-span-6 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="block w-full pl-10 pr-3 py-2.5 bg-white border border-gray-200 rounded-xl leading-5 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 sm:text-sm"
                           placeholder="Search categories...">
                </div>
                <div class="md:col-span-3">
                    <select name="status" class="block w-full py-2.5 pl-3 pr-10 bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 sm:text-sm">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="md:col-span-3 flex gap-2">
                    <button type="submit" class="flex-1 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-2.5 rounded-xl text-sm font-medium">Apply</button>
                    @if(request()->hasAny(['search', 'status']))
                    <a href="{{ route('admin.service-categories.index') }}" class="px-4 py-2.5 text-red-600 bg-red-50 hover:bg-red-100 rounded-xl text-sm font-medium flex items-center justify-center" title="Clear">×</a>
                    @endif
                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Subcategories</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($categories as $category)
                    <tr class="group hover:bg-pink-50/30 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-14 w-20 rounded-lg overflow-hidden bg-gray-100 border border-gray-200">
                                    @if($category->image)
                                    <img class="h-full w-full object-cover" src="{{ media_url($category->image) }}" alt="{{ $category->name }}">
                                    @else
                                    <div class="flex items-center justify-center h-full w-full text-gray-300">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="font-bold text-gray-900">{{ $category->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $category->slug }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-pink-50 text-pink-700 border border-pink-100">
                                {{ $category->subcategories_count }} subcategories
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($category->is_active)
                            <span class="inline-flex items-center text-sm text-emerald-700 font-medium"><span class="h-2.5 w-2.5 rounded-full bg-emerald-500 mr-2"></span>Active</span>
                            @else
                            <span class="inline-flex items-center text-sm text-gray-500"><span class="h-2.5 w-2.5 rounded-full bg-gray-400 mr-2"></span>Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $category->sort_order }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('services.show', $category->slug) }}" target="_blank" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-all" title="View on site">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                </a>
                                <a href="{{ route('admin.service-categories.edit', $category->id) }}" class="p-2 text-indigo-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('admin.service-categories.destroy', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this category and all its subcategories?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Delete">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <div class="bg-gray-50 rounded-full p-6 mb-4">
                                    <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">No categories yet</h3>
                                <p class="mb-6 max-w-sm">Add service categories to display on the public Services page.</p>
                                <a href="{{ route('admin.service-categories.create') }}" class="inline-flex items-center px-6 py-3 bg-pink-600 text-white font-medium rounded-xl hover:bg-pink-700 transition shadow-lg">Add Category</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($categories->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">{{ $categories->links() }}</div>
        @endif
    </div>
</div>
@endsection
