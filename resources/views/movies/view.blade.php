<?php
// dd($movie);
?>

<x-layout>
    <x-slot:title> Detalle de la pelicula {{ $movie->title }} </x-slot:title>
    <h1 class="mb-3"> {{ $movie->title }} </h1>
    <div class="d-flex gap-3 align-items-start" >
        <div class="col-3" >
            @if ($movie->cover && \Illuminate\Support\Facades\Storage::has($movie->cover))
                <img src="{{ \Illuminate\Support\Facades\Storage::url($movie->cover) }}" alt="" class="img-fluid" >
            @endif
        </div>

        <dl>
            <dt>Precio:</dt>
            <dd>${{ $movie->price }}</dd>
            <dt>Fecha de estreno</dt>
            <dd>{{ $movie->release_date }}</dd>
        </dl>
    </div>
    <hr class="mb-3">

    <h2 class="mb-3">Sinopsis</h2>
    <div>{{ $movie->synopsis }}</div>

</x-layout>
