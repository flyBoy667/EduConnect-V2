@extends('admin.base')
@section('title', 'Éditer Professeur')
@section('content')

    <div class="container mt-5">
        <h1 class="mb-4">Éditer le Professeur</h1>

        <form action="{{ route('admin.professeur.update', $professeur->id) }}" method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

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
                <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom"
                       value="{{ old('nom', $professeur->user->nom) }}" required>
                @error('nom')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom"
                       value="{{ old('prenom', $professeur->user->prenom) }}" required>
                @error('prenom')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" class="form-control @error('login') is-invalid @enderror" id="login" name="login"
                       value="{{ old('login', $professeur->user->login) }}" required>
                @error('login')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                       value="{{ old('email', $professeur->user->email) }}" required>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone"
                       name="telephone" value="{{ old('telephone', $professeur->user->telephone) }}" required>
                @error('telephone')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="specialites">Spécialités (séparées par des virgules)</label>
                <input type="text" class="form-control @error('specialites') is-invalid @enderror" id="specialites"
                       name="specialites"
                       value="{{ old('specialites', implode(', ', json_decode($professeur->specialites))) }}" required>
                @error('specialites')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                @if($professeur->user->image)
                    <div>
                        <img src="{{ asset('storage/' . $professeur->user->image) }}" alt="Image du Professeur"
                             style="max-width: 150px;">
                    </div>
                @endif
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="modal-footer">
                <a href="{{ route('admin.professeur.index') }}" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </div>
        </form>
    </div>

@endsection
