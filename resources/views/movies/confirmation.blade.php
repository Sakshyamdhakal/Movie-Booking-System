<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>Booking Confirmation - Movie Ticket</title>
    <style>
        .ticket-card {
            background: #000000;
            border: 1px solid #374151;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        }
        .success-section {
            background: linear-gradient(135deg, #1f2937 0%, #111827 50%, #000000 100%);
            min-height: 50vh;
        }
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .ticket-dashed {
            background-image: repeating-linear-gradient(90deg, #374151, #374151 10px, transparent 10px, transparent 20px);
        }
    </style>
</head>
<body class="bg-gray-800 min-h-screen">
    <!-- Success Section -->
    <div class="success-section relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-black via-gray-900 to-black opacity-50"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 py-16">
            <div class="text-center">
                <div class="text-8xl mb-6 floating-animation">🎉</div>
                <h1 class="text-5xl font-bold mb-4 floating-animation text-yellow-400">
                    Booking Confirmed!
                </h1>
                <p class="text-xl text-gray-300">
                    Your movie ticket has been successfully booked
                </p>
            </div>
        </div>
    </div>

    <!-- Ticket Card -->
    <div class="max-w-4xl mx-auto px-4 py-12">
        <div class="ticket-card rounded-2xl shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="gradient-bg px-8 py-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="text-4xl">🎬</div>
                        <div>
                            <h2 class="text-2xl font-bold text-black">Movie Ticket</h2>
                            <p class="text-black opacity-80">Booking ID: #{{ $booking->id }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-black text-sm opacity-80">{{ \Carbon\Carbon::parse($booking->created_at)->format('M d, Y') }}</p>
                        <p class="text-black text-sm opacity-80">{{ \Carbon\Carbon::parse($booking->created_at)->format('h:i A') }}</p>
                    </div>
                </div>
            </div>

            <!-- Ticket Content -->
            <div class="px-8 py-8">
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Movie Details -->
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-yellow-400 mb-2">Movie Details</h3>
                            <div class="bg-gray-900 border border-gray-700 rounded-xl p-4">
                                <h4 class="text-2xl font-bold text-white mb-2">
                                    @if(is_object($booking->movie))
                                        {{ $booking->movie->name }}
                                    @else
                                        {{ $booking->movie }}
                                    @endif
                                </h4>
                                <p class="text-gray-300">
                                    @if(is_object($booking->movie))
                                        {{ $booking->movie->description ?? 'Experience the magic of cinema' }}
                                    @else
                                        Experience the magic of cinema
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Movie Poster -->
                        @if(is_object($booking->movie) && $booking->movie->image)
                            <div class="relative">
                                <img src="{{ asset('storage/' . $booking->movie->image) }}"
                                     alt="@if(is_object($booking->movie)) {{ $booking->movie->name }} @else {{ $booking->movie }} @endif"
                                     class="w-full h-48 object-cover rounded-xl shadow-lg border border-gray-700" />
                            </div>
                        @endif
                    </div>

                    <!-- Customer Details -->
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-yellow-400 mb-2">Customer Details</h3>
                            <div class="space-y-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-yellow-400 rounded-full flex items-center justify-center">
                                        <span class="text-black font-semibold">{{ strtoupper(substr($booking->name, 0, 1)) }}</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-white">{{ $booking->name }}</p>
                                        <p class="text-sm text-gray-400">Customer Name</p>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-yellow-600 rounded-full flex items-center justify-center">
                                        <span class="text-black">📧</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-white">{{ $booking->email }}</p>
                                        <p class="text-sm text-gray-400">Email Address</p>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-yellow-700 rounded-full flex items-center justify-center">
                                        <span class="text-black">🎫</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-white">{{ $booking->seats }} {{ $booking->seats == 1 ? 'Seat' : 'Seats' }}</p>
                                        <p class="text-sm text-gray-400">Number of Tickets</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dashed Line -->
                <div class="ticket-dashed h-px my-8"></div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('landingpage') }}"
                       class="bg-gradient-to-r from-yellow-400 to-yellow-600 hover:from-yellow-500 hover:to-yellow-700 text-black px-8 py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h3a1 1 0 011 1v2h3a1 1 0 011 1v3a1 1 0 01-1 1h-1v9a2 2 0 01-2 2H8a2 2 0 01-2-2V9H5a1 1 0 01-1-1V5a1 1 0 011-1h2z"></path>
                        </svg>
                        Browse More Movies
                    </a>

                    <form method="POST" action="{{ route('booking.destroy', $booking->id) }}" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Are you sure you want to cancel this booking?')"
                                class="bg-gradient-to-r from-yellow-600 to-yellow-800 hover:from-yellow-700 hover:to-yellow-900 text-black px-8 py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Cancel Booking
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Welcome-style Card -->
        <div class="bg-black rounded-2xl shadow-xl p-8 mt-8 text-white border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold mb-2">🎬 Thank you, {{ $booking->name }}!</h3>
                    <p class="text-yellow-400 mb-4">Your booking has been confirmed successfully</p>
                    <div class="flex items-center gap-4">
                        <div class="bg-white bg-opacity-20 rounded-full px-4 py-2">
                            <span class="text-green-300 font-bold">Confirmed</span>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full px-4 py-2">
                            <span class="text-yellow-300 font-bold">{{ $booking->seats }} Ticket{{ $booking->seats == 1 ? '' : 's' }}</span>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="text-6xl opacity-20">🎭</div>
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