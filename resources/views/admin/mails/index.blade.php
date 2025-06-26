@extends('layouts.miniMed')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">📨 All Notifications</h1>

        @forelse ($notifications as $notification)
            @php
                $sender = \App\Models\User::find($notification->data['sender_id'] ?? null);
                $recipient = $notification->notifiable ?? null;
            @endphp

            <div class="bg-white p-4 rounded shadow mb-4">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-semibold text-gray-800 truncate w-72 md:w-96">
                            {{ Str::limit($notification->data['message'] ?? 'No message', 100) }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            From: {{ $sender?->email ?? 'System' }} |
                            To: {{ $recipient?->email ?? 'Unknown' }}
                        </p>
                    </div>
                    <div class="flex gap-2 items-center">
                        @if ($notification->read_at)
                            <span class="text-green-500 text-sm">✓ Read</span>
                        @else
                            <span class="text-orange-500 text-sm font-semibold">❗ Unread</span>
                        @endif

                        <a href="{{ route('admin.mails.show', $notification->id) }}"
                            class="bg-orange-500 text-white px-3 py-1 text-sm rounded hover:bg-orange-600 transition">
                            View
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500">No notifications yet.</p>
        @endforelse

        <div class="mt-6">
            {{ $notifications->links('pagination::tailwind') }}

        </div>
    </div>
@endsection
