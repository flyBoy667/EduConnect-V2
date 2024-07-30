@extends('admin.base')

@section('title', 'Liste des Étudiants')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Liste des Étudiants</h1>

        <!-- Bouton pour ouvrir le modal d'ajout -->
        <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addEtudiantModal">
            Ajouter un Étudiant
        </button>

        <!-- Modal pour ajouter un étudiant -->
        @include('shared.modals.etudiant.addEtudiantModal')
        <div class="row">
            @foreach($etudiants as $etudiant)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $etudiant->user->image ? $etudiant->user->imageUrl() : 'default-image.jpg' }}"
                             class="card-img-top"
                             alt="Image de {{ $etudiant->user->nom }}"
                             style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $etudiant->user->nom }} {{ $etudiant->user->prenom }}</h5>
                            <p class="card-text">
                                <strong>Email:</strong> {{ $etudiant->user->email }}<br>
                                <strong>Téléphone:</strong> {{ $etudiant->user->telephone }}<br>
                                <strong>Filière:</strong> {{ $etudiant->filiere->nom_filiere }}<br>
                                <strong>État de
                                    Paiement:</strong> {{ number_format($etudiant->etat_paiement, thousands_separator: ' ') }}
                                $
                            </p>
                            <a href="#" class="btn btn-primary">Voir Détails</a>
                            <button class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#editEtudiantModal-{{ $etudiant->id }}">Modifier
                            </button>
                            <!-- Formulaire pour supprimer l'étudiant -->
                            <form action="{{ route('admin.etudiant.destroy', $etudiant) }}" method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal pour modifier un étudiant -->
                @include('shared.modals.etudiant.editEtudiantModal')
            @endforeach
        </div>
    </div>

    @include('admin.pagination', ['data' => $etudiants])
@endsection
