@extends('layouts.app')

@section('title', 'Doctor Registration - Step 3')
@section('content')
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            @if (session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd"></path>
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
                        <h2 class="text-2xl font-bold heading-font text-gray-900">Build Your Profile</h2>
                        <span class="text-sm text-gray-500">Step 3 of 4</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-pink-600 h-2 rounded-full" style="width: 75%"></div>
                    </div>
                </div>

                <form action="{{ route('doctor.registration.store.step3') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Years of Experience *</label>
                        <input type="number" name="years_of_experience" required min="0"
                            value="{{ old('years_of_experience', $profile->years_of_experience ?? '') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 @error('years_of_experience') border-red-500 @enderror">
                        @error('years_of_experience')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Service Categories *</label>
                        <p class="text-xs text-gray-500 mb-2">Select all service categories you offer (you can choose multiple)</p>
                        @php
                            $savedCategoryIds = old('service_category_ids', $profile->service_category_ids ?? []);
                            if (!is_array($savedCategoryIds)) {
                                $savedCategoryIds = [];
                            }
                        @endphp
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach ($serviceCategories as $cat)
                                <label
                                    class="relative flex items-start p-4 rounded-xl border-2 cursor-pointer transition-all duration-200 {{ in_array($cat->id, $savedCategoryIds) ? 'border-pink-500 bg-pink-50 ring-2 ring-pink-200' : 'border-gray-200 hover:border-pink-300 hover:bg-gray-50' }}">
                                    <input type="checkbox" name="service_category_ids[]" value="{{ $cat->id }}"
                                        {{ in_array($cat->id, $savedCategoryIds) ? 'checked' : '' }}
                                        class="mt-1 h-4 w-4 rounded text-pink-600 border-gray-300 focus:ring-pink-500 service-category-cb">
                                    <span class="ml-3 block">
                                        <span class="block text-sm font-semibold text-gray-900">{{ $cat->name }}</span>
                                    </span>
                                </label>
                            @endforeach
                        </div>
                        @error('service_category_ids')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Languages *</label>
                        <p class="text-xs text-gray-500 mb-2">Select all languages you speak</p>
                        <div class="grid grid-cols-2 gap-3">
                            @php
                                $savedLanguages = old('languages', $profile->languages ?? []);
                                if (!is_array($savedLanguages)) {
                                    $savedLanguages = [];
                                }
                            @endphp
                            @foreach (['English', 'Hindi', 'Marathi', 'Gujarati', 'Tamil', 'Telugu', 'Bengali', 'Punjabi'] as $lang)
                                <label class="flex items-center">
                                    <input type="checkbox" name="languages[]" value="{{ $lang }}"
                                        {{ in_array($lang, $savedLanguages) ? 'checked' : '' }}
                                        class="rounded border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">{{ $lang }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('languages')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                        <textarea name="bio" rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400"
                            placeholder="Tell patients about yourself...">{{ old('bio', $profile->bio ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Clinic Name (Optional)</label>
                        <input type="text" name="clinic_name"
                            value="{{ old('clinic_name', $profile->clinic_name ?? '') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400">
                    </div>
    
                {{-- ── State / Union Territory (required) ── --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        State / Union Territory <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select name="state"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 appearance-none cursor-pointer @error('state') border-red-500 @enderror"
                                required>
                            <option value="">— Select your State / Union Territory —</option>
                            <optgroup label="── States">
                                @foreach(config('pelvicare.locations', []) as $loc => $type)
                                    @if($type === 'state')
                                    <option value="{{ $loc }}"
                                        {{ old('state', $profile->state ?? '') === $loc ? 'selected' : '' }}>
                                        {{ $loc }}
                                    </option>
                                    @endif
                                @endforeach
                            </optgroup>
                            <optgroup label="── Union Territories">
                                @foreach(config('pelvicare.locations', []) as $loc => $type)
                                    @if($type === 'union_territory')
                                    <option value="{{ $loc }}"
                                        {{ old('state', $profile->state ?? '') === $loc ? 'selected' : '' }}>
                                        {{ $loc }}
                                    </option>
                                    @endif
                                @endforeach
                            </optgroup>
                        </select>
                        <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </span>
                    </div>
                    @error('state')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Clinic Address (Optional)</label>
                        <textarea name="clinic_address" rows="3"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400">{{ old('clinic_address', $profile->clinic_address ?? '') }}</textarea>
                    </div>
                    <div class="flex justify-between">
                        <a href="{{ route('doctor.registration.step2') }}"
                            class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-300 font-semibold">
                            ← Back
                        </a>
                        <button type="submit"
                            class="bg-gradient-to-r from-pink-400 to-pink-600 text-white px-8 py-3 rounded-lg hover:from-pink-500 hover:to-pink-700 font-semibold">
                            Next: Fees & Availability →
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
