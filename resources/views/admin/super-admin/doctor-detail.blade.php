@extends('layouts.admin')

@section('title', 'Doctor Details')
@section('page-title', 'Doctor Verification Details')

@section('content')
    @if (session('success'))
        <div class="mb-4 bg-green-50 border-l-4 border-green-400 p-4 rounded-lg text-sm text-green-700">
            {{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-4 bg-red-50 border-l-4 border-red-400 p-4 rounded-lg text-sm text-red-700">{{ session('error') }}
        </div>
    @endif

    @if ($doctor->trashed())
        <div class="mb-6 bg-amber-50 border border-amber-200 rounded-lg p-4 flex items-center justify-between">
            <p class="text-amber-800 font-medium">This doctor has been deleted.</p>
        </div>
    @endif

    <div class="space-y-6">
        <!-- Profile Photo -->
        @if ($doctor->doctorProfile)
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Profile Photo</h3>
            <div class="flex flex-col sm:flex-row items-center gap-6">
                <!-- Current Photo -->
                <div class="shrink-0">
                    @if ($doctor->doctorProfile->profile_image)
                        <img src="{{ media_url($doctor->doctorProfile->profile_image) }}" alt="{{ $doctor->name }}" class="w-32 h-32 object-cover rounded-full border-2 border-pink-100 shadow-sm">
                    @else
                        <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold text-2xl border-2 border-gray-300">
                            {{ strtoupper(substr($doctor->name, 0, 1)) }}
                        </div>
                    @endif
                </div>

                <!-- Upload/Remove Actions -->
                <div class="flex-1 w-full space-y-4">
                    <form action="{{ route('super-admin.doctor-verification.photo.update', $doctor->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                        @csrf
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Update Photo</label>
                            <input type="file" name="profile_image" accept="image/jpeg,image/png,image/jpg,image/webp,image/gif" required class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100 border border-gray-200 rounded-lg p-1">
                        </div>
                        <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded-lg hover:bg-pink-700 text-sm font-semibold transition mt-2 sm:mt-6 shrink-0">
                            Upload New Photo
                        </button>
                    </form>

                    @if ($doctor->doctorProfile->profile_image)
                        <form action="{{ route('super-admin.doctor-verification.photo.remove', $doctor->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this profile photo?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-semibold underline">
                                Remove Current Photo
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <!-- Doctor Info -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold">{{ $doctor->name }}</h3>
                <span
                    class="px-3 py-1 text-sm font-semibold rounded-full 
                {{ $doctor->doctorProfile && $doctor->doctorProfile->verification_status == 'approved' ? 'bg-green-100 text-green-800' : '' }}
                {{ $doctor->doctorProfile && $doctor->doctorProfile->verification_status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                {{ $doctor->doctorProfile && $doctor->doctorProfile->verification_status == 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                    {{ $doctor->doctorProfile ? ucfirst($doctor->doctorProfile->verification_status) : 'Pending' }}
                </span>
            </div>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div><strong>Email:</strong> {{ $doctor->email }}</div>
                <div><strong>Phone:</strong> {{ $doctor->phone ?? 'N/A' }}</div>
                @if ($doctor->doctorProfile)
                    <div><strong>Experience:</strong> {{ $doctor->doctorProfile->years_of_experience }} years</div>
                    <div><strong>Category / Subcategory:</strong>
                        {{ $doctor->doctorProfile?->category_subcategory_display ?? 'N/A' }}</div>
                    <div><strong>Languages:</strong> {{ implode(', ', $doctor->doctorProfile->languages ?? []) }}</div>
                    <div><strong>Clinic:</strong> {{ $doctor->doctorProfile->clinic_name ?? 'N/A' }}</div>
                @endif
            </div>
        </div>

        <!-- Documents -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Documents</h3>
            <div class="space-y-4">
                @foreach ($doctor->doctorDocuments as $document)
                    <div class="border rounded-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <div>
                                <strong
                                    class="text-sm">{{ ucfirst(str_replace('_', ' ', $document->document_type)) }}</strong>
                                <span
                                    class="ml-2 px-2 py-1 text-xs font-semibold rounded-full 
                            {{ $document->status == 'approved' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $document->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $document->status == 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst($document->status) }}
                                </span>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ asset('' . $document->file_path) }}" target="_blank"
                                    class="text-blue-600 hover:text-blue-900 text-sm">View</a>
                                @if ($document->status != 'approved')
                                    <form
                                        action="{{ route('super-admin.doctor-verification.document.approve', $document->id) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        <button type="submit"
                                            class="text-green-600 hover:text-green-900 text-sm">Approve</button>
                                    </form>
                                @endif
                                @if ($document->status != 'rejected')
                                    <button onclick="showRejectModal({{ $document->id }})"
                                        class="text-red-600 hover:text-red-900 text-sm">Reject</button>
                                @endif
                            </div>
                        </div>
                        @if ($document->rejection_reason)
                            <p class="text-sm text-red-600 mt-2">Reason: {{ $document->rejection_reason }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Actions -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Actions</h3>
            <div class="flex flex-wrap gap-3">
                @if (!$doctor->trashed())
                    @if (!$doctor->doctorProfile || $doctor->doctorProfile->verification_status != 'approved')
                        <form action="{{ route('super-admin.doctor-verification.approve', $doctor->id) }}" method="POST"
                            class="inline">
                            @csrf
                            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
                                Approve Doctor
                            </button>
                        </form>
                    @endif
                    @if (!$doctor->doctorProfile || $doctor->doctorProfile->verification_status != 'rejected')
                        <button onclick="showRejectDoctorModal()"
                            class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700">
                            Reject Doctor
                        </button>
                    @endif
                    @if ($doctor->id !== auth()->id())
                        <form action="{{ route('super-admin.doctor-verification.soft-delete', $doctor->id) }}"
                            method="POST" class="inline"
                            onsubmit="return confirm('Are you sure you want to delete this doctor?');">
                            @csrf
                            <button type="submit" class="bg-amber-600 text-white px-6 py-2 rounded-lg hover:bg-amber-700">
                                Delete Doctor
                            </button>
                        </form>
                    @endif
                @endif
                <a href="{{ route('super-admin.doctor-verification') }}"
                    class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300">
                    Back to List
                </a>
            </div>
        </div>
    </div>

    <!-- Reject Document Modal -->
    <div id="rejectDocumentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <h3 class="text-lg font-semibold mb-4">Reject Document</h3>
            <form id="rejectDocumentForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Reason for Rejection *</label>
                    <textarea name="rejection_reason" rows="4" required class="w-full px-3 py-2 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"></textarea>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeRejectModal()"
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">Cancel</button>
                    <button type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Reject</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Reject Doctor Modal -->
    <div id="rejectDoctorModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <h3 class="text-lg font-semibold mb-4">Reject Doctor</h3>
            <form action="{{ route('super-admin.doctor-verification.reject', $doctor->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Reason for Rejection *</label>
                    <textarea name="rejection_reason" rows="4" required class="w-full px-3 py-2 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"></textarea>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeRejectDoctorModal()"
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">Cancel</button>
                    <button type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Reject</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showRejectModal(documentId) {
            document.getElementById('rejectDocumentForm').action =
                `/admin/super-admin/doctor-verification/document/${documentId}/reject`;
            document.getElementById('rejectDocumentModal').classList.remove('hidden');
        }

        function closeRejectModal() {
            document.getElementById('rejectDocumentModal').classList.add('hidden');
        }

        function showRejectDoctorModal() {
            document.getElementById('rejectDoctorModal').classList.remove('hidden');
        }

        function closeRejectDoctorModal() {
            document.getElementById('rejectDoctorModal').classList.add('hidden');
        }
    </script>
@endsection
