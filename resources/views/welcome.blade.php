<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Document</title>
</head>
<body>
    <nav class="block w-full max-w-screen-lg px-4 py-2 mx-auto bg-white bg-opacity-90 sticky top-3 shadow lg:px-8 lg:py-3 backdrop-blur-lg backdrop-saturate-150 z-[9999]">
  <div class="container flex flex-wrap items-center justify-between mx-auto text-slate-800">
    <a href="#"
      class="mr-4 block cursor-pointer py-1.5 text-base text-slate-800 font-semibold">
      Movie Booking System
    </a>
    <input type="search" name="search" value="" placeholder="Search for Movies" class=" border border-gray-300 rounded-full py-2 pl-10 pr-4 focus:outline-none focus:ring-0.2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm"
>
    <div class="hidden lg:block">
      <ul class="flex flex-col gap-2 mt-2 mb-4 lg:mb-0 lg:mt-0 lg:flex-row lg:items-center lg:gap-6">
        <li class="flex items-center p-1 text-sm gap-x-2 text-slate-600">
          <a class="flex items-center">Movies</a>
        </li>
        <li class="flex items-center p-1 text-sm gap-x-2 text-slate-600">
          <a href="#" class="flex items-center">Bookings</a>
        </li>
        <li class="flex items-center p-1 text-sm gap-x-2 text-slate-600">
          <a href="#" class="flex items-center">Schedule</a>
        </li>
        <li class="flex items-center p-1 text-sm gap-x-2 text-slate-600">
          <a href="#" class="flex items-center bg-gray-500 p-2 text-white rounded-sm">Login</a>
        </li>
      </ul>
    </div>
    <button
      class="relative ml-auto h-6 max-h-[40px] w-6 max-w-[40px] select-none rounded-lg text-center align-middle text-xs font-medium uppercase text-inherit transition-all hover:bg-transparent focus:bg-transparent active:bg-transparent disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none lg:hidden"
      type="button">
      <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </span>
    </button>
  </div>
</nav>

<div class="flex align-middle justify-center mt-14 font-extrabold text-yellow-500 font-sans text-3xl border-b-2 border-zinc-500 ml-3 mr-3">
    <h1 class="mb-4">Movies</h1>
</div>
        {{-- @foreach($addmovie as $movie)
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
        @foreach($addmovie as $movie)
  <div class="flex flex-col border-red-100">
    <span  class="font-mono text-2xl mt-2.5">{{ $movie->name }}</span>
        <span  class="font-mono text-2xl mt-2.5">{{ $movie->description }}</span>
    <a class="hover:cursor-pointer p-3 rounded-2xl bg-amber-500 w-fit" href="{{ route('movies.book', $movie,$movie->name) }}">Book Now</a>
  </div>
@endforeach
            <form action="{{route('addmovie.destroy',$movie->id)}}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="hover:cursor-pointer">Delete</button>
        </form>
    </div>
    
@endforeach --}}


   <div class="p-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 h-110">
        @forelse($addmovie as $movie)
            <div class="bg-white hover:cursor-pointer rounded-xl shadow-md hover:shadow-2xl transition duration-300 max-w-sm mx-auto flex flex-col">
                <!-- Image -->
                <div class="h-60 w-full">
                    <img src="{{ asset('storage/' . $movie->image) }}"
                        alt="{{ $movie->name }}"
                        class="h-full w-full object-cover" />
                </div>

                <!-- Content -->
                <div class="p-4 flex flex-col flex-grow">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $movie->name }}</h2>
                    <span class="text-2xl text-yellow-400 font-semibold font-mono">Description</span>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-8 h-40 overflow-hidden">{{ $movie->description }}</p>

                    <form action="{{ route('movie.details', $movie->id) }}" method="POST" class="mt-auto">
                        @csrf
                        <button type="submit" class="hover:cursor-pointer bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                            See more
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-center col-span-4">No movies found.</p>
        @endforelse
    </div>
</div>

</body>
</html>