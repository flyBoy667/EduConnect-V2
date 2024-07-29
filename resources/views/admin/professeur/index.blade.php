@extends('admin.base')
@section('title', 'Admin')
@section('content')

    <div class="container mt-5">
        <h1 class="mb-4">Liste des Professeurs</h1>

        <!-- Bouton pour ouvrir la boîte modale -->
        <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#createProfModal">
            Ajouter un Professeur
        </button>

        <div class="row">
            @foreach($professeurs as $professeur)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if($professeur->user->image)
                            <img class="card-img-top" src="{{ $professeur->user->imageUrl() }}" alt="Image de {{ $professeur->user->nom }}">
                        @else
                            <img class="card-img-top" src="placeholder-image-url" alt="Pas d'image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $professeur->user->nom }} {{ $professeur->user->prenom }}</h5>
                            <p class="card-text"><strong>Login:</strong> {{ $professeur->user->login }}</p>
                            <p class="card-text"><strong>Email:</strong> {{ $professeur->user->email }}</p>
                            <p class="card-text"><strong>Téléphone:</strong> {{ $professeur->user->telephone }}</p>
                            <p class="card-text"><strong>Spécialités:</strong>
                                @foreach (json_decode($professeur->specialites) as $specialite)
                                    {{ $specialite }}<br>
                                @endforeach
                            </p>
                            <a href="{{ route('admin.professeur.show', $professeur->id) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('admin.professeur.edit', $professeur->id) }}" class="btn btn-warning btn-sm">Éditer</a>
                            <form action="{{ route('admin.professeur.destroy', $professeur->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce professeur ?')">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Boîte modale pour créer un professeur -->
    <div class="modal fade" id="createProfModal" tabindex="-1" role="dialog" aria-labelledby="createProfModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createProfModalLabel">Créer un Nouveau Professeur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.professeur.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <!-- Affichage des erreurs de validation -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required>
                            @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" value="{{ old('prenom') }}" required>
                            @error('prenom')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="login">Login</label>
                            <input type="text" class="form-control @error('login') is-invalid @enderror" id="login" name="login" value="{{ old('login') }}" required>
                            @error('login')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="telephone">Téléphone</label>
                            <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{ old('telephone') }}" required>
                            @error('telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="specialites">Spécialités (séparées par des virgules)</label>
                            <input type="text" class="form-control @error('specialites') is-invalid @enderror" id="specialites" name="specialites" value="{{ old('specialites') }}" required>
                            @error('specialites')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Créer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
