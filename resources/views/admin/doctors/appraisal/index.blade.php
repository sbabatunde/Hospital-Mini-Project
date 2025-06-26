@extends('layouts.miniMed')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-10">
        <a href="{{ route('admin.doctors') }}" class="inline-flex items-center text-sm text-orange-500 hover:underline mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Doctors List
        </a>
        <h1 class="text-3xl font-bold text-gray-800 mb-6">📋 Doctors Appraisals</h1>

        @if ($appraisals->isEmpty())
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded shadow">
                No appraisals have been recorded yet.
            </div>
        @else
            <div class="grid gap-6">
                @foreach ($appraisals as $appraisal)
                    <div class="bg-white border rounded-lg shadow p-5 hover:shadow-md transition">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-1">
                                    {{ $appraisal->doctor->name ?? 'Unknown Doctor' }}
                                </h2>
                                <p class="text-sm text-gray-500 mb-2">🗓 Period: {{ $appraisal->period }}</p>

                                <div class="space-y-1 text-sm">
                                    <p><strong>Professionalism:</strong> @include('admin.doctors.appraisal.stars', [
                                        'rating' => $appraisal->professionalism,
                                    ])</p>
                                    <p><strong>Punctuality:</strong> @include('admin.doctors.appraisal.stars', [
                                        'rating' => $appraisal->punctuality,
                                    ])</p>
                                    <p><strong>Patient Feedback:</strong> @include('admin.doctors.appraisal.stars', [
                                        'rating' => $appraisal->patient_feedback,
                                    ])</p>
                                    <p><strong>Case Handling:</strong> @include('admin.doctors.appraisal.stars', [
                                        'rating' => $appraisal->case_handling,
                                    ])</p>
                                </div>
                            </div>

                            <a href="{{ route('admin.doctor.appraisals.show', $appraisal->id) }}"
                                class="text-sm bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition shadow">
                                🔍 View Full Appraisal
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $appraisals->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
@endsection
