@extends('layouts.admin')

@section('title', 'My Reports')
@section('page-title', 'My Reports')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Doctor</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($reports as $report)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $report->title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $report->doctor->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $report->report_date->format('M d, Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="{{ route('patient.reports.view', $report->id) }}" class="text-pink-600 hover:text-pink-900">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No reports available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t">
        {{ $reports->links() }}
    </div>
</div>
@endsection

