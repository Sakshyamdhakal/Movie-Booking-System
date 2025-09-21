<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Your Bookings - Movie Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .ticket-card {
            background: #000000;
            border: 1px solid #374151;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        }
        .ticket-dashed {
            background-image: repeating-linear-gradient(90deg, #374151, #374151 10px, transparent 10px, transparent 20px);
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
<body class="bg-gray-800 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header Section -->
        <div class="bg-black rounded-2xl shadow-xl p-8 mb-8 text-white border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold mb-2 text-yellow-400">🎬 Your Bookings</h1>
                    <p class="text-gray-300 mb-4">Manage all your movie ticket bookings</p>
                    <div class="flex items-center gap-4">
                        <div class="bg-white bg-opacity-20 rounded-full px-4 py-2">
                            <span class="text-yellow-300 font-bold">{{ count($bookings) }} Booking{{ count($bookings) == 1 ? '' : 's' }}</span>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="text-6xl opacity-20 floating-animation">🎭</div>
                </div>
            </div>
        </div>

        @if($bookings->isEmpty())
            <!-- Empty State -->
            <div class="bg-black rounded-2xl shadow-xl p-16 text-center border border-gray-700">
                <div class="text-6xl mb-4 floating-animation">🎬</div>
                <h2 class="text-3xl font-bold text-white mb-4">No Bookings Yet</h2>
                <p class="text-gray-400 mb-8 text-lg">You haven't made any movie bookings. Start exploring our amazing collection!</p>
                <a href="/" class="bg-gradient-to-r from-yellow-400 to-yellow-600 hover:from-yellow-500 hover:to-yellow-700 text-black font-semibold py-3 px-8 rounded-lg transition transform hover:scale-105 inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h3a1 1 0 011 1v2h3a1 1 0 011 1v3a1 1 0 01-1 1h-1v9a2 2 0 01-2 2H8a2 2 0 01-2-2V9H5a1 1 0 01-1-1V5a1 1 0 011-1h2z"></path>
                    </svg>
                    Browse Movies
                </a>
            </div>
        @else
            <div class="space-y-8">
                @foreach($bookings as $booking)
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

                                        <!-- Action Button -->
                                        <div class="mt-6">
                                            <form method="POST" action="{{ route('booking.destroy', $booking->id) }}" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                        onclick="return confirm('Are you sure you want to cancel this booking?')"
                                                        class="bg-gradient-to-r from-yellow-600 to-yellow-800 hover:from-yellow-700 hover:to-yellow-900 text-black px-6 py-2 rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Cancel Booking
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Dashed Line -->
                            <div class="ticket-dashed h-px my-8"></div>
                            
                            <!-- Booking Status -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-green-400 rounded-full"></div>

                                    @php
    $today = \Carbon\Carbon::today();
    $bookingDate = \Carbon\Carbon::parse($booking->created_at);
@endphp

<div class="flex items-center">
    @if($bookingDate->isToday())
        <svg class="w-4 h-4 mr-2 text-green-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="text-green-400 font-semibold">Active Today</span>
    @elseif($bookingDate->isFuture())
        <svg class="w-4 h-4 mr-2 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
        </svg>
        <span class="text-blue-400 font-semibold">Upcoming</span>
    @else
        <svg class="w-4 h-4 mr-2 text-red-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <span class="text-red-400 font-semibold">Expired</span>
    @endif
</div>
                                </div>
                                <div class="text-gray-400 text-sm">
                                    Booked {{ \Carbon\Carbon::parse($booking->created_at)->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Navigation Card -->
        <div class="bg-black rounded-2xl shadow-xl p-6 mt-8 border border-gray-700">
            <div class="flex items-center justify-center">
                <a href="/" class="bg-gradient-to-r from-yellow-400 to-yellow-600 hover:from-yellow-500 hover:to-yellow-700 text-black font-semibold py-3 px-8 rounded-lg transition transform hover:scale-105 inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Go Back to Home
                </a>
            </div>
        </div>
    </div>
</body>
</html>