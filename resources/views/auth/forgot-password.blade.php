@extends('layouts.app')

@section('title', 'Forgot Password - Pelvicare')

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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                    </div>
                </div>
                <h2 class="text-3xl font-bold heading-font text-gray-900">Forgot Password?</h2>
                <p class="mt-2 text-sm text-gray-600">Enter your email address and we'll send you an OTP to reset your password</p>
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

            <form action="{{ route('password.send-otp') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                        </div>
                        <input id="email" name="email" type="email" autocomplete="email" required 
                               class="w-full pl-10 pr-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all text-gray-900 placeholder-gray-400 @error('email') border-red-500 @enderror" 
                               placeholder="name@example.com" 
                               value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" 
                        class="w-full flex justify-center items-center bg-gradient-to-r from-pink-500 to-pink-600 text-white py-3 px-6 rounded-xl font-bold text-base hover:from-pink-600 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Send OTP
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-sm text-gray-600">
                    Remember your password?
                    <a href="{{ route('login') }}" class="font-bold text-pink-600 hover:text-pink-500 transition-colors ml-1">
                        Sign in
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
