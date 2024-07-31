<?php

namespace App\Http\Controllers\Professeur;

use App\Http\Controllers\Controller;
use App\Http\Requests\Professeur\RessourcesFormRequest;
use App\Models\Ressource;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    public function store(RessourcesFormRequest $request): JsonResponse|RedirectResponse
    {

        $validated = $request->validated();

        if ($request->validated('fichier')) {
            $fichierPath = $request->file('fichier')->store('ressources', 'public');
        } else {
            $fichierPath = null;
        }

        Ressource::create([
            'nom' => $validated['nom'],
            'module_id' => $validated['module_id'],
            'professeur_id' => Auth::user()->professeurs()->first()->id,
            'fichier' => $fichierPath,
        ]);

        if ($request->expectsJson()) {
            return response()->json(['success' => 'Ressources ajouté avec succès.']);
        }

        return redirect()->route('professeur.ressources.index')->with('success', 'Ressources ajouté avec succès.');
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
    function update(RessourcesFormRequest $request, Ressource $ressource): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('fichier')) {
            if ($ressource->fichier !== null) {
                Storage::disk('public')->delete($ressource->fichier);
            }
            $fichierPath = $request->validated('fichier')->store('ressources', 'public');
            $ressource->fichier = $fichierPath;
        } else {
            $fichierPath = $ressource->fichier;
        }

        $ressource->update([
            'nom' => $validated['nom'],
            'module_id' => $validated['module_id'],
            'professeur_id' => Auth::user()->professeurs()->first()->id,
            'fichier' => $fichierPath,
        ]);

        if ($request->expectsJson()) {
            return response()->json(['success' => 'Ressource modifiée avec succès.']);
        }

        return redirect()->route('professeur.ressources.index')->with('success', 'Ressource modifiée avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public
    function destroy(Ressource $ressource): RedirectResponse
    {
        if ($ressource->fichier !== null) {
            Storage::disk('public')->delete($ressource->fichier);
        }
        $ressource->delete();
        return redirect()->route('professeur.ressources.index')->with('success', 'Ressource supprimé avec succès.');
    }
}
