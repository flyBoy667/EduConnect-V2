<?php

namespace App\Http\Controllers;

use App\Models\Professeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfesseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //recuperer et afficher tous les modules du professeur
        $prof = Auth::user()->professeurs()->first();
        $modules = $prof->modules()->get();
        return view('professeur.index', compact('modules'));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function emploiDuTemps()
    {
        $professeur = Auth::user()->professeurs()->first();
        $emploisDuTemps = $professeur->emploisDuTemps()->with('module')->get();
        return view('professeur.emploi_du_temps', compact('emploisDuTemps'));
    }

}
