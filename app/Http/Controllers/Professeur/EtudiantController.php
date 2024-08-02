<?php

namespace App\Http\Controllers\Professeur;

use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Module $module)
    {
        $etudiants = Etudiant::whereHas('modules', function ($query) use ($module) {
            $query->where('module_id', $module->id);
        })->with('user', 'modules')->get();

        $professeur = Auth::user()->professeurs()->first();

        return view('professeur.etudiant.index', [
            'professeur' => $professeur,
            'etudiants' => $etudiants,
            'module' => $module
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, Module $module, Etudiant $etudiant)
    {
        $request->validate([
            'note_examen' => 'required|numeric|min:0|max:20',
            'note_classe' => 'required|numeric|min:0|max:20',
        ]);


        $etudiant->modules()->updateExistingPivot($module->id, [
            'note_examen' => $request->input('note_examen'),
            'note_classe' => $request->input('note_classe'),
        ]);

        return redirect()->route('professeur.etudiant.index', ['module' => $module->id])
            ->with('success', 'Notes mises à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
