@extends('layouts.app')

@section('title', 'Our Services - Pelvicare Women\'s Health Physiotherapy Delhi NCR')

@section('meta_description', 'Comprehensive pelvic health and women\'s health physiotherapy services in Delhi NCR. Pelvic floor rehab, pregnancy care, postpartum recovery, pelvic pain management, intimate health & more.')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-pink-50 via-white to-pink-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold heading-font text-gray-900 text-center mb-4">
                Our Services
            </h1>
            <p class="text-xl text-gray-700 text-center max-w-3xl mx-auto">
                Comprehensive pelvic health solutions for women at every stage of life
            </p>

            @if(isset($specializations) && $specializations !== [] && count($specializations) > 0)
            <div class="mt-8 flex flex-wrap justify-center gap-3">
                <form method="get" action="{{ route('services') }}" class="flex flex-wrap items-center justify-center gap-2">
                    <label for="specialization" class="text-sm font-medium text-gray-700 sr-only">Filter by category</label>
                    <select name="specialization" id="specialization" onchange="this.form.submit()" class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm text-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                        <option value="all" {{ (isset($specialization) && $specialization === 'all') || !isset($specialization) ? 'selected' : '' }}>All Categories</option>
                        @foreach($specializations as $spec)
                            <option value="{{ $spec }}" {{ (isset($specialization) && $specialization === $spec) ? 'selected' : '' }}>{{ $spec }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="rounded-lg bg-pink-600 px-4 py-2 text-sm font-medium text-white hover:bg-pink-700 transition">Filter</button>
                </form>
            </div>
            @endif
        </div>
    </section>

    <!-- Services Grid (Dynamic) -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(isset($categories) && $categories->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($categories as $category)
                @php
                    $colorMap = [
                        'pink' => ['border' => 'border-pink-100', 'overlay' => 'bg-pink-900/10', 'hover' => 'group-hover:text-pink-600', 'icon' => 'text-pink-500'],
                        'rose' => ['border' => 'border-rose-100', 'overlay' => 'bg-rose-900/10', 'hover' => 'group-hover:text-rose-500', 'icon' => 'text-rose-400'],
                        'fuchsia' => ['border' => 'border-fuchsia-100', 'overlay' => 'bg-fuchsia-900/10', 'hover' => 'group-hover:text-fuchsia-500', 'icon' => 'text-fuchsia-400'],
                        'teal' => ['border' => 'border-teal-100', 'overlay' => 'bg-teal-900/10', 'hover' => 'group-hover:text-teal-600', 'icon' => 'text-teal-400'],
                        'purple' => ['border' => 'border-purple-100', 'overlay' => 'bg-purple-900/10', 'hover' => 'group-hover:text-purple-500', 'icon' => 'text-purple-400'],
                    ];
                    $theme = $colorMap[$category->card_color ?? 'pink'] ?? $colorMap['pink'];
                @endphp
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all transform hover:-translate-y-2 {{ $theme['border'] }} border overflow-hidden group">
                    <a href="{{ route('services.show', $category->slug) }}" class="block">
                        <div class="h-48 overflow-hidden relative">
                            <div class="absolute inset-0 {{ $theme['overlay'] }} group-hover:bg-transparent transition-colors z-10"></div>
                            @if($category->image)
                            <img src="{{ media_url($category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                            <img src="{{ asset('images/pelvic_pain_service.png') }}" alt="{{ $category->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @endif
                        </div>
                        <div class="p-8">
                            <h3 class="text-2xl font-bold heading-font text-gray-900 mb-4 {{ $theme['hover'] }} transition-colors">{{ $category->name }}</h3>
                            <ul class="space-y-3 text-gray-700">
                                @foreach($category->activeSubcategories as $sub)
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 {{ $theme['icon'] }} mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <a href="{{ route('services.subservice', [$category->slug, $sub->slug]) }}" class="hover:underline hover:text-pink-600 transition-colors">{{ $sub->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                            @if($category->activeSubcategories->isEmpty())
                            <p class="text-gray-500 text-sm italic">No treatments listed yet.</p>
                            @endif
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            @else
            <!-- Fallback when no categories exist -->
            <div class="text-center py-16 bg-gray-50 rounded-2xl border border-gray-200">
                <p class="text-xl text-gray-600 mb-4">Service categories are being updated. Please check back soon.</p>
                <a href="{{ route('contact') }}" class="inline-block bg-pink-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-pink-700 transition">Contact Us</a>
            </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-pink-500 to-pink-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold heading-font text-white mb-6">
                Ready to Take the Next Step?
            </h2>
            <p class="text-xl text-pink-100 mb-8">
                Contact us today to schedule a consultation and discuss your specific needs.
            </p>
            <a href="{{ route('contact') }}" class="inline-block bg-white text-pink-600 px-8 py-4 rounded-full font-semibold hover:bg-pink-50 transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                Schedule Consultation
            </a>
        </div>
    </section>
@endsection
