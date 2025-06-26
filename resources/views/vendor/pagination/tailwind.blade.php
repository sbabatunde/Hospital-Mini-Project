@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center mt-6 space-x-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 text-sm bg-gray-200 text-gray-500 rounded cursor-not-allowed">← Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="px-4 py-2 text-sm bg-orange-500 text-white rounded hover:bg-orange-600 transition">← Previous</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="px-3 py-2 text-sm text-gray-400">...</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span
                            class="px-4 py-2 text-sm font-semibold bg-orange-100 text-orange-600 rounded">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                            class="px-4 py-2 text-sm bg-white text-gray-700 border rounded hover:bg-orange-50">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="px-4 py-2 text-sm bg-orange-500 text-white rounded hover:bg-orange-600 transition">Next →</a>
        @else
            <span class="px-4 py-2 text-sm bg-gray-200 text-gray-500 rounded cursor-not-allowed">Next →</span>
        @endif
    </nav>
@endif
