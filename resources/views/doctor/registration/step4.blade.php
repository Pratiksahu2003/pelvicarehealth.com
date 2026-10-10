@extends('layouts.app')

@section('title', 'Doctor Registration - Step 4')
@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        @if(session('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="theme-card p-8">
            <div class="mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold heading-font text-gray-900">Fees & Availability</h2>
                    <span class="text-sm text-gray-500">Step 4 of 4</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-pink-600 h-2 rounded-full" style="width: 100%"></div>
                </div>
            </div>

            @if($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('doctor.registration.store.step4') }}" method="POST" class="space-y-6" id="step4Form">
                @csrf
                <div class="theme-card-solid border-pink-100 rounded-xl p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Update Profile Info</h3>
                    <p class="text-sm text-gray-500 mb-4">Select service subcategories for each category you offer (you can select multiple).</p>
                    @php
                        $savedSubcategoryIds = old('service_subcategory_ids', $profile->service_subcategory_ids ?? []);
                        if (!is_array($savedSubcategoryIds)) {
                            $savedSubcategoryIds = [];
                        }
                    @endphp
                    <div class="space-y-6">
                        @foreach($categoriesWithSubs as $item)
                            <div class="border border-gray-200 rounded-lg p-4 bg-gray-50/50">
                                <h4 class="text-sm font-semibold text-gray-800 mb-3">{{ $item['category']->name }}</h4>
                                @if($item['subcategories']->isEmpty())
                                    <p class="text-xs text-gray-500">No subcategories available for this category.</p>
                                @else
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                        @foreach($item['subcategories'] as $sub)
                                            <label class="flex items-center p-2 rounded-lg hover:bg-white/80 cursor-pointer">
                                                <input type="checkbox" name="service_subcategory_ids[]" value="{{ $sub->id }}"
                                                    {{ in_array($sub->id, $savedSubcategoryIds) ? 'checked' : '' }}
                                                    class="h-4 w-4 rounded text-pink-600 border-gray-300 focus:ring-pink-500">
                                                <span class="ml-2 text-sm text-gray-700">{{ $sub->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    @error('service_subcategory_ids')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="theme-card-solid border-pink-100 p-4 rounded-xl mb-6">
                    <h3 class="font-semibold mb-4">Session Fees</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Home Visit Fee (₹/hr)</label>
                            <input type="number" name="home_visit_fee" min="0" step="0.01" value="{{ old('home_visit_fee', $profile->home_visit_fee ?? '') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Clinic Visit Fee (₹/hr)</label>
                            <input type="number" name="clinic_visit_fee" min="0" step="0.01" value="{{ old('clinic_visit_fee', $profile->clinic_visit_fee ?? '') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Video Session Fee (₹/hr)</label>
                            <input type="number" name="video_session_fee" min="0" step="0.01" value="{{ old('video_session_fee', $profile->video_session_fee ?? '') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400">
                        </div>
                    </div>
                </div>

                <div class="theme-card-solid border-pink-100 p-4 rounded-xl mb-6">
                    <h3 class="font-semibold mb-4">Session Settings</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Slot Duration (minutes) *</label>
                            <select name="slot_duration" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 @error('slot_duration') border-red-500 @enderror">
                                <option value="30" {{ old('slot_duration', $profile->slot_duration ?? '') == 30 ? 'selected' : '' }}>30 mins</option>
                                <option value="45" {{ old('slot_duration', $profile->slot_duration ?? '') == 45 ? 'selected' : '' }}>45 mins</option>
                                <option value="60" {{ old('slot_duration', $profile->slot_duration ?? '') == 60 ? 'selected' : '' }}>60 mins</option>
                            </select>
                            @error('slot_duration')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Max Patients Per Day *</label>
                            <input type="number" name="max_patients_per_day" required min="1" max="50" value="{{ old('max_patients_per_day', $profile->max_patients_per_day ?? 10) }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 @error('max_patients_per_day') border-red-500 @enderror">
                            @error('max_patients_per_day')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Buffer Time (minutes) *</label>
                            <input type="number" name="buffer_time" required min="0" max="60" value="{{ old('buffer_time', $profile->buffer_time ?? 15) }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 @error('buffer_time') border-red-500 @enderror">
                            @error('buffer_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" name="same_day_bookings" {{ old('same_day_bookings', $profile->same_day_bookings ?? true) ? 'checked' : '' }} class="rounded border-gray-300">
                                <span class="ml-2 text-sm text-gray-700">Allow same-day bookings</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('doctor.registration.step3') }}" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-300 font-semibold">
                        ← Back
                    </a>
                    <button type="submit" id="submitBtn" class="bg-gradient-to-r from-pink-400 to-pink-600 text-white px-8 py-3 rounded-lg hover:from-pink-500 hover:to-pink-700 font-semibold disabled:opacity-50 disabled:cursor-not-allowed">
                        <span class="submit-text">Complete Registration</span>
                        <span class="loading-text hidden">Processing...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('step4Form');
    const submitBtn = document.getElementById('submitBtn');

    if (!form || !submitBtn) {
        return;
    }

    form.addEventListener('submit', function() {
        const submitText = submitBtn.querySelector('.submit-text');
        const loadingText = submitBtn.querySelector('.loading-text');

        submitBtn.disabled = true;
        if (submitText) submitText.classList.add('hidden');
        if (loadingText) loadingText.classList.remove('hidden');
    });
});
</script>
@endsection

