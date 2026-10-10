@extends('layouts.app')

@section('title')
Book Appointment - Pelvic Health Physiotherapy
@endsection

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-pink-50 via-white to-pink-100 py-14 md:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold heading-font text-gray-900 mb-3">
                Book Your Appointment
            </h1>
            <p class="text-lg sm:text-xl text-gray-600 max-w-2xl mx-auto">
                Connect with verified women's health physiotherapists in just a few clicks
            </p>
        </div>
    </div>
</section>

<!-- Booking Form Section -->
<section class="py-16">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">
            <!-- Left Column - Form (Takes 2 columns) -->
            <div class="lg:col-span-2">
                <div class="theme-card rounded-2xl p-6 sm:p-8">
                    @if(session('success'))
                    <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded">
                        <p class="text-green-700">{{ session('success') }}</p>
                    </div>
                    @endif

                    <form action="{{ route('appointment.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Step 1: Personal Information -->
                        <div>
                            <h3 class="text-2xl font-bold heading-font text-gray-900 mb-6 flex items-center">
                                <span class="w-10 h-10 bg-gradient-to-br from-pink-500 to-pink-600 text-white rounded-full flex items-center justify-center mr-3 text-base shadow-md">1</span>
                                Personal Information
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name *</label>
                                    <input type="text" name="name" required class="w-full px-4 py-3 border border-pink-100 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 bg-white transition-all" placeholder="Enter your full name">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Age *</label>
                                    <input type="number" name="age" required class="w-full px-4 py-3 border border-pink-100 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 bg-white transition-all" placeholder="Your age">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number *</label>
                                    <input type="tel" name="phone" required class="w-full px-4 py-3 border border-pink-100 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 bg-white transition-all" placeholder="+91 XXXXX XXXXX">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                    <input type="email" name="email" class="w-full px-4 py-3 border border-pink-100 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 bg-white transition-all" placeholder="your@email.com">
                                </div>
                            </div>
                        </div>

                        <hr class="border-pink-100">

                        <!-- Step 2: Concern/Issue -->
                        <div>
                            <h3 class="text-2xl font-bold heading-font text-gray-900 mb-6 flex items-center">
                                <span class="w-10 h-10 bg-gradient-to-br from-pink-500 to-pink-600 text-white rounded-full flex items-center justify-center mr-3 text-base shadow-md">2</span>
                                What brings you here?
                            </h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Select your primary concern *</label>
                                    <select name="concern" required class="w-full px-4 py-3 border border-pink-100 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 bg-white transition-all">
                                        <option value="">Choose a concern...</option>
                                        <option value="pain-during-sex">Pain During Sex</option>
                                        <option value="postpartum-recovery">Postpartum Recovery</option>
                                        <option value="urinary-incontinence">Urinary Incontinence</option>
                                        <option value="pelvic-pain">Pelvic Pain</option>
                                        <option value="pregnancy-pain">Pregnancy-Related Pain</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Additional Details (Optional)</label>
                                    <textarea name="details" rows="4" class="w-full px-4 py-3 border border-pink-100 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 bg-white transition-all resize-none" placeholder="Share any additional information that might help us serve you better..."></textarea>
                                    <p class="text-xs text-gray-500 mt-1">Your privacy is our priority. All information is confidential.</p>
                                </div>
                            </div>
                        </div>

                        <hr class="border-pink-100">

                        <!-- Step 3: Appointment Preferences -->
                        <div>
                            <h3 class="text-2xl font-bold heading-font text-gray-900 mb-6 flex items-center">
                                <span class="w-10 h-10 bg-gradient-to-br from-pink-500 to-pink-600 text-white rounded-full flex items-center justify-center mr-3 text-base shadow-md">3</span>
                                Appointment Preferences
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Preferred Date *</label>
                                    <input type="date" name="preferred_date" required class="w-full px-4 py-3 border border-pink-100 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 bg-white transition-all">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Preferred Time *</label>
                                    <select name="preferred_time" required class="w-full px-4 py-3 border border-pink-100 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 bg-white transition-all">
                                        <option value="">Select time slot...</option>
                                        <option value="morning">Morning (9 AM - 12 PM)</option>
                                        <option value="afternoon">Afternoon (12 PM - 4 PM)</option>
                                        <option value="evening">Evening (4 PM - 7 PM)</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Consultation Type *</label>
                                    <select name="consultation_type" required class="w-full px-4 py-3 border border-pink-100 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 bg-white transition-all">
                                        <option value="">Choose type...</option>
                                        <option value="video">Online Video Consultation</option>
                                        <option value="clinic">In-Clinic Visit</option>
                                        <option value="home">Home Visit</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">City *</label>
                                    <select name="city" required class="w-full px-4 py-3 border border-pink-100 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 bg-white transition-all">
                                        <option value="">Select city...</option>
                                        <option value="delhi">Delhi NCR</option>
                                        <option value="mumbai">Mumbai</option>
                                        <option value="bangalore">Bangalore</option>
                                        <option value="pune">Pune</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-6">
                            <button type="submit" class="w-full bg-gradient-to-r from-pink-500 to-pink-600 text-white px-8 py-4 rounded-full font-bold text-lg hover:from-pink-600 hover:to-pink-700 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Confirm Appointment Request
                            </button>
                            <p class="text-center text-sm text-gray-600 mt-4">
                                We'll contact you within 24 hours to confirm your appointment
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Column - Sidebar (Takes 1 column) -->
            <div class="lg:col-span-1">
                <div class="sticky top-6 space-y-6">
                    <!-- Image -->
                    <div class="rounded-2xl overflow-hidden theme-card-solid border border-pink-100">
                        <img src="{{ asset('images/appointment_booking.png') }}" alt="Appointment Booking" class="w-full h-64 object-cover">
                    </div>

                    <!-- Why Book With Us -->
                    <div class="theme-card rounded-2xl p-6 border border-pink-100">
                        <h4 class="font-bold heading-font text-gray-900 mb-4 text-lg">Why Book With Us?</h4>
                        <ul class="space-y-3 text-sm text-gray-700">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-pink-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>100% Female Physiotherapists</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-pink-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Verified & Certified Specialists</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-pink-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Private & Confidential</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-pink-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Flexible Scheduling</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-pink-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Online & In-Person Options</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Contact Support -->
                    <div class="theme-card-solid rounded-2xl p-6 border border-pink-100">
                        <h4 class="font-bold heading-font text-gray-900 mb-3">Need Help?</h4>
                        <p class="text-sm text-gray-600 mb-4">Our support team is here to assist you</p>
                        <a href="{{ route('contact') }}" class="block text-center bg-pink-600 text-white px-4 py-3 rounded-xl hover:bg-pink-700 transition-all font-semibold text-sm shadow-md hover:shadow-lg">
                            Contact Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
