@extends('etudiant.base')

@section('title', "Les notes")

@section('content')
    <div class="container mt-5">
        <!-- Affichage de la moyenne générale -->
        <div class="alert alert-info text-center mb-4" style="font-size: 1.5rem; background-color: #17a2b8; color: white;">
            <strong>Moyenne Générale :</strong> {{ $moyenneGenerale }}
        </div>

        <h1 class="mb-4">Les notes par module</h1>

        @if($modules->isEmpty())
            <p>Aucun module avec des notes disponibles pour le moment.</p>
        @else
            <div class="row">
                @foreach($modules as $module)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $module->nom }}</h5>
                                <p class="card-text"><strong>Note d'examen :</strong> {{ $module->pivot->note_examen ?? 'N/A' }}</p>
                                <p class="card-text"><strong>Note de classe :</strong> {{ $module->pivot->note_classe ?? 'N/A' }}</p>
                                <p class="card-text"><strong>Moyenne :</strong>
                                    {{ number_format($etudiant->getAverageForModule($module), 2) }}
                                </p>
                                <p class="card-text"><strong>Professeur :</strong> {{ $module->professeur->user->nom }} {{ $module->professeur->user->prenom }}</p>
                                <p class="card-text"><strong>Date :</strong> {{ $module->pivot->updated_at->format('d/m/Y') }}</p>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#reclamationModal{{ $module->id }}">
                                    Faire une réclamation
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="reclamationModal{{ $module->id }}" tabindex="-1" aria-labelledby="reclamationModalLabel{{ $module->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="reclamationModalLabel{{ $module->id }}">Faire une réclamation pour {{ $module->nom }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('reclamation.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="module_id" value="{{ $module->id }}">
                                                    <input type="hidden" name="professeur_id" value="{{ $module->professeur->id }}">
                                                    <div class="mb-3">
                                                        <label for="description{{ $module->id }}" class="form-label">Description</label>
                                                        <textarea class="form-control" id="description{{ $module->id }}" name="description" rows="3" required></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Soumettre</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
