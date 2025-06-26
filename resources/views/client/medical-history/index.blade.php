@extends('layouts.miniMed')

@section('content')
    <div class="max-w-5xl mx-auto py-10 px-4">
        <!-- Back Button -->
        <a href="{{ route('client.dashboard') }}"
            class="inline-flex items-center text-sm text-orange-500 hover:underline mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Dashboard
        </a>

        <h1 class="text-3xl font-bold text-gray-800 mb-6">📋 My Medical History</h1>

        @forelse ($histories as $history)
            <div class="bg-white p-5 rounded shadow mb-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">{{ $history->title }}</h2>
                        <p class="text-sm text-gray-500">Doctor: {{ optional($history->doctor)->name ?? 'N/A' }}</p>
                        <p class="text-sm text-gray-600 mt-1">
                            {{ Str::limit($history->description, 120) }}
                        </p>
                        @if ($history->next_visit)
                            <p class="text-xs text-gray-500 mt-1">
                                📅 Next Visit: {{ $history->next_visit->format('M j, Y') }}
                            </p>
                        @endif
                    </div>
                    <div>
                        <a href="{{ route('client.history.show', $history->id) }}"
                            class="inline-flex items-center text-sm text-orange-500 hover:text-orange-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            View
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500">You have no medical reports yet.</p>
        @endforelse

        <!-- Pagination Links -->
        <div class="mt-6">
            {{ $histories->links('pagination::tailwind') }}
        </div>
    </div>
@endsection
