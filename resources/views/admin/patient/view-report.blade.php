@extends('layouts.admin')

@section('title', 'View Report')
@section('page-title', 'View Report')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow p-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900">{{ $report->title }}</h2>
        <div class="mt-2 text-sm text-gray-600">
            <p><strong>Doctor:</strong> {{ $report->doctor->name ?? 'N/A' }}</p>
            <p><strong>Date:</strong> {{ $report->report_date->format('M d, Y') }}</p>
            @if($report->appointment)
            <p><strong>Related Appointment:</strong> {{ $report->appointment->appointment_date->format('M d, Y') }} at {{ $report->appointment->appointment_time }}</p>
            @endif
        </div>
    </div>
    <div class="prose max-w-none">
        <h3 class="text-lg font-semibold mb-2">Description</h3>
        <p class="text-gray-700 whitespace-pre-wrap">{{ $report->description }}</p>
    </div>
    @if($report->file_path)
    <div class="mt-6">
        <a href="{{ asset('' . $report->file_path) }}" target="_blank" class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700 inline-block">Download Report</a>
    </div>
    @endif
    <div class="mt-6">
        <a href="{{ route('patient.reports') }}" class="text-pink-600 hover:text-pink-900">← Back to Reports</a>
    </div>
</div>
@endsection

