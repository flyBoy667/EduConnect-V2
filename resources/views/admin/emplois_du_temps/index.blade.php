@extends('admin.base')

@section('content')
    <h1>Liste des Emplois du Temps</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.emplois-du-temps.create') }}" class="btn btn-primary mb-3">Ajouter un Emploi du Temps</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Filière</th>
            <th>Module</th>
            <th>Professeur</th>
            <th>Jour</th>
            <th>Heure Début</th>
            <th>Heure Fin</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($emplois as $emploi)
            <tr>
                <td>{{ $emploi->id }}</td>
                <td>{{ $emploi->filiere->nom_filiere }}</td>
                <td>{{ $emploi->module->nom_module }}</td>
                <td>{{ $emploi->professeur->user->nom }}</td>
                <td>{{ $emploi->jour }}</td>
                <td>{{ $emploi->heure_debut }}</td>
                <td>{{ $emploi->heure_fin }}</td>
                <td>
                    <a href="{{ route('admin.emplois-du-temps.edit', $emploi) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('admin.emplois-du-temps.destroy', $emploi) }}" method="POST"
                          style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet emploi du temps ?')">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
