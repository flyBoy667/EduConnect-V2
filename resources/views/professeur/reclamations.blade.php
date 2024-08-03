@extends('professeur.base')

@section('title', 'Réclamations')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Réclamations sur les modules enseignés</h1>

        @if($reclamations->isEmpty())
            <p>Aucune réclamation disponible pour le moment.</p>
        @else
            <div class="list-group">
                @foreach($reclamations as $reclamation)
                    <div class="list-group-item">
                        <h5 class="mb-1">Module : {{ $reclamation->module->nom_module }}</h5>
                        <p class="mb-1"><strong>Étudiant
                                :</strong> {{ $reclamation->etudiant->user->nom }} {{ $reclamation->etudiant->user->prenom }}
                        </p>
                        <p class="mb-1"><strong>Description :</strong> {{ $reclamation->description }}</p>
                        <small class="text-muted">Date : {{ $reclamation->date }}</small>
                        <button class="btn btn-primary btn-sm float-end" data-bs-toggle="modal"
                                data-bs-target="#reclamationModal_{{ $reclamation->id }}">Traiter
                        </button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="reclamationModal_{{ $reclamation->id }}" tabindex="-1"
                         aria-labelledby="reclamationModalLabel_{{ $reclamation->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="reclamationModalLabel_{{ $reclamation->id }}">Traiter la
                                        réclamation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="reclamationForm_{{ $reclamation->id }}"
                                          action="{{ route('professeur.reclamations.update', $reclamation) }}"
                                          method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="note_examen_{{ $reclamation->id }}" class="form-label">Note
                                                d'examen</label>
                                            <input type="number" class="form-control"
                                                   id="note_examen_{{ $reclamation->id }}" name="note_examen"
                                                   value="{{ $reclamation->module->etudiants->find($reclamation->etudiant->id)->pivot->note_examen ?? '' }}"
                                                   step="0.01">
                                        </div>
                                        <div class="mb-3">
                                            <label for="note_classe_{{ $reclamation->id }}" class="form-label">Note de
                                                classe</label>
                                            <input type="number" class="form-control"
                                                   id="note_classe_{{ $reclamation->id }}" name="note_classe"
                                                   value="{{ $reclamation->module->etudiants->find($reclamation->etudiant->id)->pivot->note_classe ?? '' }}"
                                                   step="0.01">
                                        </div>
                                        <div class="mb-3">
                                            <label for="status_{{ $reclamation->id }}" class="form-label">Statut</label>
                                            <select class="form-select" id="status_{{ $reclamation->id }}"
                                                    name="status">
                                                <option value="0" {{ $reclamation->status == 0 ? 'selected' : '' }}>En
                                                    attente
                                                </option>
                                                <option value="1" {{ $reclamation->status == 1 ? 'selected' : '' }}>
                                                    Rejeté
                                                </option>
                                                <option value="2" {{ $reclamation->status == 2 ? 'selected' : '' }}>
                                                    Accepté
                                                </option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Fermer
                                            </button>
                                            <button type="submit" class="btn btn-primary">Soumettre</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
