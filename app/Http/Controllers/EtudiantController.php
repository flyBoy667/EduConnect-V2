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
        //Recuperer l'etudiant
        $etudiant = Auth::user()->etudiants()->first();

        //Recuperer tous les modules des filiers de l'etudiant
        $modules = $etudiant->filiere->modules;
        //Recuperer toutes les ressources sur les modules des filiers de l'etudiant
        $ressources = collect();
        foreach ($modules as $module) {
            $ressources = $ressources->merge($module->ressources);
        }
        dd($ressources);

        return view('etudiant.ressources', [
            'ressources' => $ressources,
        ]);
    }


}
