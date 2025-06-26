@extends('layouts.miniMed')

@section('content')
    <div class="max-w-6xl mx-auto py-10 px-4">
        <!-- Back Button -->
        <a href="{{ route('doctor.dashboard') }}"
            class="inline-flex items-center text-sm text-orange-500 hover:underline mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Dashboard
        </a>
        <h1 class="text-3xl font-bold text-gray-800 mb-6">🗂️ My Medical History</h1>

        @forelse ($reports as $report)
            <div class="bg-white rounded-lg shadow p-5 mb-4 hover:shadow-md transition">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-semibold text-orange-600">{{ $report->title }}</h2>
                        <p class="text-sm text-gray-600">For <span class="font-medium">{{ $report->client->name }}</span>
                            &bull;
                            {{ $report->created_at->format('M d, Y') }}
                        </p>
                    </div>
                    <a href="{{ route('doctor.reports.show', $report->id) }}"
                        class="text-orange-500 hover:text-orange-700 text-sm font-semibold">
                        View Report →
                    </a>
                </div>
                <p class="mt-2 text-sm text-gray-700 line-clamp-2">
                    {{ Str::limit($report->description, 120) }}
                </p>
            </div>
        @empty
            <p class="text-gray-500">You haven’t submitted any reports yet.</p>
        @endforelse

        <!-- Pagination Links -->
        <div class="mt-6">
            {{ $reports->links() }}
        </div>
    </div>
@endsection
