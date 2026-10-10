@extends('layouts.app')

@section('title', 'Book with ' . $doctor->name . ' – Pelvicare Health')
@section('meta_description', 'Book an appointment with ' . $doctor->name . ' at ' . ($doctor->doctorProfile->clinic_name ?? 'Pelvicare Health') . '. View available time slots and confirm online.')

@section('content')

@php
    $profile = $doctor->doctorProfile;
    $dayMap   = ['monday'=>1,'tuesday'=>2,'wednesday'=>3,'thursday'=>4,'friday'=>5,'saturday'=>6,'sunday'=>0];
    $availableDayNumbers = $availableDays->map(fn($d) => $dayMap[$d] ?? null)->filter()->values()->toArray();
    $sessionTypes = [];
    if ($profile->clinic_visit_fee) $sessionTypes['clinic_visit']     = ['label'=>'Clinic Visit',    'fee'=> $profile->clinic_visit_fee,    'icon'=>'🏥'];
    if ($profile->video_session_fee) $sessionTypes['video_session']    = ['label'=>'Video Consult',   'fee'=> $profile->video_session_fee,   'icon'=>'💻'];
    if ($profile->home_visit_fee)    $sessionTypes['home_visit']       = ['label'=>'Home Visit',      'fee'=> $profile->home_visit_fee,      'icon'=>'🏠'];
    $defaultSession = array_key_first($sessionTypes) ?? 'clinic_visit';
@endphp

{{-- ░░░ BREADCRUMB ░░░ --}}
<div class="bg-white border-b border-gray-100 py-3">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center gap-2 text-sm text-gray-500">
        <a href="{{ route('book-appointment') }}" class="hover:text-pink-600 transition-colors flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            All Doctors
        </a>
        <span class="text-gray-300">/</span>
        <span class="text-gray-900 font-medium">{{ $doctor->name }}</span>
    </div>
</div>

