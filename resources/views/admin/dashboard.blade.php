@extends('layouts.miniMed')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">🛡️ Admin Dashboard</h1>

        <!-- Quick Stats -->
        <div class="grid md:grid-cols-4 gap-6 mb-10">
            <a href="{{ route('admin.doctors') }}">
                <div class="bg-white rounded-lg p-5 shadow text-center">
                    <p class="text-2xl font-bold text-orange-600">{{ $doctors->count() }}</p>
                    <p class="text-sm text-gray-600">Total Doctors</p>
                </div>
            </a>
            <a href="{{ route('admin.clients.index') }}">
                <div class="bg-white rounded-lg p-5 shadow text-center">
                    <p class="text-2xl font-bold text-green-600">{{ $clients->count() }}</p>
                    <p class="text-sm text-gray-600">Total Clients</p>
                </div>
            </a>
            <a href="{{ route('admin.schedules.recent') }}">
                <div class="bg-white rounded-lg p-5 shadow text-center">
                    <p class="text-2xl font-bold text-yellow-600">{{ $appointments->count() }}</p>
                    <p class="text-sm text-gray-600">Recent Schedules</p>
                </div>
            </a>
            <div class="bg-white rounded-lg p-5 shadow text-center">
                <p class="text-2xl font-bold text-blue-600">{{ $totalRatings }}</p>
                <p class="text-sm text-gray-600">Total Ratings</p>
            </div>
        </div>

        <!-- Doctors & Ratings -->
        <div class="bg-white rounded-lg shadow p-6 mb-10">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">👨‍⚕️ Doctors and Ratings</h2>
            <div class="overflow-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Specialization</th>
                            <th class="px-4 py-2">Ratings</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($doctors as $doctor)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $doctor->name }}</td>
                                <td class="px-4 py-2">{{ $doctor->specialization ?? 'N/A' }}</td>
                                <td class="px-4 py-2">
                                    @if ($doctor->ratingsReceived->count())
                                        ⭐ {{ number_format($doctor->ratingsReceived->avg('rating'), 1) }}
                                        <span class="text-xs text-gray-500">({{ $doctor->ratingsReceived->count() }}
                                            reviews)</span>
                                    @else
                                        No Ratings Yet
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Upcoming Appointments -->
        <div class="bg-white rounded-lg shadow p-6 mb-10">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">📅 Latest Schedules</h2>
            @forelse ($appointments as $appointment)
                <div class="border-b py-3">
                    <p><strong>Doctor:</strong> {{ $appointment->doctor->name ?? 'N/A' }}</p>
                    <p><strong>Client:</strong> {{ $appointment->client->name ?? 'N/A' }}</p>
                    <p><strong>When:</strong>
                        {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('M j, Y - h:i A') }}</p>
                    <p><strong>Status:</strong>
                        <span
                            class="text-xs text-white px-2 py-1 rounded 
                        @if ($appointment->status == 'approved') bg-green-500 
                        @elseif ($appointment->status == 'pending') bg-yellow-500 
                        @elseif ($appointment->status == 'cancelled') bg-red-500 
                        @else bg-gray-400 @endif">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </p>
                </div>
            @empty
                <p class="text-sm text-gray-500">No recent appointments.</p>
            @endforelse
        </div>

        <!-- View All Mails -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">📬 All Mails</h2>
            <a href="{{ route('admin.mails.index') }}"
                class="inline-block bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded shadow text-sm transition">
                View All Messages
            </a>
        </div>
    </div>
@endsection
