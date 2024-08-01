<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Paiement;
use App\Models\PersonnelAdministratif;
use App\Models\Professeur;
use App\Models\Role;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $filieres = Filiere::pluck('nom_filiere', 'id');
        $roles = Role::pluck('nom', 'id');
        $nombreProfesseurs = Professeur::count();
        $nombreEtudiants = Etudiant::count();
        $totalPaiements = Paiement::sum('montant');
        $nombreFilieres = Filiere::count();
        $nombrePersonnel = PersonnelAdministratif::count();

        return view('admin.index', [
            'filieres' => $filieres,
            'roles' => $roles,
            'nombreProfesseurs' => $nombreProfesseurs,
            'nombreEtudiants' => $nombreEtudiants,
            'totalPaiements' => $totalPaiements,
            'nombreFilieres' => $nombreFilieres,
            'nombrePersonnel' => $nombrePersonnel,
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
}
