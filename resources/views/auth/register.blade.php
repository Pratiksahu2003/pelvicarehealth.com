@extends('layouts.app')

@section('title', 'Register - Pelvicare')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/pelvicarehealth_logo.png') }}" 
                     alt="Pelvicare Health" 
                     class="h-20 w-auto object-contain"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div class="hidden w-16 h-16 bg-gradient-to-br from-pink-400 to-pink-600 rounded-full items-center justify-center shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
            </div>
            <h2 class="text-3xl font-extrabold heading-font text-gray-900 mb-2">
                Create Your Account
            </h2>
            <p class="text-gray-600 text-base">
                Join Pelvicare to access personalized healthcare services
            </p>
        </div>

        <!-- Registration Form Card -->
        <div class="theme-card rounded-2xl overflow-hidden">
            <!-- Role Selection Tabs -->
            <!-- Role Selection Tabs -->
            <div class="p-6 pb-0">
                <div class="flex p-1 bg-gray-100 rounded-xl">
                    <button type="button" id="patient-tab" onclick="selectRole('patient')" 
                            class="flex-1 py-3 px-4 text-center font-semibold rounded-lg transition-all duration-200 bg-white text-pink-600 shadow-sm ring-1 ring-black/5">
                        <div class="flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>I'm a Patient</span>
                        </div>
                    </button>
                    <button type="button" id="doctor-tab" onclick="selectRole('admin')" 
                            class="flex-1 py-3 px-4 text-center font-semibold rounded-lg transition-all duration-200 text-gray-500 hover:text-gray-700">
                        <div class="flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>I'm a Doctor</span>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                @if(session('info'))
                    <div class="mb-6 bg-blue-50 border-l-4 border-blue-400 p-4 rounded">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700">{{ session('info') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <form id="register-form" action="{{ route('register') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="role" id="role-input" value="patient" required>

                    <!-- Patient Registration Form -->
                    <div id="patient-form">
                        <div class="space-y-5">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input id="name" name="name" type="text" required 
                                       class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all text-gray-900 placeholder-gray-400 @error('name') border-red-500 @enderror" 
                                       placeholder="Enter your full name" 
                                       value="{{ old('name') }}">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">
                                        Email Address <span class="text-red-500">*</span>
                                    </label>
                                    <input id="email" name="email" type="email" required 
                                           class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all text-gray-900 placeholder-gray-400 @error('email') border-red-500 @enderror" 
                                           placeholder="your@email.com" 
                                           value="{{ old('email') }}">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-semibold text-gray-900 mb-2">
                                        Phone Number <span class="text-red-500">*</span>
                                    </label>
                                    <input id="phone" name="phone" type="tel" required 
                                           class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all text-gray-900 placeholder-gray-400 @error('phone') border-red-500 @enderror" 
                                           placeholder="+91 1234567890" 
                                           value="{{ old('phone') }}">
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label for="password" class="block text-sm font-semibold text-gray-900 mb-2">
                                        Password <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input id="password" name="password" type="password" required 
                                               class="w-full px-4 py-3 pr-12 bg-white border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all text-gray-900 placeholder-gray-400 @error('password') border-red-500 @enderror" 
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
                                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-900 mb-2">
                                        Confirm Password <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input id="password_confirmation" name="password_confirmation" type="password" required 
                                               class="w-full px-4 py-3 pr-12 bg-white border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all text-gray-900 placeholder-gray-400" 
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
                        </div>

                        <div class="mt-6">
                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-pink-500 to-pink-600 text-white py-3 px-6 rounded-lg font-semibold hover:from-pink-600 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition-all shadow-lg transform hover:scale-[1.02]">
                                Create Patient Account
                            </button>
                        </div>
                    </div>

                    <!-- Doctor Registration Info -->
                    <div id="doctor-form" class="hidden">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-2 border-blue-200 rounded-lg p-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3 flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Doctor Registration Process</h3>
                                    <p class="text-sm text-gray-700 mb-4">
                                        As a healthcare professional, you'll need to complete a verification process to ensure patient safety and compliance.
                                    </p>
                                    <div class="space-y-2 mb-6">
                                        <div class="flex items-center text-sm text-gray-700">
                                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Upload professional documents (Degree, Council Registration, ID)</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-700">
                                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Complete your professional profile</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-700">
                                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Set your availability and fees</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-700">
                                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Admin verification (24-48 hours)</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('doctor.registration.step1') }}" 
                                       class="inline-flex items-center justify-center w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-3 px-6 rounded-lg font-semibold hover:from-blue-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all shadow-lg transform hover:scale-[1.02]">
                                        <span>Start Doctor Registration</span>
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Login Link -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-semibold text-pink-600 hover:text-pink-700">
                            Sign in here
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="mt-6 text-center">
            <p class="text-xs text-gray-500">
                By registering, you agree to our 
                <a href="#" class="text-pink-600 hover:underline">Terms of Service</a> 
                and 
                <a href="#" class="text-pink-600 hover:underline">Privacy Policy</a>
            </p>
        </div>
    </div>
</div>

<script>
function selectRole(role) {
    const patientTab = document.getElementById('patient-tab');
    const doctorTab = document.getElementById('doctor-tab');
    const patientForm = document.getElementById('patient-form');
    const doctorForm = document.getElementById('doctor-form');
    const roleInput = document.getElementById('role-input');

    if (role === 'patient') {
        // Patient selected
        patientTab.classList.add('bg-white', 'text-pink-600', 'shadow-sm', 'ring-1', 'ring-black/5');
        patientTab.classList.remove('text-gray-500', 'hover:text-gray-700');
        
        doctorTab.classList.remove('bg-white', 'text-pink-600', 'shadow-sm', 'ring-1', 'ring-black/5');
        doctorTab.classList.add('text-gray-500', 'hover:text-gray-700');
        
        patientForm.classList.remove('hidden');
        doctorForm.classList.add('hidden');
        roleInput.value = 'patient';
    } else {
        // Doctor selected
        doctorTab.classList.add('bg-white', 'text-pink-600', 'shadow-sm', 'ring-1', 'ring-black/5');
        doctorTab.classList.remove('text-gray-500', 'hover:text-gray-700');
        
        patientTab.classList.remove('bg-white', 'text-pink-600', 'shadow-sm', 'ring-1', 'ring-black/5');
        patientTab.classList.add('text-gray-500', 'hover:text-gray-700');
        
        patientForm.classList.add('hidden');
        doctorForm.classList.remove('hidden');
        roleInput.value = 'admin';
    }
}

// Initialize with patient selected
document.addEventListener('DOMContentLoaded', function() {
    @if(old('role') == 'admin')
        selectRole('admin');
    @else
        selectRole('patient');
    @endif
    
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
@endsection
