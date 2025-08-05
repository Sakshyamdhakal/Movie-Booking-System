<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<p>Movie: {{ $booking->movie->name ?? 'Unknown' }}</p>
<p>Name: {{ $booking->name }}</p>
<p>Email: {{ $booking->email }}</p>
<p>Seats: {{ $booking->seats }}</p>
</body>
</html>