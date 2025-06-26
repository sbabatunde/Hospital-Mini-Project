@extends('layouts.miniMed')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">
        <!-- Back -->
        <a href="{{ url()->previous() }}" class="inline-flex items-center text-sm text-orange-500 hover:underline mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back
        </a>

        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $history->title }}</h1>

            <div class="mb-4 text-sm text-gray-600">
                <p><strong>Date:</strong> {{ $history->created_at->format('F j, Y') }}</p>
                <p><strong>Doctor:</strong> {{ $history->doctor->name ?? 'Unknown' }}</p>
            </div>

            <div class="mb-6 text-sm text-gray-700">
                <h2 class="font-semibold text-gray-800 mb-2">📋 Description / Notes</h2>
                <p>{{ $history->description }}</p>
            </div>

            @if ($history->diagnosis)
                <div class="mb-6 text-sm text-gray-700">
                    <h2 class="font-semibold text-gray-800 mb-2">🩺 Diagnosis</h2>
                    <p>{{ $history->diagnosis }}</p>
                </div>
            @endif

            @if ($history->medications)
                <div class="mb-6 text-sm text-gray-700">
                    <h2 class="font-semibold text-gray-800 mb-2">💊 Medications</h2>
                    <p>{{ $history->medications }}</p>
                </div>
            @endif

            @if ($history->next_visit)
                <div class="mb-6 text-sm text-gray-700">
                    <h2 class="font-semibold text-gray-800 mb-2">📅 Next Visit</h2>
                    <p>{{ \Carbon\Carbon::parse($history->next_visit)->format('F j, Y') }}</p>
                </div>
            @endif

            @if ($history->attachments && is_array(json_decode($history->attachments, true)))
                <div class="mb-4">
                    <h2 class="font-semibold text-gray-800 mb-2">📎 Attachments</h2>
                    <ul class="list-disc list-inside text-sm text-blue-600">
                        @foreach (json_decode($history->attachments, true) as $file)
                            <li><a href="{{ asset('storage/' . $file) }}" target="_blank"
                                    class="hover:underline">{{ basename($file) }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection
