<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\PersonnelAdministratif;
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
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user && $user->isEtudiant()) {
                return redirect()->route('etudiant.index');
            }
            if ($user && $user->isProfesseur()) {
                return redirect()->route('professeur.index');
            }
            if ($user && $user->isPersonnelAdministratif()) {
                $role = $user->personnelAdministratifs->role_id;
                if ($role === 1) {
                    return redirect()->route('admin.professeur.index');
                }
                if ($role === 2) {
                    return redirect()->route('comptable.index');
                }
                if ($role === 3) {
                    return redirect()->route('secretaire.index');
                }

            }
            return redirect()->intended();
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
