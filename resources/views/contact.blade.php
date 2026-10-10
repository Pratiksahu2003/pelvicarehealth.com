@extends('layouts.app')

@section('title', 'Contact - Pelvicare Women\'s Health Physiotherapy')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-pink-50 via-white to-pink-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold heading-font text-gray-900 text-center mb-4">
                Contact Us
            </h1>
            <p class="text-xl text-gray-700 text-center max-w-3xl mx-auto">
                Get in touch to schedule a consultation or learn more about our services
            </p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                
                <!-- Contact Form -->
                <div>
                    <h2 class="text-3xl font-bold heading-font text-gray-900 mb-6">
                        Send Us a Message
                    </h2>
                    <form class="space-y-6" id="contact-form">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Full Name *
                            </label>
                            <input type="text" id="name" name="name" required
                                class="w-full px-4 py-3 border border-pink-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors bg-white hover:border-pink-300"
                                placeholder="Your full name">
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address *
                            </label>
                            <input type="email" id="email" name="email" required
                                class="w-full px-4 py-3 border border-pink-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors bg-white hover:border-pink-300"
                                placeholder="your.email@example.com">
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Phone Number *
                            </label>
                            <input type="tel" id="phone" name="phone" required
                                class="w-full px-4 py-3 border border-pink-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors bg-white hover:border-pink-300"
                                placeholder="+91 12345 67890">
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                                Subject *
                            </label>
                            <select id="subject" name="subject" required
                                class="w-full px-4 py-3 border border-pink-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors bg-white hover:border-pink-300">
                                <option value="">Select a subject</option>
                                <option value="consultation">Schedule Consultation</option>
                                <option value="services">General Inquiry</option>
                                <option value="treatment">Treatment Information</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                Message *
                            </label>
                            <textarea id="message" name="message" rows="6" required
                                class="w-full px-4 py-3 border border-pink-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors resize-none bg-white hover:border-pink-300"
                                placeholder="Please tell us about your concerns or questions..."></textarea>
                        </div>
                        
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-pink-500 to-pink-600 text-white px-8 py-4 rounded-full font-semibold hover:from-pink-600 hover:to-pink-700 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            Send Message
                        </button>
                    </form>
                    
                    <div id="form-success" class="hidden mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <p class="text-green-800">Thank you! Your message has been sent successfully. We'll get back to you soon.</p>
                    </div>
                </div>
                
                <!-- Contact Information -->
                <div>
                    <h2 class="text-3xl font-bold heading-font text-gray-900 mb-6">
                        Get in Touch
                    </h2>
                    
                    <div class="space-y-8 mb-8">
                        <div class="flex items-start gap-4 p-4 rounded-xl hover:bg-pink-50 transition-colors">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold heading-font text-gray-900 mb-2">Phone</h3>
                                <a href="tel:+918141652016" class="text-gray-700 hover:text-pink-600 transition-colors text-lg font-medium">
                                    +91 81416 52016
                                </a>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4 p-4 rounded-xl hover:bg-pink-50 transition-colors">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 bg-gradient-to-br from-rose-400 to-rose-500 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold heading-font text-gray-900 mb-2">Practitioner</h3>
                                <p class="text-gray-700 text-lg">Dr. Sunita Patel, PT</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4 p-4 rounded-xl hover:bg-pink-50 transition-colors">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 bg-gradient-to-br from-fuchsia-400 to-fuchsia-500 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold heading-font text-gray-900 mb-2">Office Hours</h3>
                                <p class="text-gray-700">Monday - Friday: 9:00 AM - 6:00 PM</p>
                                <p class="text-gray-700">Saturday: 9:00 AM - 2:00 PM</p>
                                <p class="text-gray-700">Sunday: Closed</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Map Placeholder -->
                    <div class="bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl p-8 h-64 flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <p class="text-gray-600">Location map will be displayed here</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold heading-font text-gray-900 mb-4">
                    Frequently Asked Questions
                </h2>
            </div>
            
            <div class="space-y-6">
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <h3 class="text-xl font-bold heading-font text-gray-900 mb-2">
                        How do I schedule an appointment?
                    </h3>
                    <p class="text-gray-700">
                        You can schedule an appointment by calling us at +91 81416 52016 or by filling out the contact form above. 
                        We'll get back to you within 24 hours to confirm your appointment.
                    </p>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <h3 class="text-xl font-bold heading-font text-gray-900 mb-2">
                        What should I expect during my first visit?
                    </h3>
                    <p class="text-gray-700">
                        Your first visit will include a comprehensive assessment where we'll discuss your medical history, 
                        current symptoms, and treatment goals. This helps us create a personalized treatment plan for you.
                    </p>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <h3 class="text-xl font-bold heading-font text-gray-900 mb-2">
                        Do you accept insurance?
                    </h3>
                    <p class="text-gray-700">
                        Please contact us directly to discuss insurance coverage and payment options. We work with various 
                        insurance providers and can help you understand your coverage.
                    </p>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <h3 class="text-xl font-bold heading-font text-gray-900 mb-2">
                        How long does treatment typically take?
                    </h3>
                    <p class="text-gray-700">
                        Treatment duration varies depending on your specific condition and goals. Some patients see improvement 
                        in a few sessions, while others may need longer-term care. We'll discuss your expected timeline during 
                        your initial consultation.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Form submission handler
        document.getElementById('contact-form')?.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // In a real application, this would send the data to a server
            // For demo purposes, we'll just show a success message
            const form = this;
            const successMessage = document.getElementById('form-success');
            
            // Hide form and show success message
            form.style.display = 'none';
            successMessage.classList.remove('hidden');
            
            // Scroll to success message
            successMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        });
    </script>
@endsection

