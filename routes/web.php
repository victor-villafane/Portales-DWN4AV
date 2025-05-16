<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [\App\http\Controllers\HomeController::class, 'home'])->name('home');
Route::get('/quienes-somos', [\App\http\Controllers\AboutController::class, 'about'])->name('about');
Route::get('/peliculas/listado', [\App\http\Controllers\MoviesController::class, 'index'])->name('movies.index');
Route::get('/peliculas/{id}', [\App\http\Controllers\MoviesController::class, 'view'])
        ->name('movies.view')
        ->whereNumber('id');
Route::get('/peliculas/publicar', [\App\http\Controllers\MoviesController::class, 'create'])->name('movies.create');
Route::post('/peliculas/publicar', [\App\http\Controllers\MoviesController::class, 'store'])->name('movies.store');

Route::get('/peliculas/{id}/eliminar', [\App\http\Controllers\MoviesController::class, 'delete'])->name('movies.delete')
        ->whereNumber('id');
Route::delete('/peliculas/{id}/eliminar', [\App\http\Controllers\MoviesController::class, 'destroy'])->name('movies.destroy')
        ->whereNumber('id');

Route::get('/peliculas/editar/{id}', [\App\http\Controllers\MoviesController::class, 'edit'])->name('movies.edit')
        ->whereNumber('id');

Route::put('/peliculas/editar/{id}', [ \App\http\Controllers\MoviesController::class, 'update' ])-> name('movies.update')
        ->whereNumber('id');

Route::get('/iniciar-sesion', [\App\http\Controllers\AuthController::class, 'login'])->name('auth.login');
Route::post('/iniciar-sesion', [\App\http\Controllers\AuthController::class, 'authenticate'])->name('auth.authenticate');

Route::post('/cerrar-sesion', [\App\http\Controllers\AuthController::class, 'logout'])->name('auth.logout');
// Route::get('/quienes-somos', function () {
//     return view('about');
// });

