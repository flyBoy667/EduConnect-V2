<?php

namespace App\Http\Controllers;

use App\Models\Ressource;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('etudiant.index');
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

    public function ressources(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $etudiant = Auth::user()->etudiants()->first();

        $modules = $etudiant->filiere->modules;
        $ressources = collect();
        foreach ($modules as $module) {
            $ressources = $ressources->merge($module->ressources);
        }

        return view('etudiant.ressources', [
            'ressources' => $ressources,
        ]);
    }

    public function notes()
    {
        $etudiant = Auth::user()->etudiants()->first();
        $modules = $etudiant->modules;
        $moyenneGenerale = $etudiant->getAverage();

        return view('etudiant.notes', [
            'etudiant' => $etudiant,
            'modules' => $modules,
            'moyenneGenerale' => number_format($moyenneGenerale, 2),
        ]);
    }

    public function reclamations()
    {
        $etudiant = Auth::user()->etudiants()->first();
        $reclamations = $etudiant->reclamations;

        return view('etudiant.reclamations', [
            'reclamations' => $reclamations,
        ]);
    }

    public function annonces()
    {
        $etudiant = Auth::user()->etudiants()->first();
        $filiere = $etudiant->filiere;
        $annonces = $filiere->annonces()->paginate(6);

        return view('etudiant.annonces', [
            'annonces' => $annonces,
        ]);
    }


}
