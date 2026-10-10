@extends('layouts.app')

@section('title', 'Book a Doctor Appointment – Pelvicare Health')
@section('meta_description', 'Find verified women\'s health physiotherapists near you and book an appointment online. Choose your city, pick a doctor, and select your preferred time slot.')

@section('content')

{{-- ░░░ HERO ░░░ --}}
<section class="relative overflow-hidden bg-gradient-to-br from-pink-600 via-pink-500 to-rose-400 py-14">
    <div class="absolute inset-0 opacity-10">
        <svg viewBox="0 0 800 400" xmlns="http://www.w3.org/2000/svg" class="w-full h-full"><circle cx="700" cy="50" r="200" fill="white"/><circle cx="100" cy="300" r="150" fill="white"/></svg>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <span class="inline-block bg-white/20 backdrop-blur text-white text-xs font-semibold px-4 py-1 rounded-full mb-4 tracking-wider uppercase">Online + In-Clinic + Home Visit</span>
        <h1 class="text-4xl md:text-5xl font-bold heading-font mb-3">Book a Doctor Appointment</h1>
        <p class="text-lg text-pink-100 max-w-2xl mx-auto">Find verified women's health physiotherapists near you. Choose your city → pick a doctor → confirm your slot.</p>

        {{-- Progress Steps --}}
        <div class="flex justify-center items-center gap-2 mt-8 text-sm font-semibold">
            <div class="flex items-center gap-2 bg-white/25 rounded-full px-4 py-1.5">
                <span class="w-6 h-6 bg-white text-pink-600 rounded-full flex items-center justify-center text-xs font-bold">1</span>
                Choose Location & Doctor
            </div>
            <div class="w-6 h-px bg-white/50"></div>
            <div class="flex items-center gap-2 bg-white/10 rounded-full px-4 py-1.5 opacity-70">
                <span class="w-6 h-6 bg-white/30 text-white rounded-full flex items-center justify-center text-xs font-bold">2</span>
                Pick Date & Slot
            </div>
            <div class="w-6 h-px bg-white/50"></div>
            <div class="flex items-center gap-2 bg-white/10 rounded-full px-4 py-1.5 opacity-70">
                <span class="w-6 h-6 bg-white/30 text-white rounded-full flex items-center justify-center text-xs font-bold">3</span>
                Confirm Booking
            </div>
        </div>
    </div>
</section>

{{-- ░░░ LOCATION FILTER ░░░ --}}
<section class="bg-white border-b border-gray-100 shadow-sm py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Filter by State / Union Territory</p>
        <div class="flex flex-wrap gap-3 items-center">
            {{-- State/UT dropdown --}}
            <div class="relative min-w-[220px]">
                <select id="state-select"
                    class="w-full pl-4 pr-10 py-2.5 border-2 border-gray-200 rounded-xl text-sm font-semibold text-gray-700 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 appearance-none cursor-pointer bg-white">
                    <option value="">🌐 All States / UTs</option>
                    <optgroup label="── States">
                    @foreach(config('pelvicare.locations', []) as $loc => $type)
                        @if($type === 'state')
                        <option value="{{ $loc }}" {{ $selectedState === $loc ? 'selected' : '' }}>{{ $loc }}</option>
                        @endif
                    @endforeach
                    </optgroup>
                    <optgroup label="── Union Territories">
                    @foreach(config('pelvicare.locations', []) as $loc => $type)
                        @if($type === 'union_territory')
                        <option value="{{ $loc }}" {{ $selectedState === $loc ? 'selected' : '' }}>{{ $loc }}</option>
                        @endif
                    @endforeach
                    </optgroup>
                </select>
                <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </span>
            </div>
            {{-- Clear filter link shown when a state is selected --}}
            @if($selectedState)
            <a href="{{ route('book-appointment') }}"
               class="flex items-center gap-1 px-4 py-2.5 rounded-xl border-2 border-gray-200 text-sm font-semibold text-gray-600 hover:border-pink-400 hover:text-pink-600 transition-all bg-white">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                Clear
            </a>
            @endif
        </div>
    </div>
</section>

