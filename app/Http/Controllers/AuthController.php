<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        return view('auth.login');
    }

    public function doLogin(LoginRequest $request): \Illuminate\Http\RedirectResponse
    {
        //Un tableau contenant la valuer des champs valides donnes en parametre
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            //On régénère la session parce que l'utilisateur est stocké dans la session:
            $request->session()->regenerate();
            //Ceci fera une redirection vers la route demander a l'origine si elle n'existe pas on ira sur la route donnee en param
            return redirect()->intended(route('test.index'));
        }

        return back()->withErrors([
            'login' => 'login ou mot de passe incorrect',
        ])->onlyInput('login');
    }

    public function logout(): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
