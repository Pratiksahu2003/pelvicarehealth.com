@extends('layouts.app')

@section('title')
Join as Physiotherapist - Pelvic Health Platform
@endsection

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-pink-50 via-white to-pink-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h1 class="text-4xl md:text-5xl font-bold heading-font text-gray-900 mb-4">
                Join Our Network of Specialists
            </h1>
            <p class="text-xl text-gray-700 max-w-3xl mx-auto">
                Empower women across India by joining our platform of verified pelvic health physiotherapists
            </p>
        </div>
    </div>
</section>

<!-- Registration Form Section -->
<section class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl p-8 border border-pink-100">
                    @if(session('success'))
                    <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded">
                        <p class="text-green-700">{{ session('success') }}</p>
                    </div>
                    @endif

                    <form action="{{ route('physiotherapist.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <!-- Step 1: Personal Information -->
                        <div>
                            <h3 class="text-2xl font-bold heading-font text-gray-900 mb-6 flex items-center">
                                <span class="w-8 h-8 bg-gradient-to-r from-pink-400 to-pink-500 text-white rounded-full flex items-center justify-center mr-3 text-sm">1</span>
                                Personal Information
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name *</label>
                                    <input type="text" name="name" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all" placeholder="Dr. Your Name">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
                                    <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all" placeholder="your@email.com">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number *</label>
                                    <input type="tel" name="phone" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all" placeholder="+91 XXXXX XXXXX">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Years of Experience *</label>
                                    <input type="number" name="experience" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all" placeholder="e.g., 5">
                                </div>
                            </div>
                        </div>

                        <hr class="border-pink-100">

                        <!-- Step 2: Professional Qualifications -->
                        <div>
                            <h3 class="text-2xl font-bold heading-font text-gray-900 mb-6 flex items-center">
                                <span class="w-8 h-8 bg-gradient-to-r from-pink-400 to-pink-500 text-white rounded-full flex items-center justify-center mr-3 text-sm">2</span>
                                Professional Qualifications
                            </h3>
                            
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Highest Qualification *</label>
                                    <select name="qualification" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all">
                                        <option value="">Select qualification...</option>
                                        <option value="bpt">BPT (Bachelor of Physiotherapy)</option>
                                        <option value="mpt">MPT (Master of Physiotherapy)</option>
                                        <option value="phd">PhD in Physiotherapy</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Category (Women's Health) *</label>
                                    <select name="specialization" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all">
                                        <option value="">Select category...</option>
                                        <option value="pelvic-floor">Pelvic Floor Rehabilitation</option>
                                        <option value="womens-health">Women's Health Physiotherapy</option>
                                        <option value="postpartum">Postpartum Care</option>
                                        <option value="prenatal">Prenatal Care</option>
                                        <option value="general">General Women's Health</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Registration Number *</label>
                                    <input type="text" name="registration_number" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all" placeholder="State Council Registration Number">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Additional Certifications</label>
                                    <textarea name="certifications" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all" placeholder="List any additional certifications (e.g., APTA Pelvic Health, Postgraduate training)"></textarea>
                                </div>
                            </div>
                        </div>

                        <hr class="border-pink-100">

                        <!-- Step 3: Practice Details -->
                        <div>
                            <h3 class="text-2xl font-bold heading-font text-gray-900 mb-6 flex items-center">
                                <span class="w-8 h-8 bg-gradient-to-r from-pink-400 to-pink-500 text-white rounded-full flex items-center justify-center mr-3 text-sm">3</span>
                                Practice Details
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">City *</label>
                                    <select name="city" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all">
                                        <option value="">Select city...</option>
                                        <option value="delhi">Delhi NCR</option>
                                        <option value="mumbai">Mumbai</option>
                                        <option value="bangalore">Bangalore</option>
                                        <option value="pune">Pune</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Clinic/Hospital Name</label>
                                    <input type="text" name="clinic_name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all" placeholder="Your clinic or hospital name">
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Services Offered *</label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        <label class="flex items-center space-x-2 cursor-pointer">
                                            <input type="checkbox" name="services[]" value="video" class="w-4 h-4 text-pink-500 border-gray-300 rounded focus:ring-pink-400">
                                            <span class="text-sm text-gray-700">Online Video Consultation</span>
                                        </label>
                                        <label class="flex items-center space-x-2 cursor-pointer">
                                            <input type="checkbox" name="services[]" value="clinic" class="w-4 h-4 text-pink-500 border-gray-300 rounded focus:ring-pink-400">
                                            <span class="text-sm text-gray-700">In-Clinic Visits</span>
                                        </label>
                                        <label class="flex items-center space-x-2 cursor-pointer">
                                            <input type="checkbox" name="services[]" value="home" class="w-4 h-4 text-pink-500 border-gray-300 rounded focus:ring-pink-400">
                                            <span class="text-sm text-gray-700">Home Visits</span>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Brief Bio</label>
                                    <textarea name="bio" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all" placeholder="Tell us about yourself and your approach to women's health physiotherapy..."></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="bg-pink-50 rounded-lg p-6">
                            <label class="flex items-start space-x-3 cursor-pointer">
                                <input type="checkbox" name="terms" required class="w-5 h-5 text-pink-500 border-gray-300 rounded focus:ring-pink-400 mt-1">
                                <span class="text-sm text-gray-700">
                                    I agree to the <a href="#" class="text-pink-600 hover:text-pink-700 font-semibold">Terms & Conditions</a> and confirm that all information provided is accurate. I understand that my credentials will be verified before approval.
                                </span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-6">
                            <button type="submit" class="w-full bg-gradient-to-r from-pink-400 to-pink-500 text-white px-8 py-4 rounded-full font-bold text-lg hover:from-pink-500 hover:to-pink-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Submit Registration
                            </button>
                            <p class="text-center text-sm text-gray-600 mt-4">
                                Our team will review your application within 48 hours
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Column - Benefits -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-6">
                    <!-- Image -->
                    <div class="rounded-2xl overflow-hidden shadow-lg">
                        <img src="{{ asset('images/physiotherapist_1.png') }}" alt="Join Our Team" class="w-full h-64 object-cover">
                    </div>

                    <!-- Benefits -->
                    <div class="bg-gradient-to-br from-pink-50 to-pink-100 rounded-2xl p-6 border border-pink-200">
                        <h4 class="font-bold heading-font text-gray-900 mb-4 text-lg">Why Join Us?</h4>
                        <ul class="space-y-3 text-sm text-gray-700">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-pink-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Access to verified patient network</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-pink-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Flexible scheduling options</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-pink-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Professional development resources</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-pink-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Marketing & platform support</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-pink-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Join a community of specialists</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Stats -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200">
                        <h4 class="font-bold heading-font text-gray-900 mb-4">Our Impact</h4>
                        <div class="space-y-4">
                            <div>
                                <div class="text-3xl font-bold text-pink-600">200+</div>
                                <div class="text-sm text-gray-600">Verified Specialists</div>
                            </div>
                            <div>
                                <div class="text-3xl font-bold text-pink-600">5,000+</div>
                                <div class="text-sm text-gray-600">Women Helped</div>
                            </div>
                            <div>
                                <div class="text-3xl font-bold text-pink-600">4</div>
                                <div class="text-sm text-gray-600">Major Cities</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
