<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MoviesController extends Controller
{
    public function index(Request $request)
    {
        // return view('movies');
        // $allMovies = Movie::all();
        $moviesQuery = Movie::with('rating', 'genres');

        $searchParams = [
            's-title' => $request->query('s-title'),
            's-rating' => $request->query('s-rating')
        ];

        if( $searchParams['s-title'] ){
            $moviesQuery->where('title','like', '%'. $searchParams['s-title'] . '%');
        }

        if( $searchParams['s-rating'] ){
            $moviesQuery->where('rating_fk', '=', $searchParams['s-rating']);
        }

        $allMovies = $moviesQuery->get();
        // dd($allMovies);
        return view('movies.index', [
                'movies' => $allMovies,
                'searchParams' => $searchParams,
                'ratings' => Rating::all(),
            ]);
    }

    public function view(Movie $movie)
    {
        // $movie = Movie::find($id);
        return view('movies.view', [
            'movie' => $movie
        ]);
    }

    public function create()
    {
        return view('movies.create', [
            'genres' => Genre::orderBy('name')->get(),
            'ratings' => Rating::all()
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        if ($request->hasFile('cover')) {
            $input['cover'] = $request->file('cover')->store('covers', 'public');
        }

        // dd($input);

        $request->validate([
            'title' => 'required|max:255|min:3',
            'price' => 'required|numeric|min:0',
            'release_date' => 'required|date',
        ], [
            'title.required' => "El campo titulo es obligatorio",
            'title.max' => "El campo titulo no puede tener mas de 255 caracteres",
            'title.min' => "El campo titulo no puede tener menos de 3 caracteres",
            'price.required' => "El campo precio es obligatorio",
            'price.numeric' => "El campo precio debe ser un numero",
            'price.min' => "El campo precio no puede ser menor a 0",
            'release_date.required' => "El campo fecha de lanzamiento es obligatorio",
            'release_date.date' => "El campo fecha de lanzamiento no es una fecha valida"
        ]);

        $movie = Movie::create($input);
        $movie->genres()->attach($input['genre_id']);

        return redirect()->route('movies.index')->with('feedback.message', "La pelicula <b>" . e($input["title"]) . "</b> se publico correctamente");
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        if( $movie->cover && Storage::has($movie->cover) ){
            Storage::delete($movie->cover);
        }

        $movie->genres()->detach();
        $movie->delete();


        return redirect()
            ->route('movies.index')
            ->with('feedback.message', "La pelicula <b>" . e($movie->title) . "</b> se elimino correctamente");
    }

    public function delete($id)
    {
        return view('movies.delete', [
            'movie' => Movie::findOrFail($id)
        ]);
    }

    public function edit(Movie $movie)
    {
        return view('movies.edit', [
            'movie' => $movie,
            'ratings' => Rating::all(),
            'genres' => Genre::orderBy('name')->get()
        ]);
    }

    public function update(Request $request, $id)
    {

        $input = $request->except(['_token', '_method']);

        $request->validate([
            'title' => 'required|max:255|min:3',
            'price' => 'required|numeric|min:0',
            'release_date' => 'required|date',
        ], [
            'title.required' => "El campo titulo es obligatorio",
            'title.max' => "El campo titulo no puede tener mas de 255 caracteres",
            'title.min' => "El campo titulo no puede tener menos de 3 caracteres",
            'price.required' => "El campo precio es obligatorio",
            'price.numeric' => "El campo precio debe ser un numero",
            'price.min' => "El campo precio no puede ser menor a 0",
            'release_date.required' => "El campo fecha de lanzamiento es obligatorio",
            'release_date.date' => "El campo fecha de lanzamiento no es una fecha valida"
        ]);
        // dd($input);
        $movie = Movie::findOrFail($id);

        $oldCover = $movie->cover;

        if ($request->hasFile('cover')) {
            $input['cover'] = $request->file('cover')->store('covers', 'public');
        }


        $movie->update($input);
        $movie->genres()->sync($request->input('genre_id'));

        if( $request->hasFile('cover') && $oldCover && Storage::has($oldCover) ){
            Storage::delete($oldCover);
        }

        return redirect()
            ->route('movies.index')
            ->with('feedback.message', "La pelicula <b>" . e($movie->title) . "</b> se edito correctamente");
    }
}
