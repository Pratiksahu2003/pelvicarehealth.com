@extends('layouts.app')

@section('title', 'Treatments - Pelvicare Women\'s Health Physiotherapy')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-pink-50 via-white to-pink-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold heading-font text-gray-900 text-center mb-4">
                Our Treatment Methods
            </h1>
            <p class="text-xl text-gray-700 text-center max-w-3xl mx-auto">
                Evidence-based approaches to pelvic health and rehabilitation
            </p>
        </div>
    </section>

    <!-- Treatments Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
                
                <!-- Manual Therapy -->
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold heading-font text-gray-900 mb-4">Manual Therapy</h3>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Hands-on techniques including soft tissue mobilization, myofascial release, and joint mobilization to address muscle tension, scar tissue, and restrictions in the pelvic region.
                        </p>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-start">
                                <span class="text-pink-500 mr-2">•</span>
                                <span>Soft tissue mobilization</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-pink-500 mr-2">•</span>
                                <span>Myofascial release</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-pink-500 mr-2">•</span>
                                <span>Joint mobilization</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Pelvic Floor Exercises -->
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold heading-font text-gray-900 mb-4">Pelvic Floor Exercises</h3>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Targeted exercises to strengthen, relax, or coordinate pelvic floor muscles. Includes Kegel exercises, biofeedback training, and progressive muscle training programs.
                        </p>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-start">
                                <span class="text-blue-500 mr-2">•</span>
                                <span>Kegel exercises</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-blue-500 mr-2">•</span>
                                <span>Biofeedback training</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-blue-500 mr-2">•</span>
                                <span>Progressive muscle training</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Biofeedback -->
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold heading-font text-gray-900 mb-4">Biofeedback</h3>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Real-time monitoring of pelvic floor muscle activity using sensors to help you understand and improve muscle function through visual or auditory feedback.
                        </p>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-start">
                                <span class="text-purple-500 mr-2">•</span>
                                <span>Real-time muscle monitoring</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-purple-500 mr-2">•</span>
                                <span>Visual feedback systems</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-purple-500 mr-2">•</span>
                                <span>Muscle coordination training</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Education & Lifestyle -->
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold heading-font text-gray-900 mb-4">Education & Lifestyle</h3>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Comprehensive education about pelvic anatomy, function, and healthy habits. Includes bladder training, bowel management, and ergonomic advice.
                        </p>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-start">
                                <span class="text-green-500 mr-2">•</span>
                                <span>Bladder training</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-green-500 mr-2">•</span>
                                <span>Bowel management</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-green-500 mr-2">•</span>
                                <span>Ergonomic advice</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Core Strengthening -->
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold heading-font text-gray-900 mb-4">Core Strengthening</h3>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Exercises to strengthen the deep core muscles that support the pelvic floor, including transverse abdominis, multifidus, and diaphragm coordination.
                        </p>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-start">
                                <span class="text-orange-500 mr-2">•</span>
                                <span>Deep core activation</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-orange-500 mr-2">•</span>
                                <span>Postural training</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-orange-500 mr-2">•</span>
                                <span>Functional movement patterns</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Pain Management -->
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold heading-font text-gray-900 mb-4">Pain Management</h3>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Techniques to reduce pelvic pain including relaxation exercises, breathing techniques, and pain neuroscience education to help manage chronic pain conditions.
                        </p>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-start">
                                <span class="text-indigo-500 mr-2">•</span>
                                <span>Relaxation techniques</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-indigo-500 mr-2">•</span>
                                <span>Breathing exercises</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-indigo-500 mr-2">•</span>
                                <span>Pain neuroscience education</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Treatment Process -->
    <section class="py-20 relative overflow-hidden">
        <!-- Background Gradient -->
        <div class="absolute inset-0 bg-gradient-to-b from-purple-50 via-pink-50 to-white -z-10"></div>
        
        <!-- Decorative blobs -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 opacity-30 pointer-events-none">
            <div class="absolute top-20 left-10 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute top-20 right-10 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-32 left-1/2 w-96 h-96 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 relative">
                <h2 class="text-3xl md:text-5xl font-bold heading-font text-gray-900 mb-6 tracking-tight">
                    Our Treatment Process
                </h2>
                <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    A caring and structured approach to help you recover and regain confidence in your body.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                <!-- Step 1 -->
                <div class="relative group h-full">
                    <div class="absolute inset-0 bg-gradient-to-br from-pink-400 to-pink-600 rounded-2xl blur opacity-20 group-hover:opacity-40 transition duration-500"></div>
                    <div class="relative bg-white/60 backdrop-blur-xl border border-white/50 rounded-2xl p-6 h-full shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col transform group-hover:-translate-y-1">
                        <div class="w-14 h-14 bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl flex items-center justify-center text-white text-2xl font-bold mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            1
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 heading-font">Initial Assessment</h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4 flex-grow">
                            Comprehensive evaluation of your condition and unique needs.
                        </p>
                        <p class="text-xs text-pink-700/80 font-medium italic mt-auto pt-4 border-t border-pink-100">
                            Used for pelvic pain, pain during sex, post-surgery recovery, back pain.
                        </p>
                    </div>
                </div>
                
                <!-- Step 2 -->
                <div class="relative group h-full">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl blur opacity-20 group-hover:opacity-40 transition duration-500"></div>
                    <div class="relative bg-white/60 backdrop-blur-xl border border-white/50 rounded-2xl p-6 h-full shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col transform group-hover:-translate-y-1">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center text-white text-2xl font-bold mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            2
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 heading-font">Treatment Plan</h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4 flex-grow">
                            Personalised plan tailored to your specific goals and life stage.
                        </p>
                        <p class="text-xs text-blue-700/80 font-medium italic mt-auto pt-4 border-t border-blue-100">
                            Not all pelvic issues need strengthening — we assess before prescribing exercises.
                        </p>
                    </div>
                </div>
                
                <!-- Step 3 -->
                <div class="relative group h-full">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl blur opacity-20 group-hover:opacity-40 transition duration-500"></div>
                    <div class="relative bg-white/60 backdrop-blur-xl border border-white/50 rounded-2xl p-6 h-full shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col transform group-hover:-translate-y-1">
                        <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center text-white text-2xl font-bold mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            3
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 heading-font">Active Treatment</h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4 flex-grow">
                            Regular sessions with hands-on therapy, exercises, and education.
                        </p>
                        <p class="text-xs text-purple-700/80 font-medium italic mt-auto pt-4 border-t border-purple-100">
                            Used for diastasis recti, back pain, pelvic instability, and postnatal recovery.
                        </p>
                    </div>
                </div>
                
                <!-- Step 4 -->
                <div class="relative group h-full">
                    <div class="absolute inset-0 bg-gradient-to-br from-teal-400 to-teal-600 rounded-2xl blur opacity-20 group-hover:opacity-40 transition duration-500"></div>
                    <div class="relative bg-white/60 backdrop-blur-xl border border-white/50 rounded-2xl p-6 h-full shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col transform group-hover:-translate-y-1">
                        <div class="w-14 h-14 bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl flex items-center justify-center text-white text-2xl font-bold mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            4
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 heading-font">Ongoing Support</h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4 flex-grow">
                            Continued guidance, progress monitoring & adjustments as you improve.
                        </p>
                        <p class="text-xs text-teal-700/80 font-medium italic mt-auto pt-4 border-t border-teal-100">
                            Education is a core part of long-term recovery.
                        </p>
                    </div>
                </div>

                <!-- Step 5 -->
                <div class="relative group h-full">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl blur opacity-20 group-hover:opacity-40 transition duration-500"></div>
                    <div class="relative bg-white/60 backdrop-blur-xl border border-white/50 rounded-2xl p-6 h-full shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col transform group-hover:-translate-y-1">
                        <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center text-white text-2xl font-bold mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            5
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 heading-font">Gradual Independence</h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4 flex-grow">
                            Empowering you with the tools & confidence to maintain results long-term.
                        </p>
                        <p class="text-xs text-orange-700/80 font-medium italic mt-auto pt-4 border-t border-orange-100">
                            Especially helpful for chronic pelvic pain, endometriosis-related pain, and sexual pain.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-gradient-to-r from-pink-600 to-pink-500 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-3xl md:text-5xl font-bold heading-font text-white mb-6 leading-tight">
                Ready to Begin Treatment?
            </h2>
            <p class="text-xl text-pink-100 mb-10 max-w-2xl mx-auto font-medium">
                Schedule a consultation to discuss which treatment approach is right for you.
            </p>
            <a href="{{ route('contact') }}" class="inline-flex items-center justify-center bg-white text-pink-600 px-10 py-4 rounded-full font-bold text-lg hover:bg-pink-50 transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1 hover:scale-105 duration-300">
                <span>Book Consultation</span>
                <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </section>
@endsection

