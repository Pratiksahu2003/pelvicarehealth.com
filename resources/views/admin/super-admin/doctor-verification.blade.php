@extends('layouts.admin')

@section('title', 'Doctor Verification')
@section('page-title', 'Physiotherapist Verification')

@section('content')
    <!-- Tabs: Pending, Approved, Rejected -->
    <div class="mb-6">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <a href="{{ route('super-admin.doctor-verification', ['status' => 'pending']) }}"
                    class="{{ request('status') == 'pending' ? 'border-pink-500 text-pink-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Pending
                    @php
                        $pendingCount = \App\Models\User::where('role', 'admin')
                            ->where(function ($q) {
                                $q->whereHas('doctorProfile', function ($profileQuery) {
                                    $profileQuery->where('verification_status', 'pending');
                                })->orDoesntHave('doctorProfile');
                            })
                            ->count();
                    @endphp
                    <span class="ml-2 bg-yellow-100 text-yellow-800 py-0.5 px-2.5 rounded-full text-xs font-medium">{{ $pendingCount }}</span>
                </a>
                <a href="{{ route('super-admin.doctor-verification', ['status' => 'approved']) }}"
                    class="{{ request('status') == 'approved' ? 'border-pink-500 text-pink-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Approved
                    @php
                        $approvedCount = \App\Models\User::where('role', 'admin')
                            ->whereHas('doctorProfile', function ($q) {
                                $q->where('verification_status', 'approved');
                            })
                            ->count();
                    @endphp
                    <span class="ml-2 bg-green-100 text-green-900 py-0.5 px-2.5 rounded-full text-xs font-medium">{{ $approvedCount }}</span>
                </a>
                <a href="{{ route('super-admin.doctor-verification', ['status' => 'rejected']) }}"
                    class="{{ request('status') == 'rejected' ? 'border-pink-500 text-pink-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Rejected
                    @php
                        $rejectedCount = \App\Models\User::where('role', 'admin')
                            ->whereHas('doctorProfile', function ($q) {
                                $q->where('verification_status', 'rejected');
                            })
                            ->count();
                    @endphp
                    <span class="ml-2 bg-red-100 text-red-800 py-0.5 px-2.5 rounded-full text-xs font-medium">{{ $rejectedCount }}</span>
                </a>
            </nav>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-4 bg-green-50 border-l-4 border-green-400 p-4 rounded-lg">
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
        <div class="mb-4 bg-red-50 border-l-4 border-red-400 p-4 rounded-lg">
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

    <div class="mb-4">
        <form method="GET" action="{{ route('super-admin.doctor-verification') }}" id="filterForm">
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div class="flex-1 min-w-[200px] flex items-center gap-2">
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        placeholder="Search physiotherapists..."
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400">
                    <button type="submit" class="px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
                <div class="flex space-x-2">
                    <select name="city"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400"
                        onchange="document.getElementById('filterForm').submit()">
                        <option value="">All Cities</option>
                        @php
                            $statusFilter = request('status');
                            $citiesQuery = \App\Models\User::where('role', 'admin')->whereHas(
                                'doctorProfile',
                                function ($q) use ($statusFilter) {
                                    $q->whereNotNull('city');
                                    if ($statusFilter == 'approved') {
                                        $q->where('verification_status', 'approved');
                                    } elseif ($statusFilter == 'pending') {
                                        $q->where('verification_status', 'pending');
                                    } elseif ($statusFilter == 'rejected') {
                                        $q->where('verification_status', 'rejected');
                                    } else {
                                        $q->whereIn('verification_status', ['pending', 'rejected']);
                                    }
                                },
                            );
                            $cities = $citiesQuery
                                ->with('doctorProfile')
                                ->get()
                                ->pluck('doctorProfile.city')
                                ->filter()
                                ->unique()
                                ->sort()
                                ->values();
                        @endphp
                        @foreach ($cities as $city)
                            <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                                {{ $city }}</option>
                        @endforeach
                    </select>
                    <select name="status"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400"
                        onchange="document.getElementById('filterForm').submit()">
                        @if (request('status') == 'approved')
                            <option value="approved" selected>Approved</option>
                        @else
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected
                            </option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved
                            </option>
                        @endif
                    </select>
                    @if (request()->has('search') || request()->has('city'))
                        <a href="{{ route('super-admin.doctor-verification', request('status') ? ['status' => request('status')] : []) }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 text-sm flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Clear
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <form id="bulkActionForm" method="POST" action="{{ route('super-admin.doctor-verification.bulk-approve') }}">
            @csrf
            <div class="p-4 border-b flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    @if (request('status') != 'approved')
                        <input type="checkbox" id="select-all" class="rounded border-gray-300"
                            onchange="toggleSelectAll(this)">
                        <span class="text-sm text-gray-600">Select All</span>
                    @else
                        <div class="text-sm font-semibold text-gray-700">
                            Approved Doctors List
                        </div>
                    @endif
                </div>
                <div class="flex space-x-2">
                    @if (request('status') != 'approved')
                        <button type="submit" id="approveSelectedBtn"
                            class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 text-sm disabled:bg-gray-400 disabled:cursor-not-allowed"
                            disabled>
                            Approve Selected (<span id="selectedCount">0</span>)
                        </button>
                    @endif
                    <button type="button" onclick="exportToCSV()"
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 text-sm">Export CSV</button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase w-12">
                                @if (request('status') != 'approved')
                                    <input type="checkbox" id="select-all-header" class="rounded border-gray-300"
                                        onchange="toggleSelectAll(this)">
                                @else
                                    <span class="text-gray-500">Select</span>
                                @endif
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Profile + Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category /
                                Subcategory</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Documents Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            @if (request('status') == 'approved')
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Verified At
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Featured</th>
                            @endif
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($doctors as $doctor)
                            @php
                                $profile = $doctor->doctorProfile;
                                $documents = $doctor->doctorDocuments;
                                $uploadedCount = $documents->count();
                                $approvedCount = $documents->where('status', 'approved')->count();
                            @endphp
                            <tr class="doctor-row" data-name="{{ strtolower($doctor->name) }}"
                                data-email="{{ strtolower($doctor->email) }}" onclick="event.stopPropagation();">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if (request('status') != 'approved')
                                        <input type="checkbox" name="doctor_ids[]" value="{{ $doctor->id }}"
                                            class="doctor-checkbox rounded border-gray-300"
                                            onchange="updateSelectedCount()">
                                    @else
                                        <input type="checkbox" name="approved_doctor_ids[]" value="{{ $doctor->id }}"
                                            class="doctor-checkbox-approved rounded border-gray-300"
                                            aria-label="Select doctor">
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if ($profile && $profile->profile_image)
                                            <img src="{{ media_url($profile->profile_image) }}"
                                                alt="{{ $doctor->name }}"
                                                class="w-10 h-10 rounded-full object-cover mr-3">
                                        @else
                                            <div
                                                class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center mr-3">
                                                <span
                                                    class="text-pink-600 font-semibold text-sm">{{ strtoupper(substr($doctor->name, 0, 1)) }}</span>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $doctor->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $doctor->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 category-subcategory-cell max-w-[220px]">
                                    @php
                                        $catDisplay = $profile ? $profile->category_subcategory_display : 'N/A';
                                        $catShort = Str::limit($catDisplay, 60);
                                    @endphp
                                    <span class="block truncate" title="{{ $catDisplay }}">{{ $catShort }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full 
                            {{ $uploadedCount >= 4 && $approvedCount == $uploadedCount ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $approvedCount }}/{{ $uploadedCount }} verified
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full 
                            {{ $profile && $profile->verification_status == 'approved' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $profile && $profile->verification_status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $profile && $profile->verification_status == 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ $profile ? ucfirst($profile->verification_status) : 'Pending' }}
                                    </span>
                                </td>
                                @if (request('status') == 'approved')
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        @if ($profile && $profile->verified_at)
                                            <div class="flex flex-col">
                                                <span>{{ $profile->verified_at->format('M d, Y') }}</span>
                                                <span
                                                    class="text-xs text-gray-500">{{ $profile->verified_at->format('h:i A') }}</span>
                                            </div>
                                        @else
                                            <span class="text-gray-400">N/A</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if ($profile)
                                            <div class="featured-toggle-container" data-doctor-id="{{ $doctor->id }}"
                                                data-action="{{ route('super-admin.doctor-verification.toggle-featured', $doctor->id) }}">
                                                <label class="relative inline-flex items-center cursor-pointer group">
                                                    <input type="checkbox" class="sr-only peer featured-toggle-checkbox"
                                                        {{ $profile->is_featured ? 'checked' : '' }}
                                                        data-doctor-id="{{ $doctor->id }}"
                                                        onchange="toggleFeaturedStatus(this, {{ $doctor->id }});">
                                                    <div
                                                        class="relative w-14 h-7 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-pink-200 rounded-full peer peer-checked:bg-gradient-to-r peer-checked:from-yellow-400 peer-checked:to-yellow-500 transition-all duration-300 ease-in-out shadow-inner">
                                                        <div
                                                            class="absolute top-0.5 left-0.5 bg-white border-2 border-gray-200 rounded-full h-6 w-6 transition-all duration-300 ease-in-out peer-checked:translate-x-7 peer-checked:border-yellow-600 shadow-md flex items-center justify-center">
                                                            @if ($profile->is_featured)
                                                                <svg class="w-3.5 h-3.5 text-yellow-600 opacity-0 peer-checked:opacity-100 transition-opacity duration-300"
                                                                    fill="currentColor" viewBox="0 0 20 20">
                                                                    <path
                                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                    </path>
                                                                </svg>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <span class="ml-3 text-sm font-semibold">
                                                        <span
                                                            class="featured-status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-bold transition-all duration-300 {{ $profile->is_featured ? 'bg-gradient-to-r from-yellow-100 to-yellow-50 text-yellow-800 border border-yellow-300' : 'bg-gray-100 text-gray-600 border border-gray-300' }}">
                                                            @if ($profile->is_featured)
                                                                <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor"
                                                                    viewBox="0 0 20 20">
                                                                    <path
                                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                    </path>
                                                                </svg>
                                                            @endif
                                                            <span
                                                                class="featured-status-text">{{ $profile->is_featured ? 'Premium' : 'Normal' }}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}"
                                                    class="csrf-token">
                                            </div>
                                        @else
                                            <span class="text-gray-400">N/A</span>
                                        @endif
                                    </td>
                                @endif
                                <td class="px-6 py-4 whitespace-nowrap text-sm space-x-3">
                                    <a href="{{ route('super-admin.doctor-verification.show', $doctor->id) }}"
                                        class="text-pink-600 hover:text-pink-900 font-medium">View Details</a>
                                    @if ($doctor->id !== auth()->id())
                                        <form
                                            action="{{ route('super-admin.doctor-verification.soft-delete', $doctor->id) }}"
                                            method="POST" class="inline"
                                            onsubmit="return confirm('Are you sure you want to delete this doctor?');">
                                            @csrf
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-800 font-medium">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                @php $colspan = request('status') == 'approved' ? 8 : 7; @endphp
                                <td colspan="{{ $colspan }}" class="px-6 py-4 text-center text-sm text-gray-500">
                                    @if (request('status') == 'approved')
                                        No approved doctors found
                                    @else
                                        No doctors pending verification
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>
        <div class="px-6 py-4 border-t">
            {{ $doctors->links() }}
        </div>
    </div>

    @push('scripts')
        <script>
            // Search functionality - submit form on Enter
            document.getElementById('search').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    document.getElementById('filterForm').submit();
                }
            });

            // Optional: Real-time search filtering (client-side)
            let searchTimeout;
            document.getElementById('search').addEventListener('input', function(e) {
                clearTimeout(searchTimeout);
                const searchTerm = e.target.value.toLowerCase();

                // Only do client-side filtering if form hasn't been submitted
                if (!searchTerm) {
                    const rows = document.querySelectorAll('.doctor-row');
                    rows.forEach(row => {
                        row.style.display = '';
                    });
                    return;
                }

                searchTimeout = setTimeout(() => {
                    const rows = document.querySelectorAll('.doctor-row');
                    rows.forEach(row => {
                        const name = row.getAttribute('data-name');
                        const email = row.getAttribute('data-email');

                        if (name.includes(searchTerm) || email.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                    updateSelectedCount(); // Update count after filtering
                }, 300); // Debounce for 300ms
            });

            // Select All functionality
            function toggleSelectAll(checkbox) {
                const checkboxes = document.querySelectorAll('.doctor-checkbox');
                const visibleRows = document.querySelectorAll('.doctor-row:not([style*="display: none"])');
                const visibleCheckboxes = Array.from(visibleRows).map(row => row.querySelector('.doctor-checkbox')).filter(cb =>
                    cb);

                visibleCheckboxes.forEach(cb => {
                    if (cb) {
                        cb.checked = checkbox.checked;
                    }
                });

                // Sync header checkbox
                const headerCheckbox = document.getElementById('select-all-header');
                if (headerCheckbox && checkbox.id !== 'select-all-header') {
                    headerCheckbox.checked = checkbox.checked;
                }
                const selectAllCheckbox = document.getElementById('select-all');
                if (selectAllCheckbox && checkbox.id !== 'select-all') {
                    selectAllCheckbox.checked = checkbox.checked;
                }

                updateSelectedCount();
            }

            // Update selected count
            function updateSelectedCount() {
                const checked = document.querySelectorAll('.doctor-checkbox:checked');
                const count = checked.length;
                document.getElementById('selectedCount').textContent = count;
                const approveBtn = document.getElementById('approveSelectedBtn');
                if (approveBtn) {
                    approveBtn.disabled = count === 0;
                }

                // Update select-all checkbox state
                const allCheckboxes = document.querySelectorAll('.doctor-checkbox');
                const visibleCheckboxes = Array.from(document.querySelectorAll('.doctor-row:not([style*="display: none"])'))
                    .map(row => row.querySelector('.doctor-checkbox'))
                    .filter(cb => cb);
                const allVisibleChecked = visibleCheckboxes.length > 0 && visibleCheckboxes.every(cb => cb.checked);
                const selectAllCheckbox = document.getElementById('select-all');
                if (selectAllCheckbox) {
                    selectAllCheckbox.checked = allVisibleChecked && visibleCheckboxes.length > 0;
                    selectAllCheckbox.indeterminate = !allVisibleChecked && checked.length > 0;
                }
            }

            // Initialize count on page load
            document.addEventListener('DOMContentLoaded', function() {
                // Only initialize if we're not on approved doctors page
                if (document.querySelector('.doctor-checkbox')) {
                    updateSelectedCount();
                }
            });

            // Bulk approve form submission (only applies on Pending/Rejected tab where Approve Selected button exists)
            document.getElementById('bulkActionForm').addEventListener('submit', function(e) {
                // Don't submit if the event came from a featured toggle
                if (e.target.closest('.featured-toggle-container')) {
                    e.preventDefault();
                    e.stopPropagation();
                    return false;
                }
                // On Approved tab there is no Approve Selected button - prevent submit and do not show alert
                const approveBtn = document.getElementById('approveSelectedBtn');
                if (!approveBtn) {
                    e.preventDefault();
                    return false;
                }
                const checked = document.querySelectorAll('.doctor-checkbox:checked');
                if (checked.length === 0) {
                    e.preventDefault();
                    alert('Please select at least one doctor to approve.');
                    return false;
                }
                if (!confirm(`Are you sure you want to approve ${checked.length} doctor(s)?`)) {
                    e.preventDefault();
                    return false;
                }
            });

            // Toggle Featured Status
            function toggleFeaturedStatus(checkbox, doctorId) {
                try {
                    // Prevent any default behavior
                    if (typeof event !== 'undefined' && event) {
                        event.preventDefault();
                        event.stopPropagation();
                    }

                    // Find the container div (not a form)
                    const container = checkbox.closest('.featured-toggle-container');
                    if (!container) {
                        checkbox.checked = !checkbox.checked; // Revert
                        alert('Error: Could not find toggle container. Please refresh the page.');
                        return false;
                    }

                    const statusText = container.querySelector('.featured-status-text');
                    if (!statusText) {
                        checkbox.checked = !checkbox.checked; // Revert
                        return false;
                    }

                    const originalChecked = checkbox.checked;

                    // Disable checkbox during request
                    checkbox.disabled = true;

                    // Get CSRF token
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                        container.querySelector('.csrf-token')?.value;

                    if (!csrfToken) {
                        alert('CSRF token not found. Please refresh the page.');
                        checkbox.checked = !originalChecked;
                        checkbox.disabled = false;
                        return false;
                    }

                    // Get action URL from container data attribute
                    const actionUrl = container.getAttribute('data-action');
                    if (!actionUrl) {
                        checkbox.checked = !originalChecked;
                        checkbox.disabled = false;
                        alert('Action URL not found. Please refresh the page.');
                        return false;
                    }

                    // Submit via AJAX (not using FormData since we don't have a form)
                    const formData = new URLSearchParams();
                    formData.append('_token', csrfToken);

                    // Submit via AJAX
                    fetch(actionUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: formData
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(err => {
                                    throw new Error(err.message || err.error || 'Server error');
                                }).catch(() => {
                                    throw new Error(`Server error: ${response.status} ${response.statusText}`);
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Update UI based on response
                            if (data && data.success) {
                                if (statusText) {
                                    statusText.textContent = data.status_text || (checkbox.checked ? 'Premium' : 'Normal');

                                    // Update badge styling
                                    const badge = statusText.closest('.featured-status-badge');
                                    if (badge) {
                                        if (checkbox.checked) {
                                            badge.className =
                                                'featured-status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-bold transition-all duration-300 bg-gradient-to-r from-yellow-100 to-yellow-50 text-yellow-800 border border-yellow-300';
                                            // Add star icon if not present
                                            if (!badge.querySelector('svg')) {
                                                const starIcon = document.createElementNS('http://www.w3.org/2000/svg',
                                                    'svg');
                                                starIcon.setAttribute('class', 'w-3.5 h-3.5 mr-1.5');
                                                starIcon.setAttribute('fill', 'currentColor');
                                                starIcon.setAttribute('viewBox', '0 0 20 20');
                                                starIcon.innerHTML =
                                                    '<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>';
                                                badge.insertBefore(starIcon, statusText);
                                            }
                                        } else {
                                            badge.className =
                                                'featured-status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-bold transition-all duration-300 bg-gray-100 text-gray-600 border border-gray-300';
                                            // Remove star icon
                                            const starIcon = badge.querySelector('svg');
                                            if (starIcon) {
                                                starIcon.remove();
                                            }
                                        }
                                    }
                                }
                                checkbox.disabled = false;
                            } else {
                                throw new Error(data?.message || 'Update failed');
                            }
                        })
                        .catch(error => {
                            // Revert UI on error
                            checkbox.checked = !originalChecked;
                            if (statusText) {
                                statusText.textContent = originalChecked ? 'Premium' : 'Normal';

                                // Revert badge styling
                                const badge = statusText.closest('.featured-status-badge');
                                if (badge) {
                                    if (originalChecked) {
                                        badge.className =
                                            'featured-status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-bold transition-all duration-300 bg-gradient-to-r from-yellow-100 to-yellow-50 text-yellow-800 border border-yellow-300';
                                        // Ensure star icon is present
                                        if (!badge.querySelector('svg')) {
                                            const starIcon = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
                                            starIcon.setAttribute('class', 'w-3.5 h-3.5 mr-1.5');
                                            starIcon.setAttribute('fill', 'currentColor');
                                            starIcon.setAttribute('viewBox', '0 0 20 20');
                                            starIcon.innerHTML =
                                                '<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>';
                                            badge.insertBefore(starIcon, statusText);
                                        }
                                    } else {
                                        badge.className =
                                            'featured-status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-bold transition-all duration-300 bg-gray-100 text-gray-600 border border-gray-300';
                                        // Remove star icon
                                        const starIcon = badge.querySelector('svg');
                                        if (starIcon) {
                                            starIcon.remove();
                                        }
                                    }
                                }
                            }
                            checkbox.disabled = false;

                            const errorMsg = error.message || error.error ||
                                'Failed to update featured status. Please try again.';
                            alert(errorMsg);
                        });

                    return false;
                } catch (error) {
                    checkbox.checked = !checkbox.checked;
                    checkbox.disabled = false;
                    alert('An unexpected error occurred. Please try again.');
                    return false;
                }
            }

            // Export to CSV
            function exportToCSV() {
                const rows = document.querySelectorAll('.doctor-row:not([style*="display: none"])');
                const isApproved = @json(request('status') == 'approved');

                let csv = isApproved ?
                    'Name,Email,Category/Subcategory,Documents Status,Verification Status,Verified At,Featured Status\n' :
                    'Name,Email,Category/Subcategory,Documents Status,Verification Status\n';

                rows.forEach(row => {
                    const cells = row.querySelectorAll('td');
                    let cellIndex = 0;

                    // Skip checkbox column if exists
                    if (row.querySelector('.doctor-checkbox')) {
                        cellIndex = 1;
                    }

                    const nameCell = cells[cellIndex];
                    const name = nameCell.querySelector('.text-sm.font-medium')?.textContent.trim() || '';
                    const email = nameCell.querySelector('.text-sm.text-gray-500')?.textContent.trim() || '';
                    const categorySubcategory = cells[cellIndex + 1]?.textContent.trim() || '';
                    const docStatus = cells[cellIndex + 2]?.textContent.trim() || '';
                    const verStatus = cells[cellIndex + 3]?.textContent.trim() || '';

                    if (isApproved) {
                        const verifiedAt = cells[cellIndex + 4]?.textContent.trim() || '';
                        const featuredStatusCell = cells[cellIndex + 5];
                        const featuredStatus = featuredStatusCell?.querySelector('.featured-status-text')?.textContent
                            .trim() || 'Normal';
                        csv +=
                            `"${name}","${email}","${categorySubcategory}","${docStatus}","${verStatus}","${verifiedAt}","${featuredStatus}"\n`;
                    } else {
                        csv += `"${name}","${email}","${categorySubcategory}","${docStatus}","${verStatus}"\n`;
                    }
                });

                // Create download link
                const blob = new Blob([csv], {
                    type: 'text/csv'
                });
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                const filename = isApproved ?
                    'approved-doctors-' + new Date().toISOString().split('T')[0] + '.csv' :
                    'doctors-verification-' + new Date().toISOString().split('T')[0] + '.csv';
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            }
        </script>
    @endpush
@endsection
