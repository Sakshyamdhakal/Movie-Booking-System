<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    {{-- <h1 class="text-5xl font-extrabold font-mono bg-amber-400/50 p-3">MOVIES LIST</h1>
    {{-- Movies-card-section --}}
    {{-- <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">

       <span>
         <div name="movie-card" class=" grid grid-rows-2 md:grid-rows-15 bg-gray-100/10 overflow-hidden rounded-lg shadow-lg hover:shadow-2xl w-80 h-100">
            <img src="{{ asset('images/Afterposter.jpg') }}" alt="image" class="w-full h-100 object-cover">
        </div>
            <button type="submit" class="bg-amber-300 p-2  rounded-b-lg"> <a href="/book">Book</a></button>
       </span>

        <span>
            <div name="movie-card" class=" grid grid-rows-2 md:grid-rows-15 bg-gray-400/10 rounded-lg w-80 h-100">
            <img src="{{ asset('images/archer-poster.jpg') }}" alt="image" class="w-full h-100 object-cover">
        </div>
            <button type="submit"  class="bg-amber-300 p-2  rounded-b-lg"><a href="/book">Book</a> </button>
        </span>

        <span>
            <div name="movie-card" class=" grid grid-rows-2 md:grid-rows-15 bg-gray-400/10 rounded-lg w-80 h-100">
            <img src="{{ asset('images/marcoposter.jpg') }}" alt="image" class="w-full h-100 object-cover">
        </div>
          <button type="submit"  class="bg-amber-300 p-2  rounded-b-lg"><a href="/book">Book</a> </button>
        </span>

        <span>
            <div name="movie-card" class="grid grid-rows-2 md:grid-rows-15 bg-gray-400/10 rounded-lg w-80 h-100">
            <img src="{{ asset('images/thecreatorposter.jpg') }}" alt="image" class="w-full h-100 object-cover">
        </div>
            <button type="submit" class="bg-amber-300 p-2  rounded-b-lg"> <a href="/book">Book</a></button>
        </span>

    </div> --}}

    <h1 class="text-5xl">Movies</h1>
@foreach($movies as $movie)
  <div class="flex flex-col">
    <span  class="font-mono text-2xl mt-2.5">{{ $movie->title }}</span>
    <a class="hover:cursor-pointer p-3 rounded-2xl bg-amber-500 m-auto" href="{{ route('movies.book', $movie,$movie->title) }}">Book Now</a>
  </div>
@endforeach

</body>
</html>