<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Book</title>
</head>
<body>
                    {{-- <h1 class="font-candara text-center">FILL THE FORM BELOW</h1>
        <div class="flex items-center justify-center">
            <form method="POST" class="w-100 h-fit font-sans border p-3 ">
            {{-- action="{{ route('movies.book', $movie->id) }}"> --}}
            {{-- <label for="name" required>Name</label>
            <input type="text" name="name" class="border p-2 w-full mb-3">

            <label for="email" required>E-mail</label>
            <input type="email" name="email" class="border p-2 w-full mb-3">

            <label for="seats">Seats</label>
            <input type="number" min="1" required>
            <button class="bg-gray-400 p-2 text-3xl cursor-pointer rounded-3xl"> <a href="/confirmation">Confirm booking</a> </button>
        </form>
        </div> --}}

<form  class="border w-100 h-fit flex flex-col bg-amber-100" method="POST" action="{{ route('movie.store', $movie->id) }}">
    @csrf 
    <h1 class="font-mono text-3xl text-center">Your Movie:{{$movie->name ?? 'Unknown'}}</h1>
    <label for="name" class="font-mono text-2xl">Name</label>
    <input class="h-fit p-4 bg-amber-50" type="text" placeholder="Enter name" name="name" required>

    <label for="email" class="font-mono text-2xl">Email</label>
    <input class="h-fit p-4 bg-amber-50" type="email" placeholder="examplemail@gmail.com" name="email" required>

    <label for="seats" class="font-mono text-2xl">Seats</label>
    <input class="h-fit p-3 bg-amber-50" type="number" name="seats" min="1" required>

    <button type="submit" class="hover:cursor-pointer p-3 rounded-2xl bg-amber-500 m-auto">Confirm Booking</button>
</form>

</body>
</html>