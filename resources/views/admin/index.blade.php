@extends('admin.base')

@section('title', 'Administration')

@section('content')
    <div class="container mt-5">
        <!-- Tableau de bord -->
        <div class="row mb-4">
            <div class="col-md-2">
                <div class="card text-center">
                    <div class="card-header">
                        Professeurs
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $nombreProfesseurs }}</h5>
                        <p class="card-text">Nombre de professeurs</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card text-center">
                    <div class="card-header">
                        Étudiants
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $nombreEtudiants }}</h5>
                        <p class="card-text">Nombre d'étudiants</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card text-center">
                    <div class="card-header">
                        Paiements
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ number_format($totalPaiements, 2, ',', ' ') }} €</h5>
                        <p class="card-text">Total des paiements</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card text-center">
                    <div class="card-header">
                        Filières
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $nombreFilieres }}</h5>
                        <p class="card-text">Nombre de filières</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card text-center">
                    <div class="card-header">
                        Personnel
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $nombrePersonnel }}</h5>
                        <p class="card-text">Nombre de personnel administratif</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cartes existantes -->
        <div class="row gap-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Étudiants
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Gérer les étudiants</h5>
                        <p class="card-text">Ajouter, modifier ou supprimer des étudiants.</p>
                        <a href="{{ route('admin.etudiant.index') }}" class="btn btn-primary">Voir la liste</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Professeurs
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Gérer les professeurs</h5>
                        <p class="card-text">Ajouter, modifier ou supprimer des professeurs.</p>
                        <a href="{{ route('admin.professeur.index') }}" class="btn btn-primary">Voir la liste</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Administrateurs
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Gérer les administrateurs</h5>
                        <p class="card-text">Ajouter, modifier ou supprimer des administrateurs.</p>
                        <a href="{{ route('admin.personnel_administratifs.index') }}" class="btn btn-primary">Voir la
                            liste</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Filières
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Gérer les filières</h5>
                        <p class="card-text">Ajouter, modifier ou supprimer des filières.</p>
                        <a href="{{route('admin.filieres.index')}}" class="btn btn-primary">Voir la liste</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Annonces
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Gérer les annonces</h5>
                        <p class="card-text">Ajouter, modifier ou supprimer des annonces.</p>
                        <a href="{{ route('admin.annonces.index') }}" class="btn btn-primary">Voir la liste</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Annonces
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Gérer les modules</h5>
                        <p class="card-text">Ajouter, modifier ou supprimer des modules.</p>
                        <a href="{{ route('admin.modules.index') }}" class="btn btn-primary">Voir la liste</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
