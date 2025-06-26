@extends('layouts.miniMed')

@section('content')
    <div class="max-w-6xl mx-auto py-8 px-4">
        <!-- Back Button -->
        <a href="{{ route('client.dashboard') }}"
            class="inline-flex items-center text-sm text-orange-500 hover:underline mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Dashboard
        </a>
        <h1 class="text-2xl font-bold mb-6 text-gray-800">📅 My Schedule Requests</h1>

        @forelse ($appointments as $appointment)
            <a href="{{ route('client.schedule.show', $appointment->id) }}"
                class="block bg-white rounded shadow p-5 mb-4 hover:bg-gray-50 transition">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">Dr. {{ $appointment->doctor->name }}</h2>
                        <p class="text-sm text-gray-500">Scheduled for:
                            {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('M d, Y - h:i A') }}</p>
                    </div>
                    <span
                        class="px-3 py-1 text-sm rounded-full 
                    @if ($appointment->status === 'pending') bg-yellow-100 text-yellow-700
                    @elseif ($appointment->status === 'approved') bg-green-100 text-green-700
                    @elseif ($appointment->status === 'rescheduled') bg-blue-100 text-blue-700
                    @elseif ($appointment->status === 'cancelled') bg-red-100 text-red-700
                    @else bg-gray-200 text-gray-800 @endif">
                        {{ ucfirst($appointment->status) }}
                    </span>
                </div>
            </a>
        @empty
            <p class="text-gray-500">You have no scheduled appointments.</p>
        @endforelse

        <div class="mt-6">
            {{ $appointments->links('pagination::tailwind') }}
        </div>
    </div>
@endsection
