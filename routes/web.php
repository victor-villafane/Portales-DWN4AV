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
// Route::get('/quienes-somos', function () {
//     return view('about');
// });

