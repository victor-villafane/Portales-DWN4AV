<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function index(){
        // return view('movies');
        // $allMovies = Movie::all();
        $allMovies = Movie::with('rating', 'genres')->get();
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
        return view('movies.create', [
            'ratings' => Rating::all()
        ]);
    }

    public function store(Request $request){
        $input = $request->all();

        // dd($input);

        $request->validate([
            'title' => 'required|max:255|min:3',
            'price' => 'required|numeric|min:0',
            'release_date' => 'required|date',
        ],[
            'title.required' => "El campo titulo es obligatorio",
            'title.max' => "El campo titulo no puede tener mas de 255 caracteres",
            'title.min' => "El campo titulo no puede tener menos de 3 caracteres",
            'price.required' => "El campo precio es obligatorio",
            'price.numeric' => "El campo precio debe ser un numero",
            'price.min' => "El campo precio no puede ser menor a 0",
            'release_date.required' => "El campo fecha de lanzamiento es obligatorio",
            'release_date.date' => "El campo fecha de lanzamiento no es una fecha valida"
        ]);

        Movie::create($input);


        return redirect()->route('movies.index')->with('feedback.message', "La pelicula <b>".e( $input["title"] )."</b> se publico correctamente");
    }

    public function destroy($id){
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()
                ->route('movies.index')
                ->with('feedback.message', "La pelicula <b>".e( $movie->title )."</b> se elimino correctamente");
    }

    public function delete($id){
        return view('movies.delete', [
            'movie' => Movie::findOrFail($id)
        ]);
    }

    public function edit($id){
        return view('movies.edit', [
            'movie' => Movie::findOrFail($id),
            'ratings' => Rating::all()
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required|max:255|min:3',
            'price' => 'required|numeric|min:0',
            'release_date' => 'required|date',
        ],[
            'title.required' => "El campo titulo es obligatorio",
            'title.max' => "El campo titulo no puede tener mas de 255 caracteres",
            'title.min' => "El campo titulo no puede tener menos de 3 caracteres",
            'price.required' => "El campo precio es obligatorio",
            'price.numeric' => "El campo precio debe ser un numero",
            'price.min' => "El campo precio no puede ser menor a 0",
            'release_date.required' => "El campo fecha de lanzamiento es obligatorio",
            'release_date.date' => "El campo fecha de lanzamiento no es una fecha valida"
        ]);
        $movie = Movie::findOrFail($id);

        $movie->update($request->all());

        return redirect()
                    ->route('movies.index')
                    ->with('feedback.message', "La pelicula <b>".e( $movie->title )."</b> se edito correctamente");
    }
}
