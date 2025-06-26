@extends('layouts.miniMed')

@section('content')
    <section class="min-h-screen flex items-center justify-center bg-gray-50 px-6 md:px-12 lg:px-24 py-12">
        <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-10 border border-gray-200" data-aos="fade-up">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-10 text-center">
                Create Your Account
            </h2>

            <form method="POST" action="{{ route('register.send') }}" novalidate>
                @csrf

                <!-- Name -->
                <div class="mb-8">
                    <label for="name" class="block text-gray-700 font-semibold mb-3">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                        autocomplete="name"
                        class="w-full px-5 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition" />
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mb-8">
                    <label for="email" class="block text-gray-700 font-semibold mb-3">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required
                        autocomplete="username"
                        class="w-full px-5 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition" />
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role Selection -->
                <div class="mb-8">
                    <label for="role" class="block text-gray-700 font-semibold mb-3">Register As</label>
                    <select id="role" name="role" required
                        class="w-full px-5 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition">
                        <option value="" disabled {{ old('role') ? '' : 'selected' }}>-- Select Role --</option>
                        <option value="client" {{ old('role') === 'client' ? 'selected' : '' }}>Client</option>
                        <option value="doctor" {{ old('role') === 'doctor' ? 'selected' : '' }}>Doctor</option>
                    </select>
                    @error('role')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-8">
                    <label for="password" class="block text-gray-700 font-semibold mb-3">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="new-password"
                        class="w-full px-5 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition" />
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-10">
                    <label for="password_confirmation" class="block text-gray-700 font-semibold mb-3">Confirm
                        Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        autocomplete="new-password"
                        class="w-full px-5 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition" />
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit and Login Link -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('login') }}"
                        class="text-sm text-gray-600 hover:text-orange-500 underline transition">
                        Already registered?
                    </a>

                    <button type="submit"
                        class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-8 py-3 rounded-md shadow-md transition">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
