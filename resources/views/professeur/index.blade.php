@extends('professeur.base')

@section('title', "Page d'accueil")

@section('content')
    <div class="container mt-5">
        <!-- Tableau de bord -->
        {{--        <div class="row mb-4">--}}
        {{--            <div class="col-md-2">--}}
        {{--                <div class="card text-center">--}}
        {{--                    <div class="card-header">--}}
        {{--                        Professeurs--}}
        {{--                    </div>--}}
        {{--                    <div class="card-body">--}}
        {{--                        <h5 class="card-title">{{ $nombreProfesseurs }}</h5>--}}
        {{--                        <p class="card-text">Nombre de professeurs</p>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--            <div class="col-md-2">--}}
        {{--                <div class="card text-center">--}}
        {{--                    <div class="card-header">--}}
        {{--                        Étudiants--}}
        {{--                    </div>--}}
        {{--                    <div class="card-body">--}}
        {{--                        <h5 class="card-title">{{ $nombreEtudiants }}</h5>--}}
        {{--                        <p class="card-text">Nombre d'étudiants</p>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--            <div class="col-md-2">--}}
        {{--                <div class="card text-center">--}}
        {{--                    <div class="card-header">--}}
        {{--                        Paiements--}}
        {{--                    </div>--}}
        {{--                    <div class="card-body">--}}
        {{--                        <h5 class="card-title">{{ number_format($totalPaiements, 2, ',', ' ') }} €</h5>--}}
        {{--                        <p class="card-text">Total des paiements</p>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--            <div class="col-md-2">--}}
        {{--                <div class="card text-center">--}}
        {{--                    <div class="card-header">--}}
        {{--                        Filières--}}
        {{--                    </div>--}}
        {{--                    <div class="card-body">--}}
        {{--                        <h5 class="card-title">{{ $nombreFilieres }}</h5>--}}
        {{--                        <p class="card-text">Nombre de filières</p>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--            <div class="col-md-2">--}}
        {{--                <div class="card text-center">--}}
        {{--                    <div class="card-header">--}}
        {{--                        Personnel--}}
        {{--                    </div>--}}
        {{--                    <div class="card-body">--}}
        {{--                        <h5 class="card-title">{{ $nombrePersonnel }}</h5>--}}
        {{--                        <p class="card-text">Nombre de personnel administratif</p>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        <!-- Cartes existantes -->
        <div class="row gap-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Étudiants
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Gérer les étudiants</h5>
                        <p class="card-text">Ajouter, modifier ou supprimer les notes des étudiants.</p>
                        <a href="{{ route('professeur.modules.index') }}" class="btn btn-primary">Voir la liste</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Ressources
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Gérer les ressources</h5>
                        <p class="card-text">Ajouter, modifier ou supprimer des professeurs.</p>
                        <a href="{{ route('professeur.ressources.index') }}" class="btn btn-primary">Voir la liste</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Ressources
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Gérer les reclamation</h5>
                        <p class="card-text">Ajouter, modifier ou supprimer des reclamation.</p>
                        <a href="{{ route('professeur.reclamation.index') }}" class="btn btn-primary">Voir la liste</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Ressources
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Gérer les annonces</h5>
                        <p class="card-text">Ajouter, modifier ou supprimer des annonces.</p>
                        <a href="{{ route('professeur.annonces.index') }}" class="btn btn-primary">Voir la liste</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Emplois du temps
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Gérer les annonces</h5>
                        <p class="card-text">Ajouter, modifier ou supprimer des annonces.</p>
                        <a href="{{ route('professeur.emploi_du_temps') }}" class="btn btn-primary">Voir la liste</a>
                    </div>
                </div>
            </div>
        </div>

@endsection
