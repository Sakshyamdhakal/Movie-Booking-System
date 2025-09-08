<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>Movies List - Movie Booking System</title>
    <style>
        .movie-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }
        .movie-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
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
        <div class="absolute inset-0 bg-gradient-to-br from-black via-gray-900 to-black opacity-40"></div>
        <div class="absolute inset-0" style="background-image: url('https://collider.com/wp-content/uploads/inception_movie_poster_banner_01.jpg'); background-size: cover; background-position: center; opacity: 0.3;"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 py-16">
            <div class="text-center text-white">
                <h1 class="text-5xl font-bold mb-4 floating-animation">
                    🎬 Movie Collection
                </h1>
                <p class="text-xl opacity-90">
                    Discover our amazing collection of movies
                </p>
            </div>
        </div>
    </div>

    <!-- Movies Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">🎭 Available Movies</h2>
                <p class="text-gray-400 text-lg">Choose from our amazing collection of movies</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($movies as $movie)
                    <div class="movie-card rounded-2xl shadow-lg overflow-hidden transition-all duration-500 group">
                        <!-- Image -->
                        <div class="relative h-72 overflow-hidden">
                            @if($movie->image)
                                <img src="{{ asset('storage/' . $movie->image) }}"
                                     alt="{{ $movie->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-purple-400 to-blue-500 flex items-center justify-center">
                                    <span class="text-white text-6xl">🎬</span>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute bottom-4 left-4 right-4 text-white transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                <h3 class="text-lg font-bold">{{ $movie->name }}</h3>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-purple-600 transition">{{ $movie->name }}</h3>
                            <p class="text-gray-600 text-sm mb-6 line-clamp-3 leading-relaxed">{{ $movie->description ?? 'Experience the magic of cinema with this amazing movie.' }}</p>

                            <div class="text-center">
                                <a href="{{ route('movies.book', $movie->id) }}"
                                   class="bg-gradient-to-r from-green-500 to-teal-500 hover:from-green-600 hover:to-teal-600 text-white py-3 px-6 rounded-xl font-semibold shadow-lg hover:shadow-xl transition transform hover:scale-105 inline-block">
                                    🎟️ Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <div class="text-6xl mb-4">🎭</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">No Movies Available</h3>
                        <p class="text-gray-600">Check back later for amazing movie releases!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="mb-6">
                <h3 class="text-2xl font-bold mb-2">🎬 Movie Booking System</h3>
                <p class="text-gray-400">Your ultimate destination for movie entertainment</p>
            </div>
            <div class="border-t border-gray-800 pt-6">
                <p class="text-gray-500">&copy; 2024 Movie Booking System. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
