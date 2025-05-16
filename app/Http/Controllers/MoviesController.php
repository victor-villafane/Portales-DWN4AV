<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function index(){
        // return view('movies');
        $allMovies = Movie::all();
        // dd($allMovies);
        return view('movies.index', ['movies' => $allMovies] );
    }

    public function view($id){
        // $movie = Movie::find($id);
        return view('movies.view', [
            'movie' => Movie::findOrFail($id)
        ]);
    }
}
