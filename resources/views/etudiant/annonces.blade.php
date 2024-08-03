@extends('etudiant.base')

@section('title', 'Liste des annonces')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">@yield('title')</h1>

        <div class="row">
            @foreach($annonces as $annonce)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $annonce->imageUrl()  }}"
                             class="card-img-top"
                             alt="Image de {{ $annonce->titre }}"
                             style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $annonce->titre }}</h5>
                            <p class="card-text">
                                <strong>Contenu:</strong> {{ $annonce->contenu }}<br>
                                <strong>Début:</strong> {{ $annonce->dateDebut }}<br>
                                <strong>Fin:</strong> {{ $annonce->dateFin }}<br>
                                <strong>Créé par:</strong> {{ $annonce->user->nom }} {{ $annonce->user->prenom }}<br>
                                <strong>Filieres:</strong> {{ $annonce->filiere->nom_filiere }}
                            </p>
                            <a href="#" class="btn btn-primary">Voir Détails</a>
                            <button class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#editAnnonceModal-{{ $annonce->id }}">Modifier
                            </button>
                            <!-- Formulaire pour supprimer l'annonce -->
                            <form action="{{ route('admin.annonces.destroy', $annonce) }}" method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?')">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>

    @include('admin.pagination', ['data' => $annonces])
@endsection
