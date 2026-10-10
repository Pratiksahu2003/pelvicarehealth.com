@extends('layouts.app')

@section('title', 'Appointment Confirmed – Pelvicare Health')

@section('content')

@php
    $doctor  = $appointment->doctor;
    $profile = $doctor?->doctorProfile;
    $isGuest = $appointment->isGuest();
    $patientName = $isGuest ? $appointment->guest_name : $appointment->patient?->name;
    $sessionLabel = match($appointment->session_type) {
        'home_visit'    => 'Home Visit',
        'video_session' => 'Video Consultation',
        default         => 'Clinic Visit',
    };
@endphp

{{-- ░░░ SUCCESS HERO ░░░ --}}
<section class="bg-gradient-to-br from-green-50 via-white to-emerald-50 py-14 text-center">
    <div class="max-w-2xl mx-auto px-4">
        {{-- Animated checkmark --}}
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-5 animate-bounce-once">
            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <h1 class="text-3xl md:text-4xl font-bold heading-font text-gray-900 mb-3">
            Appointment Booked! 🎉
        </h1>
        <p class="text-gray-600 max-w-lg mx-auto">
            Your appointment has been confirmed. You'll receive a reminder soon.
            Booking ID: <span class="font-bold text-gray-900">#{{ str_pad($appointment->id, 6, '0', STR_PAD_LEFT) }}</span>
        </p>
    </div>
</section>

{{-- ░░░ CONFIRMATION CARD ░░░ --}}
<section class="py-12 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

            {{-- Card Header --}}
            <div class="bg-gradient-to-r from-pink-500 to-rose-500 px-6 py-4 flex items-center justify-between">
                <div class="text-white">
                    <p class="text-xs font-semibold uppercase tracking-wider opacity-80">Booking Confirmation</p>
                    <p class="text-lg font-bold">#{{ str_pad($appointment->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>
                <span class="bg-white/20 text-white text-xs font-semibold px-3 py-1.5 rounded-full border border-white/30">
                    {{ ucfirst($appointment->status) }}
                </span>
            </div>

            {{-- Card Body --}}
            <div class="p-6 sm:p-8 grid grid-cols-1 sm:grid-cols-2 gap-6">

                {{-- Patient Info --}}
                <div class="space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-pink-600 border-b border-pink-100 pb-2">Patient Details</h3>

                    <div>
                        <p class="text-xs text-gray-400">Name</p>
                        <p class="font-semibold text-gray-900">{{ $patientName ?? 'N/A' }}</p>
                    </div>

                    @if($isGuest && $appointment->guest_phone)
                    <div>
                        <p class="text-xs text-gray-400">Phone</p>
                        <p class="font-semibold text-gray-900">{{ $appointment->guest_phone }}</p>
                    </div>
                    @endif

                    @if($isGuest && $appointment->guest_email)
                    <div>
                        <p class="text-xs text-gray-400">Email</p>
                        <p class="font-semibold text-gray-900">{{ $appointment->guest_email }}</p>
                    </div>
                    @elseif(!$isGuest && $appointment->patient?->email)
                    <div>
                        <p class="text-xs text-gray-400">Email</p>
                        <p class="font-semibold text-gray-900">{{ $appointment->patient->email }}</p>
                    </div>
                    @endif

                    @if($appointment->reason)
                    <div>
                        <p class="text-xs text-gray-400">Reason for Visit</p>
                        <p class="font-semibold text-gray-900">{{ $appointment->reason }}</p>
                    </div>
                    @endif
                </div>

                {{-- Appointment Info --}}
                <div class="space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-pink-600 border-b border-pink-100 pb-2">Appointment Details</h3>

                    @if($doctor)
                    <div>
                        <p class="text-xs text-gray-400">Doctor</p>
                        <p class="font-semibold text-gray-900">{{ $doctor->name }}</p>
                        @if($profile?->specializations)
                            <p class="text-xs text-gray-500 mt-0.5">{{ implode(', ', $profile->specializations) }}</p>
                        @endif
                    </div>

                    @if($profile?->clinic_name)
                    <div>
                        <p class="text-xs text-gray-400">Clinic / Hospital</p>
                        <p class="font-semibold text-gray-900">{{ $profile->clinic_name }}</p>
                        @if($profile->clinic_address)
                            <p class="text-xs text-gray-500 mt-0.5">{{ $profile->clinic_address }}</p>
                        @endif
                    </div>
                    @endif
                    @endif

                    <div>
                        <p class="text-xs text-gray-400">Date & Time</p>
                        <p class="font-semibold text-gray-900">
                            {{ $appointment->appointment_date->format('l, d F Y') }}
                        </p>
                        <p class="text-sm text-pink-600 font-bold">
                            {{ date('h:i A', strtotime($appointment->appointment_time)) }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-400">Consultation Type</p>
                        <p class="font-semibold text-gray-900">{{ $sessionLabel }}</p>
                    </div>

                    @if($appointment->session_fee)
                    <div>
                        <p class="text-xs text-gray-400">Consultation Fee</p>
                        <p class="font-bold text-gray-900 text-lg">₹{{ number_format($appointment->session_fee, 0) }}</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- What's Next --}}
            <div class="bg-amber-50 border-t border-amber-100 px-6 sm:px-8 py-5">
                <h4 class="font-bold text-amber-800 text-sm mb-3">📋 What Happens Next?</h4>
                <ol class="text-xs text-amber-700 space-y-1.5 list-decimal list-inside">
                    <li>Our team will review your booking and confirm within 2-4 hours.</li>
                    <li>You'll receive an SMS/call on <strong>{{ $isGuest ? ($appointment->guest_phone ?? 'your number') : ($appointment->patient?->phone ?? 'your number') }}</strong>.</li>
                    <li>Please arrive 10 minutes early for clinic visits.</li>
                    <li>For home visits, our physiotherapist will contact you to confirm the exact time.</li>
                </ol>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row gap-3 mt-6">
            <a href="{{ route('book-appointment') }}"
               class="flex-1 text-center bg-pink-600 text-white font-bold py-3.5 rounded-xl hover:bg-pink-700 transition-all shadow">
                📅 Book Another Appointment
            </a>
            <a href="{{ route('home') }}"
               class="flex-1 text-center bg-white text-gray-700 font-bold py-3.5 rounded-xl border-2 border-gray-200 hover:border-pink-300 hover:text-pink-600 transition-all">
                🏠 Back to Home
            </a>
            @if($doctor?->doctorProfile)
            <a href="{{ route('doctors.show', $doctor->doctorProfile->slug) }}"
               class="flex-1 text-center bg-white text-gray-700 font-bold py-3.5 rounded-xl border-2 border-gray-200 hover:border-pink-300 hover:text-pink-600 transition-all">
                👤 View Doctor Profile
            </a>
            @endif
        </div>

        {{-- Support Note --}}
        <p class="text-center text-xs text-gray-400 mt-4">
            Need help? <a href="{{ route('contact') }}" class="text-pink-600 hover:underline">Contact support</a> with your Booking ID <strong>#{{ str_pad($appointment->id, 6, '0', STR_PAD_LEFT) }}</strong>.
        </p>
    </div>
</section>

@endsection
