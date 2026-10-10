@extends('layouts.admin')

@section('title', 'Rebook Appointment')
@section('page-title', 'Rebook Appointment')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
        <h3 class="font-semibold mb-2">Previous Appointment</h3>
        <p><strong>Doctor:</strong> {{ $oldAppointment->doctor->name ?? 'N/A' }}</p>
        <p><strong>Date:</strong> {{ $oldAppointment->appointment_date->format('M d, Y') }}</p>
        <p><strong>Time:</strong> {{ $oldAppointment->appointment_time }}</p>
    </div>
    <form action="{{ route('patient.appointments.rebook.store', $oldAppointment->id) }}" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="old_reason" value="{{ $oldAppointment->reason }}">
        <div>
            <label class="block text-sm font-medium text-gray-700">Select Doctor</label>
            <select name="doctor_id" required class="mt-1 block w-full border-gray-300 rounded-md">
                <option value="">Choose a doctor...</option>
                @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}" {{ $oldAppointment->doctor_id == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">New Appointment Date</label>
            <input type="date" name="appointment_date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="mt-1 block w-full border-gray-300 rounded-md">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">New Appointment Time</label>
            <input type="time" name="appointment_time" required class="mt-1 block w-full border-gray-300 rounded-md">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Reason (Optional)</label>
            <textarea name="reason" rows="4" class="mt-1 block w-full border-gray-300 rounded-md" placeholder="Brief reason for appointment...">{{ $oldAppointment->reason }}</textarea>
        </div>
        <div class="flex space-x-4">
            <button type="submit" class="bg-pink-600 text-white px-6 py-2 rounded-md hover:bg-pink-700">Rebook Appointment</button>
            <a href="{{ route('patient.appointments') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-300">Cancel</a>
        </div>
    </form>
</div>
@endsection

