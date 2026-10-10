@extends('layouts.app')

@section('title', 'Doctor Registration - Step 1')
@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        @if(session('info'))
            <div class="mb-6 bg-pink-50 border-l-4 border-pink-400 p-4 rounded-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-pink-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-pink-700">{{ session('info') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="theme-card overflow-hidden rounded-2xl">
            <!-- Progress Header -->
            <div class="bg-gradient-to-r from-pink-500 to-pink-600 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-2xl font-bold text-white heading-font">Doctor Registration</h2>
                        <p class="text-pink-100 text-sm mt-1">Complete your professional profile</p>
                    </div>
                    <div class="bg-white/20 rounded-full px-4 py-2">
                        <span class="text-white font-semibold">Step 1 of 4</span>
                    </div>
                </div>
                <div class="w-full bg-white/20 rounded-full h-2">
                    <div class="bg-white h-2 rounded-full transition-all duration-300" style="width: 25%"></div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Basic Information</h3>
                    <p class="text-sm text-gray-600">Let's start with your basic details</p>
                </div>

                <form action="{{ route('doctor.registration.store.step1') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" required value="{{ old('name') }}" 
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all @error('name') border-red-500 @enderror" 
                               placeholder="Dr. Your Name">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" required value="{{ old('email') }}" 
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all @error('email') border-red-500 @enderror" 
                                   placeholder="your@email.com">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Phone Number <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" name="phone" required value="{{ old('phone') }}" 
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all @error('phone') border-red-500 @enderror" 
                                   placeholder="+91 1234567890">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="password" name="password" id="password" required 
                                       class="w-full px-4 py-3 pr-12 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all @error('password') border-red-500 @enderror" 
                                       placeholder="Create a strong password">
                                <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none transition-colors">
                                    <svg id="eyeIcon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <svg id="eyeOffIcon" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Confirm Password <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="password_confirmation" required 
                                       class="w-full px-4 py-3 pr-12 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all" 
                                       placeholder="Confirm your password">
                                <button type="button" id="togglePasswordConfirmation" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none transition-colors">
                                    <svg id="eyeIconConfirmation" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <svg id="eyeOffIconConfirmation" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Info Box -->
                    <div class="bg-pink-50 border-l-4 border-pink-400 p-4 rounded">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-pink-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-pink-700">
                                    <strong>Next Steps:</strong> After creating your account, you'll need to upload your professional documents (Degree, Council Registration, Government ID) for verification.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-4">
                        <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900 font-medium">
                            ← Back to Registration
                        </a>
                        <button type="submit" 
                                class="bg-gradient-to-r from-pink-500 to-pink-600 text-white px-8 py-3 rounded-lg hover:from-pink-600 hover:to-pink-700 font-semibold shadow-lg transform hover:scale-[1.02] transition-all">
                            Next: Upload Documents →
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password visibility toggle
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    const eyeOffIcon = document.getElementById('eyeOffIcon');
    
    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            if (type === 'text') {
                eyeIcon.classList.add('hidden');
                eyeOffIcon.classList.remove('hidden');
            } else {
                eyeIcon.classList.remove('hidden');
                eyeOffIcon.classList.add('hidden');
            }
        });
    }
    
    // Password confirmation visibility toggle
    const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');
    const passwordConfirmationInput = document.getElementById('password_confirmation');
    const eyeIconConfirmation = document.getElementById('eyeIconConfirmation');
    const eyeOffIconConfirmation = document.getElementById('eyeOffIconConfirmation');
    
    if (togglePasswordConfirmation && passwordConfirmationInput) {
        togglePasswordConfirmation.addEventListener('click', function() {
            const type = passwordConfirmationInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmationInput.setAttribute('type', type);
            
            if (type === 'text') {
                eyeIconConfirmation.classList.add('hidden');
                eyeOffIconConfirmation.classList.remove('hidden');
            } else {
                eyeIconConfirmation.classList.remove('hidden');
                eyeOffIconConfirmation.classList.add('hidden');
            }
        });
    }
});
</script>
@endpush
@endsection