{{-- ░░░ DOCTOR GRID ░░░ --}}
<section class="py-12 bg-gray-50 min-h-[500px]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header + Count --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-8">
            <div>
                <h2 class="text-xl font-bold heading-font text-gray-900" id="doctors-heading">
                    {{ $selectedState ? "Doctors in {$selectedState}" : 'All Available Doctors' }}
                </h2>
                <p class="text-sm text-gray-500 mt-1" id="doctors-count">{{ $doctors->count() }} specialist{{ $doctors->count() !== 1 ? 's' : '' }} found</p>
            </div>
            {{-- Search inline --}}
            <div class="relative max-w-xs w-full sm:w-auto">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" id="doctor-search" placeholder="Search by name or clinic..."
                    class="w-full pl-9 pr-4 py-2 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-pink-500 focus:border-pink-500 bg-white">
            </div>
        </div>

        {{-- Loading spinner --}}
        <div id="doctors-loading" class="hidden text-center py-16">
            <div class="inline-block w-10 h-10 border-4 border-pink-200 border-t-pink-600 rounded-full animate-spin"></div>
            <p class="text-gray-500 mt-3 text-sm">Finding doctors near you…</p>
        </div>

        {{-- No results --}}
        <div id="doctors-empty" class="hidden text-center py-16">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-gray-500 font-medium">No doctors found in this location.</p>
            <p class="text-gray-400 text-sm mt-1">Try selecting a different city or view all doctors.</p>
        </div>

        {{-- Doctor Cards Grid --}}
        <div id="doctors-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($doctors as $doctor)
            @php $profile = $doctor->doctorProfile; @endphp
            <div class="doctor-card bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 overflow-hidden transition-all duration-300 hover:-translate-y-1 flex flex-col"
                 data-name="{{ strtolower($doctor->name) }}"
                 data-clinic="{{ strtolower($profile->clinic_name ?? '') }}">

                {{-- Card Top --}}
                <div class="p-5 flex gap-4 items-start">
                    {{-- Avatar --}}
                    <div class="flex-shrink-0">
                        @if($profile->profile_image)
                            <img src="{{ media_url($profile->profile_image) }}"
                                 alt="{{ $doctor->name }}"
                                 class="w-20 h-20 rounded-2xl object-cover border-2 border-pink-100">
                        @else
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-pink-100 to-pink-200 flex items-center justify-center">
                                <span class="text-2xl font-bold text-pink-500">{{ strtoupper(substr($doctor->name, 0, 1)) }}</span>
                            </div>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-gray-900 leading-tight">{{ $doctor->name }}</h3>

                        @if($profile->specializations && count($profile->specializations))
                        <div class="flex flex-wrap gap-1 mt-1">
                            @foreach(array_slice($profile->specializations, 0, 2) as $spec)
                            <span class="inline-block text-xs bg-pink-50 text-pink-600 border border-pink-100 px-2 py-0.5 rounded-full">{{ $spec }}</span>
                            @endforeach
                        </div>
                        @endif

                        @if($profile->clinic_name)
                        <p class="text-xs text-gray-500 mt-1.5 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            {{ $profile->clinic_name }}
                        </p>
                        @endif

                        @if($profile->city)
                        <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $profile->city }}
                        </p>
                        @endif
                    </div>
                </div>

                {{-- Stats Row --}}
                <div class="grid grid-cols-3 divide-x divide-gray-100 border-t border-gray-100 text-center">
                    <div class="py-3">
                        <p class="text-base font-bold text-gray-900">{{ $profile->years_of_experience ?? 0 }}+</p>
                        <p class="text-xs text-gray-400">Yrs Exp</p>
                    </div>
                    <div class="py-3">
                        @php $rating = $profile->rating ?? 0; @endphp
                        <p class="text-base font-bold text-amber-500">
                            @if($rating > 0) {{ number_format($rating, 1) }} ★ @else — @endif
                        </p>
                        <p class="text-xs text-gray-400">Rating</p>
                    </div>
                    <div class="py-3">
                        <p class="text-base font-bold text-gray-900">
                            @if($profile->clinic_visit_fee) ₹{{ number_format($profile->clinic_visit_fee, 0) }} @else Free @endif
                        </p>
                        <p class="text-xs text-gray-400">Consult Fee</p>
                    </div>
                </div>

                {{-- CTA --}}
                <div class="p-4 mt-auto">
                    <a href="{{ route('booking.doctor', $profile->slug) }}"
                       class="block w-full text-center bg-gradient-to-r from-pink-500 to-pink-600 text-white font-bold py-3 rounded-xl hover:from-pink-600 hover:to-pink-700 transition-all shadow hover:shadow-md">
                        Book Appointment →
                    </a>
                </div>
            </div>
            @empty
            {{-- shown via JS empty state above --}}
            @endforelse
        </div>

        {{-- No doctors on first load message --}}
        @if($doctors->isEmpty())
        <div class="text-center py-16" id="initial-empty">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            <p class="text-gray-500 font-medium">No verified doctors are listed yet.</p>
            <p class="text-gray-400 text-sm mt-1">Please check back soon or <a href="{{ route('contact') }}" class="text-pink-600 hover:underline">contact us</a>.</p>
        </div>
        @endif
    </div>
