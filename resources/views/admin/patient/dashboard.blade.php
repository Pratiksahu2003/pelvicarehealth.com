@extends('layouts.admin')

@section('title', 'Patient Dashboard')
@section('page-title', 'Welcome back, ' . auth()->user()->name)
@section('page-subtitle', 'Manage your appointments and health records')

@section('content')
<div class="space-y-6">
    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('patient.appointments.book') }}" class="bg-gradient-to-r from-pink-500 to-pink-600 text-white rounded-lg p-6 hover:from-pink-600 hover:to-pink-700 transition shadow-lg">
            <div class="flex items-center">
                <div class="bg-white bg-opacity-20 rounded-full p-3 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-lg">Book Appointment</h3>
                    <p class="text-sm text-pink-100">Schedule with a doctor</p>
                </div>
            </div>
        </a>
        <a href="{{ route('patient.profile') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg p-6 hover:from-blue-600 hover:to-blue-700 transition shadow-lg">
            <div class="flex items-center">
                <div class="bg-white bg-opacity-20 rounded-full p-3 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-lg">My Profile</h3>
                    <p class="text-sm text-blue-100">Update medical info</p>
                </div>
            </div>
        </a>
        <a href="{{ route('patient.reports') }}" class="bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg p-6 hover:from-purple-600 hover:to-purple-700 transition shadow-lg">
            <div class="flex items-center">
                <div class="bg-white bg-opacity-20 rounded-full p-3 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-lg">My Reports</h3>
                    <p class="text-sm text-purple-100">View medical reports</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Appointments</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_appointments'] }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Pending</p>
                    <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $stats['pending_appointments'] }}</p>
                </div>
                <div class="bg-yellow-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Confirmed</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $stats['confirmed_appointments'] }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">My Reports</p>
                    <p class="text-3xl font-bold text-purple-600 mt-2">{{ $stats['total_reports'] }}</p>
                </div>
                <div class="bg-purple-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Appointments -->
    <div class="bg-white rounded-lg shadow-lg">
        <div class="p-6 border-b flex justify-between items-center bg-gradient-to-r from-pink-50 to-white">
            <div>
                <h3 class="text-xl font-bold text-gray-900">Upcoming Appointments</h3>
                <p class="text-sm text-gray-600 mt-1">Your scheduled appointments</p>
            </div>
            <a href="{{ route('patient.appointments.book') }}" class="bg-pink-600 text-white px-6 py-2 rounded-lg hover:bg-pink-700 font-semibold shadow-md transition">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Book New
                </span>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Doctor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($upcoming_appointments as $appointment)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-pink-100 rounded-full flex items-center justify-center">
                                    <span class="text-pink-600 font-semibold">{{ substr($appointment->doctor->name ?? 'N/A', 0, 1) }}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $appointment->doctor->name ?? 'N/A' }}</div>
                                    <div class="text-xs text-gray-500 capitalize">{{ str_replace('_', ' ', $appointment->session_type ?? 'clinic_visit') }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $appointment->appointment_date->format('M d, Y') }}</div>
                            <div class="text-xs text-gray-500">{{ $appointment->appointment_date->format('l') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $appointment->appointment_time }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                {{ $appointment->status == 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $appointment->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ route('patient.appointments.rebook', $appointment->id) }}" class="text-pink-600 hover:text-pink-900 font-medium">Rebook</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No upcoming appointments</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Reports -->
    <div class="bg-white rounded-lg shadow-lg">
        <div class="p-6 border-b bg-gradient-to-r from-purple-50 to-white">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Recent Reports</h3>
                    <p class="text-sm text-gray-600 mt-1">Your medical reports and documents</p>
                </div>
                <a href="{{ route('patient.reports') }}" class="text-purple-600 hover:text-purple-900 font-semibold text-sm">View All →</a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Doctor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($recent_reports as $report)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $report->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $report->doctor->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $report->report_date->format('M d, Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ route('patient.reports.view', $report->id) }}" class="text-pink-600 hover:text-pink-900">View</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No reports available</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

