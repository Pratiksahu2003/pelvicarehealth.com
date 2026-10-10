@extends('layouts.app')

@section('title', $category->meta_title ?? ($category->name . ' - Pelvicare Women\'s Health Physiotherapy'))
@section('meta_description', $category->meta_description ?? Str::limit(strip_tags($category->short_description ?? ''), 160))
@if($category->meta_keywords)
@section('meta_keywords', $category->meta_keywords)
@endif

@php
    $decodedShortDescription = is_string($category->short_description)
        ? html_entity_decode($category->short_description, ENT_QUOTES | ENT_HTML5, 'UTF-8')
        : $category->short_description;

    $decodedDescription = is_string($category->description)
        ? html_entity_decode($category->description, ENT_QUOTES | ENT_HTML5, 'UTF-8')
        : $category->description;

    $heroImageUrl = $category->image
        ? (media_url($category->image) ?? asset('images/pelvic_pain_service.png'))
        : asset('images/pelvic_pain_service.png');
@endphp

@push('styles')
<style>
    @keyframes service-page-fade-up {
        from { opacity: 0; transform: translateY(18px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes service-page-soft-pulse {
        0%, 100% { box-shadow: 0 10px 40px -10px rgba(230, 53, 111, 0.35); }
        50% { box-shadow: 0 14px 44px -8px rgba(230, 53, 111, 0.45); }
    }
    .service-page-fade-up {
        animation: service-page-fade-up 0.65s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    .service-page-delay-1 { animation-delay: 0.08s; }
    .service-page-delay-2 { animation-delay: 0.16s; }
    .service-page-delay-3 { animation-delay: 0.24s; }
    .service-page-delay-4 { animation-delay: 0.32s; }
    .service-page-hero-img {
        transition: transform 0.7s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .service-page-hero-wrap:hover .service-page-hero-img {
        transform: scale(1.03);
    }
    .service-page-treatment-card {
        animation: service-page-fade-up 0.55s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    .service-page-cta-btn {
        animation: service-page-soft-pulse 3s ease-in-out infinite;
    }
    @media (prefers-reduced-motion: reduce) {
        .service-page-fade-up,
        .service-page-treatment-card,
        .service-page-hero-img,
        .service-page-cta-btn {
            animation: none !important;
            transition: none !important;
        }
    }
</style>
@endpush

@section('content')
    <!-- Breadcrumb -->
    <section class="relative border-b border-pink-100/80 bg-gradient-to-b from-white to-pink-50/40 py-3 sm:py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex flex-wrap items-center gap-x-2 gap-y-1 text-sm text-gray-600" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-1 rounded-lg px-1 py-0.5 text-gray-600 transition hover:text-pink-600 hover:bg-pink-50/80 focus:outline-none focus-visible:ring-2 focus-visible:ring-pink-500 focus-visible:ring-offset-2">
                    <svg class="h-4 w-4 shrink-0 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Home
                </a>
                <span class="text-gray-300 select-none" aria-hidden="true">/</span>
                <a href="{{ route('services') }}" class="rounded-lg px-1 py-0.5 transition hover:text-pink-600 hover:bg-pink-50/80 focus:outline-none focus-visible:ring-2 focus-visible:ring-pink-500 focus-visible:ring-offset-2">Services</a>
                <span class="text-gray-300 select-none" aria-hidden="true">/</span>
                <span class="font-medium text-gray-900 line-clamp-2">{{ $category->name }}</span>
            </nav>
        </div>
    </section>

    <!-- Hero -->
    <section class="relative overflow-hidden bg-gradient-to-br from-pink-50 via-white to-rose-50/60 py-10 sm:py-14 lg:py-20">
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_80%_50%_at_50%_-20%,rgba(255,61,127,0.12),transparent)]" aria-hidden="true"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 items-center gap-10 lg:grid-cols-2 lg:gap-14 xl:gap-16">
                <div class="service-page-hero-wrap service-page-fade-up order-2 lg:order-1">
                    <div class="relative overflow-hidden rounded-2xl sm:rounded-3xl bg-gradient-to-br from-pink-100/50 to-rose-100/30 p-1 shadow-xl ring-1 ring-pink-200/40">
                        <div class="aspect-[4/3] overflow-hidden rounded-[1.35rem] sm:rounded-[1.65rem] sm:aspect-[5/4] lg:aspect-[4/3]">
                            <img
                                src="{{ $heroImageUrl }}"
                                alt="{{ $category->name }}"
                                class="service-page-hero-img h-full w-full object-cover"
                                loading="eager"
                                width="800"
                                height="600"
                            >
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2 lg:min-w-0">
                    <p class="service-page-fade-up service-page-delay-1 mb-3 inline-flex items-center gap-2 rounded-full border border-pink-200/80 bg-white/80 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-pink-700 shadow-sm backdrop-blur-sm sm:text-sm">
                        <span class="h-1.5 w-1.5 rounded-full bg-pink-500" aria-hidden="true"></span>
                        Service category
                    </p>
                    <h1 class="service-page-fade-up service-page-delay-2 heading-font text-3xl font-bold leading-tight tracking-tight text-gray-900 sm:text-4xl lg:text-[2.5rem] xl:text-5xl">
                        {{ $category->name }}
                    </h1>
                    @if(!empty(trim(strip_tags((string) $decodedShortDescription))))
                    <div class="service-page-fade-up service-page-delay-3 mt-5 text-base leading-relaxed text-gray-700 sm:text-lg">
                        <div class="rich-content prose prose-pink max-w-none prose-p:leading-relaxed">
                            {!! $decodedShortDescription !!}
                        </div>
                    </div>
                    @endif
                    <div class="service-page-fade-up service-page-delay-4 mt-8 flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-center">
                        <a href="{{ route('book-appointment') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-pink-600 px-7 py-3.5 text-sm font-semibold text-white shadow-lg transition hover:bg-pink-700 hover:shadow-xl focus:outline-none focus-visible:ring-2 focus-visible:ring-pink-500 focus-visible:ring-offset-2 sm:px-8 sm:text-base">
                            <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Book appointment
                        </a>
                        <a href="{{ route('services') }}" class="inline-flex items-center justify-center gap-2 rounded-full border border-gray-200 bg-white/90 px-6 py-3.5 text-sm font-semibold text-gray-800 shadow-sm transition hover:border-pink-200 hover:bg-pink-50/80 hover:text-pink-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-pink-500 focus-visible:ring-offset-2 sm:text-base">
                            All services
                            <svg class="h-4 w-4 shrink-0 transition group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(!empty(trim(strip_tags((string) $decodedDescription))))
    <!-- Full description (rich text) -->
    <section class="relative border-t border-gray-100 bg-gradient-to-b from-gray-50/80 to-white py-12 sm:py-16 lg:py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="service-page-fade-up overflow-hidden rounded-2xl border border-gray-200/80 bg-white shadow-[0_1px_3px_rgba(0,0,0,0.04),0_8px_24px_-4px_rgba(17,24,39,0.06)] ring-1 ring-gray-100/60">
                <div class="border-b border-pink-100/80 bg-gradient-to-r from-pink-50/90 via-white to-rose-50/40 px-6 py-5 sm:px-8 sm:py-6">
                    <h2 class="heading-font flex items-center gap-3 text-lg font-bold text-gray-900 sm:text-xl">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-pink-500 to-rose-500 text-white shadow-md">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                        </span>
                        Overview
                    </h2>
                    <p class="mt-2 text-sm text-gray-600 sm:text-[0.9375rem]">Detailed information about this service category.</p>
                </div>
                <div class="px-6 py-7 sm:px-8 sm:py-9 lg:px-10 lg:py-10">
                    <div class="rich-content prose prose-lg prose-pink max-w-none prose-headings:scroll-mt-24">
                        {!! $decodedDescription !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Treatments / Subcategories -->
    <section class="relative py-14 sm:py-16 lg:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10 max-w-2xl lg:mb-12">
                <p class="text-sm font-semibold uppercase tracking-wider text-pink-600">Explore</p>
                <h2 class="heading-font mt-2 text-2xl font-bold text-gray-900 sm:text-3xl lg:text-4xl">Treatments &amp; conditions</h2>
                <p class="mt-3 text-base text-gray-600 sm:text-lg">Specialised care pathways within this category—tap a topic to learn more.</p>
            </div>
            @if($category->activeSubcategories->isNotEmpty())
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-3 lg:gap-6">
                @foreach($category->activeSubcategories as $i => $sub)
                <a
                    href="{{ route('services.subservice', [$category->slug, $sub->slug]) }}"
                    class="service-page-treatment-card group relative flex flex-col overflow-hidden rounded-2xl border border-pink-100/90 bg-gradient-to-br from-white to-pink-50/30 p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-pink-200 hover:shadow-xl focus:outline-none focus-visible:ring-2 focus-visible:ring-pink-500 focus-visible:ring-offset-2 sm:p-6"
                    style="animation-delay: {{ min($i * 45, 400) }}ms;"
                >
                    <span class="absolute right-4 top-4 h-8 w-8 rounded-full bg-pink-100/80 opacity-0 transition group-hover:opacity-100" aria-hidden="true"></span>
                    <div class="relative flex items-start gap-4">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-pink-100 text-pink-600 shadow-inner transition duration-300 group-hover:scale-105 group-hover:bg-pink-600 group-hover:text-white group-hover:shadow-md">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h3 class="text-lg font-bold leading-snug text-gray-900 transition group-hover:text-pink-700 sm:text-xl">{{ $sub->name }}</h3>
                            @if($sub->description)
                            <p class="mt-2 line-clamp-2 text-sm leading-relaxed text-gray-600 sm:text-[0.9375rem]">{{ Str::limit(strip_tags($sub->description), 110) }}</p>
                            @endif
                            <span class="mt-4 inline-flex items-center text-sm font-semibold text-pink-600 transition group-hover:gap-1">
                                Learn more
                                <svg class="ml-1 h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @else
            <div class="rounded-2xl border border-dashed border-gray-200 bg-gray-50/80 px-6 py-12 text-center">
                <p class="text-gray-600">No treatments listed for this category yet. <a href="{{ route('contact') }}" class="font-semibold text-pink-600 underline-offset-2 hover:underline">Contact us</a> for more information.</p>
            </div>
            @endif
        </div>
    </section>

    <!-- CTA -->
    <section class="relative overflow-hidden py-14 sm:py-16 lg:py-20">
        <div class="absolute inset-0 bg-gradient-to-br from-pink-600 via-pink-500 to-rose-600" aria-hidden="true"></div>
        <div class="absolute inset-0 opacity-30 bg-[url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.08\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]" aria-hidden="true"></div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="heading-font text-2xl font-bold text-white sm:text-3xl md:text-4xl">Ready to take the next step?</h2>
            <p class="mt-4 text-base text-pink-100 sm:text-lg md:text-xl">Schedule a consultation to discuss your specific needs with confidence.</p>
            <div class="mt-8 flex flex-col items-stretch justify-center gap-3 sm:flex-row sm:items-center sm:justify-center">
                <a href="{{ route('book-appointment') }}" class="service-page-cta-btn inline-flex items-center justify-center rounded-full bg-white px-8 py-3.5 text-base font-semibold text-pink-600 shadow-lg transition hover:bg-pink-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-pink-600 sm:px-10 sm:py-4">
                    Book appointment
                </a>
                <a href="{{ route('doctors.index') }}" class="inline-flex items-center justify-center rounded-full border-2 border-white/40 bg-white/10 px-8 py-3.5 text-base font-semibold text-white backdrop-blur-sm transition hover:bg-white/20 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-pink-600 sm:px-10 sm:py-4">
                    Find a specialist
                </a>
            </div>
        </div>
    </section>
@endsection
