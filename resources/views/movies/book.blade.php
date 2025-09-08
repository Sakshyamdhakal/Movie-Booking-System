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
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 40vh;
        }
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-purple-900 via-blue-900 to-indigo-900 min-h-screen">
    <!-- Hero Section -->
    <div class="hero-section relative overflow-hidden">
        <div class="absolute h-fit inset-0 bg-gradient-to-br from-black via-gray-900 to-black opacity-40"></div>
        <div class="absolute inset-0" style="background-image: url('{{ asset('storage/' . $movie->image) }}'); background-size: cover; background-position: center; opacity: 0.3;"></div>
        <div class="relative z-10 mx-auto px-4 py-16">
            <div class="text-center text-white">
                <h1 class="text-5xl font-bold mb-4 floating-animation">
                    Book Your Ticket
                </h1>
            </div>
        </div>
    </div>

    <!-- Booking Form -->
    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="booking-form rounded-3xl shadow-2xl overflow-hidden">
            <div class="gradient-bg px-8 py-6">
                <h2 class="text-3xl font-bold text-white text-center">Complete Your  Booking</h2>
            </div>

            <form method="POST" action="{{ route('movie.store', $movie->id) }}" class="px-8 py-8">
                @csrf
                <div class="mb-6">
                    
                    <label for="name" class="block text-gray-700 text-lg font-semibold mb-2">
                            Movie Name<span class="text-red-500"></span>
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="{{$movie->name}}"
                        readOnly
                        class="w-full px-4 py-3 border-2 border-blue-300 bg-blue-100/50 text-gray-600 rounded-xl"
                        required
                    >
                    
                </div>
                <div class="mb-6">
                    
                    <label for="name" class="block text-gray-700 text-lg font-semibold mb-2">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Enter your full name"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-4 focus:ring-purple-200 transition-all duration-300"
                        required
                    >
                    
                </div>
                <!-- Email Field -->
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 text-lg font-semibold mb-2">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="your.email@example.com"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-4 focus:ring-purple-200 transition-all duration-300"
                        required
                    >
                </div>

                <!-- Seats Field -->
                <div class="mb-8">
                    <label for="seats" class="block text-gray-700 text-lg font-semibold mb-2">
                        Number of Seats <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="number"
                        id="seats"
                        name="seats"
                        min="1"
                        max="10"
                        placeholder="1"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-4 focus:ring-purple-200 transition-all duration-300"
                        required
                    >
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button
                        type="submit"
                        class="bg-gradient-to-r from-green-500 to-teal-500 hover:from-green-600 hover:to-teal-600 text-white px-12 py-4 rounded-full font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105"
                    >
                        🎟️ Confirm Booking
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-gray-500">&copy; 2024 Movie Booking System. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
