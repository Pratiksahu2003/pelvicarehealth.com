@extends('layouts.app')

@section('title', $doctor->name . ' - Expert Physiotherapist | Pelvicare')

@section('meta_description', $doctor->doctorProfile->bio ? Str::limit(strip_tags($doctor->doctorProfile->bio), 160) :
    'Expert women\'s health physiotherapist at Pelvicare.')

@section('content')
    @php
        $profile = $doctor->doctorProfile;
        $profileImageUrl = $profile->profile_image
            ? (media_url($profile->profile_image) ?? asset('images/physiotherapist_1.png'))
            : asset('images/physiotherapist_1.png');
        $allPhotos = collect();
        $allPhotos->push((object) ['url' => $profileImageUrl, 'type' => 'profile']);
        $photosList = $profile->photos instanceof \Illuminate\Support\Collection ? $profile->photos : collect();
        foreach ($photosList as $p) {
            $allPhotos->push((object) ['url' => media_url($p->path) ?? asset($p->path), 'type' => $p->type]);
        }
        $rating = $profile->rating ?? 4.5;
        $faqsList = $profile->faqs instanceof \Illuminate\Support\Collection ? $profile->faqs : collect();
        $clinicPhotosList =
            $profile->clinicPhotos instanceof \Illuminate\Support\Collection ? $profile->clinicPhotos : collect();
    @endphp
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-pink-50 via-white to-pink-100 py-10 md:py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center mb-6">
                <a href="{{ route('doctors.index') }}"
                    class="text-pink-600 hover:text-pink-700 font-semibold flex items-center text-sm md:text-base group">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0 group-hover:-translate-x-0.5 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to All Specialists
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-10">
                <!-- Left Column - Doctor Card with Photo Slider -->
                <div class="lg:col-span-1">
                    <div class="theme-card-solid rounded-2xl overflow-hidden border border-pink-100 sticky top-6">
                        <!-- Main photo (clicking thumbnails updates this) – 1:1 square -->
                        <div class="relative bg-gray-100 aspect-square">
                            <img id="doctor-main-photo" src="{{ $profileImageUrl }}" alt="{{ $doctor->name }}"
                                class="w-full h-full object-cover transition-opacity duration-300">
                            <div
                                class="absolute top-3 right-3 bg-white/95 rounded-full px-3 py-1.5 text-sm font-semibold text-pink-600 shadow-lg">
                                ⭐ {{ number_format($rating, 1) }}/5
                            </div>
                        </div>
                        <!-- Thumbnail slider (click to set main photo) -->
                        @if ($allPhotos->count() > 1)
                            <div class="p-3 bg-pink-50/50 border-t border-pink-100">
                                <p class="text-xs font-medium text-gray-500 mb-2 px-1">Click a photo to view</p>
                                <div class="flex gap-2 overflow-x-auto pb-1 scrollbar-thin scrollbar-thumb-pink-200 scrollbar-track-gray-100"
                                    style="scrollbar-width: thin;">
                                    @foreach ($allPhotos as $index => $photo)
                                        <button type="button"
                                            class="doctor-photo-thumb flex-shrink-0 w-14 h-14 rounded-lg overflow-hidden border-2 border-transparent hover:border-pink-400 focus:border-pink-500 focus:ring-2 focus:ring-pink-200 transition-all"
                                            data-photo-url="{{ $photo->url }}"
                                            aria-label="View photo {{ $index + 1 }}">
                                            <img src="{{ $photo->url }}" alt=""
                                                class="w-full h-full object-cover">
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="p-6">
                            <h2 class="text-2xl font-bold heading-font text-gray-900 mb-2">{{ $doctor->name }}</h2>
                            <div class="space-y-3 mb-6">
                                @if ($profile->years_of_experience)
                                    <div class="flex items-center text-gray-700 text-sm">
                                        <svg class="w-5 h-5 text-pink-600 mr-3 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>{{ $profile->years_of_experience }}+ years experience</span>
                                    </div>
                                @endif
                                @if ($profile->city)
                                    <div class="flex items-center text-gray-700 text-sm">
                                        <svg class="w-5 h-5 text-pink-600 mr-3 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 12z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span>{{ $profile->city }}</span>
                                    </div>
                                @endif
                                @if ($profile->languages && is_array($profile->languages))
                                    <div class="flex items-start text-gray-700 text-sm">
                                        <svg class="w-5 h-5 text-pink-600 mr-3 mt-0.5 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129">
                                            </path>
                                        </svg>
                                        <span>{{ implode(', ', $profile->languages) }}</span>
                                    </div>
                                @endif
                            </div>
                            @if ($profile->clinic_visit_fee || $profile->home_visit_fee || $profile->video_session_fee)
                                <div class="border-t border-gray-200 pt-4 mb-6">
                                    <h3 class="font-semibold text-gray-900 mb-3 text-sm">Consultation Fees</h3>
                                    <div class="space-y-2 text-sm">
                                        @if ($profile->clinic_visit_fee)
                                            <div class="flex justify-between"><span
                                                    class="text-gray-600">Clinic:</span><span
                                                    class="font-semibold text-gray-900">₹{{ number_format($profile->clinic_visit_fee, 0) }}</span>
                                            </div>
                                        @endif
                                        @if ($profile->home_visit_fee)
                                            <div class="flex justify-between"><span class="text-gray-600">Home:</span><span
                                                    class="font-semibold text-gray-900">₹{{ number_format($profile->home_visit_fee, 0) }}</span>
                                            </div>
                                        @endif
                                        @if ($profile->video_session_fee)
                                            <div class="flex justify-between"><span class="text-gray-600">Video:</span><span
                                                    class="font-semibold text-gray-900">₹{{ number_format($profile->video_session_fee, 0) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <div class="space-y-3">
                                <a href="{{ route('booking.doctor', $profile->slug) }}"
                                    class="block w-full bg-gradient-to-r from-pink-500 to-pink-600 text-white text-center px-6 py-3 rounded-xl hover:from-pink-600 hover:to-pink-700 transition-all font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 text-sm sm:text-base">
                                    Book Appointment
                                </a>
                                @if ($profile->clinic_address)
                                    <a href="https://maps.google.com/?q={{ urlencode($profile->clinic_address) }}"
                                        target="_blank" rel="noopener"
                                        class="block w-full bg-white text-pink-600 border-2 border-pink-600 text-center px-6 py-3 rounded-xl hover:bg-pink-50 transition-all font-semibold text-sm sm:text-base">
                                        View Location
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="lg:col-span-2 space-y-6 lg:space-y-8">
                    <!-- About (rich HTML from TinyMCE) -->
                    @if ($profile->bio)
                        <div class="theme-card-solid rounded-2xl p-6 sm:p-8 border border-pink-100">
                            <h2 class="text-xl sm:text-2xl font-bold heading-font text-gray-900 mb-4">About
                                {{ $doctor->name }}</h2>
                            <div class="rich-content prose prose-lg prose-pink max-w-none prose-img:rounded-xl">
                                {!! $profile->bio !!}
                            </div>
                        </div>
                    @endif

                    <!-- FAQs -->
                    @if ($faqsList->isNotEmpty())
                        <div class="theme-card-solid rounded-2xl p-6 sm:p-8 border border-pink-100">
                            <h2 class="text-xl sm:text-2xl font-bold heading-font text-gray-900 mb-4">Frequently Asked
                                Questions</h2>
                            <div class="space-y-4">
                                @foreach ($faqsList as $faq)
                                    <div class="border-b border-gray-100 last:border-0 pb-4 last:pb-0">
                                        <h3 class="font-semibold text-gray-900 mb-2">{{ $faq->question }}</h3>
                                        <p class="text-gray-600 text-sm leading-relaxed">{{ $faq->answer }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Clinic Photos (optional - only when added) -->
                    @if ($clinicPhotosList->isNotEmpty())
                        <div class="theme-card-solid rounded-2xl p-6 sm:p-8 border border-pink-100">
                            <h2 class="text-xl sm:text-2xl font-bold heading-font text-gray-900 mb-4">Clinic</h2>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                @foreach ($clinicPhotosList as $photo)
                                    <div class="rounded-xl overflow-hidden border border-gray-200 aspect-square">
                                        <img src="{{ asset('' . $photo->path) }}" alt="Clinic"
                                            class="w-full h-full object-cover">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Category / Subcategory - Grouped by category -->
                    @php
                        $categories = $profile->serviceCategories();
                        $subcategories = $profile->serviceSubcategories();
                        $hasCategoryData = $categories->isNotEmpty() || $subcategories->isNotEmpty();
                    @endphp
                    @if ($hasCategoryData)
                        <div class="theme-card-solid rounded-2xl p-6 sm:p-8 border border-pink-100">
                            <h2 class="text-xl sm:text-2xl font-bold heading-font text-gray-900 mb-6">Areas of Expertise
                            </h2>
                            <div class="space-y-6">
                                @foreach ($categories as $cat)
                                    @php $subs = $subcategories->where('service_category_id', $cat->id); @endphp
                                    <div>
                                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-3 flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-pink-500"></span>
                                            <a href="{{ route('services.show', $cat->slug) }}" class="hover:text-pink-600 transition-colors">{{ $cat->name }}</a>
                                        </h3>
                                        @if ($subs->isNotEmpty())
                                            <div class="flex flex-wrap gap-2 pl-4">
                                                @foreach ($subs as $sub)
                                                    <a href="{{ route('services.subservice', [$cat->slug, $sub->slug]) }}"
                                                        class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium bg-pink-50 text-pink-700 border border-pink-200 hover:bg-pink-100 hover:border-pink-300 transition-colors">{{ $sub->name }}</a>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                                @php $orphanSubs = $subcategories->whereNotIn('service_category_id', $categories->pluck('id')); @endphp
                                @if ($orphanSubs->isNotEmpty())
                                    <div>
                                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-3 flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-pink-500"></span>
                                            Other Specialisations
                                        </h3>
                                        <div class="flex flex-wrap gap-2 pl-4">
                                            @foreach ($orphanSubs as $sub)
                                                @php $parentCat = $sub->serviceCategory; @endphp
                                                @if ($parentCat)
                                                    <a href="{{ route('services.subservice', [$parentCat->slug, $sub->slug]) }}"
                                                        class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium bg-pink-50 text-pink-700 border border-pink-200 hover:bg-pink-100 hover:border-pink-300 transition-colors">{{ $sub->name }}</a>
                                                @else
                                                    <a href="{{ route('services') }}"
                                                        class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium bg-pink-50 text-pink-700 border border-pink-200 hover:bg-pink-100 hover:border-pink-300 transition-colors">{{ $sub->name }}</a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Clinic Information -->
                    @if ($profile->clinic_name || $profile->clinic_address)
                        <div class="theme-card-solid rounded-2xl p-6 sm:p-8 border border-pink-100">
                            <h2 class="text-xl sm:text-2xl font-bold heading-font text-gray-900 mb-4">Clinic Information
                            </h2>
                            <div class="space-y-3 text-sm sm:text-base">
                                @if ($profile->clinic_name)
                                    <div><span class="font-semibold text-gray-900">Clinic:</span> <span
                                            class="text-gray-700">{{ $profile->clinic_name }}</span></div>
                                @endif
                                @if ($profile->clinic_address)
                                    <div><span class="font-semibold text-gray-900">Address:</span>
                                        <p class="text-gray-700 mt-1">{{ $profile->clinic_address }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Experience -->
                    <div class="theme-card-solid rounded-2xl p-6 sm:p-8 border border-pink-100">
                        <h2 class="text-xl sm:text-2xl font-bold heading-font text-gray-900 mb-4">Experience & Verification
                        </h2>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-pink-600 mr-3 mt-1 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <h3 class="font-semibold text-gray-900">Experience</h3>
                                    <p class="text-gray-700 text-sm">{{ $profile->years_of_experience ?? 0 }}+ years in
                                        women's health physiotherapy</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-pink-600 mr-3 mt-1 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <h3 class="font-semibold text-gray-900">Verification</h3>
                                    <p class="text-gray-700 text-sm">Verified by Pelvicare Health Care</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var mainPhoto = document.getElementById('doctor-main-photo');
                var thumbs = document.querySelectorAll('.doctor-photo-thumb');
                if (mainPhoto && thumbs.length) {
                    thumbs.forEach(function(btn) {
                        btn.addEventListener('click', function() {
                            var url = this.getAttribute('data-photo-url');
                            if (url) {
                                mainPhoto.style.opacity = '0.5';
                                mainPhoto.src = url;
                                mainPhoto.onload = function() {
                                    mainPhoto.style.opacity = '1';
                                };
                                thumbs.forEach(function(t) {
                                    t.classList.remove('border-pink-500');
                                    t.classList.add('border-transparent');
                                });
                                btn.classList.remove('border-transparent');
                                btn.classList.add('border-pink-500');
                            }
                        });
                    });
                }
            });
        </script>
    @endpush
@endsection
