@extends('layouts.miniMed')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-10">
        <!-- Back Button -->
        <a href="{{ route('admin.dashboard') }}"
            class="inline-flex items-center text-sm text-orange-500 hover:underline mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Dashboard
        </a>

        <h1 class="text-3xl font-bold text-gray-800 mb-6">👨‍⚕️ All Registered Doctors</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($doctors as $doctor)
                <div
                    class="relative bg-white rounded-xl shadow p-6 hover:shadow-lg transition duration-300 flex flex-col justify-between h-full">
                    <!-- Top-right appraisal link -->
                    <a href="{{ route('admin.doctor.appraisals.view', $doctor->id) }}"
                        class="absolute top-4 right-4 inline-flex items-center gap-1 bg-indigo-100 text-indigo-700 px-3 py-1.5 rounded-full text-xs font-semibold hover:bg-indigo-200 transition"
                        title="View Appraisal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m6 0l-3 3m3-3l-3-3" />
                        </svg>
                        View Appraisal
                    </a>

                    <div>
                        <div class="flex items-center gap-4 mb-4">
                            <img src="{{ $doctor->photo ? asset('storage/doctors/' . $doctor->photo) : asset('default-avatar.png') }}"
                                alt="{{ $doctor->name }}"
                                class="w-16 h-16 rounded-full object-cover border-2 border-orange-200 shadow">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-800">{{ $doctor->name }}</h2>
                                <p class="text-sm text-orange-600 font-medium">
                                    {{ $doctor->specialization ?? 'General Practitioner' }}</p>
                            </div>
                        </div>

                        <div class="text-sm text-gray-600 mb-3">
                            <div><strong>Email:</strong> {{ $doctor->email }}</div>
                            <div><strong>Phone:</strong> {{ $doctor->phone ?? 'N/A' }}</div>
                        </div>

                        <div class="flex items-center text-yellow-500 mb-3">
                            @php
                                $avg = round($doctor->ratingsReceived->avg('rating'));
                            @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $avg)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-current"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 .587l3.668 7.568L24 9.423l-6 5.857 1.417 8.259L12 18.896 4.583 23.539 6 15.28 0 9.423l8.332-1.268z" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 .587l3.668 7.568L24 9.423l-6 5.857 1.417 8.259L12 18.896 4.583 23.539 6 15.28 0 9.423l8.332-1.268z" />
                                    </svg>
                                @endif
                            @endfor
                            <span class="ml-2 text-xs text-gray-500">({{ $doctor->ratings_count }} ratings)</span>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2 justify-between items-center mt-4">
                        <a href="{{ route('admin.doctors.show', $doctor->id) }}"
                            class="text-orange-500 hover:underline text-sm">
                            View Profile
                        </a>
                        <a href="{{ route('admin.doctor.schedules', $doctor->id) }}"
                            class="text-blue-500 hover:underline text-sm">
                            View Schedules
                        </a>
                        <a href="{{ route('admin.doctor.appraisal.form', $doctor->id) }}"
                            class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1.5 rounded-full text-xs font-semibold hover:bg-green-200 transition"
                            title="Give Appraisal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Appraise
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $doctors->links() }}
        </div>
    </div>
@endsection
