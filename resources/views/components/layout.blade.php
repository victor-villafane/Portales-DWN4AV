<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? '' }} Escuela Davinci</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-DQvkBjpPgn7RC31MCQoOeC9TI2kdqa4+BSgNMNj8v77fdC77Kj5zpWFTJaaAoMbC" crossorigin="anonymous">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <x-nav-link route="home">home</x-nav-link>
        </li>
        <li class="nav-item">
            <x-nav-link route="movies.index">Peliculas</x-nav-link>
        </li>
        <li class="nav-item">
            <x-nav-link route="about">About</x-nav-link>
        </li>
        @if( auth()->check() )
        <li class="nav-item">
            <form action="{{ url('/cerrar-sesion') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-link nav-link" >
                    {{ auth()->user()->email }} (Cerrar sesion)
                </button>
            </form>
        </li>
        @else
        <li class="nav-item">
            <x-nav-link route="auth.login">Iniciar sesion</x-nav-link>
        </li>
        @endif
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
   <div class="container-fluid">
        @if( session()->has('feedback.message') )
            <div class="alert alert-success" >{!! session()->get('feedback.message') !!}</div>
        @endif
    {{ $slot }}
   </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js" integrity="sha384-YUe2LzesAfftltw+PEaao2tjU/QATaW/rOitAq67e0CT0Zi2VVRL0oC4+gAaeBKu" crossorigin="anonymous"></script>
  </body>
</html>
