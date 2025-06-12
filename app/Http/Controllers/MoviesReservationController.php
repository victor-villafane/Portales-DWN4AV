<?php

namespace App\Http\Controllers;

use App\Mail\MovieReserved;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MoviesReservationController extends Controller
{
    public function reserve( int $id )
    {
        $movie = Movie::findOrFail($id);
        Mail::to(Auth::user())->send(new MovieReserved($movie));

        return to_route(('movies.index'))
            ->with('feedback.message', 'La reserva de la película se ha realizado correctamente.');
    }
}
