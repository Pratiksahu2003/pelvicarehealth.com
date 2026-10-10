@extends('layouts.admin')

@section('title', 'Book Appointment')
@section('page-title', 'Book Appointment')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
    <form action="{{ route('patient.appointments.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700">Select Doctor</label>
            <select name="doctor_id" required class="mt-1 block w-full border-gray-300 rounded-md">
                <option value="">Choose a doctor...</option>
                @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Session Type *</label>
            <select name="session_type" required class="mt-1 block w-full border-gray-300 rounded-md" onchange="toggleAddressField()">
                <option value="clinic_visit">Clinic Visit</option>
                <option value="home_visit">Home Visit</option>
                <option value="video_session">Video Session</option>
            </select>
        </div>
        <div id="address-field" class="hidden">
            <label class="block text-sm font-medium text-gray-700">Address for Home Visit *</label>
            <textarea name="patient_address" rows="3" class="mt-1 block w-full border-gray-300 rounded-md" placeholder="Enter your complete address"></textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Appointment Date</label>
            <input type="date" name="appointment_date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="mt-1 block w-full border-gray-300 rounded-md">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Appointment Time</label>
            <input type="time" name="appointment_time" required class="mt-1 block w-full border-gray-300 rounded-md">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Reason (Optional)</label>
            <textarea name="reason" rows="4" class="mt-1 block w-full border-gray-300 rounded-md" placeholder="Brief reason for appointment..."></textarea>
        </div>
        <div class="flex space-x-4">
            <button type="submit" class="bg-pink-600 text-white px-6 py-2 rounded-md hover:bg-pink-700">Book Appointment</button>
            <a href="{{ route('patient.appointments') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-300">Cancel</a>
        </div>
    </form>
</div>
<script>
function toggleAddressField() {
    const sessionType = document.querySelector('select[name="session_type"]').value;
    const addressField = document.getElementById('address-field');
    if (sessionType === 'home_visit') {
        addressField.classList.remove('hidden');
        addressField.querySelector('textarea').required = true;
    } else {
        addressField.classList.add('hidden');
        addressField.querySelector('textarea').required = false;
    }
}
</script>
@endsection

