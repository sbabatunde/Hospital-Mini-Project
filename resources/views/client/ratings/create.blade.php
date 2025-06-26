@extends('layouts.miniMed')

@section('content')
    <div class="max-w-xl mx-auto py-10 px-4">
        <!-- Back Link -->
        <a href="{{ route('client.ratings.index') }}"
            class="inline-flex items-center text-sm text-orange-500 hover:underline mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Ratings
        </a>
        <h2 class="text-2xl font-bold mb-6 text-gray-800">⭐ Rate Dr. {{ $doctor->name }}</h2>

        <form action="{{ route('client.ratings.store', $doctor->id) }}" method="POST">
            @csrf
            <!-- Stars -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2 text-gray-700">Select Rating:</label>
                <div class="flex flex-row-reverse justify-end space-x-reverse space-x-1">
                    @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}"
                            class="peer hidden" @checked(old('rating') == $i) />
                        <label for="star{{ $i }}"
                            class="cursor-pointer text-3xl transition
                                text-gray-300 peer-checked:text-yellow-400
                                hover:text-yellow-400 peer-hover:text-yellow-400
                                peer-focus:text-yellow-400
                                ">
                            ★
                        </label>
                    @endfor
                </div>
                @error('rating')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Comment -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2 text-gray-700">Comments (optional)</label>
                <textarea name="comment" rows="4" class="w-full border rounded px-3 py-2">{{ old('comment') }}</textarea>
            </div>

            <button type="submit" class="bg-orange-500 text-white px-5 py-2 rounded hover:bg-orange-600 transition">
                Submit Rating
            </button>
        </form>
    </div>
@endsection
