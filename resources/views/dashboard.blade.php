<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ ('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ ("You're logged in!") }}
                   <h1 class="text-white">You are Logged in as
    @if(Auth::check())
        @php
            $role = auth()->user()->role;
        @endphp

        @if ($role)
            <strong class="text-green-600">{{ ucfirst($role) }}!</strong>
        @else
            <strong class="text-red-500">No role assigned</strong>
        @endif
    @else
        <strong class="text-yellow-500">Guest (not logged in)</strong>
    @endif
</h1>
                </div>
            </div>
        </div>
        
    </div>

    <div class="ml-10 border-2 border-white px-4 py-2 bg-orange-500 text-white rounded-lg shadow hover:bg-orange-600 transition">
                <button >
                    <h1>Operations</h1>
            <a href="/addmovies">Add Movies +</a>
        </button>               

    <div class="mt-5 flex flex-col align-middle justify-center m-auto"> 
        <span>Movies Added</span>
                @forelse($addmovie as $movie)
                <div class="flex flex-col">
        <h1>Movie Name<p>{{ $movie->name }}</p></h1>
        <h1>Movie Description<p>{{ $movie->description }}</p></h1>
        <a href="/edit/{{$movie->id}}">Edit</a>
            <form action="{{route('addmovie.destroy',$movie->id)}}" method="post">
            @csrf
            @method('delete')
            <button type="submit">Delete</button>
            </div>
        </form>
    </div>
       @empty
        <p class="text-gray-500 text-center col-span-4">No movies found.</p>
    @endforelse
        </div>
    <div>
    </div>

</x-app-layout>
