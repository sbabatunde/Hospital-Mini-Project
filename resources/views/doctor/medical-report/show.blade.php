@extends('layouts.miniMed')

@section('content')
    <div class="max-w-4xl mx-auto py-10 px-4">
        <a href="{{ route('doctor.reports.index') }}"
            class="inline-flex items-center text-sm text-orange-500 hover:underline mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Reports
        </a>

        <div class="bg-white rounded shadow p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $report->title }}</h1>
            <p class="text-sm text-gray-600 mb-4">For <strong>{{ $report->client->name }}</strong> | Created on
                {{ $report->created_at->format('F d, Y') }}</p>

            <div class="space-y-4 text-gray-700">
                <div>
                    <h2 class="font-semibold text-gray-800">📋 Description</h2>
                    <p>{{ $report->description }}</p>
                </div>

                @if ($report->diagnosis)
                    <div>
                        <h2 class="font-semibold text-gray-800">🧠 Diagnosis</h2>
                        <p>{{ $report->diagnosis }}</p>
                    </div>
                @endif

                @if ($report->medications)
                    <div>
                        <h2 class="font-semibold text-gray-800">💊 Medications</h2>
                        <p>{{ $report->medications }}</p>
                    </div>
                @endif

                @if ($report->next_visit)
                    <div>
                        <h2 class="font-semibold text-gray-800">📅 Next Visit</h2>
                        <p>{{ \Carbon\Carbon::parse($report->next_visit)->format('F j, Y') }}</p>
                    </div>
                @endif

                @if ($report->attachments)
                    <div>
                        <h2 class="font-semibold text-gray-800">📎 Attachments</h2>
                        <ul class="list-disc ml-6">
                            @foreach (json_decode($report->attachments, true) as $attachment)
                                <li>
                                    <a href="{{ asset('storage/' . $attachment) }}" target="_blank"
                                        class="text-orange-500 hover:underline">
                                        {{ basename($attachment) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
