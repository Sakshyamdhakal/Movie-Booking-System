<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Movie</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen px-4 bg-gray-800">

  <div class="absolute inset-0 bg-cover bg-center filter blur-xs opacity-30" style="background-image: url('https://collider.com/wp-content/uploads/inception_movie_poster_banner_01.jpg'); z-index: -1;"></div>

  <div class="bg-black rounded-2xl shadow-xl p-8 w-full max-w-lg border border-gray-700 relative overflow-hidden">
    <div class="relative z-10">
       <a href="/dashboard" class="text-yellow-400 flex items-center justify-end rounded-full font-semibold overflow-hidden hover:text-yellow-300 transition">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hover:bg-yellow-400 hover:text-black transition rounded-full p-1">
            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
        </a>
        
      <div class="text-center mb-8">
         <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-full mb-4">
          <svg class="w-8 h-8 text-black" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 2L3 7v11a2 2 0 002 2h10a2 2 0 002-2V7l-7-5z"/>
          </svg>
        </div>
        <h2 class="text-3xl font-bold text-white mb-2">🎬 Add New Movie</h2>
        <p class="text-yellow-400">Expand our movie collection</p>
      </div>

      <form action="/submitmovie" method="POST" class="space-y-6" enctype="multipart/form-data">
        @csrf

        <div class="space-y-2">
          <label for="name" class="flex items-center text-sm font-semibold text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-yellow-400">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 0 1-1.125-1.125M3.375 19.5h1.5C5.496 19.5 6 18.996 6 18.375m-3.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-1.5A1.125 1.125 0 0 1 18 18.375M20.625 4.5H3.375m17.25 0c.621 0 1.125.504 1.125 1.125M20.625 4.5h-1.5C18.504 4.5 18 5.004 18 5.625m3.75 0v1.5c0 .621.504 1.125 1.125 1.125M3.375 4.5c-.621 0-1.125.504-1.125 1.125M3.375 4.5h1.5C5.496 4.5 6 5.004 6 5.625m-3.75 0v1.5c0 .621.504 1.125 1.125 1.125m0 0h1.5m-1.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m1.5-3.75C5.496 8.25 6 7.746 6 7.125v-1.5M4.875 8.25C5.496 8.25 6 8.754 6 9.375v1.5m0-5.25v5.25m0-5.25C6 5.004 6.504 4.5 7.125 4.5h9.75c.621 0 1.125.504 1.125 1.125m1.125 2.625h1.5m-1.5 0A1.125 1.125 0 0 1 18 7.125v-1.5m1.125 2.625c-.621 0-1.125.504-1.125 1.125v1.5m2.625-2.625c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125M18 5.625v5.25M7.125 12h9.75m-9.75 0A1.125 1.125 0 0 1 6 10.875M7.125 12C6.504 12 6 12.504 6 13.125m0-2.25C6 11.496 5.496 12 4.875 12M18 10.875c0 .621-.504 1.125-1.125 1.125M18 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m-12 5.25v-5.25m0 5.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125m-12 0v-1.5c0-.621-.504-1.125-1.125-1.125M18 18.375v-5.25m0 5.25v-1.5c0-.621.504-1.125 1.125-1.125M18 13.125v1.5c0 .621.504 1.125 1.125 1.125M18 13.125c0-.621.504-1.125 1.125-1.125M6 13.125v1.5c0 .621-.504 1.125-1.125 1.125M6 13.125C6 12.504 5.496 12 4.875 12m-1.5 0h1.5m-1.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M19.125 12h1.5m0 0c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h1.5m14.25 0h1.5" />
            </svg>
            Movie Name
          </label>
          <div class="relative">
            <input type="text" name="name" id="name" placeholder="Enter movie name"
              class="w-full pl-4 pr-4 py-3 border-2 border-gray-600 bg-gray-900 text-white rounded-lg focus:outline-none focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all placeholder-gray-400" required />
          </div>
        </div>

        <div class="space-y-2">
          <label for="description" class="flex items-center text-sm font-semibold text-white">
            <svg class="w-5 h-5 mr-2 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
            </svg>
            Description
          </label>
          <textarea name="description" id="description" rows="4" placeholder="Write a short description"
            class="w-full px-4 py-3 border-2 border-gray-600 bg-gray-900 text-white rounded-lg focus:outline-none focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all resize-none placeholder-gray-400"></textarea>
        </div>

        <div class="space-y-2">
          <label for="image" class="flex items-center text-sm font-semibold text-white">
            <svg class="w-5 h-5 mr-2 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
            </svg>
            Upload Image
          </label>
          <div class="relative">
            <input type="file" name="image" id="image" accept="image/*"
              class="w-full px-4 py-3 border-2 border-gray-600 bg-gray-900 text-white rounded-lg focus:outline-none focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-medium file:bg-yellow-400 file:text-black hover:file:bg-yellow-500" required />
          </div>
        </div>

        <div class="pt-4">
          <button type="submit"
            class="w-full bg-gradient-to-r from-yellow-400 to-yellow-600 hover:from-yellow-500 hover:to-yellow-700 text-black py-3 px-6 rounded-lg font-bold transition-all duration-300 transform hover:scale-105 shadow-xl flex items-center justify-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
            </svg>
            Add Movie
          </button>
        </div>
      </form>

      <div class="mt-4 text-center">
      </div>
    </div>
  </div>
</body>
</html>