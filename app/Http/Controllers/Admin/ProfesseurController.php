<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfesseurFormRequest;
use App\Models\Professeur;
use App\Models\User;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
    public function edit(Professeur $professeur)
    {
        return view('admin.professeur.edit', compact('professeur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfesseurFormRequest $request, Professeur $professeur): RedirectResponse
    {
        $validated = $request->validated();

        /**@var UploadedFile $image */
        $image = $request->validated('image');

        if ($image !== null && !$image->getError()) {
            $imageName = 'profil-' . $professeur->user->nom . '-' . $professeur->user->prenom . '.' . $image->extension();
            $validated['image'] = $image->storeAs('user/prof', $imageName, 'public');
        }

        //on verifie si l'user a deja une image si oui on la supprime
        if ($professeur->user->image) {
            Storage::disk('public')->delete($professeur->user->image);
        }

        $professeur->user->update([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'login' => $validated['login'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            'image' => $validated['image'] ?? null, // Si aucune image n'est fournie, on conserve la précédente'
        ]);

        $professeur->update([
            'specialites' => json_encode(explode(',', $validated['specialites'])),
        ]);

        return redirect()->route('admin.professeur.index')->with('success', 'Professeur modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Professeur $professeur): RedirectResponse
    {
        // Supprimer l'image de l'utilisateur si elle existe
        if ($professeur->user->image) {
            Storage::disk('public')->delete($professeur->user->image);
        }

        // Supprimer l'utilisateur associé au professeur et le professeur lui-même
        // Cela supprime également les relations avec les autres tables (élèves, notes, etc.) liées au professeur
        // Note: Si vous souhaitez supprimer seulement les relations avec les autres tables, vous pouvez utiliser la méthode `detach()` sur la relation 'user_id' du modèle Professeur
        // Exemple: $professeur->user_id = null; $professeur->save();
        $professeur->user()->delete();
        $professeur->delete();

        return redirect()->route('admin.professeur.index');
    }
}
