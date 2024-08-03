@extends('admin.base')

@section('content')
    <h1>Modifier un Emploi du Temps</h1>

    <form action="{{ route('admin.emplois-du-temps.update', $emplois_du_temp) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="filiere_id">Filière</label>
            <select name="filiere_id" id="filiere_id" class="form-control" required>
                @foreach($filieres as $filiere)
                    <option value="{{ $filiere->id }}" {{ $filiere->id == $emplois_du_temp->filiere_id ? 'selected' : '' }}>
                        {{ $filiere->nom_filiere }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="module_id">Module</label>
            <select name="module_id" id="module_id" class="form-control" required>
                @foreach($modules as $module)
                    <option value="{{ $module->id }}" {{ $module->id == $emplois_du_temp->module_id ? 'selected' : '' }}>
                        {{ $module->nom_module }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="professeur_id">Professeur</label>
            <select name="professeur_id" id="professeur_id" class="form-control" required>
                @foreach($professeurs as $professeur)
                    <option value="{{ $professeur->id }}" {{ $professeur->id == $emplois_du_temp->professeur_id ? 'selected' : '' }}>
                        {{ $professeur->user->nom }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="jour">Jour</label>
            <select name="jour" id="jour" class="form-control" required>
                <option value="lundi" {{ $emplois_du_temp->jour == 'lundi' ? 'selected' : '' }}>Lundi</option>
                <option value="mardi" {{ $emplois_du_temp->jour == 'mardi' ? 'selected' : '' }}>Mardi</option>
                <option value="mercredi" {{ $emplois_du_temp->jour == 'mercredi' ? 'selected' : '' }}>Mercredi</option>
                <option value="jeudi" {{ $emplois_du_temp->jour == 'jeudi' ? 'selected' : '' }}>Jeudi</option>
                <option value="vendredi" {{ $emplois_du_temp->jour == 'vendredi' ? 'selected' : '' }}>Vendredi</option>
                <option value="samedi" {{ $emplois_du_temp->jour == 'samedi' ? 'selected' : '' }}>Samedi</option>
                <option value="dimanche" {{ $emplois_du_temp->jour == 'dimanche' ? 'selected' : '' }}>Dimanche</option>
            </select>
        </div>
        <div class="form-group">
            <label for="heure_debut">Heure Début</label>
            <input type="time" name="heure_debut" id="heure_debut" class="form-control" value="{{ $emplois_du_temp->heure_debut }}" required>
        </div>
        <div class="form-group">
            <label for="heure_fin">Heure Fin</label>
            <input type="time" name="heure_fin" id="heure_fin" class="form-control" value="{{ $emplois_du_temp->heure_fin }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
@endsection
