<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </style>
  </head>
    <body>
        <header class="font-candara">
            <nav class="text-red-900 text-2xl font-extrabold bg-orange-900/20 pb-3 flex justify-between">
                    <div class=" text-shadow-lg">
                        <h1>Movie Booking System</h1>
                    </div>
                     <div class="flex justify-around list-none ">
                    <li class=" hover:text-red-950 pl-2 ml-3 font-mono">
                        <a href="{{route('movies.list')}}" class="hover:cursor-pointer" type="submit">Movies</button>
                    </li>
                    <li class="hover:cursor-pointer hover:text-red-950 pl-2 ml-3 font-mono">
                        <a href="/schedule" class="hover:cursor-pointer" >Schedule </a>
                    </li>
                    <li class="hover:cursor-pointer hover:text-red-950 pl-2 ml-3 mr-3 font-mono">
                        <a class="hover:cursor-pointer" href="/services">Service</a>
                    </li>
                    </div>
                   
            </nav>
        </header>
    </body>
</html>
