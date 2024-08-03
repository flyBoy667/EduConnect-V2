<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmploiDuTemps;
use App\Models\Filiere;
use App\Models\Module;
use App\Models\Professeur;
use Illuminate\Http\Request;

class EmploiDuTempsController extends Controller
{
    public function index()
    {
        $emplois = EmploiDuTemps::with('filiere', 'module', 'professeur')->get();
        return view('admin.emplois_du_temps.index', compact('emplois'));
    }

    public function create()
    {
        $filieres = Filiere::all();
        return view('admin.emplois_du_temps.create', compact('filieres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'filiere_id' => 'required|exists:filieres,id',
            'module_id' => 'required|exists:modules,id',
            'professeur_id' => 'required|exists:professeurs,id',
            'jour' => 'required|string',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i'
        ]);

        // Vérifier que le module appartient à la filière sélectionnée
        $module = Module::find($request->module_id);
        if ($module->filiere_id != $request->filiere_id) {
            return back()->withErrors(['module_id' => 'Le module sélectionné n\'appartient pas à la filière sélectionnée.']);
        }

        // Vérifier que le professeur dispense le module
        if ($module->professeur_id != $request->professeur_id) {
            return back()->withErrors(['professeur_id' => 'Le professeur sélectionné ne dispense pas ce module.']);
        }

        EmploiDuTemps::create($request->all());

        return redirect()->route('admin.emplois-du-temps.index')->with('success', 'Emploi du temps créé avec succès.');
    }

    public function edit(EmploiDuTemps $emploiDuTemps)
    {
        $filieres = Filiere::all();
        return view('admin.emplois_du_temps.edit', compact('emploiDuTemps', 'filieres'));
    }

    public function update(Request $request, EmploiDuTemps $emploiDuTemps)
    {
        $request->validate([
            'filiere_id' => 'required|exists:filieres,id',
            'module_id' => 'required|exists:modules,id',
            'professeur_id' => 'required|exists:professeurs,id',
            'jour' => 'required|string',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i'
        ]);

        // Vérifier que le module appartient à la filière sélectionnée
        $module = Module::find($request->module_id);
        if ($module->filiere_id != $request->filiere_id) {
            return back()->withErrors(['module_id' => 'Le module sélectionné n\'appartient pas à la filière sélectionnée.']);
        }

        // Vérifier que le professeur dispense le module
        if ($module->professeur_id != $request->professeur_id) {
            return back()->withErrors(['professeur_id' => 'Le professeur sélectionné ne dispense pas ce module.']);
        }

        $emploiDuTemps->update($request->all());

        return redirect()->route('admin.emplois-du-temps.index')->with('success', 'Emploi du temps mis à jour avec succès.');
    }

    public function destroy(EmploiDuTemps $emploiDuTemps)
    {
        $emploiDuTemps->delete();

        return redirect()->route('admin.emplois-du-temps.index')->with('success', 'Emploi du temps supprimé avec succès.');
    }

}
