@extends('layouts.miniMed')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Welcome Message -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
                Welcome, {{ auth()->user()->name }} 👋
            </h1>
            <p class="text-gray-600 mt-1">Your health at a glance. Here’s your latest updates.</p>
        </div>
        <!-- Client Quick Guide Note -->
        <div x-data="{ open: true }" x-show="open" x-transition
            class="bg-orange-50 border-l-4 border-orange-400 p-4 rounded-md shadow mb-8 relative">
            <button @click="open = false" class="absolute top-2 right-2 text-orange-600 hover:text-orange-800 transition"
                aria-label="Close">
                &times;
            </button>

            <h3 class="text-lg font-semibold text-orange-800 mb-1">What you can do as a client</h3>
            <ul class="list-disc list-inside text-sm text-orange-700 space-y-1">
                <li><strong>Request a Schedule:</strong> Book an appointment with your preferred doctor at a convenient
                    time.</li>
                <li><strong>View Medical History:</strong> See your consultation notes, diagnoses, prescriptions, and visit
                    records.</li>
                <li><strong>Rate a Doctor:</strong> Share your feedback to help improve care and guide others.</li>
                <li><strong>Send Messages:</strong> Contact doctors through in-app messaging or receive email updates when
                    needed.</li>
            </ul>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <a href="{{ route('client.appointments.request') }}"
                class="bg-orange-500 text-white p-6 rounded-lg shadow hover:bg-orange-600 transition duration-300">
                <h2 class="text-lg font-semibold">Request a Schedule</h2>
                <p class="text-sm mt-2">Schedule a session with a doctor</p>
            </a>

            <a href="{{ route('client.history') }}"
                class="bg-white border p-6 rounded-lg shadow hover:shadow-lg transition">
                <h2 class="text-lg font-semibold text-gray-800">Medical History</h2>
                <p class="text-sm mt-2 text-gray-600">View past consultations & notes</p>
            </a>

            <a href="{{ route('client.schedule.index') }}"
                class="bg-white border p-6 rounded-lg shadow hover:shadow-lg transition">
                <h2 class="text-lg font-semibold text-gray-800">My Schedule</h2>
                <p class="text-sm mt-2 text-gray-600">Check upcoming visits</p>
            </a>

            <a href="{{ route('client.ratings.index') }}"
                class="bg-white border p-6 rounded-lg shadow hover:shadow-lg transition">
                <h2 class="text-lg font-semibold text-gray-800">Rate My Doctors</h2>
                <p class="text-sm mt-2 text-gray-600">Give feedback and rate doctors you’ve consulted</p>
            </a>

        </div>

        <!-- Upcoming Appointments -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Upcoming Schedules</h2>
            @forelse($appointments as $appointment)
                <div class="bg-white p-6 rounded-lg shadow mb-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-700 font-semibold">{{ $appointment->doctor->name }}</p>
                            <p class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('D, M j \\a\\t h:i A') }}</p>
                        </div>
                        <span
                            class="px-3 py-1 text-sm rounded-full 
                        @if ($appointment->status == 'approved') bg-green-100 text-green-800 
                        @elseif($appointment->status == 'pending') bg-yellow-100 text-yellow-800 
                        @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-gray-600">No upcoming appointments.</p>
            @endforelse
        </div>

        <!-- Recent Medical History -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Recent Medical History</h2>
            @forelse($histories as $history)
                <div class="bg-gray-50 p-5 rounded-lg mb-4 shadow-sm">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-semibold text-gray-700">{{ $history->title }}</p>
                            <p class="text-sm text-gray-500">By {{ optional($history->doctor)->name ?? 'Unknown' }} on
                                {{ $history->created_at->format('M j, Y') }}</p>
                        </div>
                        <a href="{{ route('client.history.show', $history->id) }}"
                            class="text-orange-500 hover:underline text-sm">View</a>
                    </div>
                    <p class="text-gray-600 text-sm mt-2 line-clamp-2">{{ Str::limit($history->description, 100) }}</p>
                </div>
            @empty
                <p class="text-gray-600">No medical records available.</p>
            @endforelse
        </div>
    </div>
@endsection
