@extends('layouts.admin')

@section('title', 'My Profile')
@section('page-title', 'My Profile')
@section('page-subtitle', 'View and manage your professional information')

@section('content')
<div class="space-y-8">
    @if(session('success'))
        <div class="mb-4 bg-green-50 border-l-4 border-green-400 p-4 rounded-lg">
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
        <div class="mb-4 bg-red-50 border-l-4 border-red-400 p-4 rounded-lg">
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
    <!-- Profile Photo Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-pink-50 to-white">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold heading-font text-gray-900">Profile Photo</h3>
                    <p class="text-sm text-gray-600 mt-1">Update your profile picture (1:1 square, max 1MB)</p>
                </div>
                <div class="p-3 bg-pink-100 rounded-xl">
                    <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="p-8">
            <form action="{{ route('doctor.profile.photo.update') }}" method="POST" enctype="multipart/form-data" id="photoUploadForm">
                @csrf
                
                <div class="flex flex-col md:flex-row gap-8 items-start md:items-center">
                    <!-- Current Photo -->
                    <div class="flex-shrink-0">
                        @if($profile->profile_image)
                            <img src="{{ media_url($profile->profile_image) }}" alt="Current profile photo" class="w-48 h-48 object-cover rounded-xl border-4 border-gray-200 shadow-lg aspect-square">
                        @else
                            <div class="w-48 h-48 bg-gray-200 rounded-xl border-4 border-gray-300 flex items-center justify-center aspect-square">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Upload Section -->
                    <div class="flex-1 w-full">
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-pink-400 transition">
                            <label class="block">
                                <div class="mb-4">
                                    <span class="block text-sm font-semibold text-gray-900 mb-1">Upload New Photo</span>
                                    <span class="text-xs text-gray-500">JPG or PNG, max 1MB, 1:1 square</span>
                                </div>
                                
                                <!-- Image Preview and Crop Area -->
                                <div id="imagePreviewContainer" class="hidden mb-4">
                                    <div class="relative bg-gray-100 rounded-lg overflow-hidden" style="max-width: 560px; max-height: 560px;">
                                        <img id="imagePreview" src="" alt="Preview" class="max-w-full h-auto">
                                    </div>
                                    <p class="text-xs text-gray-600 mt-2">Crop your image to a 1:1 square. You can drag and resize the crop area.</p>
                                    <input type="hidden" name="profile_image_cropped" id="profile_image_cropped">
                                </div>
                                
                                <input type="file" name="profile_image" id="profile_image" accept="image/jpeg,image/jpg,image/png" 
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100 @error('profile_image') border-red-500 @enderror">
                                @error('profile_image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="bg-gradient-to-r from-pink-500 to-pink-600 text-white px-6 py-3 rounded-xl font-semibold hover:from-pink-600 hover:to-pink-700 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                                Update Photo
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Profile Information Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-pink-50 to-white">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold heading-font text-gray-900">Professional Information</h3>
                    <p class="text-sm text-gray-600 mt-1">Update your practice details and consultation fees</p>
                </div>
                <div class="p-3 bg-pink-100 rounded-xl">
                    <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <form action="{{ route('doctor.profile.update') }}" method="POST" class="p-8" id="profileForm">
            @csrf
            
            <!-- Bio Section (Rich text) -->
            <div class="mb-8">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Professional Bio / Description</label>
                <p class="text-xs text-gray-500 mb-2">Format your description with headings, lists, and images. Shown on your public profile.</p>
                <x-quill-editor name="bio" id="doctor-bio" :value="old('bio', $profile->bio)" height="400px" />
                @error('bio')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Clinic Information -->
            <div class="mb-8">
                <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <span class="w-8 h-8 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center mr-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </span>
                    Clinic Details
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Clinic Name</label>
                        <input type="text" name="clinic_name" value="{{ old('clinic_name', $profile->clinic_name) }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all shadow-sm" placeholder="Your clinic name">
                        @error('clinic_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- State / Union Territory --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            State / Union Territory <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="city" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all shadow-sm appearance-none cursor-pointer @error('city') border-red-500 @enderror">
                                <option value="">Select your state / UT</option>
                                <optgroup label="── States">
                                @foreach(config('pelvicare.locations', []) as $loc => $type)
                                    @if($type === 'state')
                                    <option value="{{ $loc }}" {{ old('city', $profile->city) === $loc ? 'selected' : '' }}>{{ $loc }}</option>
                                    @endif
                                @endforeach
                                </optgroup>
                                <optgroup label="── Union Territories">
                                @foreach(config('pelvicare.locations', []) as $loc => $type)
                                    @if($type === 'union_territory')
                                    <option value="{{ $loc }}" {{ old('city', $profile->city) === $loc ? 'selected' : '' }}>{{ $loc }}</option>
                                    @endif
                                @endforeach
                                </optgroup>
                            </select>
                            <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </span>
                        </div>
                        @error('city')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Clinic Address</label>
                        <textarea name="clinic_address" rows="2" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all shadow-sm resize-none" placeholder="Full clinic address">{{ old('clinic_address', $profile->clinic_address) }}</textarea>
                        @error('clinic_address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Consultation Fees -->
            <div class="mb-8">
                <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <span class="w-8 h-8 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center mr-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </span>
                    Consultation Fees (₹)
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Home Visit Fee</label>
                        <input type="number" name="home_visit_fee" value="{{ old('home_visit_fee', $profile->home_visit_fee) }}" step="0.01" min="0" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all shadow-sm" placeholder="0.00">
                        @error('home_visit_fee')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Clinic Visit Fee</label>
                        <input type="number" name="clinic_visit_fee" value="{{ old('clinic_visit_fee', $profile->clinic_visit_fee) }}" step="0.01" min="0" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all shadow-sm" placeholder="0.00">
                        @error('clinic_visit_fee')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Video Session Fee</label>
                        <input type="number" name="video_session_fee" value="{{ old('video_session_fee', $profile->video_session_fee) }}" step="0.01" min="0" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all shadow-sm" placeholder="0.00">
                        @error('video_session_fee')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Appointment Settings -->
            <div class="mb-8">
                <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <span class="w-8 h-8 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center mr-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </span>
                    Appointment Settings
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Slot Duration (minutes)</label>
                        <input type="number" name="slot_duration" value="{{ old('slot_duration', $profile->slot_duration ?? 30) }}" min="15" max="120" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all shadow-sm" placeholder="30">
                        @error('slot_duration')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Max Patients/Day</label>
                        <input type="number" name="max_patients_per_day" value="{{ old('max_patients_per_day', $profile->max_patients_per_day ?? 10) }}" min="1" max="50" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all shadow-sm" placeholder="10">
                        @error('max_patients_per_day')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Buffer Time (minutes)</label>
                        <input type="number" name="buffer_time" value="{{ old('buffer_time', $profile->buffer_time ?? 10) }}" min="0" max="60" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all shadow-sm" placeholder="10">
                        @error('buffer_time')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mt-4">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="same_day_bookings" value="1" {{ old('same_day_bookings', $profile->same_day_bookings) ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-pink-600 focus:ring-pink-500 transition-colors">
                        <span class="ml-3 text-sm font-medium text-gray-700">Allow same-day bookings</span>
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100">
                <button type="submit" class="bg-gradient-to-r from-pink-500 to-pink-600 text-white px-8 py-3 rounded-xl font-semibold hover:from-pink-600 hover:to-pink-700 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- FAQs Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-white">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <h3 class="text-xl font-bold heading-font text-gray-900">FAQs</h3>
                    <p class="text-sm text-gray-600 mt-1">Add questions & answers shown on your public profile</p>
                </div>
                <div class="p-3 bg-indigo-100 rounded-xl">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>
        <div class="p-8">
            <form action="{{ route('doctor.faqs.store') }}" method="POST" class="mb-8 p-6 bg-gray-50 rounded-xl border border-gray-200">
                @csrf
                <h4 class="font-semibold text-gray-900 mb-4">Add FAQ</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="md:col-span-2">
                        <input type="text" name="question" required placeholder="Question" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500" value="{{ old('question') }}">
                        @error('question')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <textarea name="answer" required rows="2" placeholder="Answer" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 resize-none">{{ old('answer') }}</textarea>
                        @error('answer')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700">Add FAQ</button>
            </form>
            <div class="space-y-4">
                @php $faqsList = is_iterable($profile->faqs ?? null) ? ($profile->faqs ?? []) : []; @endphp
                @forelse($faqsList as $faq)
                <div class="flex items-start justify-between gap-4 p-4 bg-white border border-gray-200 rounded-xl">
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-gray-900">{{ $faq->question }}</p>
                        <p class="text-sm text-gray-600 mt-1">{{ $faq->answer }}</p>
                    </div>
                    <div class="flex items-center gap-2 flex-shrink-0">
                        <a href="{{ route('doctor.profile') }}?edit_faq={{ $faq->id }}#faq-{{ $faq->id }}" class="p-2 text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition">Edit</a>
                        <form action="{{ route('doctor.faqs.destroy', $faq->id) }}" method="POST" class="inline" onsubmit="return confirm('Remove this FAQ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition">Delete</button>
                        </form>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-sm italic">No FAQs yet. Add one above.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Gallery & Clinic Photos -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-amber-50 to-white">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <h3 class="text-xl font-bold heading-font text-gray-900">Profile & Clinic Photos</h3>
                    <p class="text-sm text-gray-600 mt-1">Gallery photos show in your profile slider. Clinic photos (optional) show only under your profile when added.</p>
                </div>
                <div class="p-3 bg-amber-100 rounded-xl">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            </div>
        </div>
        <div class="p-8">
            @if($profile->photos->isNotEmpty())
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mb-8">
                @foreach($profile->photos as $photo)
                <div class="relative group rounded-xl overflow-hidden border border-gray-200 aspect-square">
                    <img src="{{ asset('' . $photo->path) }}" alt="" class="w-full h-full object-cover">
                    <span class="absolute top-2 left-2 px-2 py-0.5 rounded text-xs font-medium {{ $photo->type === 'clinic' ? 'bg-amber-500 text-white' : 'bg-gray-800 text-white' }}">{{ $photo->type }}</span>
                    <form action="{{ route('doctor.photos.destroy', $photo->id) }}" method="POST" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-1.5 bg-red-500 text-white rounded-lg hover:bg-red-600" onclick="return confirm('Remove this photo?');">×</button>
                    </form>
                </div>
                @endforeach
            </div>
            @endif
            <form action="{{ route('doctor.photos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Gallery photos</label>
                    <input type="file" name="gallery_photos[]" accept="image/*" multiple class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Clinic photos <span class="text-gray-400 font-normal">(optional, shown only under your profile)</span></label>
                    <input type="file" name="clinic_photos[]" accept="image/*" multiple class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                </div>
                <button type="submit" class="bg-amber-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-amber-700">Upload Photos</button>
            </form>
        </div>
    </div>

    <!-- Change Password Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-pink-50 to-white">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold heading-font text-gray-900">Change Password</h3>
                    <p class="text-sm text-gray-600 mt-1">Update your account password</p>
                </div>
                <div class="p-3 bg-pink-100 rounded-xl">
                    <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <form action="{{ route('doctor.password.update') }}" method="POST" class="p-8">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <div>
                    <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">Current Password <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="password" name="current_password" id="current_password" required 
                               class="w-full px-4 py-3 pr-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all shadow-sm @error('current_password') border-red-500 @enderror" 
                               placeholder="Enter your current password">
                        <button type="button" id="toggleCurrentPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none transition-colors">
                            <svg id="eyeIconCurrent" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <svg id="eyeOffIconCurrent" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                            </svg>
                        </button>
                    </div>
                    @error('current_password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="new_password" class="block text-sm font-semibold text-gray-700 mb-2">New Password <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="password" name="password" id="new_password" required 
                                   class="w-full px-4 py-3 pr-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all shadow-sm @error('password') border-red-500 @enderror" 
                                   placeholder="Enter new password">
                            <button type="button" id="toggleNewPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none transition-colors">
                                <svg id="eyeIconNew" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <svg id="eyeOffIconNew" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm New Password <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="password_confirmation" required 
                                   class="w-full px-4 py-3 pr-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all shadow-sm" 
                                   placeholder="Confirm new password">
                            <button type="button" id="togglePasswordConfirmation" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none transition-colors">
                                <svg id="eyeIconConfirmation" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <svg id="eyeOffIconConfirmation" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
                    <button type="submit" class="bg-gradient-to-r from-pink-500 to-pink-600 text-white px-8 py-3 rounded-xl font-semibold hover:from-pink-600 hover:to-pink-700 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Password
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Documents Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-white">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold heading-font text-gray-900">Verification Documents</h3>
                    <p class="text-sm text-gray-600 mt-1">View the status of your submitted documents</p>
                </div>
                <div class="p-3 bg-indigo-100 rounded-xl">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="p-6">
            @if($documents->count() > 0)
                <div class="space-y-4">
                    @foreach($documents as $document)
                        <div class="border border-gray-200 rounded-xl p-6 hover:shadow-md transition-all">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-2">
                                        <h4 class="text-base font-bold text-gray-900 capitalize">{{ str_replace('_', ' ', $document->document_type) }}</h4>
                                        @if($document->status === 'approved')
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-700 border border-emerald-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block mr-1"></span>
                                                Approved
                                            </span>
                                        @elseif($document->status === 'rejected')
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700 border border-red-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-500 inline-block mr-1"></span>
                                                Rejected
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-700 border border-amber-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 inline-block mr-1 animate-pulse"></span>
                                                Pending Review
                                            </span>
                                        @endif
                                    </div>
                                    
                                    @if($document->status === 'rejected' && $document->rejection_reason)
                                        <div class="mt-3 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                                            <div class="flex items-start">
                                                <svg class="w-5 h-5 text-red-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <div>
                                                    <p class="text-sm font-semibold text-red-800">Rejection Reason:</p>
                                                    <p class="text-sm text-red-700 mt-1">{{ $document->rejection_reason }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="flex items-center space-x-3 ml-4">
                                    @if($document->file_path)
                                        <a href="{{ asset('' . $document->file_path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-800 transition-colors">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                    @endif
                                    
                                    @if($document->status === 'rejected')
                                        <button type="button" onclick="document.getElementById('reupload-{{ $document->id }}').classList.toggle('hidden')" class="bg-pink-600 text-white px-4 py-2 rounded-lg hover:bg-pink-700 transition-colors text-sm font-medium">
                                            Re-upload
                                        </button>
                                    @endif
                                </div>
                            </div>

                            @if($document->status === 'rejected')
                                <div id="reupload-{{ $document->id }}" class="hidden mt-4 pt-4 border-t border-gray-200">
                                    <form action="{{ route('doctor.profile.document.reupload', $document->id) }}" method="POST" enctype="multipart/form-data" class="flex items-end space-x-3">
                                        @csrf
                                        <div class="flex-1">
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">Upload New Document</label>
                                            <input type="file" name="document" required accept=".pdf,.jpg,.jpeg,.png" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all">
                                            <p class="text-xs text-gray-500 mt-1">Accepted formats: PDF, JPG, PNG (Max 5MB)</p>
                                        </div>
                                        <button type="submit" class="bg-emerald-600 text-white px-6 py-2.5 rounded-lg hover:bg-emerald-700 transition-colors font-medium">
                                            Upload
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-gray-500">No documents submitted yet</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Cropper.js CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">

@push('scripts')
<!-- Cropper.js JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

<script>
let cropper;
let imagePreview = document.getElementById('imagePreview');
let imagePreviewContainer = document.getElementById('imagePreviewContainer');
let profileImageInput = document.getElementById('profile_image');
let croppedImageInput = document.getElementById('profile_image_cropped');

profileImageInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    
    if (!file) {
        imagePreviewContainer.classList.add('hidden');
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        return;
    }
    
    // Validate file size (1MB)
    if (file.size > 1024 * 1024) {
        alert('File size must be less than 1MB. Please choose a smaller image.');
        profileImageInput.value = '';
        return;
    }
    
    // Validate file type
    if (!file.type.match('image.*')) {
        alert('Please select an image file (JPG or PNG).');
        profileImageInput.value = '';
        return;
    }
    
    const reader = new FileReader();
    reader.onload = function(e) {
        imagePreview.src = e.target.result;
        imagePreviewContainer.classList.remove('hidden');
        
        // Destroy existing cropper if any
        if (cropper) {
            cropper.destroy();
        }
        
        // Initialize cropper with 1:1 (square) aspect ratio
        cropper = new Cropper(imagePreview, {
            aspectRatio: 1,
            viewMode: 1,
            dragMode: 'move',
            autoCropArea: 0.8,
            restore: false,
            guides: true,
            center: true,
            highlight: false,
            cropBoxMovable: true,
            cropBoxResizable: true,
            toggleDragModeOnDblclick: false,
            responsive: true,
            minCropBoxWidth: 200,
            minCropBoxHeight: 200,
        });
    };
    reader.readAsDataURL(file);
});

// Before form submit, get cropped image
document.getElementById('photoUploadForm').addEventListener('submit', function(e) {
    if (cropper && profileImageInput.files.length > 0) {
        e.preventDefault();
        
        // Get cropped canvas (1:1 square)
        const canvas = cropper.getCroppedCanvas({
            width: 600,
            height: 600,
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high',
        });
        
        // Convert canvas to blob
        canvas.toBlob(function(blob) {
            // Convert blob to base64
            const reader = new FileReader();
            reader.onload = function() {
                croppedImageInput.value = reader.result;
                // Continue with form submission
                e.target.submit();
            };
            reader.readAsDataURL(blob);
        }, 'image/jpeg', 0.9); // 90% quality
    }
    
    // Password visibility toggles
    function setupPasswordToggle(toggleId, inputId, eyeIconId, eyeOffIconId) {
        const toggle = document.getElementById(toggleId);
        const input = document.getElementById(inputId);
        const eyeIcon = document.getElementById(eyeIconId);
        const eyeOffIcon = document.getElementById(eyeOffIconId);
        
        if (toggle && input && eyeIcon && eyeOffIcon) {
            toggle.addEventListener('click', function() {
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                
                if (type === 'text') {
                    eyeIcon.classList.add('hidden');
                    eyeOffIcon.classList.remove('hidden');
                } else {
                    eyeIcon.classList.remove('hidden');
                    eyeOffIcon.classList.add('hidden');
                }
            });
        }
    }
    
    // Setup all password toggles
    setupPasswordToggle('toggleCurrentPassword', 'current_password', 'eyeIconCurrent', 'eyeOffIconCurrent');
    setupPasswordToggle('toggleNewPassword', 'new_password', 'eyeIconNew', 'eyeOffIconNew');
    setupPasswordToggle('togglePasswordConfirmation', 'password_confirmation', 'eyeIconConfirmation', 'eyeOffIconConfirmation');
});
</script>
@endpush
@endsection
