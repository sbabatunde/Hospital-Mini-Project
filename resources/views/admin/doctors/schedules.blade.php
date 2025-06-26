@extends('layouts.miniMed')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-10">
        <a href="{{ route('admin.doctors') }}" class="inline-flex items-center text-sm text-orange-500 hover:underline mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Doctors
        </a>
        <h1 class="text-2xl font-bold text-gray-800 mb-4">📅 {{ $doctor->name }}’s Schedules</h1>

        @if ($appointments->isEmpty())
            <p class="text-sm text-gray-500">No schedule yet.</p>
        @else
            <div class="bg-white rounded shadow overflow-x-auto">
                <table class="min-w-full table-auto text-sm">
                    <thead class="bg-orange-50 text-left">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Client</th>
                            <th class="px-4 py-3">Scheduled At</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Reason</th>
                            <th class="px-4 py-3">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $index => $appointment)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $appointments->firstItem() + $index }}</td>
                                <td class="px-4 py-3">{{ $appointment->client->name }}</td>
                                <td class="px-4 py-3">
                                    {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('M j, Y h:i A') }}</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="px-2 py-1 rounded-full text-xs
                                    @if ($appointment->status === 'approved') bg-green-100 text-green-700
                                    @elseif ($appointment->status === 'pending') bg-yellow-100 text-yellow-700
                                    @elseif ($appointment->status === 'cancelled') bg-red-100 text-red-700
                                    @else bg-gray-100 text-gray-700 @endif">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-700">
                                    {{ \Illuminate\Support\Str::limit($appointment->reason, 50) }}</td>
                                <td>
                                    {{-- <a href="{{ route('client.schedule.show', $appointment->id) }}" --}}
                                    <a href="{{ route('admin.schedule.show', $appointment->id) }}" class="text-center">
                                        <i class="fa fa-info-circle  text-orange-500 hover:underline text-2xl"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $appointments->links() }}
            </div>
        @endif
    </div>
@endsection
