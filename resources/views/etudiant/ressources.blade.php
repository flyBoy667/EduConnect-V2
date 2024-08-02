@extends('etudiant.base')

@section('title', "Les ressources")

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Les ressources</h1>

        @if($ressources->isEmpty())
            <p>Aucune ressource disponible pour le moment.</p>
        @else
            <div class="row">
                @foreach($ressources as $ressource)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $ressource->nom }}</h5>
                                <p class="card-text"><strong>Module :</strong> {{ $ressource->module->nom_module }}</p>
                                <p class="card-text"><strong>Professeur :</strong> {{ $ressource->professeur->user->nom }} {{ $ressource->professeur->user->prenom }}</p>
                                <p class="card-text"><strong>Date de publication :</strong> {{ $ressource->created_at->format('d/m/Y') }}</p>
                                <a href="{{ $ressource->fileUrl() }}" class="btn btn-primary" download>Télécharger</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
