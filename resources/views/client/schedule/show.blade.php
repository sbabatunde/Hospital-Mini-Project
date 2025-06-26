@extends('layouts.miniMed')

@section('content')
    <div class="max-w-3xl mx-auto py-8 px-4">
        @if (auth()->user()->hasRole('admin'))
            <a href="{{ url()->previous() }}" class="inline-flex items-center text-sm text-orange-500 hover:underline mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to schedules
            </a>
            <h1 class="text-2xl font-bold text-gray-800 mb-4">📅 Schedule Details</h1>
        @else
            <a href="{{ route('client.schedule.index') }}"
                class="inline-flex items-center text-sm text-orange-500 hover:underline mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to schedules
            </a>
            <h1 class="text-2xl font-bold text-gray-800 mb-4">📅 Your Schedule Details</h1>
        @endif


        <div class="bg-white shadow rounded p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">📄 Schedule Details</h1>

            <p class="mb-2 text-sm text-gray-600"><strong>Doctor:</strong> Dr. {{ $appointment->doctor->name }}</p>
            <p class="mb-2 text-sm text-gray-600"><strong>Email:</strong> {{ $appointment->doctor->email }}</p>
            <p class="mb-2 text-sm text-gray-600"><strong>Scheduled At:</strong>
                {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('M d, Y - h:i A') }}</p>
            <p class="mb-2 text-sm text-gray-600"><strong>Status:</strong>
                <span class="font-semibold text-orange-600">{{ ucfirst($appointment->status) }}</span>
            </p>

            @if ($appointment->reason)
                <p class="mt-4 text-sm text-gray-700"><strong>Your Reason:</strong> {{ $appointment->reason }}</p>
            @endif

            @if ($appointment->notes)
                <p class="mt-2 text-sm text-gray-700"><strong>Doctor’s Note:</strong> {{ $appointment->notes }}</p>
            @endif

            @if ($appointment->status === 'rescheduled')
                <p class="mt-4 text-sm text-blue-600 font-semibold">⚠️ This appointment has been rescheduled.</p>
            @endif
        </div>
    </div>
@endsection
