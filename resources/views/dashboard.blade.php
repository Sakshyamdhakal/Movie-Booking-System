<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Welcome Card -->
        <div class="bg-gradient-to-r from-purple-500 to-blue-600 rounded-2xl shadow-xl p-8 mb-8 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold mb-2">🎬 Welcome back, {{ Auth::user()->name }}!
                    </h3>
                    <p class="text-purple-100 mb-4">Manage your movies and bookings with ease</p>
                    <div class="flex items-center gap-4">
                        <div class="bg-white bg-opacity-20 rounded-full px-4 py-2">
                            <span class="font-semibold">Role:</span>
                            @if(Auth::check())
                                @php
                                    $role = auth()->user()->role;
                                @endphp
                                @if ($role)
                                    <span class="text-green-300 font-bold">{{ ucfirst($role) }}</span>
                                @else
                                    <span class="text-red-300">No role assigned</span>
                                @endif
                            @else
                                <span class="text-yellow-300">Guest</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="text-6xl opacity-20">🎭</div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-green-500 to-teal-500 rounded-full p-3 mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Add New Movie</h4>
                        <p class="text-gray-600 text-sm">Create and publish movies</p>
                    </div>
                </div>
                <a href="/addmovies" class="mt-4 inline-block w-full bg-gradient-to-r from-green-500 to-teal-500 hover:from-green-600 hover:to-teal-600 text-white font-semibold py-2 px-4 rounded-lg text-center transition transform hover:scale-105">
                    Add Movie +
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-blue-500 to-purple-500 rounded-full p-3 mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900">View Analytics</h4>
                        <p class="text-gray-600 text-sm">Check your performance</p>
                    </div>
                </div>
                <button class="mt-4 w-full bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white font-semibold py-2 px-4 rounded-lg transition transform hover:scale-105">
                    View Stats
                </button>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-orange-500 to-red-500 rounded-full p-3 mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Settings</h4>
                        <p class="text-gray-600 text-sm">Manage your account</p>
                    </div>
                </div>
                <button class="mt-4 w-full bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white font-semibold py-2 px-4 rounded-lg transition transform hover:scale-105">
                    Settings
                </button>
            </div>
        </div>

        <!-- Movies Management -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-8 py-6 border-b flex gap-4">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    🎬 Your Movies
                    <span class="ml-2 bg-purple-100 text-purple-800 text-sm font-medium px-2.5 py-0.5 rounded-full">
                        {{ count($addmovie) }} movies
                    </span>
                </h2>
                <a href="/"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
</svg>
</a>
            </div>

            <div class="p-8">
                @forelse($addmovie as $movie)
                    <div class="bg-gradient-to-r from-white to-gray-50 rounded-xl shadow-md p-6 mb-6 hover:shadow-lg transition-shadow border border-gray-100">
                        <div class="flex flex-col md:flex-row md:items-center justify-between">
                            <div class="flex-1 mb-4 md:mb-0">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $movie->name }}</h3>
                                <p class="text-gray-600 mb-3 line-clamp-2">{{ $movie->description }}</p>
                                <div class="flex items-center gap-4 text-sm text-gray-500">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Added {{ $movie->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <a href="/edit/{{$movie->id}}"
                                   class="bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white font-semibold py-2 px-4 rounded-lg transition transform hover:scale-105 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{route('addmovie.destroy',$movie->id)}}" method="post" class="inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this movie?')"
                                            class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white font-semibold py-2 px-4 rounded-lg transition transform hover:scale-105 flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16">
                        <div class="text-6xl mb-4">🎭</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">No Movies Yet</h3>
                        <p class="text-gray-600 mb-6">Start building your movie collection by adding your first movie!</p>
                        <a href="/addmovies" class="bg-gradient-to-r from-purple-500 to-blue-500 hover:from-purple-600 hover:to-blue-600 text-white font-semibold py-3 px-6 rounded-lg transition transform hover:scale-105 inline-block">
                            Add Your First Movie
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
