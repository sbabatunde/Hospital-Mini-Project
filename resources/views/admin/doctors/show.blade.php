@extends('layouts.miniMed')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-10">
        <a href="{{ route('admin.dashboard') }}"
            class="inline-flex items-center text-sm text-orange-500 hover:underline mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Dashboard
        </a>
        <h1 class="text-2xl font-bold text-gray-800 mb-6">👨‍⚕️ Doctor Profile</h1>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex gap-6 items-center mb-6">
                <img src="{{ $doctor->photo ? asset('storage/doctors/' . $doctor->photo) : asset('default-avatar.png') }}"
                    alt="{{ $doctor->name }}" class="w-24 h-24 rounded-full border object-cover">
                <div>
                    <h2 class="text-xl font-semibold">{{ $doctor->name }}</h2>
                    <p class="text-sm text-gray-500">{{ $doctor->email }}</p>
                    <p class="text-sm text-gray-500">{{ $doctor->phone ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="text-gray-700 text-sm">
                <p><strong>Specialization:</strong> {{ $doctor->specialization ?? 'N/A' }}</p>
                <p><strong>License Number:</strong> {{ $doctor->license_number ?? 'N/A' }}</p>
                <p class="mt-3"><strong>Bio:</strong></p>
                <p class="mt-1 text-gray-600">{{ $doctor->bio ?? 'No bio available.' }}</p>
            </div>

            <div class="mt-6 flex justify-end">
                <a href="{{ route('admin.doctor.schedules', $doctor->id) }}"
                    class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 text-sm">
                    📅 View Schedules
                </a>
            </div>
        </div>
    </div>
@endsection
