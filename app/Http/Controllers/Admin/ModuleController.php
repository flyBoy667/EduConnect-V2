<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ModuleFormResquest;
use App\Models\Filiere;
use App\Models\Module;
use App\Models\Professeur;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules = Module::with('filiere')->paginate(6);
        $professeurs = Professeur::with('user')->get();
        $filieres = Filiere::pluck('nom_filiere', 'id');

        return view('admin.modules.index', [
            'modules' => $modules,
            'professeurs' => $professeurs,
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
    public function store(ModuleFormResquest $request)
    {
        $validated = $request->validated();
        Module::create([
            'nom_module' => $validated['nom_module'],
            'description' => $validated['description'],
            'professeur_id' => $validated['professeur_id'],
            'filiere_id' => $validated['filiere_id'],
        ]);

        return response()->json(['message' => 'Module ajouté avec succès.']);
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
    public function update(ModuleFormResquest $request, Module $module)
    {
        $validated = $request->validated();
        $module->update([
            'nom_module' => $validated['nom_module'],
            'description' => $validated['description'],
            'professeur_id' => $validated['professeur_id'],
            'filiere_id' => $validated['filiere_id'],
        ]);

        return response()->json(['message' => 'Module modifié avec succès.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        $module->delete();
        return redirect()->route('admin.modules.index')->with('success', 'Module supprimé avec succès.');
    }
}
