<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfesseurFormRequest;
use App\Models\Professeur;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfesseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //On recupere et affiche tous les professeur
        $professeurs = \App\Models\Professeur::with('user')->get();
        return view('admin.professeur.index', compact('professeurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfesseurFormRequest $request)
    {
        $validated = $request->validated();

        // Vérifiez si le formulaire est valide
        if ($request->fails()) {
            return back()
                ->withErrors($request)
                ->withInput();
        }

        // Créez l'utilisateur
        $user = User::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'login' => $validated['login'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
        ]);

        // Créez le professeur
        Professeur::create([
            'user_id' => $user->id,
            'specialites' => json_encode(explode(',', $validated['specialites'])),
        ]);

        return redirect()->route('admin.professeur.index')->with('success', 'Professeur ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Professeur $professeur): RedirectResponse
    {
        $professeur->user()->delete();
        $professeur->delete();

        return redirect()->route('admin.professeur.index');
    }
}
