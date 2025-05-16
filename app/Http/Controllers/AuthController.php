<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view("auth.login");
    }

    public function authenticate(Request $request){
        //validar los datos
        $creadenciales = $request->only('email', 'password');

        if( Auth::attempt($creadenciales) ){
            //Ingreso!!
            return redirect()
                    ->intended(route('movies.index'))
                    ->with('feedback.message', "Sesion iniciada correctamente");
        }

        return redirect()
                ->back()
                ->withInput()
                ->with('feedback.message', "Las credenciales son incorrectas");
    }

    public function logout( Request $request ){
        Auth::logout();

        $request->session()->invalidate();      // Invalidar la sesion
        $request->session()->regenerateToken(); // Regenerar el token CSRF

        return redirect()
                ->route('auth.login')
                ->with('feedback.message', "Sesion cerrada correctamente");
    }
}
