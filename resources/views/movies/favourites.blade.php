<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>My Favorites - Movie Booking System</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
    function removeFromFavorites(movieId) {
        if (!confirm('Are you sure you want to remove this movie from your favorites?')) {
            return;
        }

        fetch(`/movies/${movieId}/favorite`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => {
                    throw new Error(err.error || 'Network response was not ok');
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'removed') {
                console.log('Movie removed from favorites');
                // Remove the movie card from the page
                const movieCard = document.querySelector(`[data-movie-id="${movieId}"]`);
                if (movieCard) {
                    movieCard.style.transition = 'all 0.3s ease';
                    movieCard.style.opacity = '0';
                    movieCard.style.transform = 'scale(0.8)';
                    setTimeout(() => {
                        movieCard.remove();
                        // Check if no favorites are left
                        const remainingCards = document.querySelectorAll('.movie-card');
                        if (remainingCards.length === 0) {
                            location.reload(); // Reload to show empty state
                        }
                    }, 300);
                }
            } else if (data.error) {
                alert('Error: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error removing favorite:', error);
            alert('Error removing movie from favorites: ' + error.message + '. Please try again.');
        });
    }
    </script>

    <style>
        .movie-card {
            background: linear-gradient(135deg, #1c1c1c 0%, #111 100%);
            border: 1px solid rgba(255, 215, 0, 0.3);
            backdrop-filter: blur(10px);
        }
        .movie-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(255, 215, 0, 0.4);
        }
        .gradient-bg {
            background: linear-gradient(135deg, #ffd700 0%, #b8860b 100%);
        }
        .hero-section {
            background: linear-gradient(135deg, #000 0%, #1c1c1c 50%, #222 100%);
            min-height: 60vh;
        }
    </style>
</head>
<body class="min-h-screen bg-black text-white">
    <!-- Navigation -->
    <nav class="sticky top-0 z-50 bg-gray-900 bg-opacity-95 backdrop-blur-lg shadow-lg">
        <div class="max-w-7xl mx-auto px-10 py-4 flex flex-wrap items-center justify-between">
            <a href="{{ route('landingpage') }}" class="text-2xl font-bold text-yellow-400">
                🎭 SDBS
            </a>

            <div class="hidden lg:flex items-center justify-center gap-6">
                <a href="{{ route('landingpage') }}#movies" class="text-yellow-500 hover:text-yellow-600 hover:border-b font-medium transition-all pb-3">Movies</a>
                <a href="{{ route('landingpage') }}#movies" class="text-yellow-500 hover:text-yellow-600 hover:border-b pb-3 font-medium transition">Schedule</a>
                <a href="{{ route('movies.favorites') }}" class="text-yellow-300 border-b-2 border-yellow-400 pb-3 font-medium transition">Favourites</a>
                @if(Auth::check())
                    <a href="{{route('movie.ticket')}}">
                        <button class="cursor-pointer relative flex gap-1 hover:bg-gradient-to-r from-yellow-500 to-yellow-700 hover:text-black bg-black text-yellow-600 border border-yellow-400 text-black px-6 py-2 rounded-full font-semibold shadow-lg hover:shadow-xl transition transform hover:scale-105">
                            Your Ticket
                            @if ($totalBookings ?? false)
                                <div class="w-5 h-5 top-0 right-0 bg-yellow-600 absolute flex items-center justify-center rounded-full">
                                <p class="text-white"> {{$totalBookings}}</p>
                            </div>
                            @endif
                        </button>
                    </a>
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
                    <div>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="group inline-flex items-center px-3 py-2 border border border-yellow-400 hover:bg-gray-400 text-sm leading-4 font-medium rounded-md hover:bg-gradient-to-r from-yellow-500 to-yellow-700 hover:text-black bg-black text-yellow-600 border border-yellow-400 text-black dark:text-gray-400 cursor-pointer dark:bg-transparent focus:outline-none transition ease-in-out duration-150">
                            <div class="text-yellow-600 group-hover:text-black">{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>

    <!-- Favorites Section -->
    <section class="py-16 bg-black">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-yellow-400 mb-4">⭐ Your Favorite Movies</h2>
                <p class="text-gray-100 text-lg">Your personally curated collection of amazing movies</p>

            </div>

            @if($favorites->isEmpty())
                <div class="text-center py-16">
                    <div class="text-6xl mb-4">💔</div>
                    <h3 class="text-2xl font-bold text-yellow-400 mb-2">No Favorite Movies Yet</h3>
                    <p class="text-gray-300 mb-6">Start exploring and add some movies to your favorites!</p>
                    <a href="{{ route('landingpage') }}#movies"
                       class="inline-flex gap-3 bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-700
                               hover:from-yellow-500 hover:to-yellow-800 text-black px-8 py-4 border-2 border-yellow-500
                               rounded-full font-bold transition-transform duration-300 transform origin-left
                               hover:scale-x-105 shadow-lg shadow-black">
                        Explore Movies
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                        </svg>
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($favorites as $fav)
                        <div class="movie-card rounded-2xl shadow-xs overflow-hidden transition-all duration-500 group" data-movie-id="{{ $fav->movie->id }}">
                            <!-- Image -->
                            <div class="relative h-72 overflow-hidden">
                                <img src="{{ asset('images/' . $fav->movie->image) }}"
                                     alt="{{ $fav->movie->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                                <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="absolute bottom-0 left-4 right-4 text-yellow-400 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                    <h3 class="text-lg font-bold">{{ $fav->movie->name }}</h3>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-yellow-400 mb-3 group-hover:text-yellow-300 transition">{{ $fav->movie->name }}</h3>
                                <p class="text-gray-300 text-sm mb-6 h-17 line-clamp-3 leading-relaxed">{{ $fav->movie->description }}</p>

                                <div class="flex flex-wrap gap-3 justify-between items-center">
                                    <form action="{{ route('movie.details', $fav->movie->id) }}" method="GET" class="flex-1 min-w-0">
                                        @csrf
                                        <button type="submit" class="w-full cursor-pointer bg-yellow-500 hover:bg-yellow-600 text-black py-3 px-2 rounded-xl font-semibold shadow-lg hover:shadow-xl transition transform hover:scale-105">
                                            Details
                                        </button>
                                    </form>
                                    <form action="{{ route('movies.book', $fav->movie->id) }}" method="GET" class="flex-1 min-w-0">
                                        @csrf
                                        <button type="submit" class="flex gap-3 items-center cursor-pointer justify-center w-full bg-yellow-500 hover:bg-yellow-600 text-black py-3 px-2 rounded-xl font-semibold shadow-lg hover:shadow-xl transition transform hover:scale-105">
                                            Book Now
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 30 30" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                            </svg>
                                        </button>
                                    </form>
                                    <button onclick="removeFromFavorites({{ $fav->movie->id }})"
                                            class="flex gap-2 items-center cursor-pointer bg-red-500 hover:bg-red-600 text-white py-3 px-4 rounded-xl font-semibold shadow-lg hover:shadow-xl transition transform hover:scale-105">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                        
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

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