{{-- ░░░ MAIN LAYOUT ░░░ --}}
<section class="py-10 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-start">

            {{-- ── LEFT: Doctor Profile Card ── --}}
            <aside class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-24">

                    {{-- Profile header --}}
                    <div class="bg-gradient-to-br from-pink-500 to-rose-500 p-6 text-white">
                        <div class="flex gap-4 items-start">
                            @if($profile->profile_image)
                                <img src="{{ media_url($profile->profile_image) }}"
                                     alt="{{ $doctor->name }}"
                                     class="w-24 h-24 rounded-2xl object-cover border-4 border-white/40 flex-shrink-0">
                            @else
                                <div class="w-24 h-24 rounded-2xl bg-white/20 flex items-center justify-center border-4 border-white/40 flex-shrink-0">
                                    <span class="text-4xl font-bold">{{ strtoupper(substr($doctor->name, 0, 1)) }}</span>
                                </div>
                            @endif
                            <div>
                                <h2 class="text-xl font-bold leading-tight">{{ $doctor->name }}</h2>
                                @if($profile->specializations)
                                    <p class="text-pink-100 text-sm mt-1">{{ implode(' · ', $profile->specializations) }}</p>
                                @endif
                                @if($profile->rating)
                                    <div class="flex items-center gap-1 mt-2">
                                        @for($i=1;$i<=5;$i++)
                                            <svg class="w-4 h-4 {{ $i <= round($profile->rating) ? 'text-yellow-300' : 'text-white/30' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        @endfor
                                        <span class="text-white/80 text-xs ml-1">{{ number_format($profile->rating, 1) }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Details --}}
                    <div class="p-5 space-y-4 text-sm">
                        @if($profile->years_of_experience)
                        <div class="flex gap-3 items-center">
                            <div class="w-9 h-9 bg-pink-50 rounded-xl flex items-center justify-center text-pink-500 flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">Experience</p>
                                <p class="font-semibold text-gray-900">{{ $profile->years_of_experience }}+ Years</p>
                            </div>
                        </div>
                        @endif

                        @if($profile->clinic_name)
                        <div class="flex gap-3 items-center">
                            <div class="w-9 h-9 bg-pink-50 rounded-xl flex items-center justify-center text-pink-500 flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">Clinic / Hospital</p>
                                <p class="font-semibold text-gray-900">{{ $profile->clinic_name }}</p>
                            </div>
                        </div>
                        @endif

                        @if($profile->clinic_address)
                        <div class="flex gap-3 items-start">
                            <div class="w-9 h-9 bg-pink-50 rounded-xl flex items-center justify-center text-pink-500 flex-shrink-0 mt-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">Clinic Address</p>
                                <p class="font-semibold text-gray-900">{{ $profile->clinic_address }}</p>
                            </div>
                        </div>
                        @endif

                        {{-- Available Days --}}
                        @if($availableDays->isNotEmpty())
                        <div class="pt-3 border-t border-gray-100">
                            <p class="text-xs text-gray-400 mb-2">Available Days</p>
                            <div class="flex flex-wrap gap-1.5">
                                @foreach(['Mon','Tue','Wed','Thu','Fri','Sat','Sun'] as $dayShort)
                                @php $full = strtolower(['Mon'=>'monday','Tue'=>'tuesday','Wed'=>'wednesday','Thu'=>'thursday','Fri'=>'friday','Sat'=>'saturday','Sun'=>'sunday'][$dayShort]); @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-semibold border
                                    {{ $availableDays->contains($full) ? 'bg-green-50 text-green-700 border-green-200' : 'bg-gray-50 text-gray-300 border-gray-100' }}">
                                    {{ $dayShort }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        {{-- Bio snippet --}}
                        @if($profile->bio)
                        <div class="pt-3 border-t border-gray-100">
                            <p class="text-xs text-gray-400 mb-1">About</p>
                            <p class="text-gray-600 text-xs leading-relaxed line-clamp-4">{{ $profile->bio }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </aside>

            {{-- ── RIGHT: Booking Form ── --}}
            <div class="lg:col-span-3">

                {{-- Alerts --}}
                @if(session('error'))
                <div class="mb-5 flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('error') }}
                </div>
                @endif
                @if($errors->any())
                <div class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4">
                    <ul class="list-disc list-inside text-sm space-y-1">
                        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('booking.store', $profile->slug) }}" id="booking-form">
                    @csrf

                    {{-- ── Step 1: Session Type ── --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-5">
                        <h3 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <span class="w-7 h-7 bg-pink-600 text-white rounded-full flex items-center justify-center text-xs font-bold">1</span>
                            Choose Consultation Type
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-{{ count($sessionTypes) }} gap-3" id="session-type-grid">
                            @if(empty($sessionTypes))
                                {{-- Fallback if profile fees not set --}}
                                @php $sessionTypes = ['clinic_visit'=>['label'=>'Clinic Visit','fee'=>null,'icon'=>'🏥']]; @endphp
                            @endif
                            @foreach($sessionTypes as $key => $type)
                            <label class="session-type-card cursor-pointer">
                                <input type="radio" name="session_type" value="{{ $key }}"
                                       class="sr-only peer" {{ $key === $defaultSession ? 'checked' : '' }}>
                                <div class="border-2 border-gray-200 peer-checked:border-pink-500 peer-checked:bg-pink-50 rounded-xl p-4 text-center transition-all hover:border-pink-300">
                                    <div class="text-2xl mb-1">{{ $type['icon'] }}</div>
                                    <p class="font-semibold text-sm text-gray-900">{{ $type['label'] }}</p>
                                    <p class="text-pink-600 font-bold text-sm mt-0.5">
                                        {{ $type['fee'] ? '₹' . number_format($type['fee'], 0) : 'Free' }}
                                    </p>
                                </div>
                            </label>
                            @endforeach
                        </div>
                        {{-- Home Visit Address (conditional) --}}
                        @if(isset($sessionTypes['home_visit']))
                        <div id="home-address-field" class="mt-4 hidden">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Your Address for Home Visit <span class="text-red-500">*</span></label>
                            <textarea name="patient_address" rows="2" placeholder="Full address including area, city, PIN..."
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-pink-500 focus:border-pink-500 resize-none"></textarea>
                        </div>
                        @endif
                    </div>

                    {{-- ── Step 2: Pick Date ── --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-5">
                        <h3 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <span class="w-7 h-7 bg-pink-600 text-white rounded-full flex items-center justify-center text-xs font-bold">2</span>
                            Select Appointment Date
                        </h3>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="flex-1">
                                <input type="date" id="appointment_date" name="appointment_date"
                                       value="{{ old('appointment_date') }}"
                                       min="{{ now()->format('Y-m-d') }}"
                                       max="{{ now()->addDays(60)->format('Y-m-d') }}"
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 text-sm">
                            </div>
                            <div class="sm:w-auto flex items-center gap-2 text-xs text-gray-400 bg-gray-50 rounded-xl px-4 py-2">
                                <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="5"/></svg> Available
                                <svg class="w-4 h-4 text-gray-300 ml-2" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="5"/></svg> Unavailable
                            </div>
                        </div>
                        <p id="date-error" class="hidden text-red-500 text-xs mt-2"></p>
                    </div>

                    {{-- ── Step 3: Pick Slot ── --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-5">
                        <h3 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <span class="w-7 h-7 bg-pink-600 text-white rounded-full flex items-center justify-center text-xs font-bold">3</span>
                            Choose Time Slot
                        </h3>

                        {{-- Slot Loading / States --}}
                        <div id="slots-placeholder" class="text-center py-8 text-gray-400 text-sm">
                            <svg class="w-10 h-10 mx-auto mb-2 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Please select a date to see available slots
                        </div>
                        <div id="slots-loading" class="hidden text-center py-8">
                            <div class="inline-block w-8 h-8 border-4 border-pink-200 border-t-pink-600 rounded-full animate-spin"></div>
                            <p class="text-gray-400 text-sm mt-2">Loading slots…</p>
                        </div>
                        <div id="slots-unavailable" class="hidden text-center py-8">
                            <p class="text-orange-600 font-medium">🗓️ Doctor is not available on this day.</p>
                            <p class="text-gray-400 text-sm mt-1">Please select a different date.</p>
                        </div>
                        <div id="slots-grid" class="hidden">
                            <div id="slots-container" class="grid grid-cols-3 sm:grid-cols-4 gap-2.5"></div>
                        </div>
                        <input type="hidden" name="appointment_time" id="appointment_time" value="{{ old('appointment_time') }}">
                        <p id="slot-selected-display" class="hidden mt-3 text-green-700 font-semibold text-sm bg-green-50 border border-green-200 rounded-xl px-4 py-2"></p>
                    </div>

                    {{-- ── Step 4: Your Details ── --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-5">
                        <h3 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <span class="w-7 h-7 bg-pink-600 text-white rounded-full flex items-center justify-center text-xs font-bold">4</span>
                            Your Information
                        </h3>

                        @auth
                        {{-- Logged in --}}
                        <div class="bg-pink-50 border border-pink-100 rounded-xl px-4 py-3 mb-4 flex items-center gap-3">
                            <div class="w-9 h-9 bg-pink-500 text-white rounded-full flex items-center justify-center font-bold text-sm">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900 text-sm">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                            </div>
                            <span class="ml-auto text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-semibold">Logged in</span>
                        </div>
                        @else
                        {{-- Guest --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="sm:col-span-2 sm:grid sm:grid-cols-2 sm:gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Full Name <span class="text-red-500">*</span></label>
                                    <input type="text" name="guest_name" value="{{ old('guest_name') }}" required
                                           placeholder="Your full name"
                                           class="w-full px-4 py-2.5 border {{ $errors->has('guest_name') ? 'border-red-400' : 'border-gray-200' }} rounded-xl text-sm focus:ring-2 focus:ring-pink-500 focus:border-pink-500 @error('guest_name') border-red-400 @enderror">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Phone Number <span class="text-red-500">*</span></label>
                                    <input type="tel" name="guest_phone" value="{{ old('guest_phone') }}" required
                                           placeholder="+91 XXXXX XXXXX"
                                           class="w-full px-4 py-2.5 border {{ $errors->has('guest_phone') ? 'border-red-400' : 'border-gray-200' }} rounded-xl text-sm focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email Address <span class="text-gray-400 font-normal">(optional)</span></label>
                                <input type="email" name="guest_email" value="{{ old('guest_email') }}"
                                       placeholder="your@email.com"
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-3">
                            <a href="{{ route('login') }}" class="text-pink-600 hover:underline font-medium">Sign in</a> for a faster experience. Or continue as guest.
                        </p>
                        @endauth

                        {{-- Reason / Notes --}}
                        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="sm:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Reason for Visit <span class="text-gray-400 font-normal">(optional)</span></label>
                                <textarea name="reason" rows="2" placeholder="Briefly describe your concern..."
                                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-pink-500 focus:border-pink-500 resize-none">{{ old('reason') }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- ── Submit ── --}}
                    <button type="submit" id="submit-btn"
                        class="w-full bg-gradient-to-r from-pink-500 to-pink-600 text-white font-bold py-4 rounded-2xl text-base hover:from-pink-600 hover:to-pink-700 transition-all shadow-lg hover:shadow-xl flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Confirm Appointment
                    </button>
                    <p class="text-center text-xs text-gray-400 mt-2">By confirming, you agree that your contact info will only be used for appointment purposes.</p>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const doctorId   = {{ $doctor->id }};
    const slotsUrl   = '{{ route("api.booking.slots") }}';
    const dateInput  = document.getElementById('appointment_date');
    const timeInput  = document.getElementById('appointment_time');
    const placeholder= document.getElementById('slots-placeholder');
    const loadingEl  = document.getElementById('slots-loading');
    const unavailEl  = document.getElementById('slots-unavailable');
    const slotsGrid  = document.getElementById('slots-grid');
    const slotsContainer = document.getElementById('slots-container');
    const slotDisplay    = document.getElementById('slot-selected-display');
    const dateError      = document.getElementById('date-error');
    const submitBtn      = document.getElementById('submit-btn');
    const availableDays  = @json($availableDayNumbers); // [1,2,3,4,5]

    // Available days validation
    function isDayAvailable(dateStr) {
        const d = new Date(dateStr + 'T00:00:00');
        return availableDays.includes(d.getDay());
    }

    function showState(state) {
        placeholder.classList.add('hidden');
        loadingEl.classList.add('hidden');
        unavailEl.classList.add('hidden');
        slotsGrid.classList.add('hidden');
        if (state === 'placeholder') placeholder.classList.remove('hidden');
        if (state === 'loading')     loadingEl.classList.remove('hidden');
        if (state === 'unavailable') unavailEl.classList.remove('hidden');
        if (state === 'slots')       slotsGrid.classList.remove('hidden');
    }

    function loadSlots(date) {
        timeInput.value = '';
        slotDisplay.classList.add('hidden');
        slotDisplay.textContent = '';
        showState('loading');

        fetch(`${slotsUrl}?doctor_id=${doctorId}&date=${date}`)
            .then(r => r.json())
            .then(data => {
                if (!data.slots || data.slots.length === 0) {
                    showState('unavailable');
                    if (data.message) unavailEl.querySelector('p').textContent = '🗓️ ' + data.message;
                    return;
                }
                slotsContainer.innerHTML = '';
                data.slots.forEach(slot => {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.dataset.time = slot.time;
                    btn.textContent = slot.display_time;
                    if (slot.is_booked) {
                        btn.className = 'py-2 px-2 rounded-xl text-xs font-medium border-2 border-gray-100 bg-gray-50 text-gray-300 cursor-not-allowed line-through';
                        btn.disabled = true;
                        btn.title = 'Already booked';
                    } else {
                        btn.className = 'slot-btn py-2 px-2 rounded-xl text-xs font-semibold border-2 border-gray-200 bg-white text-gray-700 hover:border-pink-500 hover:bg-pink-50 hover:text-pink-700 transition-all cursor-pointer';
                        btn.addEventListener('click', function () {
                            document.querySelectorAll('.slot-btn').forEach(b => {
                                b.classList.remove('border-pink-500','bg-pink-500','text-white');
                                b.classList.add('border-gray-200','bg-white','text-gray-700');
                            });
                            this.classList.add('border-pink-500','bg-pink-500','text-white');
                            this.classList.remove('border-gray-200','bg-white','text-gray-700');
                            timeInput.value = this.dataset.time;
                            slotDisplay.textContent = `✓ Selected slot: ${this.textContent}`;
                            slotDisplay.classList.remove('hidden');
                        });
                    }
                    slotsContainer.appendChild(btn);
                });
                showState('slots');
            })
            .catch(() => {
                showState('unavailable');
                unavailEl.querySelector('p').textContent = '⚠️ Could not load slots. Please refresh.';
            });
    }

    dateInput.addEventListener('change', function () {
        const val = this.value;
        dateError.classList.add('hidden');
        if (!val) { showState('placeholder'); return; }
        if (!isDayAvailable(val)) {
            dateError.textContent = 'Doctor is not available on this day. Please choose a different date.';
            dateError.classList.remove('hidden');
            showState('unavailable');
            return;
        }
        loadSlots(val);
    });

    // Home visit address toggle
    const sessionRadios = document.querySelectorAll('input[name="session_type"]');
    const homeField     = document.getElementById('home-address-field');
    sessionRadios.forEach(r => {
        r.addEventListener('change', function () {
            if (homeField) homeField.classList.toggle('hidden', this.value !== 'home_visit');
        });
    });

    // Form validation before submit
    document.getElementById('booking-form').addEventListener('submit', function (e) {
        if (!timeInput.value) {
            e.preventDefault();
            alert('Please select a time slot before confirming your appointment.');
            return;
        }
        submitBtn.disabled = true;
        submitBtn.innerHTML = `<svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Confirming…`;
    });

    // Restore selected slot on validation error
    @if(old('appointment_time'))
    if (dateInput.value) loadSlots(dateInput.value);
    @endif
});
</script>
@endpush
