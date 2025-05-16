<x-layout>
    <x-slot:title>Eliminar pelicula</x-slot:title>
    <h1>Eliminar pelicula {{$movie->title}}</h1>

    <dl class="mb-3" >
        <dt>Precio</dt>
        <dd>${{ $movie->price }}</dt>
        <dt>Fecha de estreno</dt>
        <dd>{{$movie->release_date}}</dt>
    </dl>

    <hr class="mb-3" >

    <h2 class="mb-3" >Sinopsis</h2>
    <div>{{$movie->synopsis}}</div>

    <p class="mb-3" >
        <a href="{{ route('movies.index') }}" class="btn btn-primary" >Volver a peliculas</a>
    </p>

    <form action="{{ route('movies.destroy', ['id' => $movie->movie_id]) }}" method="post" >
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger"  >Eliminar</button>
    </form>
</x-layout>
