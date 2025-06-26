@extends('layouts.miniMed')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-10">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">🔄 Reschedule Appointment</h1>

        <div class="bg-white p-6 rounded shadow">
            <form action="{{ route('doctor.schedule.reschedule', $appointment->id) }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="scheduled_at" class="block text-sm font-medium text-gray-700">New Date & Time</label>
                    <input type="datetime-local" name="scheduled_at" id="scheduled_at"
                        value="{{ old('scheduled_at', \Carbon\Carbon::parse($appointment->scheduled_at)->format('Y-m-d\TH:i')) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">
                    @error('scheduled_at')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="note" class="block text-sm font-medium text-gray-700">Note to Client (Optional)</label>
                    <textarea name="note" id="note" rows="3"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">{{ old('note', $appointment->notes) }}</textarea>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('doctor.schedules.index') }}"
                        class="inline-flex items-center px-5 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded shadow-sm hover:bg-gray-100 hover:text-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-400 transition">
                        Cancel
                    </a>

                    <button type="submit"
                        class="inline-flex items-center bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:ring-orange-300 text-white text-sm font-semibold px-5 py-2 rounded shadow transition">
                        <span class="mr-2" aria-hidden="true">✅</span>
                        Reschedule Appointment
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
