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
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $professeur = Auth::user()->professeurs()->first();
        $modules = $professeur->modules;
        return view('professeur.qcm.create', compact('modules'));
    }

    public function store(Request $request)
    {
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
                    'is_correct' => $optionData['is_correct'],
                ]);
            }
        }

        return redirect()->route('professeur.qcm.index')->with('success', 'QCM créé avec succès');
    }
}
