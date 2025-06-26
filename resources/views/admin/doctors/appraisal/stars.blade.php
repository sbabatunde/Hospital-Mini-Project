@php $rating = $rating ?? 0; @endphp
@for ($i = 1; $i <= 10; $i++)
    <span class="{{ $rating >= $i ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
@endfor
