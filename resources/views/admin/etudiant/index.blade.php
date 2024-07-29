@extends('admin.base')

@section('title', 'Liste des Étudiants')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Liste des Étudiants</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

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
                                    Paiement:</strong> {{ number_format($etudiant->etat_paiement , thousands_separator: ' ') }}
                                $
                            </p>
                            <a href="#" class="btn btn-primary">Voir Détails</a>
                            <button class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#editEtudiantModal-{{ $etudiant->id }}">Modifier
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal pour modifier un étudiant -->
                <div class="modal fade" id="editEtudiantModal-{{ $etudiant->id }}" tabindex="-1"
                     aria-labelledby="editEtudiantModalLabel-{{ $etudiant->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editEtudiantModalLabel-{{ $etudiant->id }}">Modifier
                                    Étudiant</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.etudiant.update', $etudiant->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="nom" class="form-label">Nom</label>
                                        <input type="text" class="form-control" id="nom" name="nom"
                                               value="{{ $etudiant->user->nom }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="{{ $etudiant->user->email }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="telephone" class="form-label">Téléphone</label>
                                        <input type="text" class="form-control" id="telephone"
                                               name="telephone" value="{{ $etudiant->user->telephone }}"
                                               required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Filière</label>
                                        <select name="filiere_id" id="filiere_id" class="form-control">
                                            @foreach($filieres as $id => $nom)
                                                <option value="{{ $id }}"
                                                    {{ $etudiant->filiere_id == $id ? 'selected' : '' }}>
                                                    {{ $nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="etat_paiement" class="form-label">État de Paiement</label>
                                        <input type="text" class="form-control" id="etat_paiement"
                                               name="etat_paiement" value="{{ $etudiant->etat_paiement }}" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include('admin.pagination', ['data' => $etudiants])
@endsection
