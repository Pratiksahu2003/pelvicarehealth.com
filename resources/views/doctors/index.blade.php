@extends('layouts.app')

@section('title', 'Our Expert Physiotherapists - Pelvicare')
@section('meta_description', 'Browse our verified women\'s health physiotherapists. Find certified specialists for pelvic health, postpartum care, and sexual pain treatment.')

@section('content')
{{-- Hero: theme gradient --}}
<section class="bg-gradient-to-br from-pink-50 via-white to-pink-100 border-b border-pink-100/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <div class="max-w-2xl doctors-page-hero">
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold heading-font text-gray-900 tracking-tight leading-tight mb-3">
                Find a specialist
            </h1>
            <p class="text-base text-gray-600 leading-relaxed">
                Verified women's health physiotherapists. Book a consultation or explore profiles to find the right fit for you.
            </p>
        </div>
    </div>
</section>

{{-- Filters: theme bar --}}
<section class="sticky top-0 z-20 bg-white/95 backdrop-blur border-b border-pink-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <form method="GET" action="{{ route('doctors.index') }}" class="flex flex-col lg:flex-row lg:items-end gap-4">
            <div class="flex-1 min-w-0">
                <label for="search" class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1.5">Search</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </span>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                           placeholder="Name, category or clinic"
                           class="block w-full pl-10 pr-4 py-2.5 text-gray-900 placeholder-gray-400 border border-pink-100 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 bg-white transition-all">
                </div>
            </div>
            <div class="grid grid-cols-2 lg:flex lg:flex-nowrap gap-4">
                <div class="lg:w-44">
                    <label for="city" class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1.5">City</label>
                    <select name="city" id="city" class="block w-full px-4 py-2.5 text-gray-900 border border-pink-100 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 bg-white transition-all">
                        <option value="">All cities</option>
                        @foreach($cities as $city)
                            <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="lg:w-52">
                    <label for="category" class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1.5">Category</label>
                    <select name="category" id="category" class="block w-full px-4 py-2.5 text-gray-900 border border-pink-100 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 bg-white transition-all">
                        <option value="">All categories</option>
                        @foreach($allCategories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == (string)$cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2 lg:col-span-1 flex gap-2 lg:flex-shrink-0">
                    <button type="submit" class="flex-1 lg:flex-none px-5 py-2.5 bg-pink-600 text-white text-sm font-semibold rounded-xl hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition-colors shadow-md hover:shadow-lg">
                        Apply filters
                    </button>
                    @if(request()->has('search') || request()->has('city') || request()->has('category'))
                        <a href="{{ route('doctors.index') }}" class="flex-1 lg:flex-none px-5 py-2.5 text-pink-600 text-sm font-medium rounded-xl border-2 border-pink-200 bg-white hover:bg-pink-50 text-center transition-colors">
                            Clear
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</section>

{{-- Results --}}
<section class="min-h-[50vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-10">
        @if($doctors->count() > 0)
            <div class="doctors-results-head flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-6">
                <p class="text-sm text-gray-600">
                    <span class="font-semibold text-gray-900">{{ $doctors->total() }}</span> specialist{{ $doctors->total() === 1 ? '' : 's' }}
                    @if(request()->has('search') || request()->has('city') || request()->has('category'))
                        <span class="text-pink-600">(filtered)</span>
                    @endif
                </p>
                @if($doctors->total() > $doctors->count())
                    <p class="text-sm text-gray-500">
                        Showing {{ $doctors->firstItem() }}–{{ $doctors->lastItem() }}
                    </p>
                @endif
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 lg:gap-8">
                @foreach($doctors as $doctor)
                    @php
                        $profile = $doctor->doctorProfile;
                        $categoryDisplay = $profile->category_subcategory_display;
                        $rating = $profile->rating ?? null;
                        $hasMeaningfulRating = $rating !== null && (float)$rating > 0;
                        $city = $profile->city ?? null;
                        $years = (int)($profile->years_of_experience ?? 0);
                        $image = $profile->profile_image ? (media_url($profile->profile_image) ?? asset('images/physiotherapist_' . (($loop->index % 3) + 1) . '.png')) : asset('images/physiotherapist_' . (($loop->index % 3) + 1) . '.png');
                    @endphp
                    <article class="theme-card doctors-card-reveal overflow-hidden rounded-2xl flex flex-col h-full group" style="--reveal-delay: {{ min($loop->index * 42, 340) }}ms">
                        <a href="{{ route('doctors.show', $profile->slug) }}" class="block focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-inset rounded-t-2xl overflow-hidden">
                            <div class="relative aspect-[4/3] bg-pink-50/50 overflow-hidden">
                                <img src="{{ $image }}" alt="{{ $doctor->name }}" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
                                @if($hasMeaningfulRating)
                                    <div class="absolute top-3 right-3 flex items-center gap-1 bg-white/95 rounded-lg px-2.5 py-1.5 text-xs font-semibold text-gray-800 shadow-md border border-pink-100">
                                        <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        {{ number_format((float)$rating, 1) }}
                                    </div>
                                @endif
                                <span class="absolute top-3 left-3 inline-flex items-center gap-1 bg-green-500 text-white text-[10px] font-semibold uppercase tracking-wider rounded-md px-2 py-1 shadow-sm" title="Verified by Pelvicare">Verified</span>
                            </div>
                        </a>
                        <div class="p-5 flex flex-col flex-1 border-t border-pink-100/50">
                            <h2 class="text-base font-bold heading-font text-gray-900 leading-snug mb-1 mt-0">
                                <a href="{{ route('doctors.show', $profile->slug) }}" class="hover:text-pink-600 transition-colors">{{ $doctor->name }}</a>
                            </h2>
                            <p class="text-sm text-pink-600 font-medium mb-3">Women's health physiotherapist</p>

                            @php
                                $catList = $profile->serviceCategories();
                                $subList = $profile->serviceSubcategories();
                                $indexLinks = collect();
                                foreach ($catList as $cat) {
                                    $subs = $subList->where('service_category_id', $cat->id);
                                    if ($subs->isNotEmpty()) {
                                        foreach ($subs->take(2) as $sub) {
                                            $indexLinks->push(['url' => route('services.subservice', [$cat->slug, $sub->slug]), 'name' => $sub->name]);
                                        }
                                    } else {
                                        $indexLinks->push(['url' => route('services.show', $cat->slug), 'name' => $cat->name]);
                                    }
                                }
                                foreach ($subList->whereNotIn('service_category_id', $catList->pluck('id'))->take(1) as $sub) {
                                    $parentCat = $sub->serviceCategory;
                                    $indexLinks->push(['url' => $parentCat ? route('services.subservice', [$parentCat->slug, $sub->slug]) : route('services'), 'name' => $sub->name]);
                                }
                            @endphp
                            @if($indexLinks->isNotEmpty())
                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                                    @foreach($indexLinks as $i => $link)
                                        <a href="{{ $link['url'] }}" class="text-pink-600 hover:text-pink-700 hover:underline font-medium">{{ $link['name'] }}</a>{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                </p>
                            @endif

                            <ul class="space-y-1.5 mb-4 text-sm text-gray-500">
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-pink-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $years }}+ years experience
                                </li>
                                @if($city)
                                    <li class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-pink-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 12z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        {{ $city }}
                                    </li>
                                @endif
                            </ul>

                            <div class="mt-auto pt-4 border-t border-pink-100 space-y-2">
                                <a href="{{ route('doctors.show', $profile->slug) }}" class="block w-full text-center py-3 px-4 bg-gradient-to-r from-pink-500 to-pink-600 text-white text-sm font-semibold rounded-xl hover:from-pink-600 hover:to-pink-700 transition-all shadow-md hover:shadow-lg">
                                    View profile
                                </a>
                                <a href="{{ route('booking.doctor', $profile->slug) }}" class="block w-full text-center py-3 px-4 text-pink-600 text-sm font-semibold rounded-xl border-2 border-pink-200 bg-white hover:bg-pink-50 transition-colors">
                                    Book appointment
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            @if($doctors->hasPages())
                <div class="mt-10 pt-6 border-t border-pink-100">
                    {{ $doctors->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-16 px-4 theme-card-solid rounded-2xl max-w-lg mx-auto border border-pink-100">
                <div class="w-16 h-16 rounded-full bg-pink-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h2 class="text-lg font-bold heading-font text-gray-900 mb-2">No specialists match your filters</h2>
                <p class="text-sm text-gray-600 max-w-sm mx-auto mb-6">Try changing your search or filter criteria, or clear filters to see all specialists.</p>
                <a href="{{ route('doctors.index') }}" class="inline-flex items-center justify-center px-5 py-3 bg-pink-600 text-white text-sm font-semibold rounded-xl hover:bg-pink-700 transition-colors shadow-md hover:shadow-lg">
                    View all specialists
                </a>
            </div>
        @endif
    </div>
</section>
@endsection

@push('styles')
<style>
    /* Page intro: one-shot fade-rise (no scroll observer) */
    @keyframes doctors-hero-enter {
        from {
            opacity: 0;
            transform: translate3d(0, 14px, 0);
        }
        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }
    .doctors-page-hero h1 {
        opacity: 0;
        animation: doctors-hero-enter 0.65s cubic-bezier(0.22, 1, 0.36, 1) forwards;
    }
    .doctors-page-hero p {
        opacity: 0;
        animation: doctors-hero-enter 0.65s cubic-bezier(0.22, 1, 0.36, 1) 0.1s forwards;
    }
    .doctors-results-head {
        opacity: 0;
        animation: doctors-hero-enter 0.55s cubic-bezier(0.22, 1, 0.36, 1) 0.15s forwards;
    }

    /* Cards: unified rise + fade + subtle settle (GPU-friendly) */
    .doctors-card-reveal {
        opacity: 0;
        transform: translate3d(0, 22px, 0) scale(0.985);
        transform-origin: 50% 80%;
        backface-visibility: hidden;
        transition:
            opacity 0.72s cubic-bezier(0.22, 1, 0.36, 1),
            transform 0.72s cubic-bezier(0.22, 1, 0.36, 1),
            box-shadow 0.35s ease;
        transition-delay: var(--reveal-delay, 0ms);
        will-change: opacity, transform;
    }
    .doctors-card-reveal.is-visible {
        opacity: 1;
        transform: translate3d(0, 0, 0) scale(1);
        will-change: auto;
    }
    .theme-card.doctors-card-reveal:hover {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    @media (prefers-reduced-motion: reduce) {
        .doctors-page-hero h1,
        .doctors-page-hero p,
        .doctors-results-head {
            animation: none !important;
            opacity: 1 !important;
            transform: none !important;
        }
        .doctors-card-reveal {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
            will-change: auto !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var cards = document.querySelectorAll('.doctors-card-reveal');
        if (!cards.length) return;
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

        function reveal(el) {
            el.classList.add('is-visible');
        }

        if ('IntersectionObserver' in window) {
            var io = new IntersectionObserver(
                function (entries) {
                    entries.forEach(function (entry) {
                        if (!entry.isIntersecting) return;
                        reveal(entry.target);
                        io.unobserve(entry.target);
                    });
                },
                { root: null, rootMargin: '0px 0px -10% 0px', threshold: 0.04 }
            );
            cards.forEach(function (el) {
                io.observe(el);
            });
        } else {
            cards.forEach(reveal);
        }
    });
</script>
@endpush
