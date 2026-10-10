@extends('layouts.admin')

@section('title', 'Service Subcategories')
@section('page-title', 'Service Subcategories')
@section('page-subtitle', 'Manage treatments and conditions under each service category')

@section('content')
<div class="space-y-6">
    <!-- Tabs: Categories | Subcategories -->
    <div class="flex gap-2 border-b border-gray-200 pb-2">
        <a href="{{ route('admin.service-categories.index') }}" class="px-4 py-2 rounded-t-lg font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition">Categories</a>
        <a href="{{ route('admin.service-subcategories.index') }}" class="px-4 py-2 rounded-t-lg font-medium bg-pink-100 text-pink-700 border-b-2 border-pink-500 -mb-0.5">Subcategories</a>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200/60 overflow-hidden">
        <div class="p-5 border-b border-gray-100 bg-gray-50/30">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <h3 class="text-lg font-bold text-gray-900 heading-font">All Subcategories</h3>
                <a href="{{ route('admin.service-subcategories.create') }}" class="group inline-flex items-center px-5 py-2.5 bg-gray-900 text-white text-sm font-medium rounded-xl hover:bg-gray-800 transition-all duration-200 shadow-lg shadow-gray-900/20 focus:ring-4 focus:ring-gray-200">
                    <svg class="w-5 h-5 mr-2 transition-transform group-hover:rotate-90 duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Subcategory
                </a>
            </div>

            <form method="GET" action="{{ route('admin.service-subcategories.index') }}" class="mt-6 grid grid-cols-1 md:grid-cols-12 gap-4">
                <div class="md:col-span-4 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="block w-full pl-10 pr-3 py-2.5 bg-white border border-gray-200 rounded-xl leading-5 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 sm:text-sm"
                           placeholder="Search subcategories...">
                </div>
                <div class="md:col-span-3">
                    <select name="category" class="block w-full py-2.5 pl-3 pr-10 bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 sm:text-sm">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-2">
                    <select name="status" class="block w-full py-2.5 pl-3 pr-10 bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 sm:text-sm">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="md:col-span-3 flex gap-2">
                    <button type="submit" class="flex-1 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-2.5 rounded-xl text-sm font-medium">Apply</button>
                    @if(request()->hasAny(['search', 'category', 'status']))
                    <a href="{{ route('admin.service-subcategories.index') }}" class="px-4 py-2.5 text-red-600 bg-red-50 hover:bg-red-100 rounded-xl text-sm font-medium flex items-center justify-center" title="Clear">×</a>
                    @endif
                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Subcategory</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($subcategories as $sub)
                    <tr class="group hover:bg-pink-50/30 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($sub->image)
                                <div class="flex-shrink-0 h-12 w-16 rounded-lg overflow-hidden bg-gray-100 border border-gray-200 mr-3">
                                    <img class="h-full w-full object-cover" src="{{ media_url($sub->image) }}" alt="{{ $sub->name }}">
                                </div>
                                @endif
                                <div>
                                    <div class="font-bold text-gray-900">{{ $sub->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $sub->slug }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200">
                                {{ $sub->serviceCategory->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($sub->is_active)
                            <span class="inline-flex items-center text-sm text-emerald-700 font-medium"><span class="h-2.5 w-2.5 rounded-full bg-emerald-500 mr-2"></span>Active</span>
                            @else
                            <span class="inline-flex items-center text-sm text-gray-500"><span class="h-2.5 w-2.5 rounded-full bg-gray-400 mr-2"></span>Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $sub->sort_order }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('services.subservice', [$sub->serviceCategory->slug, $sub->slug]) }}" target="_blank" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-all" title="View on site">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                </a>
                                <a href="{{ route('admin.service-subcategories.edit', $sub->id) }}" class="p-2 text-indigo-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('admin.service-subcategories.destroy', $sub->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this subcategory?');">
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
                                    <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">No subcategories yet</h3>
                                <p class="mb-6 max-w-sm">Add treatments/conditions under each service category.</p>
                                <a href="{{ route('admin.service-subcategories.create') }}" class="inline-flex items-center px-6 py-3 bg-pink-600 text-white font-medium rounded-xl hover:bg-pink-700 transition shadow-lg">Add Subcategory</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($subcategories->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">{{ $subcategories->links() }}</div>
        @endif
    </div>
</div>
@endsection
