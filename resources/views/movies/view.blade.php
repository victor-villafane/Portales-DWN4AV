<?php
    // dd($movie);
?>

<x-layout>
    <x-slot:title> Detalle de la pelicula {{ $movie->title }} </x-slot:title>
    <h1 class="mb-3" > {{$movie->title}} </h1>

    <dl>
        <dt>Precio:</dt>
        <dd>${{ $movie->price }}</dd>
        <dt>Fecha de estreno</dt>
        <dd>{{ $movie->release_date }}</dd>
    </dl>

    <hr class="mb-3" >

    <h2 class="mb-3" >Sinopsis</h2>
    <div>{{ $movie->synopsis }}</div>
</x-layout>
