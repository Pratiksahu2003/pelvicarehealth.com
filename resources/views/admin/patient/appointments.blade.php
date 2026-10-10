@extends('layouts.admin')

@section('title', 'My Appointments')
@section('page-title', 'My Appointments')

@section('content')
<div class="mb-4">
    <a href="{{ route('patient.appointments.book') }}" class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700 inline-block">Book New Appointment</a>
</div>
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Doctor</th>
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
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $appointment->doctor->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $appointment->appointment_date->format('M d, Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $appointment->appointment_time }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $appointment->reason ? \Illuminate\Support\Str::limit($appointment->reason, 50) : 'N/A' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                            {{ $appointment->status == 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $appointment->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $appointment->status == 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $appointment->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="{{ route('patient.appointments.rebook', $appointment->id) }}" class="text-pink-600 hover:text-pink-900">Rebook</a>
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

