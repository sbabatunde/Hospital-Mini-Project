    <!-- =======================
         HEADER / NAVBAR
    ======================== -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-orange-500">medProffessionals</a>
            <nav class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="text-orange-500 hover:text-orange-800 px-4">Home</a>
                <a href="{{ route('home.doctors') }}" class="text-gray-600 hover:text-orange-500 px-4">Doctors</a>

                @auth
                    @if (auth()->user()->role == 'admin')
                        <a href="{{ route('admin.clients.index') }}"
                            class="text-gray-600 hover:text-orange-500 px-4">Clients</a>
                        <a href="{{ route('admin.dashboard') }}"
                            class="text-gray-600 hover:text-orange-500 px-4">Dashboard</a>
                    @elseif(auth()->user()->role == 'doctor')
                        <a href="{{ route('doctor.dashboard') }}" class="text-gray-600 hover:text-orange-500 px-4">
                            Dashboard
                        </a>
                        <a href="{{ route('profile.show') }}" class="text-gray-600 hover:text-orange-500 px-4">
                            Profile
                        </a>
                    @elseif(auth()->user()->role == 'client')
                        <a href="{{ route('profile.show') }}" class="text-gray-600 hover:text-orange-500 px-4">
                            Profile
                        </a>
                        <a href="{{ route('client.dashboard') }}" class="text-gray-600 hover:text-orange-500 px-4">
                            Dashboard
                        </a>
                    @endif
                    @php
                        $unreadCount = auth()->user()->unreadNotifications->count();
                    @endphp

                    <div class="relative" x-data="{ open: false }" @click.away="open = false" @mouseenter="open = true"
                        @mouseleave="open = false" @keydown.escape.window="open = false">
                        <button @click="open = !open" type="button" class="relative focus:outline-none"
                            aria-haspopup="true" :aria-expanded="open.toString()" aria-label="Notifications">
                            <!-- Font Awesome Envelope Icon -->
                            <span class="text-gray-600 hover:text-orange-500">Mail</span>
                            <i class="fas fa-envelope text-gray-600 hover:text-orange-500 text-xl transition mr-3"
                                aria-hidden="true">
                            </i>

                            <!-- Unread Badge -->
                            @if ($unreadCount > 0)
                                <span
                                    class="absolute -top-1 -right-1 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold text-white bg-red-600 rounded-full animate-pulse"
                                    aria-label="{{ $unreadCount }} unread notifications">
                                    {{ $unreadCount }}
                                </span>
                            @endif
                        </button>

                        <!-- Dropdown Notifications List -->
                        <div x-show="open" x-transition x-cloak
                            class="absolute right-0 mt-2 w-80 bg-white border border-gray-200 rounded shadow-lg z-50">
                            <div class="p-3 border-b font-semibold text-gray-700 flex justify-between items-center">
                                <span>Notifications</span>
                                <a href="{{ route('notifications.index') }}"
                                    class="text-sm text-orange-500 hover:underline">
                                    View All
                                </a>
                            </div>

                            <div class="max-h-80 overflow-y-auto divide-y divide-gray-200">
                                @forelse(auth()->user()->unreadNotifications as $notification)
                                    <a href="{{ route('notifications.index') }}"
                                        class="block p-3 hover:bg-gray-100 transition cursor-pointer">
                                        <p class="text-sm text-gray-800 truncate">
                                            {{ $notification->data['message'] ?? 'New notification' }}</p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </p>
                                    </a>
                                @empty
                                    <p class="p-3 text-center text-gray-500 italic">No new notifications.</p>
                                @endforelse
                            </div>

                            @if ($unreadCount > 0)
                                <div class="border-t p-2 text-center">
                                    <form method="POST" action="{{ route('notifications.markAllAsRead') }}">
                                        @csrf
                                        <button type="submit"
                                            class="text-xs text-orange-600 hover:underline focus:outline-none">
                                            Mark all as read
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-4 py-2 rounded-md shadow-md transition focus:outline-none focus:ring-2 focus:ring-orange-400">
                            Logout
                        </button>
                    </form>
                @else
                    <!-- Register Button -->
                    <a href="{{ route('register') }}"
                        class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-5 py-2 rounded shadow transition duration-300">
                        Register
                    </a>

                    <!-- Login Button -->
                    <a href="{{ route('login') }}"
                        class="border border-orange-500 text-orange-500 font-semibold px-5 py-2 rounded hover:bg-orange-50 transition duration-300">
                        Login
                    </a>
                @endauth

            </nav>
        </div>
    </header>
