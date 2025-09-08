<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Your Bookings - Movie Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .ticket-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .ticket-dashed {
            background-image: repeating-linear-gradient(90deg, #e5e7eb, #e5e7eb 10px, transparent 10px, transparent 20px);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-purple-900 via-blue-900 to-indigo-900 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-4xl font-bold text-white mb-8 text-center">Your Bookings</h1>
        @if($bookings->isEmpty())
            <p class="text-white text-center text-xl">You have no bookings yet.</p>
        @else
            <div class="space-y-12">
                @foreach($bookings as $booking)
                    <div class="ticket-card rounded-3xl shadow-2xl overflow-hidden">
                        <!-- Header -->
                        <div class="gradient-bg px-8 py-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="text-4xl">🎬</div>
                                    <div>
                                        <h2 class="text-2xl font-bold text-white">Movie Ticket</h2>
                                        <p class="text-white opacity-90">Booking ID: #{{ $booking->id }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-white text-sm opacity-90">{{ \Carbon\Carbon::parse($booking->created_at)->format('M d, Y') }}</p>
                                    <p class="text-white text-sm opacity-90">{{ \Carbon\Carbon::parse($booking->created_at)->format('h:i A') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Ticket Content -->
                        <div class="px-8 py-8">
                            <div class="grid md:grid-cols-2 gap-8">
                                <!-- Movie Details -->
                                <div class="space-y-6">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Movie Details</h3>
                                        <div class="bg-gray-50 rounded-xl p-4">
                                            <h4 class="text-2xl font-bold text-gray-900 mb-2">
                                                @if(is_object($booking->movie))
                                                    {{ $booking->movie->name }}
                                                @else
                                                    {{ $booking->movie }}
                                                @endif
                                            </h4>
                                            <p class="text-gray-600">
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
                                                 class="w-full h-48 object-cover rounded-xl shadow-lg" />
                                        </div>
                                    @endif
                                </div>

                                <!-- Customer Details -->
                                <div class="space-y-6">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Customer Details</h3>
                                        <div class="space-y-4">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                                    <span class="text-purple-600 font-semibold">{{ strtoupper(substr($booking->name, 0, 1)) }}</span>
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-gray-900">{{ $booking->name }}</p>
                                                    <p class="text-sm text-gray-600">Customer Name</p>
                                                </div>
                                            </div>

                                            <div class="flex items-center space-x-3">
                                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                    <span class="text-blue-600">📧</span>
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-gray-900">{{ $booking->email }}</p>
                                                    <p class="text-sm text-gray-600">Email Address</p>
                                                </div>
                                            </div>

                                            <div class="flex items-center space-x-3">
                                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                                    <span class="text-green-600">🎫</span>
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-gray-900">{{ $booking->seats }} {{ $booking->seats == 1 ? 'Seat' : 'Seats' }}</p>
                                                    <p class="text-sm text-gray-600">Number of Tickets</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="px-2 py-6">
                                            <form method="POST" action="{{ route('booking.destroy', $booking->id) }}" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Are you sure you want to cancel this booking?')"
                                class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white px-8 py-3 rounded-full font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            ❌ Cancel Booking
                        </button>
                    </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Dashed Line -->
                            <div class="ticket-dashed h-px my-8"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <div class="px-4 py-4 text-white"> <a href="/">Go back</a> </div>
    </div>
</body>
</html>
