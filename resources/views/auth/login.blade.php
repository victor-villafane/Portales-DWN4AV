<x-layout>
    <x-slot:title>Iniciar sesion</x-slot:title>
    <h1 class="mb-3" >Iniciar sesion</h1>

    <form action="{{ route('auth.authenticate') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
                type="email"
                class="form-control"
                id="email"
                name="email"
            >
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input
                type="password"
                class="form-control"
                id="password"
                name="password"
            >
        </div>
        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
    </form>

</x-layout>
