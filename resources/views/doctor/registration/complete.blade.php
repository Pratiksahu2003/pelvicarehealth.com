@extends('layouts.app')

@section('title', 'Registration Complete')
@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <div class="theme-card p-8 text-center">
            <div class="mb-6">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold heading-font text-gray-900 mb-2">Registration Submitted!</h2>
                <p class="text-gray-600">Your profile has been submitted for verification.</p>
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6 text-left">
                <h3 class="font-semibold text-blue-900 mb-2">What's Next?</h3>
                <ul class="space-y-2 text-sm text-blue-800">
                    <li>✓ Our medical team will review your documents</li>
                    <li>✓ Verification usually takes 24-48 hours</li>
                    <li>✓ You'll receive an email once your profile is approved</li>
                    <li>✓ After approval, you can set your weekly schedule and go live!</li>
                </ul>
            </div>

            @if(isset($profile) && $profile->verification_status === 'approved')
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                    <p class="text-green-800 font-semibold">✓ Your account has been verified! You can now access the dashboard.</p>
                </div>
                <div class="space-y-4">
                    <a href="{{ route('doctor.dashboard') }}" class="block bg-gradient-to-r from-pink-400 to-pink-600 text-white px-8 py-3 rounded-lg hover:from-pink-500 hover:to-pink-700 font-semibold">
                        Go to Dashboard
                    </a>
                    <a href="{{ route('home') }}" class="block text-gray-600 hover:text-gray-900">
                        Return to Home
                    </a>
                </div>
            @else
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                    <p class="text-yellow-800 font-semibold">⏳ Your account is pending verification.</p>
                    <p class="text-yellow-700 text-sm mt-1">You'll be able to access the dashboard once your documents are approved.</p>
                </div>
                <div class="space-y-4">
                    <a href="{{ route('home') }}" class="block bg-gradient-to-r from-pink-400 to-pink-600 text-white px-8 py-3 rounded-lg hover:from-pink-500 hover:to-pink-700 font-semibold">
                        Return to Home
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="block w-full text-gray-600 hover:text-gray-900">
                            Logout
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

