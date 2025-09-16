<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>Movie Booking System</title>
    <style>
        .movie-card {
            background: linear-gradient(135deg, #1c1c1c 0%, #111 100%);
            border: 1px solid rgba(255, 215, 0, 0.3); /* gold border */
            backdrop-filter: blur(10px);
        }
        .movie-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(255, 215, 0, 0.4); /* gold shadow */
        }
        .gradient-bg {
            background: linear-gradient(135deg, #ffd700 0%, #b8860b 100%); /* gold gradient */
        }
        .hero-section {
            background: linear-gradient(135deg, #000 0%, #1c1c1c 50%, #222 100%);
            min-height: 60vh;
        }
        .floating-animation {
            animation: float 4s ease-in-out infinite;
        }
        
        @keyframes float {
          0% { transform: translateY(0px); }
          50% { transform: translateY(-10px); }
          100% { transform: translateY(0px); }
}
    </style>
</head>
<body class="min-h-screen bg-black text-white">
    @if(session('error'))
        <div class="bg-red-700 text-white p-4 m-4 rounded-xl shadow-lg animate-pulse">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-700 text-white px-6 py-4 m-4 rounded-xl shadow-lg animate-pulse">
            {{ session('success') }}
        </div>
    @endif

    <!-- Hero Section -->
    <div class="hero-section relative overflow-hidden">
    <!-- Dark gradient overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-black via-gray-900 to-black opacity-80"></div>

    <!-- Background movie poster -->
    <div class="absolute inset-0" 
        style="background-image: url('https://collider.com/wp-content/uploads/inception_movie_poster_banner_01.jpg'); 
               background-size: cover; 
               background-position: center; 
               opacity: 0.25;">
    </div>

    <!-- Subtle spotlight glow behind text -->
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="w-96 h-96 bg-yellow-500 rounded-full blur-3xl opacity-10"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 py-28 text-center">
        <h1 class="text-6xl md:text-7xl font-extrabold font-mono mb-6 floating-animation text-yellow-400 drop-shadow-[0_0_20px_rgba(0,0,0,0.9)]">
            Book Your Favourite Movie Ticket 🎥
        </h1>
        <p class="text-xl md:text-2xl mb-10 text-gray-300 opacity-90 drop-shadow-[0_0_10px_black]">
            Discover amazing movies and book your tickets instantly
        </p>

        <!-- Buttons -->
        <div class="flex justify-center gap-6">
            <a href="#movies" 
               class="bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-700 hover:from-yellow-500 hover:to-yellow-800 text-black px-10 py-4 border-2 border-yellow-500 rounded-full font-bold transition-all transform hover:scale-110 shadow-lg shadow-black">
                🎬 Explore Movies
            </a>
            @if(!Auth::check())
                <a href="{{ route('login') }}" 
                   class="bg-black/40 hover:bg-black/60 text-yellow-300 px-10 py-4 rounded-full font-semibold transition backdrop-blur-md shadow-lg shadow-black">
                    🚀 Get Started
                </a>
            @endif
        </div>
    </div>

    <!-- Bottom black fade -->
    <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-black to-transparent"></div>
</div>

<!-- Floating Animation -->
<style>
@keyframes float {
  0% { transform: translateY(0px); }
  50% { transform: translateY(-10px); }
  100% { transform: translateY(0px); }
}
.floating-animation {
  animation: float 4s ease-in-out infinite;
}
</style>


    <!-- Navigation -->
    <nav class="sticky top-0 z-50 bg-gray-900 bg-opacity-95 backdrop-blur-lg shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4 flex flex-wrap items-center justify-between">
            <a href="#" class="text-2xl font-bold text-yellow-400">
                🎭 SDBS
            </a>

            <form action="{{ route('landingpage') }}" class="flex-1 max-w-lg mx-8">
                <div class="relative">
                    <input type="search" name="search" value="{{ request('search') }}"
                           placeholder="Search amazing movies..."
                           class="w-full bg-black border border-yellow-500 text-yellow-300 rounded-full py-3 px-10 pr-12 focus:outline-none focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400 transition-all duration-500" />
                    <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-yellow-300 hover:text-yellow-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </form>

            <div class="hidden lg:flex items-center justify-center gap-6">
                <a href="#movies" class="text-yellow-500 hover:text-yellow-600 hover:border-b font-medium transition-all pb-3">Movies</a>
                <a href="#" class="text-yellow-500 hover:text-yellow-600 hover:border-b font-medium transition pb-3">Bookings</a>
                <a href="#" class="text-yellow-500 hover:text-yellow-600 hover:border-b pb-3 font-medium transition">Schedule</a>
                @if(Auth::check())
                    <button class="cursor-pointer hover:bg-gradient-to-r from-yellow-500 to-yellow-700 hover:text-black bg-black text-yellow-600 border border-yellow-400 text-black px-6 py-2 rounded-full font-semibold shadow-lg hover:shadow-xl transition transform hover:scale-105">
                        <a href="{{route('movie.ticket')}}">Your Ticket</a>
                    </button>
                      @if (auth()->user()->role== 'admin')
                        <a href="/dashboard" class="cursor-pointer hover:bg-gradient-to-r from-yellow-500 to-yellow-700 hover:text-black bg-black text-yellow-600 border border-yellow-400 text-black px-6 py-2 rounded-full font-semibold shadow-lg hover:shadow-xl transition transform hover:scale-105">
                            Go to Dashboard
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="cursor-pointer bg-yellow-600 hover:bg-yellow-700 text-black px-6 py-2 rounded-full font-semibold shadow-lg hover:shadow-xl transition transform hover:scale-105">
                        Login
                    </a>
                @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="cursor-pointer bg-red-600 hover:text-red-500 border border-red-500 hover:bg-black text-black px-6 py-2 rounded-full font-semibold shadow-lg hover:shadow-xl transition transform hover:scale-105">
                            Logout
                        </button>
                    </form>     
            </div>
        </div>
    </nav>

    <!-- Movies Section -->
    <section id="movies" class="py-16 bg-black">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-yellow-400 mb-4">🎬 Featured Movies</h2>
                <p class="text-gray-300 text-lg">Choose from our amazing collection of movies</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($addmovie as $movie)
                    <div class="movie-card rounded-2xl shadow-xs overflow-hidden transition-all duration-500 group">
                        <!-- Image -->
                        <div class="relative h-72 overflow-hidden">
                            <img src="{{ asset('images/' . $movie->image) }}"
                                 alt="{{ $movie->name }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute bottom-0 left-4 right-4 text-yellow-400 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                <h3 class="text-lg font-bold">{{ $movie->name }}</h3>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-yellow-400 mb-3 group-hover:text-yellow-300 transition">{{ $movie->name }}</h3>
                            <p class="text-gray-300 text-sm mb-6 h-17 line-clamp-3 leading-relaxed">{{ $movie->description }}</p>

                            <div class="flex gap-3">
                                <form action="{{ route('movie.details', $movie->id) }}" method="GET" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full cursor-pointer bg-yellow-500 hover:bg-yellow-600 text-black py-3 px-4 rounded-xl font-semibold shadow-lg hover:shadow-xl transition transform hover:scale-105">
                                        Details
                                    </button>
                                </form>
                                <form action="{{ route('movies.book', $movie->id) }}" method="GET" class="flex-1">
                                    @csrf
                                    <button type="submit" class="flex gap-3 items-center cursor-pointer justify-center w-fit bg-yellow-500 hover:bg-yellow-600 text-black py-3 px-4 rounded-xl font-semibold shadow-lg hover:shadow-xl transition transform hover:scale-105">
                                        Book Now
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <div class="text-6xl mb-4">🎭</div>
                        <h3 class="text-2xl font-bold text-yellow-400 mb-2">No Movies Available</h3>
                        <p class="text-gray-300">Check back later for amazing movie releases!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <div>

    </div>

    <!-- Footer -->
    <footer class="bg-black text-yellow-400 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="mb-6">
                <h3 class="text-2xl font-bold mb-2">🎬 Movie Booking System</h3>
                <p class="text-gray-400">Your ultimate destination for movie entertainment</p>
            </div>
            <div class="border-t border-yellow-600 pt-6">
                <p class="text-gray-500">&copy; 2024 Movie Booking System. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
