<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReclamationRequest;
use App\Models\Reclamation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ReclamationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professeur = Auth::user()->professeurs()->first();
        $reclamations = $professeur->modules()->with('reclamations.etudiant.user', 'reclamations.module.etudiants')
            ->get()
            ->pluck('reclamations')
            ->flatten()
            ->filter(function ($reclamation) {
                return $reclamation->status === 0; // Filtre uniquement les réclamations en attente
            });

        return view('professeur.reclamations', [
            'professeur' => $professeur,
            'reclamations' => $reclamations
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
    public function store(ReclamationRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        // Create the reclamation
        Reclamation::create([
            'module_id' => $validatedData['module_id'],
            'professeur_id' => $validatedData['professeur_id'],
            'etudiant_id' => Auth::user()->etudiants()->first()->id,
            'description' => $validatedData['description'],
            'date' => now()->format('Y-m-d'), // Date du jour
            'status' => 0, // Status initial, vous pouvez le changer selon votre logique
        ]);

        // Redirect with success message
        return Redirect::back()->with('success', 'Réclamation soumise avec succès.');
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
    public function update(Request $request, Reclamation $reclamation)
    {
        $validatedData = $request->validate([
            'note_examen' => 'nullable|numeric|min:0|max:20',
            'note_classe' => 'nullable|numeric|min:0|max:20',
            'status' => 'required|integer|in:0,1,2'
        ]);

        $etudiant = $reclamation->etudiant;
        $module = $reclamation->module;

        $etudiant->modules()->updateExistingPivot($module->id, [
            'note_examen' => $validatedData['note_examen'],
            'note_classe' => $validatedData['note_classe']
        ]);

        $reclamation->status = $validatedData['status'];
        $reclamation->save();

        return Redirect::back()->with('success', 'Réclamation mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reclamation $reclamation)
    {
        $reclamation->delete();
        return Redirect::back()->with('success', 'Réclamation supprimée avec succès.');
    }
}
