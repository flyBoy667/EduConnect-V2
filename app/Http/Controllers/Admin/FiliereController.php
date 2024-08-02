<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FiliereFormResquest;
use App\Models\Filiere;
use Illuminate\Http\Request;

class FiliereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filieres = Filiere::with('modules')->paginate(6);
        return view('admin.filieres.index', [
            'filieres' => $filieres
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
    public function store(FiliereFormResquest $request)
    {
        Filiere::create($request->validated());
        return redirect()->route('admin.filieres.index')->with('success', 'Filière ajoutée avec succès');
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
    public function update(FiliereFormResquest $request, Filiere $filiere)
    {
        $filiere->update($request->validated());
        return redirect()->route('admin.filieres.index')->with('success', 'Filière modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Filiere $filiere)
    {
        $filiere->delete();
        return redirect()->route('admin.filieres.index')->with('success', 'Filière supprimée avec succès');
    }
}
