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
                            <img class="card-img-top" src="{{ $professeur->user->imageUrl() }}"
                                 alt="Image de {{ $professeur->user->nom }}">
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
                            <a href="{{ route('admin.professeur.show', $professeur) }}"
                               class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('admin.professeur.edit', $professeur) }}" class="btn btn-warning btn-sm">Éditer</a>
                            <form action="{{ route('admin.professeur.destroy', $professeur->id) }}" method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce professeur ?')">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Boîte modale pour créer un professeur -->
    @include('shared.modals.professeur.createProfModal')
@endsection