</section>

{{-- ░░░ WHY BOOK WITH US ░░░ --}}
<section class="py-12 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            @foreach([
                ['icon'=>'🏅','title'=>'Verified Doctors','desc'=>'Every specialist is screened & certified'],
                ['icon'=>'🔒','title'=>'100% Private','desc'=>'Confidential & judgment-free consultations'],
                ['icon'=>'📅','title'=>'Flexible Slots','desc'=>'Book online, in-clinic or home visits'],
                ['icon'=>'⚡','title'=>'Instant Confirmation','desc'=>'Get confirmed within a few minutes'],
            ] as $item)
            <div class="p-5 rounded-2xl bg-pink-50 border border-pink-100">
                <div class="text-3xl mb-2">{{ $item['icon'] }}</div>
                <h4 class="font-bold text-gray-900 text-sm">{{ $item['title'] }}</h4>
                <p class="text-xs text-gray-500 mt-1">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const cityBtns  = document.querySelectorAll('.city-btn');
    const grid      = document.getElementById('doctors-grid');
    const loading   = document.getElementById('doctors-loading');
    const empty     = document.getElementById('doctors-empty');
    const heading   = document.getElementById('doctors-heading');
    const count     = document.getElementById('doctors-count');
    const searchBox = document.getElementById('doctor-search');

    function setActive(btn) {
        cityBtns.forEach(b => {
            b.classList.remove('bg-pink-600','border-pink-600','text-white','shadow-md');
            b.classList.add('bg-white','border-gray-200','text-gray-600');
        });
        btn.classList.add('bg-pink-600','border-pink-600','text-white','shadow-md');
        btn.classList.remove('bg-white','border-gray-200','text-gray-600');
    }

    function renderDoctors(doctors) {
        grid.innerHTML = '';
        if (!doctors.length) {
            empty.classList.remove('hidden');
            return;
        }
        empty.classList.add('hidden');
        doctors.forEach(doc => {
            const specs  = (doc.specializations||[]).slice(0,2).map(s =>
                `<span class="inline-block text-xs bg-pink-50 text-pink-600 border border-pink-100 px-2 py-0.5 rounded-full">${s}</span>`
            ).join('');
            const avatar = doc.profile_image
                ? `<img src="${doc.profile_image}" alt="${doc.name}" class="w-20 h-20 rounded-2xl object-cover border-2 border-pink-100">`
                : `<div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-pink-100 to-pink-200 flex items-center justify-center"><span class="text-2xl font-bold text-pink-500">${doc.name.charAt(0).toUpperCase()}</span></div>`;
            const ratingHtml = doc.rating ? `<p class="text-base font-bold text-amber-500">${parseFloat(doc.rating).toFixed(1)} ★</p>` : `<p class="text-base font-bold text-gray-400">—</p>`;
            const feeHtml    = doc.clinic_visit_fee ? `₹${Math.round(doc.clinic_visit_fee)}` : 'Free';
            grid.insertAdjacentHTML('beforeend', `
                <div class="doctor-card bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 overflow-hidden transition-all duration-300 hover:-translate-y-1 flex flex-col"
                     data-name="${doc.name.toLowerCase()}" data-clinic="${(doc.clinic_name||'').toLowerCase()}">
                    <div class="p-5 flex gap-4 items-start">
                        <div class="flex-shrink-0">${avatar}</div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-gray-900 leading-tight">${doc.name}</h3>
                            <div class="flex flex-wrap gap-1 mt-1">${specs}</div>
                            ${doc.clinic_name ? `<p class="text-xs text-gray-500 mt-1.5">🏥 ${doc.clinic_name}</p>` : ''}
                            ${doc.city ? `<p class="text-xs text-gray-400 mt-1">📍 ${doc.city}</p>` : ''}
                        </div>
                    </div>
                    <div class="grid grid-cols-3 divide-x divide-gray-100 border-t border-gray-100 text-center">
                        <div class="py-3"><p class="text-base font-bold text-gray-900">${doc.experience || 0}+</p><p class="text-xs text-gray-400">Yrs Exp</p></div>
                        <div class="py-3">${ratingHtml}<p class="text-xs text-gray-400">Rating</p></div>
                        <div class="py-3"><p class="text-base font-bold text-gray-900">${feeHtml}</p><p class="text-xs text-gray-400">Consult Fee</p></div>
                    </div>
                    <div class="p-4 mt-auto">
                        <a href="${doc.book_url}" class="block w-full text-center bg-gradient-to-r from-pink-500 to-pink-600 text-white font-bold py-3 rounded-xl hover:from-pink-600 hover:to-pink-700 transition-all shadow hover:shadow-md">
                            Book Appointment →
                        </a>
                    </div>
                </div>`
            );
        });
    }

    cityBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const state = this.dataset.state;
            setActive(this);
            heading.textContent = state ? `Doctors in ${state}` : 'All Available Doctors';

            // Show loading
            grid.innerHTML = '';
            loading.classList.remove('hidden');
            empty.classList.add('hidden');
            count.textContent = '';

            fetch(`{{ route('api.booking.doctors') }}?state=${encodeURIComponent(state)}`)
                .then(r => r.json())
                .then(data => {
                    loading.classList.add('hidden');
                    const doctors = data.doctors || [];
                    count.textContent = `${doctors.length} specialist${doctors.length !== 1 ? 's' : ''} found`;
                    renderDoctors(doctors);
                })
                .catch(() => {
                    loading.classList.add('hidden');
                    count.textContent = 'Error loading doctors.';
                });
        });
    });

    // State select dropdown drives filter
    const stateSelect = document.getElementById('state-select');
    if (stateSelect) {
        stateSelect.addEventListener('change', function () {
            const state = this.value;
            heading.textContent = state ? `Doctors in ${state}` : 'All Available Doctors';
            grid.innerHTML = '';
            loading.classList.remove('hidden');
            empty.classList.add('hidden');
            count.textContent = '';

            fetch(`{{ route('api.booking.doctors') }}?state=${encodeURIComponent(state)}`)
                .then(r => r.json())
                .then(data => {
                    loading.classList.add('hidden');
                    const doctors = data.doctors || [];
                    count.textContent = `${doctors.length} specialist${doctors.length !== 1 ? 's' : ''} found`;
                    renderDoctors(doctors);
                })
                .catch(() => {
                    loading.classList.add('hidden');
                    count.textContent = 'Error loading doctors.';
                });
        });
    }

    // Live search filter within current cards
    searchBox.addEventListener('input', function () {
        const q = this.value.toLowerCase().trim();
        const cards = document.querySelectorAll('.doctor-card');
        let visible = 0;
        cards.forEach(card => {
            const matches = card.dataset.name.includes(q) || card.dataset.clinic.includes(q);
            card.style.display = matches ? '' : 'none';
            if (matches) visible++;
        });
        count.textContent = `${visible} specialist${visible !== 1 ? 's' : ''} found`;
        empty.classList.toggle('hidden', visible > 0);
    });
});
</script>
@endpush
