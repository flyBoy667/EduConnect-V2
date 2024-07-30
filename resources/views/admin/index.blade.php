@extends('admin.base')

@section('title', 'Administration')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Étudiants
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Gérer les étudiants</h5>
                        <p class="card-text">Ajouter, modifier ou supprimer des étudiants.</p>
                        <a href="{{ route('admin.etudiant.index') }}" class="btn btn-primary">Voir la liste</a>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addEtudiantModal">
                            Ajouter
                        </button>
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
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createProfModal">
                            Ajouter
                        </button>
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
                        <a href="{{ route('professeur.index') }}" class="btn btn-primary">Voir la liste</a>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createPersonnelModal">Ajouter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modales pour ajouter des utilisateurs -->
    @include('shared.modals.etudiant.addEtudiantModal')
    @include('shared.modals.professeur.createProfModal')
    @include('shared.modals.personnel.createPersonnelModal')

@endsection
