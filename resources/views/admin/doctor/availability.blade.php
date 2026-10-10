@extends('layouts.admin')

@section('title', 'Availability')
@section('page-title', 'Manage Availability')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Set Your Availability</h3>
        <form action="{{ route('doctor.availability.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Day of Week</label>
                    <select name="day_of_week" required class="mt-1 block w-full border-gray-300 rounded-md">
                        <option value="monday">Monday</option>
                        <option value="tuesday">Tuesday</option>
                        <option value="wednesday">Wednesday</option>
                        <option value="thursday">Thursday</option>
                        <option value="friday">Friday</option>
                        <option value="saturday">Saturday</option>
                        <option value="sunday">Sunday</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Start Time</label>
                    <input type="time" name="start_time" required class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">End Time</label>
                    <input type="time" name="end_time" required class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
            </div>
            <div>
                <label class="flex items-center">
                    <input type="checkbox" name="is_available" value="1" checked class="rounded border-gray-300">
                    <span class="ml-2 text-sm text-gray-700">Available</span>
                </label>
            </div>
            <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700">Save Availability</button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold text-gray-900">Current Availability</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Day</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Start Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">End Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($availabilities as $availability)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 capitalize">{{ $availability->day_of_week }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ date('h:i A', strtotime($availability->start_time)) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ date('h:i A', strtotime($availability->end_time)) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $availability->is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $availability->is_available ? 'Available' : 'Unavailable' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <form action="{{ route('doctor.availability.delete', $availability->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No availability set</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

