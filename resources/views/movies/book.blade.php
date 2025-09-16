<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>Book Movie Ticket - {{ $movie->name ?? 'Movie Booking' }}</title>
    <style>
        .booking-form {
            background: #000000;
            border: 1px solid #374151;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        }
        .hero-section {
            background: linear-gradient(135deg, #1f2937 0%, #111827 50%, #000000 100%);
            min-height: 40vh;
        }
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .input-field {
            background: #1f2937;
            border: 1px solid #374151;
            color: white;
        }
        .input-field:focus {
            background: #111827;
            border-color: #fbbf24;
            box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1);
        }
        .input-field::placeholder {
            color: #9ca3af;
        }
        .readonly-field {
            background: #374151;
            border: 1px solid #4b5563;
            color: #fbbf24;
        }
    </style>
</head>
<body class="bg-gray-800 min-h-screen">
    <!-- Hero Section -->
    <div class="hero-section relative overflow-hidden">
        <div class="absolute h-full inset-0 bg-gradient-to-br from-black via-gray-900 to-black opacity-60"></div>
        <div class="absolute inset-0" style="background-image: url('{{ asset('storage/' . $movie->image) }}'); background-size: cover; background-position: center; opacity: 0.3;"></div>
        <div class="relative z-10 mx-auto px-4 py-16">
            <div class="text-center">
                <div class="text-6xl mb-4 floating-animation">🎬</div>
                <h1 class="text-5xl font-bold mb-4 floating-animation text-yellow-400">
                    Book Your Ticket
                </h1>
                <p class="text-xl text-gray-300">
                    Reserve your seats for {{ $movie->name ?? 'this amazing movie' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Booking Form -->
    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="booking-form rounded-2xl shadow-xl overflow-hidden">
            <!-- Form Header -->
            <div class="gradient-bg px-8 py-6">
                <div class="flex items-center justify-center space-x-3">
                    <div class="text-3xl">🎫</div>
                    <h2 class="text-3xl font-bold text-black text-center">Complete Your Booking</h2>
                </div>
            </div>

            <!-- Form Content -->
            <form method="POST" action="{{ route('movie.store', $movie->id) }}" class="px-8 py-8">
                @csrf
                
                <!-- Movie Name Field (Read-only) -->
                <div class="mb-6">
                    <label for="movie_name" class="block text-yellow-400 text-lg font-semibold mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h3a1 1 0 011 1v2h3a1 1 0 011 1v3a1 1 0 01-1 1h-1v9a2 2 0 01-2 2H8a2 2 0 01-2-2V9H5a1 1 0 01-1-1V5a1 1 0 011-1h2z"></path>
                        </svg>
                        Movie Selection
                    </label>
                    <input
                        type="text"
                        id="movie_name"
                        value="{{ $movie->name }}"
                        readonly
                        class="readonly-field w-full px-4 py-3 rounded-lg font-semibold text-lg"
                    >
                    <p class="text-gray-400 text-sm mt-1">Selected movie cannot be changed</p>
                </div>

                <!-- Full Name Field -->
                <div class="mb-6">
                    <label for="name" class="block text-yellow-400 text-lg font-semibold mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Full Name <span class="text-red-400">*</span>
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Enter your full name"
                        class="input-field w-full px-4 py-3 rounded-lg focus:outline-none transition-all duration-300"
                        required
                    >
                </div>

                <!-- Email Field -->
                <div class="mb-6">
                    <label for="email" class="block text-yellow-400 text-lg font-semibold mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Email Address <span class="text-red-400">*</span>
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="your.email@example.com"
                        class="input-field w-full px-4 py-3 rounded-lg focus:outline-none transition-all duration-300"
                        required
                    >
                </div>

                <!-- Seats Field -->
                <div class="mb-8">
                    <label for="seats" class="block text-yellow-400 text-lg font-semibold mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Number of Seats <span class="text-red-400">*</span>
                    </label>
                    <div class="relative">
                        <input
                            type="number"
                            id="seats"
                            name="seats"
                            min="1"
                            max="10"
                            placeholder="1"
                            class="input-field w-full px-4 py-3 rounded-lg focus:outline-none transition-all duration-300"
                            required
                        >
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <span class="text-gray-400 text-sm">Max: 10</span>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm mt-1">Select between 1-10 seats for your booking</p>
                </div>

                <!-- Submit Button -->
                <div class="text-center space-y-4">
                    <button
                        type="submit"
                        class="bg-gradient-to-r from-yellow-400 to-yellow-600 hover:from-yellow-500 hover:to-yellow-700 text-black px-12 py-4 rounded-lg font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center mx-auto"
                    >
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Confirm Booking
                    </button>

                    <!-- Back Button -->
                    <div class="pt-2">
                        <a href="/" class="text-gray-400 hover:text-yellow-400 transition-colors duration-300 inline-flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Movies
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Movie Info Card -->
        <div class="bg-black rounded-2xl shadow-xl p-6 mt-8 border border-gray-700">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    @if($movie->image)
                        <img src="{{ asset('storage/' . $movie->image) }}" 
                             alt="{{ $movie->name }}" 
                             class="w-16 h-16 object-cover rounded-lg border border-gray-600">
                    @else
                        <div class="w-16 h-16 bg-gray-700 rounded-lg flex items-center justify-center">
                            <span class="text-2xl">🎬</span>
                        </div>
                    @endif
                    <div>
                        <h3 class="text-xl font-bold text-white">{{ $movie->name }}</h3>
                        <p class="text-gray-400 line-clamp-2">{{ $movie->description ?? 'Experience the magic of cinema' }}</p>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="gradient-bg bg-opacity-20 border border-yellow-400 rounded-full px-4 py-2">
                        <span class="text-white  font-bold">Selected</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 mt-12 border-t border-gray-700">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-gray-400">&copy; 2024 Movie Booking System. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>