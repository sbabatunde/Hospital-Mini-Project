@extends('layouts.miniMed')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-10">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">👤 Update Profile</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data"
            class="bg-white p-6 rounded-lg shadow-md space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="mt-1 w-full border border-gray-300 p-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                    class="mt-1 w-full border border-gray-300 p-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Photo</label>
                <input type="file" name="photo" class="mt-1 block">
                @if ($user->photo)
                    <img src="{{ asset('storage/doctors/' . $user->photo) }}" alt="Photo" class="h-20 mt-2">
                @endif
            </div>

            @if ($user->role === 'doctor')
                <div>
                    <label class="block text-sm font-medium text-gray-700">Specialization</label>
                    {{-- <input type="text" name="specialization" value="{{ old('specialization', $user->specialization) }}"
                        class="mt-1 w-full border border-gray-300 p-2 rounded"> --}}
                    <select name="specialization"
                        class="form-control w-full mt-1 w-full border border-gray-300 p-2 rounded"" required>
                        <option value="">Select specialization</option>
                        @php
                            $specializations = [
                                'General Practitioner',
                                'Cardiologist',
                                'Pulmonologist',
                                'Neurologist',
                                'Dermatologist',
                                'Pediatrician',
                                'Endocrinologist',
                                'Orthopedic Surgeon',
                                'Gastroenterologist',
                                'Psychiatrist',
                                'OB-GYN',
                                'Oncologist',
                                'Infectious Disease Specialist',
                                'Nephrologist',
                                'Allergist/Immunologist',
                            ];

                            $selectedSpecialization = old('specialization', $user->specialization ?? '');
                        @endphp

                        @foreach ($specializations as $specialty)
                            <option value="{{ $specialty }}"
                                {{ $selectedSpecialization === $specialty ? 'selected' : '' }}>
                                {{ $specialty }}
                            </option>
                        @endforeach
                    </select>

                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Bio</label>
                    <textarea name="bio" class="mt-1 w-full border border-gray-300 p-2 rounded" rows="3">{{ old('bio', $user->bio) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">License Number</label>
                    <input type="text" name="license_number" value="{{ old('license_number', $user->license_number) }}"
                        class="mt-1 w-full border border-gray-300 p-2 rounded">
                </div>
            @endif

            @if ($user->role === 'client')
                <div>
                    <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}"
                        class="mt-1 w-full border border-gray-300 p-2 rounded">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Gender</label>
                    <select name="gender" class="mt-1 w-full border border-gray-300 p-2 rounded">
                        <option value="">Select Gender</option>
                        <option value="male" @selected(old('gender', $user->gender) == 'male')>Male</option>
                        <option value="female" @selected(old('gender', $user->gender) == 'female')>Female</option>
                        <option value="other" @selected(old('gender', $user->gender) == 'other')>Other</option>
                    </select>
                </div>
            @endif

            <div class="pt-4">
                <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-2 rounded shadow">
                    Update Profile
                </button>
            </div>
        </form>
    </div>
@endsection
