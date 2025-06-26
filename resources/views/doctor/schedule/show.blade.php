@extends('layouts.miniMed')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-10">
        <a href="{{ route('doctor.schedules.index') }}"
            class="inline-flex items-center text-sm text-orange-500 hover:underline mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Schedules
        </a>

        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">🗓 Schedule Details</h2>

            <div class="text-gray-700 space-y-3">
                <p><strong>Client:</strong> {{ $appointment->client->name }} ({{ $appointment->client->email }})</p>
                <p><strong>Scheduled Time:</strong>
                    {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('l, F j Y \a\t h:i A') }}</p>
                <p><strong>Status:</strong>
                    <span
                        class="inline-block px-3 py-1 rounded-full text-sm
                    @if ($appointment->status == 'approved') bg-green-100 text-green-700
                    @elseif($appointment->status == 'pending') bg-yellow-100 text-yellow-700
                    @elseif($appointment->status == 'completed') bg-gray-200 text-gray-800
                    @elseif($appointment->status == 'cancelled') bg-red-100 text-red-700
                    @else bg-blue-100 text-blue-700 @endif">
                        {{ ucfirst($appointment->status) }}
                    </span>
                </p>

                @if ($appointment->reason)
                    <p><strong>Reason:</strong> {{ $appointment->reason }}</p>
                @endif

                @if ($appointment->notes)
                    <p><strong>Doctor's Notes:</strong> {{ $appointment->notes }}</p>
                @endif

                @if ($appointment->approved_at)
                    <p><strong>Approved At:</strong>
                        {{ \Carbon\Carbon::parse($appointment->approved_at)->format('M j, Y h:i A') }}</p>
                @endif

                @if ($appointment->completed_at)
                    <p><strong>Completed At:</strong>
                        {{ \Carbon\Carbon::parse($appointment->completed_at)->format('M j, Y h:i A') }}</p>
                @endif

                <!-- Actions -->
                <div class="mt-4 flex flex-wrap gap-3">
                    @if ($appointment->status === 'pending' || $appointment->status === 'rescheduled')
                        <!-- Approve Button -->
                        <form action="{{ route('doctor.appointments.approve', $appointment->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow-sm text-sm">
                                ✅ Approve
                            </button>
                        </form>
                    @endif

                    @if ($appointment->status !== 'cancelled' && $appointment->status !== 'completed')
                        <!-- Reschedule Button -->
                        <a href="{{ route('doctor.reschedule.form', $appointment->id) }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow-sm text-sm">
                            🔄 Reschedule
                        </a>
                        <form action="{{ route('doctor.appointments.cancel', $appointment->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded shadow-sm text-sm">
                                ❌ Cancel
                            </button>
                        </form>
                    @endif

                    @if ($appointment->status === 'approved')
                        <a href="{{ route('doctor.medical-report', $appointment->id) }}">
                            <button type="submit"
                                class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded shadow-sm text-sm">
                                ✔️ Mark as Completed
                            </button>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
