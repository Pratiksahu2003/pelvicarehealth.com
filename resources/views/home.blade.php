@extends('layouts.app')

@section('title')
Women's Health Physiotherapy India | Pain During Sex & Postpartum Care
@endsection

@section('meta_description')
Pain during sex? Leaking urine after childbirth? Connect with verified women's health physiotherapists in Delhi NCR. Private, safe, judgment-free care.
@endsection

@push('styles')
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    /* Featured Doctors Swiper Styles */
    .featured-doctors-swiper {
        padding: 20px 60px 60px 60px !important;
    }
    
    .featured-doctors-swiper .swiper-slide {
        height: auto;
    }
    
    /* Navigation Arrows */
    .featured-doctors-next,
    .featured-doctors-prev {
        background: white;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        color: #db2777;
        transition: all 0.3s ease;
    }
    
    .featured-doctors-next:hover,
    .featured-doctors-prev:hover {
        background: #fce7f3;
        transform: scale(1.1);
        box-shadow: 0 6px 16px rgba(219, 39, 119, 0.3);
    }
    
    .featured-doctors-next::after,
    .featured-doctors-prev::after {
        font-size: 18px;
        font-weight: bold;
    }
    
    /* Pagination */
    .featured-doctors-pagination {
        bottom: 20px !important;
    }
    
    .featured-doctors-pagination .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        background: #d1d5db;
        opacity: 1;
        transition: all 0.3s ease;
    }
    
    .featured-doctors-pagination .swiper-pagination-bullet-active {
        background: #db2777;
        width: 30px;
        border-radius: 5px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .featured-doctors-swiper {
            padding: 20px 40px 60px 40px !important;
        }
        
        .featured-doctors-next,
        .featured-doctors-prev {
            width: 36px;
            height: 36px;
        }
        
        .featured-doctors-next::after,
        .featured-doctors-prev::after {
            font-size: 14px;
        }
    }
    
    @media (max-width: 640px) {
        .featured-doctors-swiper {
            padding: 20px 30px 60px 30px !important;
        }
    }
    
    /* Blob Animation */
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-4000 {
        animation-delay: 4s;
    }

    /* ── Home: professional motion (scoped) ───────────────────────────── */
    @keyframes home-fade-up {
        from { opacity: 0; transform: translateY(22px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes home-fade-in {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes home-float-soft {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }
    @keyframes home-shine {
        0% { background-position: 200% center; }
        100% { background-position: -200% center; }
    }

    .home-hero-line {
        opacity: 0;
        animation: home-fade-up 0.75s cubic-bezier(0.22, 1, 0.36, 1) forwards;
    }
    .home-hero-line:nth-child(1) { animation-delay: 0.04s; }
    .home-hero-line:nth-child(2) { animation-delay: 0.1s; }
    .home-hero-line:nth-child(3) { animation-delay: 0.16s; }
    .home-hero-line:nth-child(4) { animation-delay: 0.22s; }
    .home-hero-line:nth-child(5) { animation-delay: 0.28s; }
    .home-hero-line:nth-child(6) { animation-delay: 0.34s; }
    .home-hero-line:nth-child(7) { animation-delay: 0.4s; }
    .home-hero-line:nth-child(8) { animation-delay: 0.46s; }

    .home-hero-img-wrap {
        opacity: 0;
        animation: home-fade-up 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.15s forwards;
    }
    .home-hero-img-wrap img {
        transition: transform 0.7s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.5s ease;
    }
    .home-hero-img-wrap:hover img {
        transform: scale(1.02);
        box-shadow: 0 25px 50px -12px rgba(219, 39, 119, 0.25);
    }

    .home-reveal {
        opacity: 0;
        transform: translateY(26px);
        transition: opacity 0.65s cubic-bezier(0.22, 1, 0.36, 1),
                    transform 0.65s cubic-bezier(0.22, 1, 0.36, 1);
        transition-delay: var(--reveal-delay, 0ms);
        will-change: opacity, transform;
    }
    .home-reveal.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    .home-card-interactive {
        transition: transform 0.4s cubic-bezier(0.22, 1, 0.36, 1),
                    box-shadow 0.4s ease,
                    border-color 0.35s ease;
    }
    .home-card-interactive:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.12), 0 0 0 1px rgba(236, 72, 153, 0.12);
    }

    .home-stat-card {
        transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.35s ease;
    }
    .home-stat-card:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 16px 32px -8px rgba(219, 39, 119, 0.18);
    }

    .home-step-card .home-step-icon {
        transition: transform 0.45s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.35s ease;
    }
    .home-step-card:hover .home-step-icon {
        transform: scale(1.08);
        box-shadow: 0 12px 24px -6px rgba(219, 39, 119, 0.35);
    }

    .home-cta-pulse {
        animation: home-float-soft 5s ease-in-out infinite;
    }

    @media (prefers-reduced-motion: reduce) {
        .home-hero-line,
        .home-hero-img-wrap {
            animation: none !important;
            opacity: 1 !important;
            transform: none !important;
        }
        .home-reveal {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }
        .home-card-interactive:hover,
        .home-stat-card:hover {
            transform: none !important;
        }
        .home-cta-pulse {
            animation: none !important;
        }
    }
</style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-pink-50 via-white to-pink-100 overflow-hidden flex items-center" style="height: auto; min-height: 500px;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center w-full py-8">
                <!-- Left Column - Text Content -->
            <div class="order-2 lg:order-1 flex flex-col justify-center">
                <div class="home-hero-line inline-block bg-pink-50 border border-pink-100 text-pink-700 px-4 py-1.5 rounded-full text-xs md:text-sm font-semibold mb-6 w-fit shadow-sm">
                    ✨ Trusted by 5,000+ Women Across India
                </div>
                <h1 class="home-hero-line text-5xl sm:text-5xl md:text-5xl font-bold heading-font text-gray-900 mb-5 leading-tight">
                    Your Body Deserves <br>
                    <span class="relative inline-block mb-2">
                        <span class="relative z-10 bg-pink-100 text-pink-600 px-3 py-1 rounded-lg shadow-md border border-pink-200 text-lg sm:text-xl md:text-4xl">Expert Care</span>
                        <span class="absolute -bottom-2 -right-2 w-full h-full bg-pink-50 rounded-lg -z-0"></span>
                    </span>
                </h1>
                <p class="home-hero-line text-3xl sm:text-lg text-gray-700 mb-6 leading-relaxed max-w-lg">
                    <b>Do You Have</b>
                </p>
                <ul class="home-hero-line space-y-2.5 sm:space-y-3 mb-6 max-w-lg list-none pl-0" role="list">
                    <li class="flex items-center gap-3 text-gray-700 text-sm sm:text-base leading-relaxed font-bold py-0.5">
                        <span class="flex-shrink-0 w-2 h-2 rounded-full bg-pink-500 ring-4 ring-pink-100" aria-hidden="true"></span>
                        <span>Pain during sex?</span>
                    </li>
                    <li class="flex items-center gap-3 text-gray-700 text-sm sm:text-base leading-relaxed font-bold py-0.5">
                        <span class="flex-shrink-0 w-2 h-2 rounded-full bg-pink-500 ring-4 ring-pink-100" aria-hidden="true"></span>
                        <span>Leaking urine?</span>
                    </li>
                    <li class="flex items-center gap-3 text-gray-700 text-sm sm:text-base leading-relaxed font-bold py-0.5">
                        <span class="flex-shrink-0 w-2 h-2 rounded-full bg-pink-500 ring-4 ring-pink-100" aria-hidden="true"></span>
                        <span>Pelvic discomfort?</span>
                    </li>
                </ul>
                <p class="home-hero-line text-base sm:text-lg text-gray-700 mb-6 leading-relaxed max-w-lg">
                    You're not alone. Connect with verified women's health physiotherapists who understand your concerns.
                </p>
                
                <!-- Trust Signals - One Line with Icons -->
                <div class="home-hero-line flex items-center gap-6 md:gap-8 mb-8 flex-wrap">
                    <div class="flex items-center gap-3 group">
                        <div class="w-10 h-10 bg-white border border-pink-100 rounded-full flex items-center justify-center flex-shrink-0 shadow-sm group-hover:shadow-md transition-all text-pink-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="text-base font-bold text-gray-900 leading-none">200+</div>
                            <div class="text-xs text-gray-500 font-medium mt-0.5">Specialists</div>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3 group">
                        <div class="w-10 h-10 bg-white border border-pink-100 rounded-full flex items-center justify-center flex-shrink-0 shadow-sm group-hover:shadow-md transition-all text-pink-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="text-base font-bold text-gray-900 leading-none">100%</div>
                            <div class="text-xs text-gray-500 font-medium mt-0.5">Women-Only</div>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3 group">
                        <div class="w-10 h-10 bg-white border border-pink-100 rounded-full flex items-center justify-center flex-shrink-0 shadow-sm group-hover:shadow-md transition-all text-pink-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="text-base font-bold text-gray-900 leading-none">24/7</div>
                            <div class="text-xs text-gray-500 font-medium mt-0.5">Available</div>
                        </div>
                    </div>
                </div>
                
                <!-- CTAs -->
                <div class="home-hero-line flex flex-col sm:flex-row gap-4 mb-6">
                    <a href="{{ route('book-appointment') }}" class="flex items-center justify-center bg-pink-600 text-white px-8 py-4 rounded-xl font-bold hover:bg-pink-700 transition-all shadow-lg hover:shadow-pink-200 hover:-translate-y-0.5 text-center text-base min-w-[200px]" style="background-color: #db2777;">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Book Consultation
                    </a>
                    <a href="#problems" class="flex items-center justify-center bg-white text-gray-700 px-8 py-4 rounded-xl font-bold hover:bg-gray-50 transition-all border border-gray-200 hover:border-pink-200 hover:text-pink-600 text-center text-base min-w-[160px]">
                        Learn More
                    </a>
                </div>
                
                <p class="home-hero-line text-xs text-gray-500 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    Available in <strong>Delhi NCR, Mumbai, Bangalore, Pune</strong> • 💻 Online & In-Person
                </p>
            </div>
            
            <!-- Right Column - Image -->
            <div class="order-1 lg:order-2 flex items-center justify-center p-4 lg:p-8">
                <div class="home-hero-img-wrap relative w-full max-w-md mx-auto">
                    <div class="absolute inset-0 bg-gradient-to-tr from-pink-100 to-pink-50 rounded-[2rem] transform rotate-3 scale-105 -z-10"></div>
                    <img src="{{ asset('images/hero_woman_consultation.png') }}" alt="Women's Health Consultation" class="relative rounded-[1.5rem] shadow-2xl w-full h-auto object-cover border-4 border-white max-h-[500px]">
                </div>
            </div>
            </div>
        </div>
    </section>
    
    <!-- Mobile Search Bar (Initially after Hero Section) -->
    @include('partials.search-bar', ['class' => 'md:hidden'])

    <!-- Featured Physiotherapists Section -->
    <section class="py-8 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="home-reveal text-xl sm:text-2xl md:text-3xl font-bold heading-font text-gray-900 mb-3">
                    Meet Pelvicare's Verified Women's Health Physiotherapists
                </h2>
                <p class="home-reveal text-base text-gray-600" style="--reveal-delay: 80ms">Trained Specialists in Pelvic floor, Pregnancy, Postpartum, and Intemate Health Care</p>
            </div>
            
            @if($featuredDoctors->count() > 0)
            <!-- Swiper Container -->
            <div class="relative">
                <div class="swiper featured-doctors-swiper">
                    <div class="swiper-wrapper">
                        @foreach($featuredDoctors as $doctor)
                            @php
                                $profile = $doctor->doctorProfile;
                                $rating = $profile->rating ?? 4.5;
                                $image = $profile->profile_image ? (media_url($profile->profile_image) ?? asset('images/physiotherapist_' . (($loop->index % 3) + 1) . '.png')) : asset('images/physiotherapist_' . (($loop->index % 3) + 1) . '.png');
                                $catIds = $profile->service_category_ids ?? [];
                                $subIds = $profile->service_subcategory_ids ?? [];
                                $homeCatList = $categoriesById->only($catIds)->values();
                                $homeSubList = $subcategoriesById->only($subIds)->values();
                                $homeLinks = collect();
                                foreach ($homeCatList as $cat) {
                                    $subs = $homeSubList->where('service_category_id', $cat->id);
                                    if ($subs->isNotEmpty()) {
                                        foreach ($subs->take(2) as $sub) {
                                            $homeLinks->push(['url' => route('services.subservice', [$cat->slug, $sub->slug]), 'name' => $sub->name]);
                                        }
                                    } else {
                                        $homeLinks->push(['url' => route('services.show', $cat->slug), 'name' => $cat->name]);
                                    }
                                }
                                foreach ($homeSubList->whereNotIn('service_category_id', $homeCatList->pluck('id'))->take(2) as $sub) {
                                    $parentCat = $categoriesById->get($sub->service_category_id);
                                    $homeLinks->push(['url' => $parentCat ? route('services.subservice', [$parentCat->slug, $sub->slug]) : route('services'), 'name' => $sub->name]);
                                }
                            @endphp
                            <div class="swiper-slide">
                                <div class="home-card-interactive bg-gradient-to-br from-pink-50 to-white rounded-2xl p-6 shadow-lg border border-pink-100 h-full flex flex-col">
                                    <div class="relative mb-4">
                                        <img src="{{ $image }}" alt="{{ $doctor->name }}" class="w-full h-52 object-cover rounded-xl">
                                        <div class="absolute top-3 right-3 bg-white rounded-full px-3 py-1 text-xs font-semibold text-pink-600 shadow-md">
                                            ⭐ {{ number_format($rating, 1) }}/5
                                        </div>
                                    </div>
                                    <h3 class="text-lg font-bold heading-font text-gray-900 mb-2">{{ $doctor->name }}</h3>
                                    @if($homeLinks->isNotEmpty())
                                        <div class="flex flex-wrap gap-1.5 mb-3 min-h-[3.25rem] overflow-hidden content-start" style="max-height: 3.53rem;">
                                            @foreach($homeLinks->take(4) as $link)
                                                <a href="{{ $link['url'] }}" class="bg-pink-100 text-pink-700 px-2.5 py-1 rounded-full text-xs font-semibold border border-pink-200 shrink-0 hover:bg-pink-200 transition-colors">{{ $link['name'] }}</a>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="min-h-[3.25rem] flex items-center mb-3">
                                            <p class="text-sm text-pink-600 font-semibold">Women's Health Specialist</p>
                                        </div>
                                    @endif
                                    <p class="text-sm text-gray-600 mb-4 min-h-[2.5rem] line-clamp-2">
                                        {{ $profile->years_of_experience ?? 0 }}+ years experience
                                        @if($profile->bio)
                                            {{ Str::limit(strip_tags($profile->bio), 60) }}
                                        @endif
                                    </p>
                                    <div class="mt-auto flex items-center justify-between gap-2">
                                        <a href="{{ route('booking.doctor', $doctor->doctorProfile->slug) }}" class="inline-block bg-pink-600 text-white px-4 py-2 rounded-lg hover:bg-pink-700 font-semibold text-sm transition-colors">Book Now</a>
                                        <a href="{{ route('doctors.show', $doctor->doctorProfile->slug) }}" class="text-pink-600 hover:text-pink-700 font-semibold text-sm whitespace-nowrap">View Profile →</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Navigation arrows -->
                    <div class="swiper-button-next featured-doctors-next"></div>
                    <div class="swiper-button-prev featured-doctors-prev"></div>
                    <!-- Pagination -->
                    <div class="swiper-pagination featured-doctors-pagination"></div>
                </div>
            </div>
            @else
            <div class="text-center py-12">
                <p class="text-gray-600 mb-4">No doctors available at the moment.</p>
            </div>
            @endif
            
            <div class="text-center mt-8">
                <a href="{{ route('doctors.index') }}" class="home-reveal inline-block bg-gradient-to-r from-pink-400 to-pink-500 text-white px-8 py-3 rounded-full font-semibold hover:from-pink-500 hover:to-pink-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1" style="--reveal-delay: 120ms">
                    View All Specialists
                </a>
            </div>
        </div>
    </section>

    <!-- Problem Discovery / Our Services Section (Dynamic) -->
    <section id="problems" class="py-8 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="home-reveal text-xl sm:text-2xl md:text-3xl font-bold heading-font text-gray-900 mb-3">
                    Search Your Symptoms – Get Real Answers
                </h2>
            </div>

            @php
                $problemColors = [
                    'pink' => ['from' => 'from-pink-50', 'to' => 'to-pink-100', 'border' => 'border-pink-200', 'icon' => 'from-pink-500 to-pink-600', 'link' => 'text-pink-600 hover:text-pink-700'],
                    'rose' => ['from' => 'from-rose-50', 'to' => 'to-rose-100', 'border' => 'border-rose-200', 'icon' => 'from-rose-500 to-rose-600', 'link' => 'text-rose-600 hover:text-rose-700'],
                    'fuchsia' => ['from' => 'from-fuchsia-50', 'to' => 'to-fuchsia-100', 'border' => 'border-fuchsia-200', 'icon' => 'from-fuchsia-500 to-fuchsia-600', 'link' => 'text-fuchsia-600 hover:text-fuchsia-700'],
                    'teal' => ['from' => 'from-teal-50', 'to' => 'to-teal-100', 'border' => 'border-teal-200', 'icon' => 'from-teal-500 to-teal-600', 'link' => 'text-teal-600 hover:text-teal-700'],
                    'purple' => ['from' => 'from-purple-50', 'to' => 'to-purple-100', 'border' => 'border-purple-200', 'icon' => 'from-purple-500 to-purple-600', 'link' => 'text-purple-600 hover:text-purple-700'],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @if(isset($serviceCategories) && $serviceCategories->isNotEmpty())
                    @foreach($serviceCategories as $category)
                        @php $theme = $problemColors[$category->card_color ?? 'pink'] ?? $problemColors['pink']; @endphp
                        <div class="home-reveal home-card-interactive group/svc bg-gradient-to-br {{ $theme['from'] }} {{ $theme['to'] }} rounded-2xl p-6 border {{ $theme['border'] }}" style="--reveal-delay: {{ $loop->index * 75 }}ms">
                            <div class="w-12 h-12 bg-gradient-to-br {{ $theme['icon'] }} rounded-xl flex items-center justify-center mb-4 transition-transform duration-300 group-hover/svc:scale-110 group-hover/svc:rotate-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-base sm:text-lg font-bold heading-font text-gray-900 mb-3">
                                {{ $category->name }}
                            </h3>
                            <p class="text-gray-700 text-sm mb-4 line-clamp-2">{{ Str::limit(strip_tags($category->short_description), 120) }}</p>
                            @if($category->activeSubcategories->isNotEmpty())
                                <ul class="text-gray-700 space-y-1 mb-4 text-sm">
                                    @foreach($category->activeSubcategories->take(3) as $sub)
                                        <li>• {{ $sub->name }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <a href="{{ route('services.show', $category->slug) }}" class="{{ $theme['link'] }} font-semibold inline-flex items-center">
                                Learn More →
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="md:col-span-2 lg:col-span-3 text-center py-8">
                        <p class="text-gray-600 mb-4">Explore our services for women's pelvic health.</p>
                        <a href="{{ route('services') }}" class="inline-block bg-pink-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-pink-700 transition">View All Services</a>
                    </div>
                @endif
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('services') }}" class="home-reveal inline-flex items-center gap-2 bg-pink-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-pink-700 transition-all shadow-lg hover:shadow-xl" style="--reveal-delay: 100ms">
                    View All Services
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Meet Pelvicare-Verified Physiotherapists -->
    <section class="relative py-10 sm:py-16 bg-gradient-to-r from-pink-50 via-pink-50/50 to-white overflow-hidden">
        <div class="absolute inset-0 opacity-30 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] bg-fixed"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-0 items-center">
                <!-- Left: Text Content -->
                <div class="home-reveal order-2 lg:order-1 lg:pr-10 py-4" style="--reveal-delay: 0ms">
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold heading-font text-slate-900 mb-4 leading-tight">
                        Meet Pelvicare-Verified <br class="hidden lg:block">
                        Women's Health Physiotherapists
                    </h2>
                    <p class="text-base text-slate-600 mb-6 leading-relaxed max-w-lg">
                        Certified specialists dedicated to pelvic floor, pregnancy, postpartum, and intimate health care.
                    </p>

                    <ul class="space-y-4 mb-6">
                        <li class="flex items-start gap-3">
                            <div class="shrink-0 w-7 h-7 rounded-full border border-slate-300 flex items-center justify-center text-slate-600 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <h5 class="font-semibold text-slate-800 text-base">Women-only care</h5>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="shrink-0 w-7 h-7 rounded-full border border-slate-300 flex items-center justify-center text-slate-600 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <h5 class="font-semibold text-slate-800 text-base">Consent-based assessment</h5>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="shrink-0 w-7 h-7 rounded-full border border-slate-300 flex items-center justify-center text-slate-600 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <h5 class="font-semibold text-slate-800 text-base">Online & in-person options</h5>
                        </li>
                    </ul>

                    <div class="w-20 h-0.5 bg-pink-500 rounded-full mb-6"></div>

                    <a href="{{ route('doctors.index') }}" class="inline-flex items-center gap-2 bg-pink-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-pink-700 transition-all shadow-lg hover:shadow-xl">
                        Talk to a Specialist
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>

                <!-- Right: Image with Horizontal Fade -->
                <div class="home-reveal order-1 lg:order-2 relative lg:absolute lg:right-0 lg:top-0 lg:bottom-0 lg:w-1/2 h-full min-h-[320px] lg:min-h-auto w-full" style="--reveal-delay: 120ms">
                    <div class="relative w-full h-full">
                        <img src="{{ asset('images/hero_woman_consultation.png') }}" 
                             alt="Pelvicare verified specialist consultation" 
                             class="w-full h-full object-cover object-bottom lg:object-left-bottom"
                             style="-webkit-mask-image: linear-gradient(to right, transparent, black 25%); mask-image: linear-gradient(to right, transparent, black 15%);">
                        <div class="absolute inset-0 bg-gradient-to-r from-pink-50 via-transparent to-transparent opacity-50 lg:hidden"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- When Tests Are Normal – Stats & How It Works -->
    <section class="py-4 sm:py-6 lg:py-6 bg-gradient-to-b from-pink-50 via-white to-indigo-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-10 sm:mb-14 max-w-3xl mx-auto">
                <h2 class="home-reveal text-xl sm:text-2xl md:text-3xl font-bold heading-font text-gray-900 mb-5 leading-tight">
                    When Tests Are Normal, But the Pain Is Still Real
                </h2>
                <p class="home-reveal text-gray-700 text-sm sm:text-base leading-relaxed mb-2" style="--reveal-delay: 90ms">
                    If you've been told <em>"just relax,"</em> <em>"it's stress,"</em> <em>"give it more time,"</em> or <em>"this is normal after childbirth"</em> — or <em>"this happens to many women"</em> — but the pain or leakage continues — <em>These conditions are common — but they are treatable.</em>
               </p>
            </div>

            <!-- 5 Stats Cards – subtle gradient per card, soft shadow -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 sm:gap-6 mb-8 sm:mb-10">
                <!-- Card 1: Urine Leakage -->
                <div class="home-reveal home-stat-card bg-gradient-to-br from-pink-50 to-pink-100/80 rounded-2xl p-5 sm:p-6 shadow-sm border border-pink-100/80" style="--reveal-delay: 0ms">
                    <div class="w-11 h-11 rounded-xl bg-pink-500 flex items-center justify-center mb-4 shadow-sm">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.69C12 2.69 6 10 6 14c0 3.31 2.69 6 6 6s6-2.69 6-6c0-4-6-11.31-6-11.31z"/></svg>
                    </div>
                    <h4 class="font-bold text-gray-900 text-sm sm:text-base mb-2">Urine Leakage</h4>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-900 mb-1">25–45%</p>
                    <p class="text-gray-600 text-xs sm:text-sm leading-snug">of women experience urine leakage</p>
                    <p class="text-gray-700 text-xs sm:text-sm mt-1.5 leading-snug">Common, but not something you have to live with</p>
                </div>
                <!-- Card 2: Pain During Sex -->
                <div class="home-reveal home-stat-card bg-gradient-to-br from-rose-50 to-red-50 rounded-2xl p-5 sm:p-6 shadow-sm border border-red-100/80" style="--reveal-delay: 60ms">
                    <div class="w-11 h-11 rounded-xl bg-red-500 flex items-center justify-center mb-4 shadow-sm">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    </div>
                    <h4 class="font-bold text-gray-900 text-sm sm:text-base mb-2">Pain During Sex</h4>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-900 mb-1">20–40%</p>
                    <p class="text-gray-600 text-xs sm:text-sm leading-snug">of women report sexual pain</p>
                    <p class="text-gray-700 text-xs sm:text-sm mt-1.5 leading-snug">Pain is common — but not normal to ignore</p>
                </div>
                <!-- Card 3: Pelvic Organ Prolapse -->
                <div class="home-reveal home-stat-card bg-gradient-to-br from-purple-50 to-purple-100/70 rounded-2xl p-5 sm:p-6 shadow-sm border border-purple-100/80" style="--reveal-delay: 120ms">
                    <div class="w-11 h-11 rounded-xl bg-purple-500 flex items-center justify-center mb-4 shadow-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                    </div>
                    <h4 class="font-bold text-gray-900 text-sm sm:text-base mb-2">Pelvic Organ Prolapse</h4>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-900 mb-1">30–50%</p>
                    <p class="text-gray-600 text-xs sm:text-sm leading-snug">of women show symptoms of prolapse</p>
                    <p class="text-gray-700 text-xs sm:text-sm mt-1.5 leading-snug">Often managed with pelvic rehabilitation</p>
                </div>
                <!-- Card 4: Back or Pelvic Pain -->
                <div class="home-reveal home-stat-card bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-5 sm:p-6 shadow-sm border border-green-100/80" style="--reveal-delay: 180ms">
                    <div class="w-11 h-11 rounded-xl bg-green-500 flex items-center justify-center mb-4 shadow-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    </div>
                    <h4 class="font-bold text-gray-900 text-sm sm:text-base mb-2">Back or Pelvic Pain</h4>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-900 mb-1">50–70%</p>
                    <p class="text-gray-600 text-xs sm:text-sm leading-snug">of women experience back or pelvic pain</p>
                    <p class="text-gray-700 text-xs sm:text-sm mt-1.5 leading-snug">Pain is common — persistent pain deserves care</p>
                </div>
                <!-- Card 5: Diastasis Recti -->
                <div class="home-reveal home-stat-card bg-gradient-to-br from-indigo-50 to-sky-50 rounded-2xl p-5 sm:p-6 shadow-sm border border-indigo-100/80" style="--reveal-delay: 240ms">
                    <div class="w-11 h-11 rounded-xl bg-indigo-500 flex items-center justify-center mb-4 shadow-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16M6 6v12M18 6v12"></path></svg>
                    </div>
                    <h4 class="font-bold text-gray-900 text-sm sm:text-base mb-2">Diastasis Recti</h4>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-900 mb-1">60–70%</p>
                    <p class="text-gray-600 text-xs sm:text-sm leading-snug">of postpartum women have diastasis</p>
                    <p class="text-gray-700 text-xs sm:text-sm mt-1.5 leading-snug">Abdominal changes are common — recovery is possible</p>
                </div>
            </div>

            
            <!-- Two columns: Important to Know + How It Works -->
            {{-- <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-10 mb-12 sm:mb-14">
                <!-- Left: Important to know -->
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-6 sm:p-8 shadow-sm border border-gray-100">
                    <h3 class="font-bold heading-font text-gray-900 text-lg sm:text-xl mb-5">Important to know</h3>
                    <ul class="space-y-5 list-none pl-0">
                        <li class="flex items-start gap-4">
                            <span class="flex-shrink-0 w-9 h-9 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center mt-0.5">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.69C12 2.69 6 10 6 14c0 3.31 2.69 6 6 6s6-2.69 6-6c0-4-6-11.31-6-11.31z"/></svg>
                            </span>
                            <span class="text-gray-700 text-sm sm:text-base leading-relaxed pt-0.5">Urine leakage is common — but it is <strong>not</strong> something you have to live with.</span>
                        </li>
                        <li class="flex items-start gap-4">
                            <span class="flex-shrink-0 w-9 h-9 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center mt-0.5">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                            </span>
                            <span class="text-gray-700 text-sm sm:text-base leading-relaxed pt-0.5">Pain during sex is common — but it is <strong>not</strong> something you should ignore or accept.</span>
                        </li>
                    </ul>
                </div>
                <!-- Right: How It Works -->
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-6 sm:p-8 shadow-sm border border-gray-100">
                    <h3 class="font-bold heading-font text-gray-900 text-lg sm:text-xl mb-6">Private, Respectful Care — Here's How It Works</h3>
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <span class="flex-shrink-0 w-11 h-11 rounded-full bg-pink-500 text-white flex items-center justify-center font-bold text-lg shadow-sm">1</span>
                            <div class="pt-0.5">
                                <h4 class="font-bold text-gray-900 text-base mb-1">Choose What Feels Right</h4>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">Explore symptoms privately. No pressure. No judgement.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <span class="flex-shrink-0 w-11 h-11 rounded-full bg-sky-500 text-white flex items-center justify-center font-bold text-lg shadow-sm">2</span>
                            <div class="pt-0.5">
                                <h4 class="font-bold text-gray-900 text-base mb-1">Talk to a Specialist</h4>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">Connect with trained, women-only pelvic health physiotherapists.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <span class="flex-shrink-0 w-11 h-11 rounded-full bg-purple-500 text-white flex items-center justify-center font-bold text-lg shadow-sm">3</span>
                            <div class="pt-0.5">
                                <h4 class="font-bold text-gray-900 text-base mb-1">Get a Personalised Plan</h4>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">Gentle, respectful care designed around your comfort and goals.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <p class="home-reveal text-center text-pink-400/90 text-sm sm:text-base mb-10 font-medium font-weight-bold" style="--reveal-delay: 100ms">
                Private. Respectful. Women-only care.
            </p>

            <div class="text-center">
                <a href="{{ route('contact') }}" class="home-reveal inline-flex items-center gap-2 bg-gradient-to-r from-pink-500 to-pink-600 text-white px-6 sm:px-8 py-3.5 sm:py-4 rounded-full font-semibold hover:from-pink-600 hover:to-pink-700 transition-all shadow-md hover:shadow-lg text-sm sm:text-base home-cta-pulse" style="--reveal-delay: 160ms">
                    Talk to a Women's Health Specialist
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-8 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="home-reveal text-3xl md:text-4xl font-bold heading-font text-gray-900 mb-4">
                    Private Care Without Judgment – Here's How
                </h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="home-step-card home-reveal text-center" style="--reveal-delay: 0ms">
                    <div class="home-step-icon w-20 h-20 bg-gradient-to-br from-pink-500 to-pink-600 rounded-full flex items-center justify-center mx-auto mb-6 text-white text-3xl font-bold">
                        1
                    </div>
                    <h3 class="text-xl font-bold heading-font text-gray-900 mb-4">
                        Choose What Feels Right
                    </h3>
                    <p class="text-gray-700 leading-relaxed">
                        Read about your symptoms privately. No login required. Take your time.
                    </p>
                </div>
                
                <div class="home-step-card home-reveal text-center" style="--reveal-delay: 100ms">
                    <div class="home-step-icon w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-6 text-white text-3xl font-bold">
                        2
                    </div>
                    <h3 class="text-xl font-bold heading-font text-gray-900 mb-4">
                        Talk to a Specialist
                    </h3>
                    <p class="text-gray-700 leading-relaxed">
                        Connect with women-only physiotherapists specializing in pelvic pain, sexual pain, and postpartum recovery. Available via online video consult or clinic/home visit.
                    </p>
                </div>
                
                <div class="home-step-card home-reveal text-center" style="--reveal-delay: 200ms">
                    <div class="home-step-icon w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-6 text-white text-3xl font-bold">
                        3
                    </div>
                    <h3 class="text-xl font-bold heading-font text-gray-900 mb-4">
                        Get a Personalized Plan
                    </h3>
                    <p class="text-gray-700 leading-relaxed">
                        Gentle, respectful care designed for women's bodies. No embarrassment. No rushing.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Social Proof Section -->
    <section id="testimonials" class="py-8 bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="home-reveal text-3xl md:text-4xl font-bold heading-font text-gray-900 mb-4">
                    You're in Safe Company
                </h2>
            </div>
            
            <!-- Stats Bar -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="home-reveal home-stat-card bg-white rounded-xl p-6 text-center shadow-md" style="--reveal-delay: 0ms">
                    <div class="text-4xl font-bold text-pink-600 mb-2">5,247</div>
                    <div class="text-gray-700">women found answers here</div>
                </div>
                <div class="home-reveal home-stat-card bg-white rounded-xl p-6 text-center shadow-md" style="--reveal-delay: 80ms">
                    <div class="text-4xl font-bold text-pink-600 mb-2">200+</div>
                    <div class="text-gray-700">verified women's health specialists</div>
                </div>
                <div class="home-reveal home-stat-card bg-white rounded-xl p-6 text-center shadow-md" style="--reveal-delay: 160ms">
                    <div class="text-4xl font-bold text-pink-600 mb-2">10+</div>
                    <div class="text-gray-700">Cities: Delhi NCR | Mumbai | Bangalore ...</div>
                </div>
            </div>
            
            <!-- Testimonials -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="home-reveal home-card-interactive bg-white rounded-xl p-8 shadow-lg" style="--reveal-delay: 0ms">
                    <div class="flex items-center mb-4">
                        <svg class="w-8 h-8 text-pink-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.996 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                    </div>
                    <p class="text-gray-700 mb-4 italic leading-relaxed">
                        "I suffered for 2 years after my C-section... Within 6 weeks of physiotherapy, the pain reduced by 70%."
                    </p>
                    <p class="text-sm text-gray-600">– Anonymous, Delhi (Age 31)</p>
                </div>
                
                <div class="home-reveal home-card-interactive bg-white rounded-xl p-8 shadow-lg" style="--reveal-delay: 100ms">
                    <div class="flex items-center mb-4">
                        <svg class="w-8 h-8 text-pink-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.996 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                    </div>
                    <p class="text-gray-700 mb-4 italic leading-relaxed">
                        "I couldn't talk to anyone about pain during sex. This platform made it easy to ask questions anonymously first."
                    </p>
                    <p class="text-sm text-gray-600">– Anonymous, Bangalore (Age 28)</p>
                </div>
            </div>
        </div>
    </section>

    <!-- What We Treat Section -->
    {{-- <section class="py-8 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold heading-font text-gray-900 mb-4">
                    Conditions Women Search For... But Rarely Talk About
                </h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-gradient-to-br from-pink-50 to-pink-100 rounded-xl p-6 border border-pink-200">
                    <h3 class="font-bold text-gray-900 mb-3 text-lg">Sexual Health</h3>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li>• Pain during sex (dyspareunia)</li>
                        <li>• Painful penetration</li>
                        <li>• Pain after sex</li>
                        <li>• Fear of intimacy after childbirth</li>
                        <li>• Tight pelvic floor muscles</li>
                    </ul>
                </div>
                
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 border border-blue-200">
                    <h3 class="font-bold text-gray-900 mb-3 text-lg">Postpartum Issues</h3>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li>• Pain after episiotomy</li>
                        <li>• C-section scar pain</li>
                        <li>• Urine leakage after delivery</li>
                        <li>• Core weakness (diastasis recti)</li>
                        <li>• Pain during first sex after delivery</li>
                    </ul>
                </div>
                
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 border border-purple-200">
                    <h3 class="font-bold text-gray-900 mb-3 text-lg">Pelvic & Bladder</h3>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li>• Chronic pelvic pain</li>
                        <li>• Stress urinary incontinence</li>
                        <li>• Frequent urge to pee</li>
                        <li>• Pelvic organ prolapse symptoms</li>
                    </ul>
                </div>
                
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border border-green-200">
                    <h3 class="font-bold text-gray-900 mb-3 text-lg">Pregnancy-Related</h3>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li>• Pelvic girdle pain</li>
                        <li>• Sciatica during pregnancy</li>
                        <li>• Pubic bone pain</li>
                        <li>• Back pain during pregnancy</li>
                    </ul>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('treatments') }}" class="inline-block text-pink-600 font-semibold hover:text-pink-700 transition-colors text-lg">
                    → Full list of conditions we treat
                </a>
            </div>
        </div>
    </section> --}}

    <!-- Who You'll Meet Section -->
    {{-- <section class="py-8 bg-gradient-to-br from-pink-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold heading-font text-gray-900 mb-4">
                    Women's Health Specialists Who Understand
                </h2>
            </div>
            
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl p-8 shadow-lg mb-8">
                    <h3 class="font-bold text-gray-900 mb-6 text-xl">Specialist Standards:</h3>
                    <ul class="space-y-4 text-gray-700">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-pink-600 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span><strong>Female-only</strong> (no male physios)</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-pink-600 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span><strong>Certified</strong> in women's health physiotherapy (APTA Pelvic Health or Postgraduate training)</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-pink-600 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span><strong>3+ years</strong> treating women-specific conditions</span>
                        </li>
                    </ul>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-white rounded-xl p-6 shadow-md">
                        <h4 class="font-bold text-gray-900 mb-3">Expertise In:</h4>
                        <p class="text-gray-700">Sexual pain, bladder issues, postpartum recovery, and pelvic floor dysfunction.</p>
                    </div>
                    <div class="bg-white rounded-xl p-6 shadow-md">
                        <h4 class="font-bold text-gray-900 mb-3">Availability:</h4>
                        <p class="text-gray-700">Online video consultation, in-clinic appointments, and home visits (select cities).</p>
                    </div>
                </div>
                
                <div class="text-center">
                    <a href="{{ route('about') }}" class="inline-block bg-gradient-to-r from-pink-500 to-pink-600 text-white px-8 py-4 rounded-full font-semibold hover:from-pink-600 hover:to-pink-700 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        Browse Specialists →
                    </a>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Questions Section (4 FAQs + CTA to FAQ page) -->
    <section class="py-12 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="home-reveal text-3xl md:text-4xl font-bold heading-font text-gray-900 mb-4">
                    The Questions You've Been Googling
                </h2>
                {{-- <p class="text-xl text-gray-600">Written like a friend explaining, not a doctor.</p> --}}
            </div>
            @php
                $homeFaqs = [
                    ['q' => 'Why does sex hurt even when I want it?', 'a' => 'It\'s often due to pelvic floor muscle tightness or overactivity, not just "in your head." Your body might be protecting itself, but physical therapy can help retrain these muscles to relax.'],
                    ['q' => 'Is pain during sex normal?', 'a' => 'Common? Yes. Normal? No. Sex should never be painful. Pain is your body\'s signal that something needs attention, and treatable causes like muscle tension or hormonal changes are often to blame.'],
                    ['q' => 'Why do I leak urine when I laugh?', 'a' => 'This is often "stress incontinence" caused by weak or uncoordinated pelvic floor muscles unable to handle the extra pressure. Specialized exercises can often improve bladder control.'],
                    ['q' => 'Can physiotherapy really help with sexual pain?', 'a' => 'Absolutely. We treat the physical root cause—tight muscles, scar tissue, or nerve sensitivity—using hands-on techniques and dilation therapy to make intimacy comfortable again.']
                ];
            @endphp
            <div class="space-y-4">
                @foreach($homeFaqs as $index => $item)
                <div class="home-reveal bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-md group" style="--reveal-delay: {{ $index * 70 }}ms">
                    <button class="w-full flex items-start text-left p-6 focus:outline-none" onclick="toggleFaq(this)">
                        <span class="text-pink-600 font-bold mr-4 text-lg shrink-0 mt-0.5">{{ $index + 1 }}.</span>
                        <span class="text-gray-900 font-bold text-lg flex-1 group-hover:text-pink-600 transition-colors">{{ $item['q'] }}</span>
                        <span class="ml-4 shrink-0 text-gray-400 transform transition-transform duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </span>
                    </button>
                    <div class="text-gray-600 text-base leading-relaxed px-6 pb-6 pl-12 hidden transition-all duration-300 ease-in-out border-t border-gray-100 mt-2 pt-4">
                        {{ $item['a'] }}
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-10">
                <a href="{{ route('faq') }}" class="home-reveal inline-flex items-center gap-2 bg-pink-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-pink-700 transition-colors shadow-md hover:shadow-lg" style="--reveal-delay: 120ms">
                    View All Answers
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
        <script>
            function toggleFaq(button) {
                const content = button.nextElementSibling;
                const icon = button.querySelector('svg');
                if (content.classList.contains('hidden')) {
                    content.classList.remove('hidden');
                    icon.parentElement.classList.add('rotate-180');
                    button.parentElement.classList.add('shadow-md', 'bg-white');
                    button.parentElement.classList.remove('bg-gradient-to-r');
                } else {
                    content.classList.add('hidden');
                    icon.parentElement.classList.remove('rotate-180');
                    button.parentElement.classList.remove('shadow-md', 'bg-white');
                    button.parentElement.classList.add('bg-gradient-to-r');
                }
            }
        </script>
    </section>

    <!-- Privacy Promise Section -->
    <section class="py-8 bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="home-reveal text-3xl md:text-4xl font-bold heading-font text-gray-900 mb-8">
                Your Privacy Is Non-Negotiable
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="home-reveal home-card-interactive bg-white rounded-xl p-6 shadow-md" style="--reveal-delay: 0ms">
                    <svg class="w-12 h-12 text-pink-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <h3 class="font-bold text-gray-900 mb-2">Optional anonymity</h3>
                    <p class="text-gray-700 text-sm">Use a pseudonym</p>
                </div>
                
                <div class="home-reveal home-card-interactive bg-white rounded-xl p-6 shadow-md" style="--reveal-delay: 80ms">
                    <svg class="w-12 h-12 text-pink-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    <h3 class="font-bold text-gray-900 mb-2">Discreet appointments</h3>
                    <p class="text-gray-700 text-sm">Labeled as "Wellness Consultation"</p>
                </div>
                
                <div class="home-reveal home-card-interactive bg-white rounded-xl p-6 shadow-md" style="--reveal-delay: 160ms">
                    <svg class="w-12 h-12 text-pink-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    <h3 class="font-bold text-gray-900 mb-2">Secure & encrypted</h3>
                    <p class="text-gray-700 text-sm">No data selling</p>
                </div>
                
                <div class="home-reveal home-card-interactive bg-white rounded-xl p-6 shadow-md" style="--reveal-delay: 240ms">
                    <svg class="w-12 h-12 text-pink-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    <h3 class="font-bold text-gray-900 mb-2">Judgment-free zone</h3>
                    <p class="text-gray-700 text-sm">Nothing is "too embarrassing"</p>
                </div>
            </div>
            
            <a href="#" class="home-reveal inline-block text-pink-600 font-semibold hover:text-pink-700 transition-colors" style="--reveal-delay: 200ms">
                Read our full privacy policy →
            </a>
        </div>
    </section>

    <!-- Final Conversion Push -->
    <section class="py-8 bg-gradient-to-r from-pink-500 to-pink-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="home-reveal text-xl md:text-2xl font-bold heading-font text-white mb-4">
                If You've Been Carrying This Silently – Put It Down Here
            </h2>
            <p class="home-reveal text-sm md:text-base text-pink-100 mb-8 leading-relaxed max-w-2xl mx-auto" style="--reveal-delay: 80ms">
                You don't have to explain perfectly, be brave, or know what's wrong—you just have to be tired of the pain.
            </p>

            <div class="flex flex-col sm:flex-row gap-3 justify-center items-center flex-wrap">
                <a href="{{ route('doctors.index') }}" class="home-reveal inline-flex items-center justify-center bg-white text-pink-600 px-5 py-2.5 rounded-full font-semibold hover:bg-pink-50 transition-all shadow-lg hover:shadow-xl text-sm whitespace-nowrap border border-pink-200" style="--reveal-delay: 140ms">
                    Find a Specialist Now →
                </a>
                <a href="#problems" class="home-reveal inline-flex items-center justify-center bg-pink-400/20 text-white px-5 py-2.5 rounded-full font-semibold hover:bg-pink-400/30 transition-all border border-white/50 text-sm whitespace-nowrap" style="--reveal-delay: 200ms">
                    Read About Common Issues First →
                </a>
                <a href="{{ route('contact') }}" class="home-reveal inline-flex items-center justify-center bg-pink-400/20 text-white px-5 py-2.5 rounded-full font-semibold hover:bg-pink-400/30 transition-all border border-white/50 text-sm whitespace-nowrap" style="--reveal-delay: 260ms">
                    Ask a Question Anonymously →
                </a>
            </div>
        </div>
    </section>

@push('scripts')
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Featured Doctors Swiper
        const featuredDoctorsSwiper = new Swiper('.featured-doctors-swiper', {
            // Responsive breakpoints
            slidesPerView: 1,
            spaceBetween: 20,
            loop: {{ $featuredDoctors->count() > 3 ? 'true' : 'false' }},
            loopAdditionalSlides: 2,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            speed: 600,
            grabCursor: true,
            
            // Navigation arrows
            navigation: {
                nextEl: '.featured-doctors-next',
                prevEl: '.featured-doctors-prev',
            },
            
            // Pagination
            pagination: {
                el: '.featured-doctors-pagination',
                clickable: true,
                dynamicBullets: true,
            },
            
            // Responsive breakpoints
            breakpoints: {
                // Mobile (default)
                320: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                // Tablet
                640: {
                    slidesPerView: 2,
                    spaceBetween: 24,
                },
                // Desktop
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 32,
                },
                // Large Desktop
                1280: {
                    slidesPerView: 3,
                    spaceBetween: 32,
                },
            },
            
            // Effects
            effect: 'slide',
            
            // Accessibility
            a11y: {
                prevSlideMessage: 'Previous doctor',
                nextSlideMessage: 'Next doctor',
                firstSlideMessage: 'This is the first doctor',
                lastSlideMessage: 'This is the last doctor',
            },
        });

        // Scroll reveal: .home-reveal → .is-visible (CSS keeps content visible if prefers-reduced-motion)
        const revealNodes = document.querySelectorAll('.home-reveal');
        const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (revealNodes.length && !reducedMotion) {
            if ('IntersectionObserver' in window) {
                const io = new IntersectionObserver(
                    (entries) => {
                        entries.forEach((entry) => {
                            if (!entry.isIntersecting) return;
                            entry.target.classList.add('is-visible');
                            io.unobserve(entry.target);
                        });
                    },
                    { root: null, rootMargin: '0px 0px -6% 0px', threshold: 0.06 }
                );
                revealNodes.forEach((el) => io.observe(el));
            } else {
                revealNodes.forEach((el) => el.classList.add('is-visible'));
            }
        }
    });
</script>
@endpush
@endsection
