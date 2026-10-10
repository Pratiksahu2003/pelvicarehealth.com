@extends('layouts.admin')

@section('title', 'Appointments')
@section('page-title', 'Manage Appointments')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Patient</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Time</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reason</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($appointments as $appointment)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $appointment->patient->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $appointment->appointment_date->format('M d, Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $appointment->appointment_time }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $appointment->reason ? \Illuminate\Support\Str::limit($appointment->reason, 50) : 'N/A' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <form action="{{ route('doctor.appointments.update-status', $appointment->id) }}" method="POST" class="inline">
                            @csrf
                            <select name="status" onchange="this.form.submit()" class="text-sm border-gray-300 rounded-md">
                                <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <button onclick="document.getElementById('notes-{{ $appointment->id }}').classList.toggle('hidden')" class="text-pink-600 hover:text-pink-900">Add Notes</button>
                    </td>
                </tr>
                <tr id="notes-{{ $appointment->id }}" class="hidden">
                    <td colspan="6" class="px-6 py-4">
                        <form action="{{ route('doctor.appointments.update-status', $appointment->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="{{ $appointment->status }}">
                            <textarea name="doctor_notes" rows="3" class="w-full border-gray-300 rounded-md" placeholder="Doctor notes...">{{ $appointment->doctor_notes }}</textarea>
                            <button type="submit" class="mt-2 bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700">Save Notes</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No appointments found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t">
        {{ $appointments->links() }}
    </div>
</div>
@endsection

