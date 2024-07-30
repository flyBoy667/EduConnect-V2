<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EtudiantFormRequest;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $filieres = Filiere::pluck('nom_filiere', 'id');
        $etudiants = Etudiant::with('user', 'filiere')->paginate(6);
        return view('admin.etudiant.index', [
            'etudiants' => $etudiants,
            'filieres' => $filieres,
        ]);
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
    public function store(EtudiantFormRequest $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();

        // Créez l'utilisateur
        $user = User::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'login' => $validated['login'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
        ]);

        // Créez l'étudiant
        Etudiant::create([
            'user_id' => $user->id,
            'filiere_id' => $validated['filiere_id'],
            'etat_paiement' => $validated['etat_paiement'],
        ]);

        if ($request->expectsJson()) {
            return response()->json(['success' => 'Étudiant ajouté avec succès.']);
        }

        return redirect()->route('admin.etudiant.index')->with('success', 'Étudiant ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(EtudiantFormRequest $request, Etudiant $etudiant): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();

        // Si une image est fournie, traitement de l'image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'profil-' . $etudiant->user->nom . '-' . $etudiant->user->prenom . '.' . $image->extension();
            $imagePath = $image->storeAs('user/etudiants', $imageName, 'public');

            if ($etudiant->user->image && Storage::disk('public')->exists($etudiant->user->image)) {
                Storage::disk('public')->delete($etudiant->user->image);
            }

            $validated['image'] = $imagePath;
        }

        // Mettre à jour les informations de l'étudiant
        $etudiant->user->update([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            'image' => $validated['image'] ?? $etudiant->user->image,
            'login' => $validated['login'] ?? $etudiant->user->login
        ]);

        // Mettre à jour les informations spécifiques à l'étudiant
        $etudiant->update([
            'filiere_id' => $validated['filiere_id'],
            'etat_paiement' => $validated['etat_paiement'],
        ]);

        if ($request->expectsJson()) {
            return response()->json(['success' => 'Étudiant modifié avec succès.']);
        }

        return redirect()->route('admin.etudiant.index')->with('success', 'Étudiant modifié avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public
    function destroy(Etudiant $etudiant)
    {
        $etudiant->user()->delete();
        $etudiant->delete();
        return redirect()->route('admin.etudiant.index')->with('success', 'Étudiant supprimé avec succès.');
    }
}
