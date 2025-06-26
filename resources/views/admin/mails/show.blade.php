@extends('layouts.miniMed')

@section('content')
    <div class="max-w-3xl mx-auto px-6 py-10">
        <a href="{{ route('admin.mails.index') }}" class="text-orange-500 hover:underline text-sm mb-4 inline-block">
            ← Back to All Mails
        </a>

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">📩 Message Details</h2>

            <p class="text-sm text-gray-600 mb-1">
                <strong>From:</strong>
                {{ \App\Models\User::find($notification->data['sender_id'] ?? null)?->email ?? 'System' }}
            </p>
            <p class="text-sm text-gray-600 mb-3">
                <strong>To:</strong> {{ $notification->notifiable?->email ?? 'Unknown Recipient' }}
            </p>

            <div class="border-t pt-4 mt-4">
                <p class="text-gray-700 text-base whitespace-pre-wrap">
                    {{ $notification->data['message'] ?? 'No message available.' }}
                </p>
            </div>

            <p class="text-xs text-gray-500 mt-6">
                Sent: {{ $notification->created_at->format('M j, Y - h:i A') }}
                | Status:
                @if ($notification->read_at)
                    <span class="text-green-600">Read</span>
                @else
                    <span class="text-orange-500">Unread</span>
                @endif
            </p>
        </div>
    </div>
@endsection
