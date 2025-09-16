<x-app-layout>
    <div class="py-12 w-full mx-auto sm:px-6 lg:px-8 bg-gray-800 min-h-screen">
        <div class="bg-black rounded-2xl shadow-xl p-8 text-white max-w-2xl mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-yellow-400 mb-2">🎬 Edit Movie</h1>
                <p class="text-gray-300">Update the movie details below</p>
            </div>

            @if($movie->image)
                <div class="mb-6 text-center">
                    <h3 class="text-lg font-semibold text-yellow-400 mb-4">Current Poster</h3>
                    <img src="{{ asset('images/' . $movie->image) }}" alt="Current Image" class="max-w-xs max-h-96 object-cover rounded-lg shadow-lg mx-auto border-2 border-yellow-500">
                </div>
            @endif

            <form action="{{ route('movies.updateMovie', $movie->id) }}" method="post" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-yellow-400 mb-2">Movie Name</label>
                    <input type="text" name="name" value="{{ $movie->name }}" required
                           class="w-full bg-gray-700 border border-yellow-500 text-yellow-300 rounded-lg py-3 px-4 focus:outline-none focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400 transition">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-yellow-400 mb-2">Description</label>
                    <textarea name="description" rows="4" class="w-full bg-gray-700 border border-yellow-500 text-yellow-300 rounded-lg py-3 px-4 focus:outline-none focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400 transition">{{ $movie->description }}</textarea>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-yellow-400 mb-2">New Poster Image <span class="text-gray-400">(leave empty to keep current)</span></label>
                    <input type="file" name="image" accept="image/*"
                           class="w-full bg-gray-700 border border-yellow-500 text-yellow-300 rounded-lg py-3 px-4 focus:outline-none focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400 transition file:bg-yellow-500 file:text-black file:border-none file:rounded file:px-3 file:py-1 file:mr-3 file:font-semibold hover:file:bg-yellow-600">
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-yellow-400 to-yellow-600 hover:from-yellow-500 hover:to-yellow-700 text-black font-semibold py-3 px-6 rounded-lg transition transform hover:scale-105 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Movie
                    </button>
                    <a href="{{ route('dashboard') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-3 px-6 rounded-lg transition transform hover:scale-105 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Dashboard
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
