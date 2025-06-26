@extends('layouts.miniMed')

@section('content')
    <section class="min-h-screen flex items-center justify-center bg-gray-50 px-6 md:px-12 lg:px-24 py-12">
        <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-10 border border-gray-200" data-aos="fade-up">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-10 text-center">
                Login to Your Account
            </h2>

            <form method="POST" action="{{ route('login.send') }}" novalidate>
                @csrf

                <!-- Email Address -->
                <div class="mb-8">
                    <label for="email" class="block text-gray-700 font-semibold mb-3">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                        autocomplete="username"
                        class="w-full px-5 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition" />
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-10">
                    <label for="password" class="block text-gray-700 font-semibold mb-3">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password"
                        class="w-full px-5 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition" />
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit and Register Link -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('password.request') }}"
                        class="text-sm text-gray-600 hover:text-orange-500 underline transition">
                        Forgot your password?
                    </a>
                    <button type="submit"
                        class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-8 py-3 rounded-md shadow-md transition">
                        Login
                    </button>
                </div>

                <div class="mt-8 text-center">
                    <span class="text-gray-600">Don't have an account?</span>
                    <a href="{{ route('register') }}"
                        class="text-orange-500 hover:underline font-semibold ml-1">Register</a>
                </div>
            </form>
        </div>
    </section>
@endsection
