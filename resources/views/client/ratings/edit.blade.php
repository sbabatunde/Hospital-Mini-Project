@extends('layouts.miniMed')

@section('content')
    <div class="max-w-3xl mx-auto px-6 py-10">
        <!-- Back Link -->
        <a href="{{ route('client.ratings.index') }}"
            class="inline-flex items-center text-sm text-orange-500 hover:underline mb-6 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Ratings
        </a>

        <h1 class="text-3xl font-extrabold text-gray-900 mb-8 flex items-center gap-2">
            <span>✏️</span> Edit Rating for {{ $doctor->name }}
        </h1>

        <form action="{{ route('client.ratings.update', $doctor->id) }}" method="POST"
            class="bg-white p-8 rounded-xl shadow-md max-w-xl mx-auto space-y-6">
            @csrf
            @method('PUT')

            <!-- Doctor Info -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800">{{ $doctor->name }}</h2>
                <p class="text-sm text-gray-500">Specialization: <span
                        class="font-medium">{{ $doctor->specialization ?? 'N/A' }}</span></p>
            </div>

            <!-- Rating Stars -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Rating:</label>
                <div class="flex flex-row-reverse justify-end space-x-reverse space-x-3">
                    @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}"
                            class="peer hidden" {{ old('rating', $rating->rating) == $i ? 'checked' : '' }} />
                        <label for="star{{ $i }}"
                            class="cursor-pointer text-4xl transition text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400 peer-focus-visible:outline-none peer-focus-visible:ring-2 peer-focus-visible:ring-yellow-400 peer-focus-visible:ring-offset-1">
                            ★
                        </label>
                    @endfor
                </div>
                @error('rating')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Comment -->
            <div>
                <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Comment (optional):</label>
                <textarea name="comment" id="comment" rows="5"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition resize-none"
                    placeholder="Your thoughts about the doctor...">{{ old('comment', $rating->comment) }}</textarea>
                @error('comment')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold py-3 rounded-lg shadow hover:from-orange-600 hover:to-orange-700 transition">
                💾 Update Rating
            </button>
        </form>
    </div>
@endsection
