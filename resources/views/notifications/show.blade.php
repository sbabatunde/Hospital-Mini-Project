@extends('layouts.miniMed')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-8">
        <!-- Back -->
        <a href="{{ url()->previous() }}" class="inline-flex items-center text-sm text-orange-500 hover:underline mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back
        </a>

        <div class="bg-white shadow rounded p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">📨 Mail</h1>

            <p class="text-sm text-gray-600 mb-1">
                <strong>From:</strong> {{ $sender?->name ?? 'Unknown' }} ({{ $sender?->email ?? 'N/A' }})
            </p>
            <p class="text-sm text-gray-600 mb-4">
                <strong>To:</strong> {{ $recipient?->name ?? 'Unknown' }} ({{ $recipient?->email ?? 'N/A' }})
            </p>

            <div class="border-t pt-4 mt-4">
                <p class="text-gray-800">
                    {{ $notification->data['message'] ?? 'No message content.' }}
                </p>
            </div>

            <p class="text-xs text-gray-500 mt-4">Sent: {{ $notification->created_at->format('M d, Y h:i A') }}</p>

            @if (is_null($notification->read_at) && auth()->id() === $recipient?->id)
                <form method="POST" action="{{ route('notifications.markAsRead', $notification->id) }}" class="mt-4">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                        class="text-white bg-green-600 hover:bg-green-700 px-4 py-2 rounded text-sm shadow">
                        ✓ Mark as Read
                    </button>
                </form>
            @endif
        </div>
    </div>
@endsection
