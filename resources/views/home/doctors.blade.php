@extends('layouts.miniMed')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">👨‍⚕️ All Doctors</h1>

        <div class="grid md:grid-cols-3 gap-8">
            @foreach ($doctors as $doctor)
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
                    <img src="{{ $doctor->photo ? asset('storage/doctors/' . $doctor->photo) : asset('default-doctor.png') }}"
                        class="w-20 h-20 rounded-full object-cover mx-auto mb-4 border-4 border-orange-100">
                    <h2 class="text-md font-semibold text-gray-800 text-center">{{ $doctor->name }}</h2>
                    <p class="text-xs text-gray-500 text-center mb-2">{{ $doctor->specialization ?? 'General Practitioner' }}
                    </p>
                    <div class="text-center">
                        <a href="{{ route('home.doctor.show', $doctor->id) }}"
                            class="text-orange-600 text-sm hover:underline">View Profile</a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $doctors->links() }}
        </div>
    </div>
@endsection
