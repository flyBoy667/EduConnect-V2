<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AnnoncesFormRequest;
use App\Models\Annonce;
use App\Models\Filiere;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnnoncesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = Auth::user();
        $filieres = Filiere::pluck('nom_filiere', 'id');
        $annonces = $user->annonces()->with('filiere')->paginate(6);

        return view('admin.annonces.index', compact('annonces', 'filieres'));
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
    public function store(AnnoncesFormRequest $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();
        $user = Auth::user();
        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                $imageName = 'annonce-' . $user->nom . '-' . $user->prenom . '.' . $image->extension();
                $imagePath = $image->storeAs('annonce', $imageName, 'public');
            }
        } else {
            $imagePath = 'default/annonces/info_logo';
        }

        foreach ($validated['filieres'] as $filiereId) {
            Annonce::create([
                'titre' => $validated['titre'],
                'contenu' => $validated['contenu'],
                'image' => $imagePath,
                'dateDebut' => $validated['dateDebut'],
                'dateFin' => $validated['dateFin'],
                'user_id' => $user->id,
                'filiere_id' => $filiereId,
            ]);
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => 'Étudiant modifié avec succès.']);
        }

        return redirect()->route('admin.annonces.index')->with('success', 'Annonces créées avec succès');
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
    public function update(AnnoncesFormRequest $request, Annonce $annonce): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();
        $imagePath = $annonce->image;
        $user = Auth::user();

        if ($request->hasFile('image')) {
            $image = $request->validated('image');

            if ($image->isValid()) {
                if ($imagePath) {
                    Storage::disk('public')->delete($imagePath);
                }

                $imageName = 'annonce-' . $user->nom . '-' . $user->prenom . '.' . $image->extension();
                $imagePath = $image->storeAs('annonce', $imageName, 'public');
            }
        }

        foreach ($validated['filieres'] as $filiereId) {
            $annonce->update([
                'titre' => $validated['titre'],
                'contenu' => $validated['contenu'],
                'image' => $imagePath,
                'dateDebut' => $validated['dateDebut'],
                'dateFin' => $validated['dateFin'],
                'user_id' => $user->id,
                'filiere_id' => $filiereId,
            ]);
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => 'Étudiant modifié avec succès.']);
        }

        return redirect()->route('admin.annonces.index')->with('success', 'Annonce modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Annonce $annonce): RedirectResponse
    {
        $annonce->delete();
        Storage::disk('public')->delete($annonce->imageUrl());
        return redirect()->route('admin.annonces.index')->with('success', 'Annonce supprimée avec succès');
    }
}
