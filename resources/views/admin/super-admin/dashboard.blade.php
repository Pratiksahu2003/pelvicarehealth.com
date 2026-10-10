@extends('layouts.admin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Admin Dashboard')
@section('page-subtitle', 'System overview and management')

@section('content')
<div class="space-y-6">
    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
        <a href="{{ route('super-admin.doctor-verification') }}" class="bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-lg p-5 hover:from-orange-600 hover:to-orange-700 transition shadow-lg">
            <div class="flex items-center">
                <div class="bg-orange-500 bg-opacity-20 rounded-full p-2 mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold">Verify Doctors</h3>
                    <p class="text-xs text-orange-100">Review applications</p>
                </div>
            </div>
        </a>
        <a href="{{ route('super-admin.users') }}" class="bg-gradient-to-r from-indigo-500 to-indigo-600 text-white rounded-lg p-5 hover:from-indigo-600 hover:to-indigo-700 transition shadow-lg">
            <div class="flex items-center">
                <div class="bg-indigo-500 bg-opacity-20 rounded-full p-2 mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold">Manage Users</h3>
                    <p class="text-xs text-indigo-100">User management</p>
                </div>
            </div>
        </a>
        <a href="{{ route('super-admin.appointments') }}" class="bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg p-5 hover:from-purple-600 hover:to-purple-700 transition shadow-lg">
            <div class="flex items-center">
                <div class="bg-purple-500 bg-opacity-20 rounded-full p-2 mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold">Appointments</h3>
                    <p class="text-xs text-purple-100">View all appointments</p>
                </div>
            </div>
        </a>
        <a href="{{ route('admin.content.index') }}" class="bg-gradient-to-r from-teal-500 to-teal-600 text-white rounded-lg p-5 hover:from-teal-600 hover:to-teal-700 transition shadow-lg">
            <div class="flex items-center">
                <div class="bg-teal-500 bg-opacity-20 rounded-full p-2 mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold">Content</h3>
                    <p class="text-xs text-teal-100">Manage content</p>
                </div>
            </div>
        </a>
        <a href="{{ route('admin.blog.index') }}" class="bg-gradient-to-r from-pink-500 to-pink-600 text-white rounded-lg p-5 hover:from-pink-600 hover:to-pink-700 transition shadow-lg">
            <div class="flex items-center">
                <div class="bg-pink-500 bg-opacity-20 rounded-full p-2 mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold">Blog</h3>
                    <p class="text-xs text-pink-100">Manage posts</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Users</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_users'] }}</p>
                </div>
                <div class="bg-pink-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Patients</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_patients'] }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Doctors</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_doctors'] }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <a href="{{ route('super-admin.appointments') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Appointments</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_appointments'] }}</p>
                </div>
                <div class="bg-purple-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </a>
    </div>

    <!-- Recent Appointments -->
    <div class="bg-white rounded-lg shadow-lg">
        <div class="p-6 border-b bg-gradient-to-r from-purple-50 to-white">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Recent Appointments</h3>
                    <p class="text-sm text-gray-600 mt-1">Latest system activity</p>
                </div>
                <a href="{{ route('super-admin.appointments') }}" class="bg-gradient-to-r from-purple-500 to-purple-600 text-white px-4 py-2 rounded-lg hover:from-purple-600 hover:to-purple-700 transition shadow-md text-sm font-medium">
                    View All
                </a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Patient</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Doctor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($recent_appointments as $appointment)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-pink-100 rounded-full flex items-center justify-center">
                                    <span class="text-pink-600 font-semibold">{{ strtoupper(substr($appointment->patient?->name ?? 'U', 0, 1)) }}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ strtoupper(substr($appointment->patient?->name ?? 'U', 0, 1)) }}</div>
                                    <div class="text-xs text-gray-500">Patient</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                    <span class="text-blue-600 font-semibold">{{ substr($appointment->doctor->name ?? 'N', 0, 1) }}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $appointment->doctor->name ?? 'N/A' }}</div>
                                    <div class="text-xs text-gray-500">Doctor</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $appointment->appointment_date->format('M d, Y') }}</div>
                            <div class="text-xs text-gray-500">{{ $appointment->appointment_time }}</div>
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
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No appointments found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

