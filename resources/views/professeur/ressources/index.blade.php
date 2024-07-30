@extends('professeur.base')

@section('title', 'Ressources')

@section('content')
    <div class="mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addResourceModal">
            Ajouter une Ressource
        </button>
    </div>
    <!-- Modal pour ajouter une ressource -->
    @include('shared.modals.professeur.addRessourceModal')

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
                            <a href="{{ $resource->fileUrl() }}" class="btn btn-primary" download>Télécharger</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Aucune ressource disponible pour ce cours.</p>
        @endforelse
    </div>

@endsection
