@extends('layouts.miniMed')

@section('content')
    <div class="max-w-6xl mx-auto py-10 px-4">
        <!-- Back Button -->
        <a href="{{ route('admin.dashboard') }}"
            class="inline-flex items-center text-sm text-orange-500 hover:underline mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Dashboard
        </a>
        <h1 class="text-3xl font-bold text-gray-800 mb-6">👥 All Clients</h1>

        @if ($clients->isEmpty())
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded">
                No clients found.
            </div>
        @else
            <div class="overflow-x-auto bg-white rounded shadow">
                <table class="min-w-full text-sm text-left border border-gray-200">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Phone</th>
                            <th class="px-4 py-3">Gender</th>
                            <th class="px-4 py-3">Date of Birth</th>
                            <th class="px-4 py-3">Registered</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    {{ $loop->iteration + ($clients->currentPage() - 1) * $clients->perPage() }}</td>
                                <td class="px-4 py-3">{{ $client->name }}</td>
                                <td class="px-4 py-3">{{ $client->email }}</td>
                                <td class="px-4 py-3">{{ $client->phone ?? 'N/A' }}</td>
                                <td class="px-4 py-3">{{ $client->gender ?? 'N/A' }}</td>
                                <td class="px-4 py-3">
                                    {{ $client->date_of_birth ? $client->date_of_birth->format('M d, Y') : 'N/A' }}</td>
                                <td class="px-4 py-3">{{ $client->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $clients->links() }}
            </div>
        @endif
    </div>
@endsection
