@extends('admin.base')
@section('title', 'Personnels Administratifs')
@section('content')

    <div class="container mt-5">
        <h1 class="mb-4">Liste des Personnels Administratifs</h1>

        <!-- Bouton pour ouvrir la boîte modale -->
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal"
                data-bs-target="#addPersonnelModal">
            Ajouter un Personnel Administratif
        </button>

        <div class="row">
            @foreach($personnels as $personnel)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img class="card-img-top" src="{{ $personnel->user->imageUrl() }}"
                             alt="Image de {{ $personnel->user->nom }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $personnel->user->nom }} {{ $personnel->user->prenom }}</h5>
                            <p class="card-text"><strong>Login:</strong> {{ $personnel->user->login }}</p>
                            <p class="card-text"><strong>Email:</strong> {{ $personnel->user->email }}</p>
                            <p class="card-text"><strong>Téléphone:</strong> {{ $personnel->user->telephone }}</p>
                            <p class="card-text"><strong>Rôle:</strong> {{ $personnel->role->nom }}</p>
                            <a href="{{ route('admin.personnel_administratifs.show', $personnel->id) }}"
                               class="btn btn-info btn-sm">Voir</a>
                            <button class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#editPersonnelModal-{{ $personnel->id }}">Modifier
                            </button>
                            <form action="{{ route('admin.personnel_administratifs.destroy', $personnel->id) }}"
                                  method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce personnel ?')">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @include('shared.modals.personnel.editPersonnelModal')
            @endforeach
        </div>
    </div>

    <!-- Boîte modale pour créer un personnel administratif -->
    @include('shared.modals.personnel.addPersonnelModal')

@endsection
