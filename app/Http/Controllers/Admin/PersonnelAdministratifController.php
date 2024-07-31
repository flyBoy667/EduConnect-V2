<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PersonnelFormRequest;
use App\Models\PersonnelAdministratif;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PersonnelAdministratifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::pluck('nom', 'id');
        $personnels = PersonnelAdministratif::with('user', 'role')->get();

        return view('admin.personnel.index', [
            'personnels' => $personnels,
            'roles' => $roles,
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
    public function store(PersonnelFormRequest $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();

        if ($request->validated('image')) {
            $imagePath = $request->file('image')->store('personnel', 'public');
        } else {
            $imagePath = null;
        }

        $imageMap = [
            1 => 'default/personnel/profil-admin.png',
            2 => 'default/personnel/profil-comptable.png',
            3 => 'default/personnel/profil-secretaire.png'
        ];

        $defaultImagePath = $imageMap[$validated['role_id']] ?? '';

        $user = User::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'login' => $validated['login'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            'image' => $defaultImagePath,
        ]);


        $t = PersonnelAdministratif::create([
            'user_id' => $user->id,
            'role_id' => $validated['role_id'],
        ]);


        if ($request->expectsJson()) {
            return response()->json(['success' => 'Personnel administratif ajouté avec succès.']);
        }


        return redirect()->route('admin.personnel_administratifs.index')->with('success', 'Personnel administratif ajouté avec succès.');
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
    public function update(PersonnelFormRequest $request, PersonnelAdministratif $personnelAdministratif): RedirectResponse|JsonResponse
    {
        $validated = $request->validated();
        // dd($validated); // Décommenter pour déboguer les données validées

        $imagePath = $personnelAdministratif->user->image;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                if ($imagePath) {
                    Storage::disk('public')->delete($imagePath);
                }
                $imageName = 'profil-' . $personnelAdministratif->user->nom . '-' . $personnelAdministratif->user->prenom . '.' . $image->extension();
                $imagePath = $image->storeAs('user/personnel', $imageName, 'public');
            }
        }

        $personnelAdministratif->user->update([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            'image' => $imagePath,
            'login' => $validated['login'] ?? $personnelAdministratif->user->login
        ]);

        $personnelAdministratif->update([
            'role_id' => $validated['role_id'],
        ]);

        if ($request->expectsJson()) {
            return response()->json(['success' => 'Personnel modifié avec succès.']);
        }

        return redirect()->route('admin.personnel_administratifs.index')->with('success', 'Personnel modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PersonnelAdministratif $personnelAdministratif)
    {
        $personnelAdministratif->user()->delete();
        $personnelAdministratif->delete();
        return redirect()->route('admin.personnel_administratifs.index')->with('success', 'Personnel supprimé avec succès.');
    }
}
