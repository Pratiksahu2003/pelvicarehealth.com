@extends('layouts.admin')

@section('title', 'All Appointments')
@section('page-title', 'Appointments Management')
@section('page-subtitle', 'View and manage all appointments')

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
        <div class="bg-white rounded-lg shadow p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-600 uppercase">Total</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['total'] }}</p>
                </div>
                <div class="bg-purple-100 rounded-full p-2">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-600 uppercase">Pending</p>
                    <p class="text-2xl font-bold text-yellow-600 mt-1">{{ $stats['pending'] }}</p>
                </div>
                <div class="bg-yellow-100 rounded-full p-2">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-600 uppercase">Confirmed</p>
                    <p class="text-2xl font-bold text-green-600 mt-1">{{ $stats['confirmed'] }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-2">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-600 uppercase">Completed</p>
                    <p class="text-2xl font-bold text-blue-600 mt-1">{{ $stats['completed'] }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-2">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-600 uppercase">Cancelled</p>
                    <p class="text-2xl font-bold text-red-600 mt-1">{{ $stats['cancelled'] }}</p>
                </div>
                <div class="bg-red-100 rounded-full p-2">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-6">
        <form method="GET" action="{{ route('super-admin.appointments') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Filter by Status</label>
                <select name="status" id="status" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" 
                       placeholder="Search by patient or doctor name..." 
                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 bg-gradient-to-r from-pink-500 to-pink-600 text-white px-6 py-2.5 rounded-lg hover:from-pink-600 hover:to-pink-700 transition shadow-md font-medium">
                    <div class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Filter
                    </div>
                </button>
                @if(request('status') || request('search'))
                <a href="{{ route('super-admin.appointments') }}" class="bg-gray-200 text-gray-700 px-6 py-2.5 rounded-lg hover:bg-gray-300 transition font-medium">
                    Clear
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Appointments Table -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6 border-b bg-gradient-to-r from-purple-50 to-white">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">All Appointments</h3>
                    <p class="text-sm text-gray-600 mt-1">
                        Showing {{ $appointments->firstItem() ?? 0 }} to {{ $appointments->lastItem() ?? 0 }} of {{ $appointments->total() }} appointments
                    </p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Doctor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Session Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fee</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reason</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($appointments as $appointment)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-medium text-gray-900">#{{ $appointment->id }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-pink-100 rounded-full flex items-center justify-center">
                                    <span class="text-pink-600 font-semibold text-sm">{{ substr($appointment->patient->name ?? 'N', 0, 1) }}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $appointment->patient->name ?? 'N/A' }}</div>
                                    <div class="text-xs text-gray-500">{{ $appointment->patient->email ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                    <span class="text-blue-600 font-semibold text-sm">{{ substr($appointment->doctor->name ?? 'N', 0, 1) }}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $appointment->doctor->name ?? 'N/A' }}</div>
                                    <div class="text-xs text-gray-500">{{ $appointment->doctor->email ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $appointment->appointment_date->format('M d, Y') }}</div>
                            <div class="text-xs text-gray-500">{{ $appointment->appointment_time }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                {{ $appointment->session_type == 'home_visit' ? 'bg-indigo-100 text-indigo-800' : 'bg-teal-100 text-teal-800' }}">
                                {{ $appointment->session_type == 'home_visit' ? 'Home Visit' : 'Clinic Visit' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-gray-900">₹{{ number_format($appointment->session_fee, 2) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                {{ $appointment->status == 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $appointment->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $appointment->status == 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $appointment->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $appointment->reason }}">
                                {{ $appointment->reason ?? 'N/A' }}
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-gray-500 text-lg font-medium">No appointments found</p>
                                <p class="text-gray-400 text-sm mt-1">Try adjusting your filters or search criteria</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($appointments->hasPages())
        <div class="px-6 py-4 border-t bg-gray-50">
            {{ $appointments->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
