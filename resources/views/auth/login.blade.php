@extends('layouts.app')

@section('title', 'Login - Pelvicare')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl w-full theme-card rounded-3xl overflow-hidden flex flex-col md:flex-row">
        
        <!-- Left Side - Image -->
        <div class="w-full md:w-1/2 h-48 md:h-auto relative bg-pink-50">
            <!-- Image with fallback -->
            <img src="{{ asset('images/login_visual.png') }}" 
                 alt="Welcome to Pelvicare" 
                 class="absolute inset-0 w-full h-full object-cover"
                 onerror="this.style.display='none'; this.parentElement.classList.add('bg-gradient-to-br', 'from-pink-400', 'to-pink-600');">
            
            <div class="absolute inset-0 bg-gradient-to-t from-pink-900/60 to-transparent md:from-pink-900/40"></div>
            
            <div class="absolute bottom-6 left-6 md:bottom-10 md:left-10 text-white z-10">
                <h3 class="text-2xl md:text-3xl font-bold heading-font mb-2 shadow-sm">Welcome Back</h3>
                <p class="text-pink-100 opacity-90 text-sm md:text-base">Expert care for your pelvic health journey.</p>
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="w-full md:w-1/2 p-8 md:p-12 lg:p-16 flex flex-col justify-center">
            <div class="text-center md:text-left mb-10">
                <div class="flex justify-center md:justify-start mb-6">
                    <img src="{{ asset('images/pelvicarehealth_logo.png') }}" 
                         alt="Pelvicare Health" 
                         class="h-16 w-auto object-contain"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="hidden items-center justify-center w-12 h-12 rounded-full bg-pink-100 text-pink-600 shadow-sm">
                       <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                </div>
                <h2 class="text-3xl font-bold heading-font text-gray-900">Sign In</h2>
                <p class="mt-2 text-sm text-gray-600">Please enter your credentials to access your account</p>
            </div>

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

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
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

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input id="password" name="password" type="password" autocomplete="current-password" required 
                               class="w-full pl-10 pr-12 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all text-gray-900 placeholder-gray-400 @error('password') border-red-500 @enderror" 
                               placeholder="••••••••">
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
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" 
                               class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded cursor-pointer">
                        <label for="remember" class="ml-2 block text-sm text-gray-600 cursor-pointer">
                            Keep me signed in
                        </label>
                    </div>
                    
                    @if (Route::has('password.request'))
                        <a class="text-sm font-medium text-pink-600 hover:text-pink-500 transition-colors" href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <button type="submit" 
                        class="w-full flex justify-center items-center bg-gradient-to-r from-pink-500 to-pink-600 text-white py-3 px-6 rounded-xl font-bold text-base hover:from-pink-600 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Sign In to Account
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-sm text-gray-600">
                    Not a member yet?
                    <a href="{{ route('register') }}" class="font-bold text-pink-600 hover:text-pink-500 transition-colors ml-1">
                        Create an account
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeOffIcon = document.getElementById('eyeOffIcon');

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
    });
</script>
@endpush
@endsection

