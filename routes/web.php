<?php

use App\Http\Controllers\AgeVericationController;
use App\Http\Controllers\MercadoPagoController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [\App\http\Controllers\HomeController::class, 'home'])->name('home');
Route::get('/quienes-somos', [\App\http\Controllers\AboutController::class, 'about'])->name('about');
Route::get('/peliculas/listado', [\App\http\Controllers\MoviesController::class, 'index'])->name('movies.index');
Route::get('/peliculas/publicar', [\App\http\Controllers\MoviesController::class, 'create'])->name('movies.create')
    ->middleware('auth');
Route::post('/peliculas/publicar', [\App\http\Controllers\MoviesController::class, 'store'])->name('movies.store')
    ->middleware('auth');
Route::get('/peliculas/{movie}', [\App\http\Controllers\MoviesController::class, 'view'])
    ->name('movies.view')
    ->middleware('require-age'); //php artisan make:middleware RequireAgeOver18
// ->whereNumber('id');
Route::get('/peliculas/{id}/eliminar', [\App\http\Controllers\MoviesController::class, 'delete'])->name('movies.delete')
    ->whereNumber('id')
    ->middleware('auth');
Route::delete('/peliculas/{id}/eliminar', [\App\http\Controllers\MoviesController::class, 'destroy'])->name('movies.destroy')
    ->whereNumber('id')
    ->middleware('auth');

Route::get('/peliculas/editar/{movie}', [\App\http\Controllers\MoviesController::class, 'edit'])
    ->name('movies.edit')
    // ->whereNumber('id')
    ->middleware('auth');

Route::put('/peliculas/editar/{id}', [\App\http\Controllers\MoviesController::class, 'update'])->name('movies.update')
    ->whereNumber('id')
    ->middleware('auth');

Route::get('/iniciar-sesion', [\App\http\Controllers\AuthController::class, 'login'])->name('auth.login');
Route::post('/iniciar-sesion', [\App\http\Controllers\AuthController::class, 'authenticate'])->name('auth.authenticate');

Route::post('/cerrar-sesion', [\App\http\Controllers\AuthController::class, 'logout'])->name('auth.logout');

Route::get('/peliculas/{id}/verificar-edad', [\App\http\Controllers\AgeVericationController::class, 'show'])
    ->name(('movies.age-verification.show'))
    ->whereNumber('id');

Route::post('/peliculas/{id}/verificar-edad', [\App\http\Controllers\AgeVericationController::class, 'save'])
    ->name('movies.age-verification.save')
    ->whereNumber('id');

Route::post('peliculas/{id}/reservar', [\App\Http\Controllers\MoviesReservationController::class, 'reserve'])
    ->name('movies.reserve')
    ->middleware('auth');

Route::get('mp/comprar', [\App\Http\Controllers\MercadoPagoController::class, 'showBuyForm'])
    ->name('mp.show-buy-form');

Route::get('mp/exito', [\App\Http\Controllers\MercadoPagoController::class, 'success'])
    ->name('mp.success');

Route::get('mp/pendiente', [\App\Http\Controllers\MercadoPagoController::class, 'pending'])
    ->name('mp.pending');

Route::get('mp/error', [\App\Http\Controllers\MercadoPagoController::class, 'failure'])
    ->name('mp.failure');
