@extends('professeur.base')

@section('title', 'Ressources')

@section('content')
    <div class="mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addResourceModal">
            Ajouter une Ressource
        </button>
    </div>
    <!-- Modal pour ajouter une ressource -->
    @include('shared.modals.professeur.ressources.addRessourceModal')

    <div class="container mt-5">
        <h1 class="mb-4">Ressources</h1>
        <!-- Liste des ressources -->
        @forelse($ressources as $resource)
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $resource->nom }}</h5>
                            <p class="card-text">{{ $resource->description }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                @if($resource->fichier)
                                    <a href="{{ $resource->fileUrl() }}" class="btn btn-primary"
                                       target="_blank">Télécharger</a>
                                @endif
                                <button class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#editResourceModal-{{ $resource->id }}">Modifier
                                </button>
                                <form action="{{ route('professeur.ressources.destroy', $resource->id) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('shared.modals.professeur.ressources.editRessourcesModal')
        @empty
            <p class="text-center">Aucune ressource disponible pour ce cours.</p>
        @endforelse
    </div>

@endsection
