@extends('layouts.app')

@section('title', $subcategory->meta_title ?? ($subcategory->name . ' - ' . $category->name . ' | Pelvicare'))
@section('meta_description', $subcategory->meta_description ?? Str::limit(strip_tags($subcategory->description ?? ''), 160))
@if($subcategory->meta_keywords ?? null)
@section('meta_keywords', $subcategory->meta_keywords)
@endif

@section('content')
    <!-- Breadcrumb -->
    <section class="bg-gray-50 border-b border-gray-100 py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex flex-wrap items-center gap-2 text-sm text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-pink-600 transition">Home</a>
                <span>/</span>
                <a href="{{ route('services') }}" class="hover:text-pink-600 transition">Services</a>
                <span>/</span>
                <a href="{{ route('services.show', $category->slug) }}" class="hover:text-pink-600 transition">{{ $category->name }}</a>
                <span>/</span>
                <span class="text-gray-900 font-medium">{{ $subcategory->name }}</span>
            </nav>
        </div>
    </section>

    <!-- Hero -->
    <section class="bg-gradient-to-br from-pink-50 via-white to-pink-100 py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-center gap-8 lg:gap-12">
                <div class="lg:w-1/2 order-2 lg:order-1">
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-medium bg-pink-100 text-pink-700 mb-4">{{ $category->name }}</span>
                    <h1 class="text-4xl md:text-5xl font-bold heading-font text-gray-900 mb-4">{{ $subcategory->name }}</h1>
                    <a href="{{ route('book-appointment') }}" class="inline-flex items-center px-6 py-3 bg-pink-600 text-white font-semibold rounded-full hover:bg-pink-700 transition shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Book Appointment
                    </a>
                </div>
                <div class="lg:w-1/2 order-1 lg:order-2">
                    @if($subcategory->image)
                    <img src="{{ media_url($subcategory->image) }}" alt="{{ $subcategory->name }}" class="w-full rounded-2xl shadow-xl object-cover max-h-96">
                    @elseif($category->image)
                    <img src="{{ media_url($category->image) }}" alt="{{ $subcategory->name }}" class="w-full rounded-2xl shadow-xl object-cover max-h-96">
                    @else
                    <img src="{{ asset('images/pelvic_health_services.png') }}" alt="{{ $subcategory->name }}" class="w-full rounded-2xl shadow-xl object-cover max-h-96">
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Content -->
    <section class="py-16 bg-gradient-to-b from-gray-50/50 to-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($subcategory->description)
            <div class="overflow-hidden rounded-2xl border border-gray-200/80 bg-white p-6 shadow-sm ring-1 ring-gray-100/80 sm:p-8 lg:p-10">
                <div class="rich-content prose prose-lg prose-pink max-w-none">
                    {!! $subcategory->description !!}
                </div>
            </div>
            @else
            <p class="text-gray-600">Detailed information about this treatment is being updated. Please <a href="{{ route('contact') }}" class="text-pink-600 hover:underline">contact us</a> for more information or to book a consultation.</p>
            @endif
        </div>
    </section>

    <!-- Related: other subcategories in same category -->
    @if($category->activeSubcategories->count() > 1)
    <section class="py-16 bg-gray-50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold heading-font text-gray-900 mb-6">Other {{ $category->name }} treatments</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($category->activeSubcategories->where('id', '!=', $subcategory->id)->take(6) as $other)
                <a href="{{ route('services.subservice', [$category->slug, $other->slug]) }}" class="block p-4 rounded-xl bg-white border border-gray-100 hover:border-pink-200 hover:shadow-md transition-all text-gray-900 font-medium">
                    {{ $other->name }}
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA -->
    <section class="py-16 bg-gradient-to-r from-pink-500 to-pink-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold heading-font text-white mb-6">Ready to Take the Next Step?</h2>
            <p class="text-xl text-pink-100 mb-8">Schedule a consultation to discuss your specific needs.</p>
            <a href="{{ route('book-appointment') }}" class="inline-block bg-white text-pink-600 px-8 py-4 rounded-full font-semibold hover:bg-pink-50 transition-all shadow-xl">Book Appointment</a>
        </div>
    </section>
@endsection
