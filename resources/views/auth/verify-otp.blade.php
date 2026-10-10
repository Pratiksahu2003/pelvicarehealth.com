@extends('layouts.app')

@section('title', 'Verify OTP - Pelvicare')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full theme-card rounded-3xl overflow-hidden">
        <div class="p-8 md:p-12">
            <div class="text-center mb-10">
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('images/pelvicarehealth_logo.png') }}" 
                         alt="Pelvicare Health" 
                         class="h-16 w-auto object-contain"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="hidden items-center justify-center w-16 h-16 rounded-full bg-pink-100 text-pink-600 shadow-sm">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                </div>
                <h2 class="text-3xl font-bold heading-font text-gray-900">Verify OTP</h2>
                <p class="mt-2 text-sm text-gray-600">Enter the 6-digit OTP sent to <span class="font-semibold text-gray-900">{{ $email }}</span></p>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700 font-medium">{{ $errors->first() }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('password.verify-otp') }}" method="POST" class="space-y-6">
                @csrf
                
                <input type="hidden" name="email" value="{{ $email }}">

                <div>
                    <label for="otp" class="block text-sm font-semibold text-gray-700 mb-2">Enter OTP</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input id="otp" name="otp" type="text" maxlength="6" pattern="[0-9]{6}" required 
                               class="w-full pl-10 pr-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all text-gray-900 placeholder-gray-400 text-center text-2xl tracking-widest font-mono @error('otp') border-red-500 @enderror" 
                               placeholder="000000"
                               autocomplete="one-time-code"
                               inputmode="numeric">
                    </div>
                    @error('otp')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-500">OTP is valid for 10 minutes</p>
                </div>

                <button type="submit" 
                        class="w-full flex justify-center items-center bg-gradient-to-r from-pink-500 to-pink-600 text-white py-3 px-6 rounded-xl font-bold text-base hover:from-pink-600 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Verify OTP
                </button>
            </form>

            <div class="mt-6 text-center">
                <form action="{{ route('password.resend-otp') }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <button type="submit" class="text-sm font-medium text-pink-600 hover:text-pink-500 transition-colors">
                        Resend OTP
                    </button>
                </form>
            </div>

            <div class="mt-8 text-center">
                <p class="text-sm text-gray-600">
                    <a href="{{ route('password.request') }}" class="font-bold text-pink-600 hover:text-pink-500 transition-colors">
                        ← Back to forgot password
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const otpInput = document.getElementById('otp');
        
        // Auto-focus on OTP input
        otpInput.focus();
        
        // Only allow numbers
        otpInput.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, '');
        });
        
        // Auto-submit when 6 digits are entered
        otpInput.addEventListener('input', function(e) {
            if (e.target.value.length === 6) {
                // Optional: auto-submit after a short delay
                // setTimeout(() => {
                //     e.target.form.submit();
                // }, 500);
            }
        });
    });
</script>
@endpush
@endsection
