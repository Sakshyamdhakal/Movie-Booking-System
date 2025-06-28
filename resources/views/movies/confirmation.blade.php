<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Confirmation</title>
</head>
<body>
    {{-- <h1 class="text-5xl font-extrabold font-mono bg-amber-400/50 p-3">Booking confirmed</h1>
        <p><strong>Movie:</strong> {{$movie->title}} </p>
        <p><strong>Name:</strong> {{$booking->name}} </p>
        <p><strong>E-mail</strong> {{$booking->email}} </p>
        <p><strong>Seat</strong> {{$booking->seat}} </p>
        <a href="/">Back To HomePage</a> --}}

        <div class="border font-sans w-fit h-fit flex flex-col p-5 pt-0.5 text-center m-auto mt-60 bg-amber-600/10">
            <h1>Movie Ticket</h1>
            <h1>Movie:{{ $booking->movie->title }}</h1>
    <p>Name: {{ $booking->name }}</p>
    <p>Email: {{ $booking->email }}</p>
    <p>Seats: {{ $booking->seats }}</p>

            </div>
    <div class="flex justify-center align-middle">
        <form method="POST" action="{{ route('movies.destroy', $booking) }}">
    @csrf @method('DELETE')
    <button type="submit" class="hover:cursor-pointer ml-5 hover:shadow-lg p-3">Delete Booking</button>
</form>
<a class="ml-5 hover:shadow-lg p-3" href="{{ route('movies.index') }}">Back to Movies</a>
<a class="ml-5 hover:shadow-lg p-3" href="/bookings/{{$booking->id}}/edit">Edit/Update</a>
    </div>
</body>
</html>