@extends('layouts.miniMed')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">👤 Profile</h1>

        <div class="bg-white shadow rounded-lg p-6">
            <!-- Profile Photo -->
            <div class="flex items-center space-x-4 mb-6">
                @if ($user->photo)
                    <img src="{{ asset('storage/doctors/' . $user->photo) }}" alt="User Photo"
                        class="w-20 h-20 rounded-full object-cover">
                @else
                    <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A8 8 0 1118.88 6.196a8 8 0 01-13.76 11.608z" />
                        </svg>
                    </div>
                @endif
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">{{ $user->name }}</h2>
                    <p class="text-sm text-gray-600">{{ $user->email }}</p>
                    @if ($user->phone)
                        <p class="text-sm text-gray-600">📞 {{ $user->phone }}</p>
                    @endif
                </div>
            </div>

            <!-- Shared Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm font-medium text-gray-600">Role</p>
                    <p class="text-base text-gray-800 capitalize">{{ $user->role }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Date Joined</p>
                    <p class="text-base text-gray-800">{{ $user->created_at->format('M j, Y') }}</p>
                </div>
            </div>

            <!-- Doctor Info -->
            @if ($user->role === 'doctor')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Specialization</p>
                        <p class="text-base text-gray-800">{{ $user->specialization ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">License Number</p>
                        <p class="text-base text-gray-800">{{ $user->license_number ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="mt-6">
                    <p class="text-sm font-medium text-gray-600">Bio</p>
                    <p class="text-base text-gray-800 mt-1 whitespace-pre-line">
                        {{ $user->bio ?? 'No biography provided yet.' }}
                    </p>
                </div>
            @endif

            <!-- Client Info -->
            @if ($user->role === 'client')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Date of Birth</p>
                        <p class="text-base text-gray-800">
                            {{ $user->date_of_birth ? \Carbon\Carbon::parse($user->date_of_birth)->format('M j, Y') : 'N/A' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Gender</p>
                        <p class="text-base text-gray-800">{{ $user->gender ?? 'N/A' }}</p>
                    </div>
                </div>
            @endif

            <!-- Edit Button -->
            @if (auth()->id() === $user->id)
                <div class="mt-8 text-right">
                    <a href="{{ route('profile.edit') }}"
                        class="inline-block bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600 transition">
                        ✏️ Edit Profile
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
