<?php

namespace App\Http\Middleware;

use App\Models\Movie;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequireAgeOver18
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // echo "MIDDLEWARE: VERIFICANDO!!!!\n";
        // $id = $request->route('id');
        $movie = $request->route('movie');

        if( $movie->rating_fk === 4 && !$request->session()->has('age-verified') ){
            return to_route('movies.age-verification.show', [ 'id' => $movie->movie_id ]);
        }

        return $next($request);
    }
}
