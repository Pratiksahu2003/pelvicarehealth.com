@extends('layouts.admin')

@section('title', 'Doctor Dashboard')
@section('page-title', 'Welcome back, Dr. ' . auth()->user()->name)
@section('page-subtitle', 'Manage your appointments and schedule')

@section('content')
<div class="space-y-6">
    <!-- Verification Status Banner -->
    @if(isset($verificationStatus) && $verificationStatus !== 'approved')
        <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border-l-4 border-yellow-400 rounded-lg shadow-md p-6">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="text-lg font-semibold text-yellow-800 mb-2">
                        @if($verificationStatus === 'pending')
                            ⏳ Verification Pending
                        @elseif($verificationStatus === 'rejected')
                            ❌ Verification Rejected
                        @else
                            ⚠️ Verification Required
                        @endif
                    </h3>
                    <p class="text-yellow-700 mb-3">
                        @if($verificationStatus === 'pending')
                            Your registration has been submitted successfully! Our medical team is reviewing your documents and credentials. Verification usually takes 24-48 hours. You'll receive an email notification once your profile is approved.
                        @elseif($verificationStatus === 'rejected')
                            Your verification request was rejected. Please contact support or resubmit your documents with corrections.
                        @else
                            Please complete the verification process to access all dashboard features.
                        @endif
                    </p>
                    @if($verificationStatus === 'pending')
                        <div class="bg-white bg-opacity-50 rounded-lg p-4 mt-4">
                            <p class="text-sm text-yellow-800 font-medium mb-2">What happens next?</p>
                            <ul class="text-sm text-yellow-700 space-y-1 list-disc list-inside">
                                <li>Our team reviews your professional documents</li>
                                <li>We verify your credentials and qualifications</li>
                                <li>You'll receive an email notification upon approval</li>
                                <li>Once approved, you can start accepting appointments</li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('doctor.appointments') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg p-6 hover:from-blue-600 hover:to-blue-700 transition shadow-lg">
            <div class="flex items-center">
                <div class="bg-blue-500 bg-opacity-20 rounded-full p-3 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="white" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-lg">Manage Appointments</h3>
                    <p class="text-sm text-blue-100">View and update appointments</p>
                </div>
            </div>
        </a>
        <a href="{{ route('doctor.availability') }}" class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg p-6 hover:from-green-600 hover:to-green-700 transition shadow-lg">
            <div class="flex items-center">
                <div class="bg-green-500 bg-opacity-20 rounded-full p-3 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="white" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-lg">Set Availability</h3>
                    <p class="text-sm text-green-100">Update your schedule</p>
                </div>
            </div>
        </a>
        <a href="{{ route('doctor.profile') }}" class="bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg p-6 hover:from-purple-600 hover:to-purple-700 transition shadow-lg">
            <div class="flex items-center">
                <div class="bg-purple-500 bg-opacity-20 rounded-full p-3 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="white" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-lg">My Profile</h3>
                    <p class="text-sm text-purple-100">Manage documents & details</p>
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
                    <p class="text-sm font-medium text-gray-600">Completed</p>
                    <p class="text-3xl font-bold text-purple-600 mt-2">{{ $stats['completed_appointments'] }}</p>
                </div>
                <div class="bg-purple-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Appointments -->
    <div class="bg-white rounded-lg shadow-lg">
        <div class="p-6 border-b bg-gradient-to-r from-blue-50 to-white">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Recent Appointments</h3>
                    <p class="text-sm text-gray-600 mt-1">Latest appointment requests</p>
                </div>
                <a href="{{ route('doctor.appointments') }}" class="text-blue-600 hover:text-blue-900 font-semibold text-sm">View All →</a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Patient</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($appointments as $appointment)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                    <span class="text-blue-600 font-semibold">{{ substr($appointment->patient?->name ?? 'U', 0, 1) }}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $appointment->patient?->name ?? 'Unknown Patient' }}</div>
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
                                {{ $appointment->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $appointment->status == 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $appointment->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ route('doctor.appointments') }}" class="text-blue-600 hover:text-blue-900 font-medium">Manage</a>
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

