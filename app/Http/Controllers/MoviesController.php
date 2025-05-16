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

    public function create(){
        return view('movies.create');
    }

    public function store(Request $request){
        $input = $request->all();

        $movie = new Movie();
        $movie->title = $input['title'];
        $movie->price = $input['price'];
        $movie->release_date = $input['release_date'];
        $movie->synopsis = $input['synopsis'];
        $movie->save();

        return redirect()->route('movies.index')->with('feedback.message', "La pelicula se publico correctamente");
    }
}
