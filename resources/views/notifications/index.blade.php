@extends('layouts.miniMed')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-8">
        <!-- Back Button & Compose -->
        <div class="flex justify-between items-center mb-6">
            @if (Auth::user()->hasRole('client'))
                <a href="{{ route('client.dashboard') }}" class="text-sm text-orange-500 hover:underline">← Back to
                    Dashboard</a>
            @elseif (Auth::user()->hasRole('doctor'))
                <a href="{{ route('doctors.dashboard') }}" class="text-sm text-orange-500 hover:underline">← Back to
                    Dashboard</a>
            @else
                <a href="{{ route('admin.dashboard') }}" class="text-sm text-orange-500 hover:underline">← Back to
                    Dashboard</a>
            @endif

            <div class="flex items-center gap-3">
                <a href="{{ route('notifications.markAllAsRead') }}"
                    class="text-sm text-gray-600 hover:text-orange-500 underline">✅
                    Mark All as Read</a>
                <a href="{{ route('mails.create') }}"
                    class="bg-orange-500 text-white px-4 py-2 rounded shadow hover:bg-orange-600 text-sm">
                    ✉️ Compose Mail
                </a>
            </div>
        </div>

        <h1 class="text-3xl font-bold text-gray-800 mb-4">📬 My Mails</h1>

        <!-- Tabs -->
        <div x-data="{ tab: 'inbox' }">
            <div class="flex space-x-4 mb-4">
                <button @click="tab = 'inbox'"
                    :class="tab === 'inbox' ? 'bg-orange-500 text-white' : 'bg-gray-200 text-gray-700'"
                    class="px-5 py-2 rounded shadow">Inbox</button>
                <button @click="tab = 'sent'"
                    :class="tab === 'sent' ? 'bg-orange-500 text-white' : 'bg-gray-200 text-gray-700'"
                    class="px-5 py-2 rounded shadow">Sent</button>
            </div>

            <!-- INBOX -->
            <div x-show="tab === 'inbox'" x-transition>
                <h2 class="text-xl font-semibold mb-3">Incoming Messages</h2>

                @forelse($inboxNotifications as $notification)
                    @php
                        $sender = \App\Models\User::find($notification->data['sender_id'] ?? null);
                        $isRead = !is_null($notification->read_at);
                        $icon = $isRead ? '✅' : '❗';
                    @endphp

                    <div class="bg-white p-4 rounded shadow mb-3 hover:bg-gray-50 transition">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-semibold text-gray-800">
                                    {{ $icon }} {{ Str::limit($notification->data['message'], 100) }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    From: {{ $sender->email ?? 'Unknown' }} •
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <div class="flex gap-3 items-center">
                                <a href="{{ route('mails.show', $notification->id) }}"
                                    class="text-sm text-blue-600 hover:underline">Open</a>
                                @unless ($isRead)
                                    <form method="POST" action="{{ route('notifications.markAsRead', $notification->id) }}">
                                        @csrf
                                        <button type="submit" class="text-sm text-orange-500 hover:text-orange-700 underline">
                                            Mark as Read
                                        </button>
                                    </form>
                                @endunless
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">No messages found.</p>
                @endforelse

                {{ $inboxNotifications->links() }}
            </div>

            <!-- SENT -->
            <div x-show="tab === 'sent'" x-transition>
                <h2 class="text-xl font-semibold mb-3">Sent Messages</h2>

                @forelse($sentNotifications as $sent)
                    @php
                        $recipient = $sent->notifiable ?? null;
                    @endphp
                    <div class="bg-white p-4 rounded shadow mb-3 hover:bg-gray-50 transition">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-semibold text-gray-800">
                                    ✉️ {{ Str::limit($sent->data['message'] ?? 'No message content.', 100) }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    To: {{ $recipient?->email ?? 'Unknown Recipient' }} •
                                    {{ $sent->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <a href="{{ route('mails.show', $sent->id) }}"
                                class="text-sm text-blue-600 hover:underline">Open</a>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">No sent messages.</p>
                @endforelse

                {{ $sentNotifications->links() }}
            </div>
        </div>
    </div>
@endsection
