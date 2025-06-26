@extends('layouts.miniMed')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">
        {{-- Personalized Greeting with Doctor's Name --}}
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">
            Welcome back, <span class="text-orange-500">{{ auth()->user()->name }}</span> 👨‍⚕️
        </h1>
        <p class="text-gray-600 text-lg mb-12">Here’s your dashboard overview and upcoming appointments.</p>

        {{-- Summary Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-12">
            <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
                <p class="text-gray-500 font-semibold mb-2">New Schedules</p>
                <p class="text-4xl font-extrabold text-orange-500">{{ $newAppointmentsCount ?? 0 }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
                <p class="text-gray-500 font-semibold mb-2">Approved Schedules</p>
                <p class="text-4xl font-extrabold text-green-500">{{ $approvedAppointmentsCount ?? 0 }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
                <p class="text-gray-500 font-semibold mb-2">Recheduled Schedules</p>
                <p class="text-4xl font-extrabold text-cyan-500">{{ $rescheduledAppointmentsCount ?? 0 }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
                <p class="text-gray-500 font-semibold mb-2">Schedules Completed</p>
                <p class="text-4xl font-extrabold text-neutral-500">{{ $completedAppointmentsCount ?? 0 }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
                <p class="text-gray-500 font-semibold mb-2">Canceled Schedules</p>
                <p class="text-4xl font-extrabold text-red-500">{{ $canceledAppointmentsCount ?? 0 }}</p>
            </div>
        </div>

        {{-- Upcoming Appointments List --}}
        <section class="bg-white rounded-lg shadow p-6 mb-12">
            <h2 class="text-2xl font-semibold text-gray-900 mb-6">Upcoming Schedules</h2>

            @if ($upcomingAppointments->isEmpty())
                <p class="text-gray-600 italic">No upcoming schedules.</p>
            @else
                <ul class="divide-y divide-gray-200">
                    @foreach ($upcomingAppointments as $appointment)
                        <li class="py-4 flex justify-between items-center">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $appointment->client->name }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('D, M j, Y \a\t h:i A') }}
                                </p>
                            </div>
                            <div>
                                <span
                                    class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                                    @if ($appointment->status == 'approved') bg-green-100 text-green-800
                                    @elseif($appointment->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($appointment->status == 'rescheduled') bg-red-100 text-red-800
                                    @elseif($appointment->status == 'canceled') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </div>
                            <div>
                                <a href="{{ route('doctor.schedule.show', $appointment->id) }}"
                                    class="text-orange-500 hover:underline font-semibold">
                                    <i class="fa fa-eye text-orange-500 text-xl"></i>
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>

        {{-- Quick Links --}}
        <section class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <a href="{{ route('doctor.schedules.index') }}"
                class="block bg-orange-500 hover:bg-orange-600 text-white rounded-lg shadow p-6 text-center font-semibold transition">
                Manage Schedule
            </a>
            {{-- <a href="{{ route('doctor.schedules.index') }}"
                class="block bg-white border border-gray-300 rounded-lg shadow p-6 text-center font-semibold hover:shadow-lg transition">
                Manage Schedule
            </a> --}}
            <a href="{{ route('doctor.reports.index') }}"
                class="block bg-white border border-gray-300 rounded-lg shadow p-6 text-center font-semibold hover:shadow-lg transition">
                Medical History
            </a>
        </section>
    </div>
@endsection
