@extends('layouts.miniMed')

@section('content')
    <div class="max-w-5xl mx-auto px-6 py-12">
        <div class="bg-white p-8 rounded-2xl shadow-lg">
            <div class="flex flex-col md:flex-row items-center md:items-start mb-8 space-y-6 md:space-y-0 md:space-x-8">
                <img src="{{ $doctor->photo ? asset('storage/doctors/' . $doctor->photo) : asset('default-doctor.png') }}"
                    alt="Photo of Dr. {{ $doctor->name }}"
                    class="w-28 h-28 md:w-32 md:h-32 rounded-full object-cover border-4 border-orange-300 shadow-md">
                <div class="text-center md:text-left">
                    <h1 class="text-3xl font-extrabold text-gray-900">{{ $doctor->name }}</h1>
                    <p class="text-orange-600 font-semibold mt-1">{{ $doctor->specialization ?? 'General Practitioner' }}</p>
                    <p class="text-gray-500 mt-1 text-sm">{{ $doctor->email }}</p>
                    @if ($doctor->license_number)
                        <p class="text-gray-400 mt-2 text-xs"><span class="font-semibold">License Number:</span>
                            {{ $doctor->license_number }}</p>
                    @endif
                </div>
            </div>

            @if ($doctor->bio)
                <section class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-3 border-b border-orange-300 pb-2">About Doctor</h2>
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $doctor->bio }}</p>
                </section>
            @endif

            <div class="text-center md:text-left">
                <a href="{{ route('client.ratings.create', $doctor->id) }}"
                    class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-orange-400 to-orange-600 text-white font-semibold rounded-lg shadow-md hover:from-orange-500 hover:to-orange-700 transition focus:outline-none focus:ring-2 focus:ring-orange-400 focus:ring-offset-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.285 3.946a1 1 0 00.95.69h4.15c.969 0 1.371 1.24.588 1.81l-3.36 2.44a1 1 0 00-.364 1.118l1.285 3.947c.3.92-.755 1.688-1.54 1.118l-3.36-2.44a1 1 0 00-1.175 0l-3.36 2.44c-.784.57-1.838-.197-1.539-1.118l1.285-3.947a1 1 0 00-.364-1.118L2.527 9.373c-.783-.57-.38-1.81.588-1.81h4.15a1 1 0 00.95-.69l1.285-3.946z" />
                    </svg>
                    ⭐ Rate this Doctor
                </a>
            </div>
        </div>
    </div>
@endsection
