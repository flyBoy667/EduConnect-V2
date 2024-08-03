<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\QCM;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QcmController extends Controller
{

    public function index()
    {
        // Supposons que vous ayez un moyen de récupérer l'identifiant du professeur connecté
        $professeurId = Auth::user()->professeurs()->first()->id;

        $qcms = Qcm::whereHas('module.professeur', function ($query) use ($professeurId) {
            $query->where('id', $professeurId);
        })->get();

        return view('professeur.qcm.index', compact('qcms'));
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $professeur = Auth::user()->professeurs()->first();
        $modules = $professeur->modules;
        return view('professeur.qcm.create', compact('modules'));
    }

    public function store(Request $request)
    {
        $totalPoints = array_sum(array_column($request->questions, 'points'));

        if ($totalPoints > 20) {
            return redirect()->back()->withInput()->withErrors(['total_points' => 'Le total des points ne doit pas dépasser 20.']);
        }

        $qcm = Qcm::create([
            'module_id' => $request->module_id,
            'theme' => $request->theme,
        ]);

        foreach ($request->questions as $questionData) {
            $question = $qcm->questions()->create([
                'question_text' => $questionData['question_text'],
                'points' => $questionData['points'],
            ]);

            foreach ($questionData['options'] as $optionData) {
                $question->options()->create([
                    'option_text' => $optionData['option_text'],
                    'is_correct' => isset($optionData['is_correct']) ? 1 : 0,
                ]);
            }
        }

        return redirect()->route('professeur.qcm.index')->with('success', 'QCM créé avec succès');
    }

    public function edit($id)
    {
        $qcm = Qcm::findOrFail($id);
        $modules = Auth::user()->professeurs()->first()->modules;

        return view('professeur.qcm.edit', compact('qcm', 'modules'));
    }

    public function update(Request $request, $id)
    {
        $qcm = Qcm::findOrFail($id);

        $qcm->update([
            'module_id' => $request->module_id,
            'theme' => $request->theme,
        ]);

        $qcm->questions()->delete();

        foreach ($request->questions as $questionData) {
            $question = $qcm->questions()->create([
                'question_text' => $questionData['question_text'],
                'points' => $questionData['points'],
            ]);

            foreach ($questionData['options'] as $optionData) {
                $question->options()->create([
                    'option_text' => $optionData['option_text'],
                    'is_correct' => isset($optionData['is_correct']) ? 1 : 0,
                ]);
            }
        }

        return redirect()->route('professeur.qcm.index')->with('success', 'QCM mis à jour avec succès');
    }

    public function destroy($id)
    {
        Qcm::findOrFail($id)->delete();

        return redirect()->route('professeur.qcm.index')->with('success', 'QCM supprimé avec succès');
    }

}
