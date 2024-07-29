<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\PersonnelAdministratif;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        return view('auth.login');
    }

    public function doLogin(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            return $this->redirectUser($user);
        }

        return back()->withErrors([
            'login' => 'login ou mot de passe incorrect',
        ])->onlyInput('login');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }

    //Une fonction qui gere la redirection
    private function redirectUser($user): RedirectResponse
    {
        $type = $user->getType();
        if ($type) {
            return redirect()->route("{$type}.index");
        }
        return redirect()->intended();
    }
}
