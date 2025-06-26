@extends('layouts.miniMed')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-10">
        <a href="{{ route('admin.doctor.appraisals.view', $appraisal->doctor->id) }}"
            class="inline-flex items-center text-sm text-orange-500 hover:underline mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Doctor's Appraisals
        </a>
        <h1 class="text-2xl font-bold text-gray-800 mb-6">🗂️ {{ $appraisal->created_at->format('M d, Y') }} Appraisal for
            Dr. {{ $appraisal->doctor->name }} </h1>

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-800 mb-1">{{ $appraisal->doctor->name }}</h2>
            <p class="text-sm text-gray-500 mb-3">Period: {{ $appraisal->period }}</p>

            <div class="grid grid-cols-2 gap-4 mb-4 text-sm text-gray-700">
                <p><strong>Professionalism:</strong> {{ $appraisal->professionalism ?? 'N/A' }}</p>
                <p><strong>Punctuality:</strong> {{ $appraisal->punctuality ?? 'N/A' }}</p>
                <p><strong>Patient Feedback:</strong> {{ $appraisal->patient_feedback ?? 'N/A' }}</p>
                <p><strong>Case Handling:</strong> {{ $appraisal->case_handling ?? 'N/A' }}</p>
            </div>

            <div class="mb-6">
                <h3 class="font-semibold mb-1 text-sm text-gray-700">Appraisal Notes</h3>
                <p class="text-gray-600 text-sm leading-relaxed">{{ $appraisal->appraisal_notes }}</p>
            </div>

            @if ($appraisal->attachments)
                <div class="mb-4">
                    <h4 class="font-semibold text-sm text-gray-700 mb-1">Attachments:</h4>
                    <ul class="list-disc ml-6 text-sm text-orange-600">
                        @foreach (json_decode($appraisal->attachments) as $file)
                            <li>
                                <a href="{{ asset('storage/' . $file) }}" target="_blank" class="hover:underline">
                                    View File
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <p class="text-xs text-gray-400 mt-6">Appraised by: {{ $appraisal->admin->name }} •
                {{ $appraisal->created_at->format('M d, Y') }}</p>
        </div>
    </div>
@endsection
