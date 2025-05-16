<x-layout>
    <x-slot:title>Editar pelicula</x-slot:title>
    <h1 class="mb-3" >Editar pelicula: {{ $movie->title }}</h1>

    <form action="{{ route('movies.update', ['id' => $movie-> movie_id]) }}" method="POST">
        @csrf   {{--  TOKEN NECESARIO --}}
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Titulo</label>
            <input
                type="text"
                class="form-control @error('title') is-invalid @enderror"
                id="title"
                name="title"
                value="{{ old('title', $movie->title) }}"
            >
        @error('title')
            <div class="text-danger" >{{ $message }}</div>
        @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input
                type="number"
                class="form-control @error('price') is-invalid @enderror"
                id="price"
                name="price"
                value="{{ old('price', $movie->price) }}"
            >
        @error('price')
            <div class="text-danger" >{{ $message }}</div>
        @enderror
        </div>
        <div class="mb-3">
            <label for="release_date" class="form-label">Fecha de estreno</label>
            <input
                type="date"
                class="form-control @error('release_date') is-invalid @enderror"
                id="release_date"
                name="release_date"
                value="{{ old('release_date', $movie->release_date) }}"
            >
        @error('release_date')
            <div class="text-danger" >{{ $message }}</div>
        @enderror
        </div>
        <div class="mb-3">
            <label for="synopsis" class="form-label">Sinopsis</label>
            <textarea class="form-control" id="synopsis" name="synopsis" rows="3">{{ old('synopsis', $movie->synopsis) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="cover" class="form-label">
                Portada <span class="small" >(Opcional)</span>
            </label>
            <input type="file" class="form-control" id="cover" name="cover">
        </div>
        <div class="mb-3">
            <label for="cover_description" class="form-label">
                Descripcion de la portada <span class="small" >(Opcional)</span>
            </label>
            <input type="file" class="form-control" id="cover_description" name="cover_description">
        </div>
        <button type="submit" class="btn btn-primary">Editar pelicula</button>
    </form>
</x-layout>
