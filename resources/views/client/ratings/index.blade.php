@extends('layouts.miniMed')

@section('content')
    <div class="max-w-4xl mx-auto px-6 py-12 bg-gray-50 min-h-screen">
        <!-- Back Button -->
        <a href="{{ route('client.dashboard') }}"
            class="inline-flex items-center text-sm text-orange-500 hover:text-orange-600 hover:underline mb-8 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Dashboard
        </a>

        <h1 class="text-3xl font-extrabold text-gray-900 mb-10 flex items-center gap-3">
            <span>👨‍⚕️</span> Rate Your Doctors
        </h1>

        @forelse ($doctors as $doctor)
            @php
                $rating = $ratings->firstWhere('doctor_id', $doctor->id);
            @endphp
            <div class="bg-white rounded-xl shadow-md p-6 mb-6 hover:shadow-lg transition">
                <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">{{ $doctor->name }}</h2>
                        <p class="text-sm text-gray-500 mt-1">Specialization: <span
                                class="font-medium">{{ $doctor->specialization ?? 'N/A' }}</span></p>

                        @if ($rating)
                            <div class="mt-3 flex items-center space-x-3">
                                <div class="flex text-yellow-400 text-lg">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $rating->rating)
                                            <span>★</span>
                                        @else
                                            <span class="text-gray-300">★</span>
                                        @endif
                                    @endfor
                                </div>
                                <p class="text-gray-600 italic max-w-xl truncate" title="{{ $rating->comment }}">
                                    "{{ $rating->comment }}"
                                </p>
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center space-x-6">
                        @if ($rating)
                            <a href="{{ route('client.ratings.edit', $doctor->id) }}"
                                class="text-blue-600 hover:text-blue-700 font-semibold text-sm flex items-center gap-1 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5h2M12 7v10m-4-4h8" />
                                </svg>
                                Edit Rating
                            </a>
                        @else
                            <a href="{{ route('client.ratings.create', $doctor->id) }}"
                                class="text-orange-500 hover:text-orange-600 font-semibold text-sm flex items-center gap-1 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.39 2.462a1 1 0 00-.364 1.118l1.287 3.974c.3.922-.755 1.688-1.538 1.118l-3.39-2.462a1 1 0 00-1.176 0l-3.39 2.462c-.783.57-1.838-.196-1.538-1.118l1.287-3.974a1 1 0 00-.364-1.118L2.98 9.4c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.974z" />
                                </svg>
                                Rate Doctor
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-600 text-center mt-20 text-lg">You haven’t interacted with any doctors yet.</p>
        @endforelse
    </div>
@endsection
