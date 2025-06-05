<?php
// dd($movie);
?>

<x-layout>
    <x-slot:title>
        Confirmacion de edad
    </x-slot:title>

    <h1 class="mb-3">Necesita confirmacion de edad</h1>

    <p>La pelicula <b>{{ $movie->title }}</b> esta marcada como <b>Solo para mayores de 18</b>.</p>
    <p>Para continuar, es necesario confirmar que cumplis con este requerimiento</p>


    <form method="post" action="{{route('movies.age-verification.save', [ 'id' => $movie->movie_id ])}}">
        @csrf
        <div class="d-flex gap-4" >
            <button type="submit" class="btn btn-primary">Confirmar edad</button>
            <a href="{{ route('movies.index') }}" class="btn btn-danger" >No, soy menor. SACAME DE ACA!</a>
        </div>
    </form>



</x-layout>
