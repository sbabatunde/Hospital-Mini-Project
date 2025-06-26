@extends('layouts.miniMed')

@section('content')
    <div class="max-w-4xl mx-auto py-10 px-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">📝 Add Medical Report for {{ $appointment->client->name }}
        </h2>

        <form action="{{ route('doctor.history.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded shadow">
            @csrf

            <input type="hidden" name="client_id" value="{{ $appointment->client_id }}">
            <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Title</label>
                <input type="text" name="title" required class="w-full border border-gray-300 rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Description / Report</label>
                <textarea name="description" rows="6" required class="w-full border border-gray-300 rounded p-2"></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Diagnosis</label>
                <input type="text" name="diagnosis" class="w-full border border-gray-300 rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Medications</label>
                <textarea name="medications" rows="3" class="w-full border border-gray-300 rounded p-2"></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Next Visit Date</label>
                <input type="date" name="next_visit" class="w-full border border-gray-300 rounded p-2">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold mb-1">Attachments (optional)</label>
                <input type="file" name="attachments[]" multiple class="w-full border border-gray-300 p-2 rounded">
            </div>

            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded">Save
                Report</button>
        </form>
    </div>
@endsection
