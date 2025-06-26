@extends('layouts.miniMed')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-10">
        <a href="{{ route('admin.doctors') }}" class="inline-flex items-center text-sm text-orange-500 hover:underline mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Doctors
        </a>
        <h1 class="text-3xl font-extrabold text-gray-900 mb-8 flex items-center gap-2">
            <span>📝</span> Appraise Doctor
        </h1>

        <div class="bg-white p-8 rounded-2xl shadow-lg">
            <form action="{{ route('admin.doctor.appraise', $doctor->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                <!-- Doctor Name -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Doctor</label>
                    <p class="text-lg text-gray-800 font-bold">{{ $doctor->name }}</p>
                </div>

                <!-- Period -->
                <div>
                    <label for="period" class="block text-sm font-semibold text-gray-700 mb-1">Review Period</label>
                    <input type="text" name="period" id="period" placeholder="e.g. June 2025" required
                        class="w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 px-4 py-2 text-gray-800 bg-gray-50 shadow-sm transition placeholder:text-gray-400">
                </div>

                <!-- Performance Metrics -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach (['professionalism', 'punctuality', 'patient_feedback', 'case_handling'] as $field)
                        <div>
                            <label for="{{ $field }}"
                                class="block text-sm font-semibold text-gray-700 mb-1 capitalize">
                                {{ ucwords(str_replace('_', ' ', $field)) }} <span
                                    class="text-xs text-gray-400">(1–10)</span>
                            </label>
                            <input type="number" name="{{ $field }}" id="{{ $field }}" min="1"
                                max="10"
                                class="w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 px-4 py-2 text-gray-800 bg-gray-50 shadow-sm transition placeholder:text-gray-400">
                        </div>
                    @endforeach
                </div>

                <!-- Appraisal Notes -->
                <div>
                    <label for="appraisal_notes" class="block text-sm font-semibold text-gray-700 mb-1">Appraisal
                        Notes</label>
                    <textarea name="appraisal_notes" id="appraisal_notes" rows="5" required
                        class="w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 px-4 py-2 text-gray-800 bg-gray-50 shadow-sm transition placeholder:text-gray-400 resize-none"
                        placeholder="Write your detailed appraisal here..."></textarea>
                </div>

                <!-- Attachments -->
                <div>
                    <label for="attachments" class="block text-sm font-semibold text-gray-700 mb-1">Attachments
                        (optional)</label>
                    <input type="file" name="attachments[]" id="attachments" multiple
                        class="block w-full text-sm text-gray-600 file:bg-orange-100 file:border-0 file:rounded-lg file:px-4 file:py-2 file:text-orange-600 file:font-semibold file:mr-4">
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-semibold px-8 py-3 rounded-lg shadow transition focus:outline-none focus:ring-2 focus:ring-orange-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Submit Appraisal
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
