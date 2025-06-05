<?php

use App\Http\Controllers\AgeVericationController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [\App\http\Controllers\HomeController::class, 'home'])->name('home');
Route::get('/quienes-somos', [\App\http\Controllers\AboutController::class, 'about'])->name('about');
Route::get('/peliculas/listado', [\App\http\Controllers\MoviesController::class, 'index'])->name('movies.index');
Route::get('/peliculas/{id}', [\App\http\Controllers\MoviesController::class, 'view'])
        ->name('movies.view')
        ->middleware('require-age') //php artisan make:middleware RequireAgeOver18
        ->whereNumber('id');
Route::get('/peliculas/publicar', [\App\http\Controllers\MoviesController::class, 'create'])->name('movies.create')
    ->middleware('auth');
Route::post('/peliculas/publicar', [\App\http\Controllers\MoviesController::class, 'store'])->name('movies.store')
    ->middleware('auth');

Route::get('/peliculas/{id}/eliminar', [\App\http\Controllers\MoviesController::class, 'delete'])->name('movies.delete')
        ->whereNumber('id')
        ->middleware('auth');
Route::delete('/peliculas/{id}/eliminar', [\App\http\Controllers\MoviesController::class, 'destroy'])->name('movies.destroy')
        ->whereNumber('id')
        ->middleware('auth');

Route::get('/peliculas/editar/{id}', [\App\http\Controllers\MoviesController::class, 'edit'])->name('movies.edit')
        ->whereNumber('id')
        ->middleware('auth');

Route::put('/peliculas/editar/{id}', [ \App\http\Controllers\MoviesController::class, 'update' ])-> name('movies.update')
        ->whereNumber('id')
        ->middleware('auth');

Route::get('/iniciar-sesion', [\App\http\Controllers\AuthController::class, 'login'])->name('auth.login');
Route::post('/iniciar-sesion', [\App\http\Controllers\AuthController::class, 'authenticate'])->name('auth.authenticate');

Route::post('/cerrar-sesion', [\App\http\Controllers\AuthController::class, 'logout'])->name('auth.logout');

Route::get('/peliculas/{id}/verificar-edad', [ \App\http\Controllers\AgeVericationController::class, 'show' ])
    ->name(('movies.age-verification.show'))
    ->whereNumber('id');

Route::post('/peliculas/{id}/verificar-edad', [\App\http\Controllers\AgeVericationController::class, 'save'])
    ->name('movies.age-verification.save')
    ->whereNumber('id');

// Route::get('/quienes-somos', function () {
//     return view('about');
// });

