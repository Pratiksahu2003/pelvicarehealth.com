@extends('layouts.admin')

@section('title', 'Manage Users')
@section('page-title', 'Manage Users')

@section('content')
@if(session('success'))
    <div class="mb-4 bg-green-50 border-l-4 border-green-400 p-4 rounded-lg text-sm text-green-700">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="mb-4 bg-red-50 border-l-4 border-red-400 p-4 rounded-lg text-sm text-red-700">{{ session('error') }}</div>
@endif

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Joined</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($users as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <form action="{{ route('super-admin.users.update-role', $user->id) }}" method="POST" class="inline">
                            @csrf
                            <select name="role" onchange="this.form.submit()" class="text-sm border-gray-300 rounded-md">
                                <option value="super_admin" {{ $user->role == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin/Doctor</option>
                                <option value="patient" {{ $user->role == 'patient' ? 'selected' : '' }}>Patient</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($user->id !== auth()->id() && !($user->isSuperAdmin() && \App\Models\User::where('role', 'super_admin')->count() <= 1))
                            <form action="{{ route('super-admin.users.soft-delete', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Delete</button>
                            </form>
                        @else
                            <span class="text-gray-400">—</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t">
        {{ $users->links() }}
    </div>
</div>
@endsection
