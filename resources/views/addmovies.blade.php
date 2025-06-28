<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
   <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Movie</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen px-4">

  <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Add New Movie</h2>

    <form action="/submitmovie" method="POST" class="space-y-5" enctype="multipart/form-data">
      @csrf

      <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Movie Name</label>
        <input type="text" name="name" id="name" placeholder="Enter movie name"
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" />
      </div>

      <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea name="description" id="description" rows="4" placeholder="Write a short description"
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"></textarea>
      </div>
            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Upload Image</label>
        <input type="file" name="image" alt="image">
      <button type="submit"
        class="w-full bg-orange-500 text-white py-2 px-4 rounded-md hover:bg-orange-600 transition-all">
        Add Movie
      </button>
    </form>
</body>
</html>