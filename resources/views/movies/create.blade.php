<x-layout>
    <x-slot:title>Crear pelicula</x-slot:title>
    <h1 class="mb-3" >Crear pelicula</h1>

    <form action="{{ route('movies.store') }}" method="POST">
        @csrf   {{--  TOKEN NECESARIO --}}
        <div class="mb-3">
            <label for="title" class="form-label">Titulo</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
            <label for="release_date" class="form-label">Fecha de estreno</label>
            <input type="date" class="form-control" id="release_date" name="release_date" required>
        </div>
        <div class="mb-3">
            <label for="synopsis" class="form-label">Sinopsis</label>
            <textarea class="form-control" id="synopsis" name="synopsis" rows="3"></textarea>
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
        <button type="submit" class="btn btn-primary">Crear pelicula</button>
    </form>
</x-layout>
