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
        <div class="modal fade" id="addEtudiantModal" tabindex="-1" aria-labelledby="addEtudiantModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEtudiantModalLabel">Ajouter un Étudiant</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Affichage des erreurs -->
                        @if($errors->any())
                            <div class="alert alert-danger mb-3">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.etudiant.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nom" class="form-label">Nom</label>
                                        <input type="text" class="form-control" id="nom" name="nom"
                                               value="{{ old('nom') }}" required>
                                        @error('nom')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="prenom" class="form-label">Prénom</label>
                                        <input type="text" class="form-control" id="prenom" name="prenom"
                                               value="{{ old('prenom') }}" required>
                                        @error('prenom')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="login" class="form-label">Login</label>
                                        <input type="text" class="form-control" id="login" name="login"
                                               value="{{ old('login') }}" required>
                                        @error('login')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="{{ old('email') }}" required>
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="telephone" class="form-label">Téléphone</label>
                                        <input type="text" class="form-control" id="telephone" name="telephone"
                                               value="{{ old('telephone') }}" required>
                                        @error('telephone')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="filiere_id" class="form-label">Filière</label>
                                        <select name="filiere_id" id="filiere_id" class="form-select">
                                            @foreach($filieres as $id => $nom)
                                                <option
                                                    value="{{ $id }}" {{ old('filiere_id') == $id ? 'selected' : '' }}>
                                                    {{ $nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('filiere_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="etat_paiement" class="form-label">État de Paiement</label>
                                        <input type="text" class="form-control" id="etat_paiement" name="etat_paiement"
                                               value="{{ old('etat_paiement') }}" required>
                                        @error('etat_paiement')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                        @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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
                <div class="modal fade" id="editEtudiantModal-{{ $etudiant->id }}" tabindex="-1"
                     aria-labelledby="editEtudiantModalLabel-{{ $etudiant->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editEtudiantModalLabel-{{ $etudiant->id }}">Modifier
                                    Étudiant</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Affichage des erreurs -->
                                @if($errors->any())
                                    <div class="alert alert-danger mb-3">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('admin.etudiant.update', $etudiant) }}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nom" class="form-label">Nom</label>
                                                <input type="text" class="form-control" id="nom" name="nom"
                                                       value="{{ old('nom', $etudiant->user->nom) }}" required>
                                                @error('nom')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="prenom" class="form-label">Prénom</label>
                                                <input type="text" class="form-control" id="prenom" name="prenom"
                                                       value="{{ old('prenom', $etudiant->user->prenom) }}" required>
                                                @error('prenom')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="login" class="form-label">Login</label>
                                                <input type="text" class="form-control" id="login" name="login"
                                                       value="{{ old('login', $etudiant->user->login) }}" required>
                                                @error('login')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                       value="{{ old('email', $etudiant->user->email) }}" required>
                                                @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="telephone" class="form-label">Téléphone</label>
                                                <input type="text" class="form-control" id="telephone" name="telephone"
                                                       value="{{ old('telephone', $etudiant->user->telephone) }}"
                                                       required>
                                                @error('telephone')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="filiere_id" class="form-label">Filière</label>
                                                <select name="filiere_id" id="filiere_id" class="form-select">
                                                    @foreach($filieres as $id => $nom)
                                                        <option
                                                            value="{{ $id }}" {{ old('filiere_id', $etudiant->filiere_id) == $id ? 'selected' : '' }}>
                                                            {{ $nom }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('filiere_id')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="etat_paiement" class="form-label">État de Paiement</label>
                                                <input type="text" class="form-control" id="etat_paiement"
                                                       name="etat_paiement"
                                                       value="{{ old('etat_paiement', $etudiant->etat_paiement) }}"
                                                       required>
                                                @error('etat_paiement')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Image</label>
                                                <input type="file" class="form-control" id="image" name="image">
                                                @error('image')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
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
