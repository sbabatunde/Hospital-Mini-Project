@extends('layouts.miniMed')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-8 px-4">
        <div class="w-full max-w-2xl bg-white rounded-2xl shadow-lg p-8">
            <a href="{{ route('notifications.index') }}"
                class="flex items-center text-orange-500 text-sm hover:underline mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Mails
            </a>

            <h1 class="text-3xl font-extrabold text-gray-800 mb-8 flex items-center">
                <span class="mr-2">✉️</span> Compose Message
            </h1>

            <form method="POST" action="{{ route('mails.send') }}" class="space-y-6">
                @csrf

                <!-- Recipient -->
                <div>
                    <label for="recipient_id" class="block text-sm font-semibold text-gray-700 mb-1">Send To</label>
                    <select name="recipient_id" id="recipient_id" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                        <option value="">-- Select Recipient --</option>
                        @foreach ($users as $user)
                            @if ($user->id !== auth()->id())
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endif
                        @endforeach
                    </select>
                    @error('recipient_id')
                        <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Message -->
                <div>
                    <label for="message" class="block text-sm font-semibold text-gray-700 mb-1">Message</label>
                    <textarea name="message" id="message" rows="5" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition resize-none"
                        placeholder="Type your message here..."></textarea>
                    @error('message')
                        <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center bg-gradient-to-r from-orange-400 to-orange-600 text-white font-semibold px-8 py-2 rounded-lg shadow hover:from-orange-500 hover:to-orange-700 transition focus:outline-none focus:ring-2 focus:ring-orange-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h8m0 0l-4-4m4 4l-4 4" />
                        </svg>
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
