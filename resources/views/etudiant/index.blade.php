@extends('etudiant.base')

@section('title', "Page d'accueil")

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Page d'accueil</h1>
        <p>Bienvenue sur votre espace étudiant!</p>

        <div class="row">
            <!-- Card pour les ressources -->
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ressources</h5>
                        <p class="card-text">Consultez toutes vos ressources disponibles.</p>
                        <a href="{{ route('etudiant.ressources.index') }}" class="btn btn-primary">Voir les
                            ressources</a>
                    </div>
                </div>
            </div>

            <!-- Card pour les notes -->
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Notes</h5>
                        <p class="card-text">Consultez vos notes et résultats académiques.</p>
                        <a href="{{ route('etudiant.notes.index') }}" class="btn btn-primary">Voir les notes</a>
                    </div>
                </div>
            </div>

            <!-- Card pour les annonces -->
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Annonces</h5>
                        <p class="card-text">Consultez les dernières annonces et mises à jour.</p>
                        <a href="{{route('etudiant.annonces.index')}}" class="btn btn-primary">Voir les annonces</a>
                    </div>
                </div>
            </div>

            <!-- Card pour l'emploi du temps -->
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Emploi du temps</h5>
                        <p class="card-text">Consultez votre emploi du temps pour le semestre.</p>
                        <a href="" class="btn btn-primary">Voir l'emploi du
                            temps</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Reclamations</h5>
                        <p class="card-text">Consultez les reclamations.</p>
                        <a href="{{route('etudiant.reclamations.index')}}" class="btn btn-primary">Voir les reclamations</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
