@extends('admin.base')

@section('content')
    <h1>Ajouter un Emploi du Temps</h1>

    <form action="{{ route('admin.emplois-du-temps.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="filiere_id">Filière</label>
            <select name="filiere_id" id="filiere_id" class="form-control" required>
                @foreach($filieres as $filiere)
                    <option value="{{ $filiere->id }}">{{ $filiere->nom_filiere }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="module_id">Module</label>
            <select name="module_id" id="module_id" class="form-control" required>
                @foreach($modules as $module)
                    <option value="{{ $module->id }}">{{ $module->nom_module }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="professeur_id">Professeur</label>
            <select name="professeur_id" id="professeur_id" class="form-control" required>
                @foreach($professeurs as $professeur)
                    <option value="{{ $professeur->id }}">{{ $professeur->user->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="jour">Jour</label>
            <input type="text" name="jour" id="jour" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="heure_debut">Heure Début</label>
            <input type="time" name="heure_debut" id="heure_debut" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="heure_fin">Heure Fin</label>
            <input type="time" name="heure_fin" id="heure_fin" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
@endsection
