<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>edit page</title>
</head>
<body>
        <h1>Edit/Update</h1>
        <form action="{{route('movies.update',$booking->id)}}" method="post">
            @csrf
            @method('PUT')
            <label for="text">Name:</label>
            <input type="text" value="{{$booking->name}}" required>
            <label for="email">Email </label>
            <input type="email" value="{{$booking->email}}" required>
            <label for="seats">Seats</label>
            <input type="seats" value="{{$booking->seats}}" required>
            <button type="submit">Update</button>
        </form>
</body>
</html>