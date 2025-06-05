<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class AgeVericationController extends Controller
{
    public function show(int $id){
        return view('movies.age-verification', [
            'movie' => Movie::findOrFail($id)
        ]);
    }

    public function save( Request $request, int $id ){
        $request->session()->put('age-verified', true);
        return to_route('movies.view', ['id' => $id]);
    }
}
