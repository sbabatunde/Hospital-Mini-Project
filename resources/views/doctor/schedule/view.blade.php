@extends('layouts.miniMed')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-10">
        <!-- Back Button -->
        <a href="{{ route('doctor.dashboard') }}"
            class="inline-flex items-center text-sm text-orange-500 hover:underline mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Dashboard
        </a>

        <h1 class="text-3xl font-bold text-gray-800 mb-6">📅 My Schedules</h1>

        @if ($appointments->isEmpty())
            <div class="bg-yellow-50 text-yellow-800 px-4 py-4 rounded shadow text-sm">
                You have no schedule request yet.
            </div>
        @else
            <div class="grid gap-6">
                @foreach ($appointments as $appointment)
                    <div class="bg-white p-6 rounded-lg shadow border border-gray-100 hover:shadow-md transition">
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-2">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-800">
                                    Patient: {{ $appointment->client->name }}
                                </h2>
                                <p class="text-sm text-gray-500">Email: {{ $appointment->client->email }}</p>
                            </div>
                            <span
                                class="mt-2 sm:mt-0 inline-block px-3 py-1 text-sm rounded-full
                            @if ($appointment->status == 'approved') bg-green-100 text-green-700
                            @elseif ($appointment->status == 'pending') bg-yellow-100 text-yellow-700
                            @elseif ($appointment->status == 'cancelled') bg-red-100 text-red-700
                            @elseif ($appointment->status == 'completed') bg-gray-200 text-gray-700
                            @else bg-blue-100 text-blue-700 @endif">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </div>

                        <div class="mt-3 text-sm text-gray-700">
                            <p><strong>Scheduled:</strong>
                                {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('D, M j Y \a\t h:i A') }}
                            </p>
                            @if ($appointment->reason)
                                <p class="mt-1"><strong>Reason:</strong> {{ $appointment->reason }}</p>
                            @endif
                            @if ($appointment->notes)
                                <p class="mt-1"><strong>Note:</strong> {{ $appointment->notes }}</p>
                            @endif
                        </div>

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
                @endforeach
            </div>
            <!-- Pagination Links -->
            <div class="mt-6">
                {{ $appointments->links() }}
            </div>
        @endif
    </div>
@endsection
