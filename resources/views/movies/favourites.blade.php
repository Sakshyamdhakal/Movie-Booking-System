
<div class="max-w-6xl mx-auto py-10">
    <h2 class="text-3xl font-bold text-yellow-400 mb-6">⭐ Your Favorite Movies</h2>

    @if($favorites->isEmpty())
        <p class="text-gray-400">No favorite movies yet!</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($favorites as $fav)
                <div class="movie-card rounded-2xl p-6 shadow-lg">
                    <img src="{{ asset('images/' . $fav->movie->image) }}" class="rounded-xl mb-4">
                    <h3 class="text-xl font-bold text-yellow-400">{{ $fav->movie->name }}</h3>
                    <p class="text-gray-300">{{ $fav->movie->description }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
