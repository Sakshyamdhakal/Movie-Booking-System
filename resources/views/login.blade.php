<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <form action="{{ route('user.login') }}" method="POST" class="bg-white p-8 rounded shadow-md w-full max-w-md space-y-4">
        @csrf
        <h2 class="text-2xl font-bold text-center text-gray-700">Signup</h2>

        <div>
            <label for="name" class="block text-sm font-semibold text-gray-600">Name</label>
            <input type="text" name="name" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold text-gray-600">Email</label>
            <input type="email" name="email" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-gray-600">Password</label>
            <input type="password" name="password" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">Sign Up</button>
    </form>
    @if ($errors->any())
  <div>
    <ul>
      @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif


</body>
</html>
