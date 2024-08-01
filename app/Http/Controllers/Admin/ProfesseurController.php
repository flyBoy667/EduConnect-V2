<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfesseurFormRequest;
use App\Models\Professeur;
use App\Models\User;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\JsonResponse;
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
    public function store(ProfesseurFormRequest $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();

        $defaultImagePath = 'default/prof/profil_prof.png';

        $user = User::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'login' => $validated['login'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            'image' => $defaultImagePath,
        ]);

        Professeur::create([
            'user_id' => $user->id,
            'specialites' => json_encode(explode(',', $validated['specialites'])),
        ]);

        if ($request->expectsJson()) {
            return response()->json(['success' => 'Professeur ajouté avec succès.']);
        }

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
    public function update(ProfesseurFormRequest $request, Professeur $professeur): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();

        $imagePath = $professeur->user->image;


        if ($request->hasFile('image')) {
            $image = $request->validated('image');

            if ($image->isValid()) {
                if ($imagePath) {
                    Storage::disk('public')->delete($imagePath);
                }

                $imageName = 'profil-' . $professeur->user->nom . '-' . $professeur->user->prenom . '.' . $image->extension();
                $imagePath = $image->storeAs('user/prof', $imageName, 'public');
            }
        }

        $professeur->user->update([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            'image' => $imagePath,
            'login' => $validated['login'] ?? $professeur->user->login
        ]);

        $professeur->update([
            'specialites' => json_encode(explode(',', $validated['specialites'])),
        ]);

        if ($request->expectsJson()) {
            return response()->json(['success' => 'Professeur modifié avec succès.']);
        }

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
