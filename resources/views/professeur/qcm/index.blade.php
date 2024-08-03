@extends('professeur.base')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Mes Évaluations (QCM)</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-3">
            <a href="{{ route('professeur.qcm.create') }}" class="btn btn-primary">Créer un nouveau QCM</a>
        </div>

        @if($qcms->isEmpty())
            <div class="alert alert-info">
                Vous n'avez aucune évaluation pour le moment.
            </div>
        @else
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Module</th>
                    <th>Thème</th>
                    <th>Date de création</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($qcms as $qcm)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $qcm->module->nom_module }}</td>
                        <td>{{ $qcm->theme }}</td>
                        <td>{{ $qcm->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('professeur.qcm.show', $qcm->id) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('professeur.qcm.edit', $qcm->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('professeur.qcm.destroy', $qcm->id) }}" method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce QCM ?')">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
