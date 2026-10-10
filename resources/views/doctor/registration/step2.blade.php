@extends('layouts.app')

@section('title', 'Doctor Registration - Step 2')
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

        <div class="theme-card overflow-hidden rounded-2xl">
            <!-- Progress Header -->
            <div class="bg-gradient-to-r from-pink-500 to-pink-600 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-2xl font-bold text-white heading-font">Verify Your Identity</h2>
                        <p class="text-pink-100 text-sm mt-1">Upload your professional documents</p>
                    </div>
                    <div class="bg-white/20 rounded-full px-4 py-2">
                        <span class="text-white font-semibold">Step 2 of 4</span>
                    </div>
                </div>
                <div class="w-full bg-white/20 rounded-full h-2">
                    <div class="bg-white h-2 rounded-full transition-all duration-300" style="width: 50%"></div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                <div class="mb-6 bg-pink-50 border-l-4 border-pink-400 p-4 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-pink-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-pink-700">
                                <strong>Verification Process:</strong> Our medical team will review your documents. Verification usually takes 24-48 hours. You'll receive an email once your profile is approved.
                            </p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('doctor.registration.store.step2') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="registrationForm">
                    @csrf
                    
                    <!-- Profile Photo Upload -->
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-pink-400 transition mb-6">
                        <label class="block">
                            <div class="flex items-center justify-between mb-2">
                                <div>
                                    <span class="block text-sm font-semibold text-gray-900">Profile Photo</span>
                                    <span class="text-xs text-gray-500">This will be displayed on your public profile</span>
                                    @if(isset($profile) && $profile->profile_image)
                                        <span class="text-xs text-green-600 font-medium block mt-1">✓ Photo uploaded</span>
                                        <div class="mt-3">
                                            <img src="{{ media_url($profile->profile_image) }}" alt="Current profile photo" class="w-32 h-32 object-cover rounded-lg border-2 border-gray-200 aspect-square">
                                        </div>
                                    @endif
                                </div>
                                <span class="px-2 py-1 text-xs font-semibold bg-pink-100 text-pink-800 rounded">Recommended</span>
                            </div>
                            <p class="text-xs text-gray-500 mb-3">Supported: JPG, PNG (Max 1MB, 1:1 square)</p>
                            
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
                    
                    <!-- Required Documents -->
                    <div class="space-y-5">
                        @php
                            $uploadedDocs = [];
                            if (isset($documents)) {
                                foreach ($documents as $doc) {
                                    $uploadedDocs[$doc->document_type] = $doc;
                                }
                            }
                        @endphp
                        <div class="border-2 border-dashed {{ isset($uploadedDocs['degree_certificate']) ? 'border-green-400 bg-green-50' : 'border-gray-300' }} rounded-lg p-6 hover:border-pink-400 transition">
                            <label class="block">
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <span class="block text-sm font-semibold text-gray-900">Degree Certificate (BPT/MPT)</span>
                                        <span class="text-xs text-gray-500">Required document</span>
                                        @if(isset($uploadedDocs['degree_certificate']))
                                            <span class="text-xs text-green-600 font-medium block mt-1">✓ Uploaded: {{ $uploadedDocs['degree_certificate']->file_name }}</span>
                                        @endif
                                    </div>
                                    <span class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded">Required</span>
                                </div>
                                <p class="text-xs text-gray-500 mb-3">Supported: PDF, JPG, PNG (Max 5MB)</p>
                                <input type="file" name="degree_certificate" {{ !isset($uploadedDocs['degree_certificate']) ? 'required' : '' }} accept=".pdf,.jpg,.jpeg,.png" 
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100 @error('degree_certificate') border-red-500 @enderror">
                                @if(isset($uploadedDocs['degree_certificate']))
                                    <p class="text-xs text-gray-600 mt-2">Leave empty to keep current file, or upload a new one to replace.</p>
                                @endif
                                @error('degree_certificate')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>

                        <div class="border-2 border-dashed {{ isset($uploadedDocs['council_registration']) ? 'border-green-400 bg-green-50' : 'border-gray-300' }} rounded-lg p-6 hover:border-pink-400 transition">
                            <label class="block">
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <span class="block text-sm font-semibold text-gray-900">Council Registration</span>
                                        <span class="text-xs text-gray-500">Optional document</span>
                                        @if(isset($uploadedDocs['council_registration']))
                                            <span class="text-xs text-green-600 font-medium block mt-1">✓ Uploaded: {{ $uploadedDocs['council_registration']->file_name }}</span>
                                        @endif
                                    </div>
                                    <span class="px-2 py-1 text-xs font-semibold bg-gray-100 text-gray-800 rounded">Optional</span>
                                </div>
                                <p class="text-xs text-gray-500 mb-3">Supported: PDF, JPG, PNG (Max 5MB)</p>
                                <input type="file" name="council_registration" accept=".pdf,.jpg,.jpeg,.png"
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100 @error('council_registration') border-red-500 @enderror">
                                @if(isset($uploadedDocs['council_registration']))
                                    <p class="text-xs text-gray-600 mt-2">Leave empty to keep current file, or upload a new one to replace.</p>
                                @endif
                                @error('council_registration')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>

                        <div class="border-2 border-dashed {{ isset($uploadedDocs['government_id']) ? 'border-green-400 bg-green-50' : 'border-gray-300' }} rounded-lg p-6 hover:border-pink-400 transition">
                            <label class="block">
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <span class="block text-sm font-semibold text-gray-900">Government ID (Aadhaar/PAN)</span>
                                        <span class="text-xs text-gray-500">Required document</span>
                                        @if(isset($uploadedDocs['government_id']))
                                            <span class="text-xs text-green-600 font-medium block mt-1">✓ Uploaded: {{ $uploadedDocs['government_id']->file_name }}</span>
                                        @endif
                                    </div>
                                    <span class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded">Required</span>
                                </div>
                                <p class="text-xs text-gray-500 mb-3">Supported: PDF, JPG, PNG (Max 5MB)</p>
                                <input type="file" name="government_id" {{ !isset($uploadedDocs['government_id']) ? 'required' : '' }} accept=".pdf,.jpg,.jpeg,.png" 
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100 @error('government_id') border-red-500 @enderror">
                                @if(isset($uploadedDocs['government_id']))
                                    <p class="text-xs text-gray-600 mt-2">Leave empty to keep current file, or upload a new one to replace.</p>
                                @endif
                                @error('government_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>

                        <div class="border-2 border-dashed {{ isset($uploadedDocs['iap_membership']) ? 'border-green-400 bg-green-50' : 'border-gray-300' }} rounded-lg p-6 hover:border-pink-400 transition">
                            <label class="block">
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <span class="block text-sm font-semibold text-gray-900">IAP Membership</span>
                                        <span class="text-xs text-gray-500">Optional document</span>
                                        @if(isset($uploadedDocs['iap_membership']))
                                            <span class="text-xs text-green-600 font-medium block mt-1">✓ Uploaded: {{ $uploadedDocs['iap_membership']->file_name }}</span>
                                        @endif
                                    </div>
                                    <span class="px-2 py-1 text-xs font-semibold bg-gray-100 text-gray-800 rounded">Optional</span>
                                </div>
                                <p class="text-xs text-gray-500 mb-3">Supported: PDF, JPG, PNG (Max 5MB)</p>
                                <input type="file" name="iap_membership" accept=".pdf,.jpg,.jpeg,.png" 
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100">
                                @if(isset($uploadedDocs['iap_membership']))
                                    <p class="text-xs text-gray-600 mt-2">Leave empty to keep current file, or upload a new one to replace.</p>
                                @endif
                            </label>
                        </div>

                        <div class="border-2 border-dashed {{ isset($uploadedDocs['clinic_proof']) ? 'border-green-400 bg-green-50' : 'border-gray-300' }} rounded-lg p-6 hover:border-pink-400 transition">
                            <label class="block">
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <span class="block text-sm font-semibold text-gray-900">Clinic Proof</span>
                                        <span class="text-xs text-gray-500">Optional document</span>
                                        @if(isset($uploadedDocs['clinic_proof']))
                                            <span class="text-xs text-green-600 font-medium block mt-1">✓ Uploaded: {{ $uploadedDocs['clinic_proof']->file_name }}</span>
                                        @endif
                                    </div>
                                    <span class="px-2 py-1 text-xs font-semibold bg-gray-100 text-gray-800 rounded">Optional</span>
                                </div>
                                <p class="text-xs text-gray-500 mb-3">Supported: PDF, JPG, PNG (Max 5MB)</p>
                                <input type="file" name="clinic_proof" accept=".pdf,.jpg,.jpeg,.png"
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100">
                                @if(isset($uploadedDocs['clinic_proof']))
                                    <p class="text-xs text-gray-600 mt-2">Leave empty to keep current file, or upload a new one to replace.</p>
                                @endif
                            </label>
                        </div>

                        {{-- Optional certifications --}}
                        @php
                            $certDocs = [
                                'certified_womens_health_physiotherapy' => 'Certified Women\'s Health Physiotherapy',
                                'certified_reproductive_health_therapist' => 'Certified Reproductive Health Therapist',
                                'certified_pelvic_floor_rehab_therapist' => 'Certified Pelvic Floor Rehab Therapist',
                                'certified_pregnancy_postnatal_rehab_therapist' => 'Certified Pregnancy and Postnatal Rehab Therapist',
                                'certified_lactation_counselor' => 'Certified Lactation Counselor',
                            ];
                        @endphp
                        @foreach($certDocs as $docKey => $docLabel)
                        <div class="border-2 border-dashed {{ isset($uploadedDocs[$docKey]) ? 'border-green-400 bg-green-50' : 'border-gray-300' }} rounded-lg p-6 hover:border-pink-400 transition">
                            <label class="block">
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <span class="block text-sm font-semibold text-gray-900">{{ $docLabel }}</span>
                                        <span class="text-xs text-gray-500">Optional certification</span>
                                        @if(isset($uploadedDocs[$docKey]))
                                            <span class="text-xs text-green-600 font-medium block mt-1">✓ Uploaded: {{ $uploadedDocs[$docKey]->file_name }}</span>
                                        @endif
                                    </div>
                                    <span class="px-2 py-1 text-xs font-semibold bg-gray-100 text-gray-800 rounded">Optional</span>
                                </div>
                                <p class="text-xs text-gray-500 mb-3">Supported: PDF, JPG, PNG (Max 5MB)</p>
                                <input type="file" name="{{ $docKey }}" accept=".pdf,.jpg,.jpeg,.png"
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100">
                                @if(isset($uploadedDocs[$docKey]))
                                    <p class="text-xs text-gray-600 mt-2">Leave empty to keep current file, or upload a new one to replace.</p>
                                @endif
                            </label>
                        </div>
                        @endforeach
                    </div>

                    <!-- Confirmation Checkbox -->
                    <div class="bg-gray-50 border-2 border-gray-200 rounded-lg p-4">
                        <label class="flex items-start">
                            <input type="checkbox" name="confirm" required class="mt-1 rounded border-gray-300 text-pink-600 focus:ring-pink-500">
                            <span class="ml-3 text-sm text-gray-700">
                                <strong>I confirm</strong> that all information provided is correct and all documents are authentic. I understand that providing false information may result in account termination.
                            </span>
                        </label>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between items-center pt-4">
                        <a href="{{ route('doctor.registration.step1') }}" class="text-gray-600 hover:text-gray-900 font-medium flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Back
                        </a>
                        <button type="submit" 
                                class="bg-gradient-to-r from-pink-500 to-pink-600 text-white px-8 py-3 rounded-lg hover:from-pink-600 hover:to-pink-700 font-semibold shadow-lg transform hover:scale-[1.02] transition-all">
                            Next: Build Profile →
                        </button>
                    </div>
                </form>
            </div>
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
document.getElementById('registrationForm').addEventListener('submit', function(e) {
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
});
</script>
@endpush
@endsection

