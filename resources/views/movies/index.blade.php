<?php
// dd($movies);
?>

<x-layout>
    <x-slot:title>home: </x-slot:title>
    <h1>Peliculas</h1>
    @auth
        <p class="mb-3">
            <a href="{{ route('movies.create') }}" class="btn btn-primary">Crear pelicula</a>
        </p>
    @endauth

    <section class="mb-3">
        <h2>Buscador</h2>
        <form action="{{ route('movies.index') }}" method="get">
            <div class="d-flex gap-3 align-items-end mb-3">
                <div>
                    <label for="s-title" class="form-label" >Titulo</label>
                    <input
                        type="search"
                        name="s-title"
                        id="s-title"
                        class="form-control"
                        value="{{ $searchParams['s-title'] }}"
                    >
                </div>
                <div>
                    <label for="s-rating" class="form-label" >Clasificacion</label>
                    <select class="form-control" name="s-rating" id="s-rating" >
                        <option value="">Todas</option>
                        @foreach ($ratings as $rating )
                            <option
                                value="{{ $rating->rating_id }}"
                                @selected( $rating->rating_id == $searchParams['s-rating'] )
                            >{{$rating->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
    </section>

    @if( !empty($searchParams['s-title']) )
        <p class="mb-3 fst-italic" >
            Mostrando resultados para: <b>{{ $searchParams['s-title'] }}</b>
        </p>
    @endif

    @if( $movies->isNotEmpty() )
        <table class="table table-bordered table-striped">
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
                @foreach ($movies as $movie)
                    <tr>
                        <td>{{ $movie->movie_id }}</td>
                        <td>{{ $movie->title }}</td>
                        <td>{{ $movie->price }}</td>
                        <td>{{ $movie->release_date }}</td>
                        <td>
                            @foreach ($movie->genres as $genre)
                                <span class="badge bg-secondary">{{ $genre->name }}</span>
                            @endforeach
                        </td>
                        <td>{{ $movie->rating->name }}</td>
                        <td>
                            <a href="{{ route('movies.view', ['movie' => $movie->movie_id]) }}"
                                class="btn btn-primary">Ver</a>
                            @auth
                                <a href="{{ route('movies.edit', ['movie' => $movie->movie_id]) }}"
                                    class="btn btn-secondary">Editar</a>
                                <a href="{{ route('movies.delete', ['id' => $movie->movie_id]) }}"
                                    class="btn btn-danger">Eliminar</a>
                            @endauth
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="m-3">No se encontraron peliculas</p>
    @endif
</x-layout>
