@extends('layouts.admin')

@section('title', 'Restore Deleted')
@section('page-title', 'Restore Deleted (Developer)')

@section('content')
<div class="mb-6 p-4 bg-amber-50 border border-amber-200 rounded-lg">
    <p class="text-sm text-amber-800">This page is for restoring soft-deleted users and doctors. It is not linked from the admin panel.</p>
</div>

@if(session('success'))
    <div class="mb-4 bg-green-50 border-l-4 border-green-400 p-4 rounded-lg text-sm text-green-700">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="mb-4 bg-red-50 border-l-4 border-red-400 p-4 rounded-lg text-sm text-red-700">{{ session('error') }}</div>
@endif

{{-- Deleted Users --}}
<div class="bg-white rounded-lg shadow overflow-hidden mb-8">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Deleted Users</h3>
        <p class="text-sm text-gray-500 mt-1">Restore soft-deleted users (all roles).</p>
    </div>
    <div class="overflow-x-auto">
        @if($deletedUsers->isEmpty())
            <p class="px-6 py-8 text-gray-500 text-sm">No deleted users.</p>
        @else
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deleted at</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($deletedUsers as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ ucfirst(str_replace('_', ' ', $user->role)) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->deleted_at?->format('M d, Y H:i') ?? '—' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('super-admin.users.restore', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Restore this user?');">
                                @csrf
                                <button type="submit" class="text-green-600 hover:text-green-800 font-medium text-sm">Restore</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

{{-- Deleted Doctors --}}
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Deleted Doctors</h3>
        <p class="text-sm text-gray-500 mt-1">Restore soft-deleted doctors (role: admin).</p>
    </div>
    <div class="overflow-x-auto">
        @if($deletedDoctors->isEmpty())
            <p class="px-6 py-8 text-gray-500 text-sm">No deleted doctors.</p>
        @else
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deleted at</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($deletedDoctors as $doctor)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $doctor->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $doctor->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $doctor->deleted_at?->format('M d, Y H:i') ?? '—' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('super-admin.doctor-verification.restore', $doctor->id) }}" method="POST" class="inline" onsubmit="return confirm('Restore this doctor?');">
                                @csrf
                                <button type="submit" class="text-green-600 hover:text-green-800 font-medium text-sm">Restore</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
