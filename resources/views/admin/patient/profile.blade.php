@extends('layouts.admin')

@section('title', 'My Profile')
@section('page-title', 'My Profile')

@section('content')
<div class="space-y-6">
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
    <!-- Medical Information -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Medical Information</h3>
        <form action="{{ route('patient.profile.update') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Medical History</label>
                <textarea name="medical_history" rows="4" class="w-full border-gray-300 rounded-md">{{ old('medical_history', $profile->medical_history ?? '') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Allergies</label>
                <textarea name="allergies" rows="2" class="w-full border-gray-300 rounded-md">{{ old('allergies', $profile->allergies ?? '') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Medications</label>
                <textarea name="current_medications" rows="3" class="w-full border-gray-300 rounded-md">{{ old('current_medications', $profile->current_medications ?? '') }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Emergency Contact Name</label>
                    <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name', $profile->emergency_contact_name ?? '') }}" class="w-full border-gray-300 rounded-md">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Emergency Contact Phone</label>
                    <input type="tel" name="emergency_contact_phone" value="{{ old('emergency_contact_phone', $profile->emergency_contact_phone ?? '') }}" class="w-full border-gray-300 rounded-md">
                </div>
            </div>
            <button type="submit" class="bg-pink-600 text-white px-6 py-2 rounded-md hover:bg-pink-700">Save Medical Info</button>
        </form>
    </div>

    <!-- Address Information -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Address Information</h3>
        <form action="{{ route('patient.profile.update') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                <textarea name="address" rows="3" class="w-full border-gray-300 rounded-md">{{ old('address', $profile->address ?? '') }}</textarea>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                    <input type="text" name="city" value="{{ old('city', $profile->city ?? '') }}" class="w-full border-gray-300 rounded-md">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">State</label>
                    <input type="text" name="state" value="{{ old('state', $profile->state ?? '') }}" class="w-full border-gray-300 rounded-md">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pincode</label>
                    <input type="text" name="pincode" value="{{ old('pincode', $profile->pincode ?? '') }}" class="w-full border-gray-300 rounded-md">
                </div>
            </div>
            <button type="submit" class="bg-pink-600 text-white px-6 py-2 rounded-md hover:bg-pink-700">Save Address</button>
        </form>
    </div>

    <!-- Change Password Section -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Change Password</h3>
        <form action="{{ route('patient.password.update') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Password <span class="text-red-500">*</span></label>
                <div class="relative">
                    <input type="password" name="current_password" id="current_password" required 
                           class="w-full px-4 py-2 pr-12 border-gray-300 rounded-md @error('current_password') border-red-500 @enderror" 
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
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">New Password <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="password" name="password" id="new_password" required 
                               class="w-full px-4 py-2 pr-12 border-gray-300 rounded-md @error('password') border-red-500 @enderror" 
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
                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" required 
                               class="w-full px-4 py-2 pr-12 border-gray-300 rounded-md" 
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
            <button type="submit" class="bg-pink-600 text-white px-6 py-2 rounded-md hover:bg-pink-700">Update Password</button>
        </form>
    </div>

    <!-- Documents -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold">My Documents</h3>
            <button onclick="document.getElementById('uploadModal').classList.remove('hidden')" class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700 text-sm">
                Upload Document
            </button>
        </div>
        <div class="space-y-4">
            @forelse(auth()->user()->patientDocuments as $document)
            <div class="border rounded-lg p-4 flex items-center justify-between">
                <div>
                    <h4 class="font-semibold">{{ $document->title }}</h4>
                    <p class="text-sm text-gray-600">{{ ucfirst($document->document_type) }}</p>
                    @if($document->document_date)
                    <p class="text-xs text-gray-500">{{ $document->document_date->format('M d, Y') }}</p>
                    @endif
                </div>
                <div class="flex space-x-2">
                    <a href="{{ asset('' . $document->file_path) }}" target="_blank" class="text-blue-600 hover:text-blue-900 text-sm">View</a>
                    <form action="{{ route('patient.documents.delete', $document->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                    </form>
                </div>
            </div>
            @empty
            <p class="text-gray-500 text-center py-8">No documents uploaded yet</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Upload Modal -->
<div id="uploadModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full">
        <h3 class="text-lg font-semibold mb-4">Upload Document</h3>
        <form action="{{ route('patient.documents.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Document Type *</label>
                    <select name="document_type" required class="w-full border-gray-300 rounded-md">
                        <option value="mri">MRI</option>
                        <option value="xray">X-Ray</option>
                        <option value="prescription">Prescription</option>
                        <option value="lab_report">Lab Report</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                    <input type="text" name="title" required class="w-full border-gray-300 rounded-md">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">File *</label>
                    <input type="file" name="file" required accept=".pdf,.jpg,.jpeg,.png" class="w-full border-gray-300 rounded-md">
                    <p class="text-xs text-gray-500 mt-1">Supported: PDF, JPG, PNG (Max 5MB)</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="3" class="w-full border-gray-300 rounded-md"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Document Date</label>
                    <input type="date" name="document_date" class="w-full border-gray-300 rounded-md">
                </div>
            </div>
            <div class="flex justify-end space-x-2 mt-6">
                <button type="button" onclick="document.getElementById('uploadModal').classList.add('hidden')" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md">Cancel</button>
                <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700">Upload</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
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

