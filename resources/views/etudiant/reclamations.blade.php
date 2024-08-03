<!-- resources/views/etudiant/reclamations.blade.php -->

@extends('etudiant.base')

@section('content')
    <div class="container">
        <h1>Mes Réclamations</h1>

        @if ($reclamations->isEmpty())
            <div class="alert alert-info">
                Vous n'avez aucune réclamation.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Module</th>
                        <th>Professeur</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($reclamations as $reclamation)
                        <tr>
                            <td>{{ $reclamation->module->nom_module }}</td>
                            <td> {{$reclamation->professeur->user->prenom}} {{ $reclamation->professeur->user->nom }}</td>
                            <td>{{ $reclamation->description }}</td>
                            <td>{{ $reclamation->date }}</td>
                            <td>
                                @switch($reclamation->status)
                                    @case(0)
                                        En attente
                                        @break
                                    @case(1)
                                        Rejettée
                                        @break
                                    @case(2)
                                        Traité
                                        @break
                                    @default
                                        Inconnu
                                @endswitch
                            </td>
                            <td>
                                <form action="{{ route('reclamation.destroy', $reclamation->id) }}" method="POST"
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réclamation ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
