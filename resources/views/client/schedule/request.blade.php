@extends('layouts.miniMed')

@section('content')
    <div class="max-w-2xl my-2 mx-auto py-12 px-6 sm:px-8 lg:px-10 bg-white rounded-lg shadow-md">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-8 text-center">Request a Schedule</h2>

        <form method="POST" action="{{ route('client.appointments.request') }}" novalidate>
            @csrf

            <!-- Doctor Selection -->
            <div class="mb-6">
                <label for="doctor_id" class="block text-gray-700 font-semibold mb-2">Select Doctor</label>
                <select id="doctor_id" name="doctor_id" required
                    class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition">
                    <option value="" disabled selected>-- Choose a doctor --</option>
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                            Dr. {{ $doctor->name }}
                        </option>
                    @endforeach
                </select>
                @error('doctor_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Scheduled Date & Time -->
            <div class="mb-6">
                <label for="scheduled_at" class="block text-gray-700 font-semibold mb-2">Date & Time</label>
                <input type="datetime-local" id="scheduled_at" name="scheduled_at" required
                    value="{{ old('scheduled_at') }}"
                    class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition" />
                @error('scheduled_at')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Reason -->
            <div class="mb-6">
                <label for="reason" class="block text-gray-700 font-semibold mb-2">Schedule Note</label>
                <textarea id="reason" name="reason" rows="5" placeholder="Describe your symptoms or reason..."
                    class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition resize-none">{{ old('reason') }}</textarea>
                @error('reason')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-center">
                <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-8 py-3 rounded-md shadow-lg transition focus:outline-none focus:ring-4 focus:ring-orange-300">
                    Submit Appointment Request
                </button>
            </div>
        </form>
    </div>
@endsection
