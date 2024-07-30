<?php

namespace App\Http\Controllers\Professeur;

use App\Http\Controllers\Controller;
use App\Http\Requests\Professeur\RessourcesFormRequest;
use App\Models\Ressource;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RessourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $prof = Auth::user()->professeurs()->first();
        $modules = $prof->modules;

        $ressources = $modules->flatMap(function ($module) {
            return $module->ressources;
        });
        return view('professeur.ressources.index', [
            'ressources' => $ressources,
            'modules' => $modules,
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
    public function store(RessourcesFormRequest $request)
    {
        // Validation déjà effectuée par StoreRessourceRequest

        $validated = $request->validated();

        // Stocker le fichier et obtenir le chemin
        if ($request->hasFile('fichier')) {
            $fichierPath = $request->file('fichier')->store('ressources', 'public');
        } else {
            $fichierPath = null;
        }


        // Créer la ressource
        Ressource::create([
            'nom' => $validated['nom'],
            'module_id' => $validated['module_id'],
            'professeur_id' => Auth::user()->professeurs->id,
            'fichier' => $fichierPath,
        ]);

        return response()->json(['message' => 'Ressource ajoutée avec succès.']);

    }

    /**
     * Display the specified resource.
     */
    public
    function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public
    function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public
    function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public
    function destroy(string $id)
    {
        //
    }
}
