<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>{{ $movie->name }} | Movie Details</title>
@vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gradient-to-br from-black via-gray-900 to-black text-gray-200 relative">

<!-- Background Accent (subtle spotlight effect) -->
<div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(255,215,0,0.08),transparent_70%)]"></div>

<!-- Container -->
<div class="relative max-w-5xl mx-auto px-6 py-16">
  
  <!-- Header -->
  <h1 class="text-5xl font-extrabold text-yellow-400 drop-shadow-[0_0_20px_rgba(255,215,0,0.7)] mb-12 text-center tracking-wide">
    {{ $movie->name }}
  </h1>

  <!-- Movie Info Card -->
  <div class="bg-black/60 backdrop-blur-md rounded-3xl shadow-2xl border border-yellow-900/40 overflow-hidden flex flex-col md:flex-row transition transform hover:scale-[1.01] duration-300">
    
    <!-- Poster -->
    <div class="md:w-1/3 flex items-center justify-center bg-gradient-to-b from-gray-900 to-black p-4">
      <img src="{{ asset('images/' . $movie->image) }}" 
           alt="Movie Poster" 
           class="max-w-xs max-h-96 object-cover rounded-2xl shadow-lg shadow-black border-2 border-yellow-500/80">
    </div>

    <!-- Details -->
    <div class="p-10 md:w-2/3 flex flex-col justify-between">
      <div>
        <h2 class="text-3xl font-bold text-yellow-300 mb-4 drop-shadow-[0_0_10px_rgba(255,215,0,0.5)]">
          {{ $movie->name }}
        </h2>
        <p class="text-gray-400 mb-2">
          <span class="font-semibold text-yellow-500">Genre:</span> {{ $movie->genre ?? 'N/A' }}
        </p>
        <p class="text-gray-400 mb-2">
          <span class="font-semibold text-yellow-500">Release Date:</span>
          {{ $movie->release_date ? \Carbon\Carbon::parse($movie->release_date)->format('M d, Y') : 'N/A' }}
        </p>
        <p class="text-gray-400 mb-6">
          <span class="font-semibold text-yellow-500">Duration:</span> {{ $movie->duration ?? 'N/A' }} mins
        </p>
        <h3 class="text-xl font-semibold text-yellow-400 mb-3">Synopsis</h3>
        <p class="text-gray-300 leading-relaxed">
          {{ $movie->description ?? 'No description available for this movie.' }}
        </p>
      </div>

      <!-- Book Button -->
      <div class="mt-8">
        <a href="{{ route('movie.ticket', $movie->id) }}"
           class="inline-flex gap-2 text-gray-200 bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 hover:from-yellow-500 hover:to-yellow-700 text-black px-10 py-4 rounded-full font-extrabold shadow-lg shadow-yellow-900/50 transition transform hover:scale-110 hover:shadow-yellow-500/40">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
</svg>

          Book Ticket
        </a>
        
      </div>
            <div class="flex items-center justify-end mt-3">
                <a href="/" class="bg-gradient-to-r from-yellow-400 to-yellow-600 hover:from-yellow-500 hover:to-yellow-700 text-black font-semibold py-3 px-8 rounded-lg transition transform hover:scale-105 inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Go Back to Home
                </a>
            </div>
    </div>
    
  </div>
  
</div>

</body>
</html>
