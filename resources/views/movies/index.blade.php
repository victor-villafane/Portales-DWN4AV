<?php
    // dd($movies);
?>

<x-layout>
    <x-slot:title>home: </x-slot:title>
    <h1>Peliculas</h1>
    @auth
        <p class="mb-3" >
            <a href="{{ route('movies.create') }}" class="btn btn-primary" >Crear pelicula</a>
        </p>
    @endauth

    <table class="table table-bordered table-striped" >
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Precio</th>
                <th>Fecha de estreno</th>
                <th>Generos</th>
                <th>Clasificacion</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $movies as $movie )
                <tr>
                    <td>{{$movie->movie_id}}</td>
                    <td>{{$movie->title}}</td>
                    <td>{{$movie->price}}</td>
                    <td>{{$movie->release_date}}</td>
                    <td>
                        @foreach( $movie->genres as $genre )
                            <span class="badge bg-secondary" >{{ $genre->name }}</span>
                        @endforeach
                    </td>
                    <td>{{$movie->rating->name}}</td>
                    <td>
                        <a href="{{ route('movies.view', ['movie' => $movie->movie_id]) }}" class="btn btn-primary" >Ver</a>
                        @auth
                            <a href="{{ route('movies.edit', ['movie' => $movie->movie_id]) }}" class="btn btn-secondary" >Editar</a>
                            <a href="{{ route('movies.delete', ['id' => $movie->movie_id]) }}" class="btn btn-danger" >Eliminar</a>
                        @endauth
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-layout>
