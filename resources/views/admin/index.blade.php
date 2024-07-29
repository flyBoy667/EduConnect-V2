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
                        <a href="{{ route('etudiant.index') }}" class="btn btn-primary">Voir la liste</a>
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
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProfesseurModal">
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
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addAdminModal">Ajouter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modales pour ajouter des utilisateurs -->
    <div class="modal fade" id="addEtudiantModal" tabindex="-1" aria-labelledby="addEtudiantModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEtudiantModalLabel">Ajouter un étudiant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <!-- Formulaire pour ajouter un étudiant -->
                        <div class="mb-3">
                            <label for="etudiantName" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="etudiantName" required>
                        </div>
                        <div class="mb-3">
                            <label for="etudiantEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="etudiantEmail" required>
                        </div>
                        <!-- Ajoutez d'autres champs selon vos besoins -->
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addProfesseurModal" tabindex="-1" aria-labelledby="addProfesseurModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProfesseurModalLabel">Ajouter un professeur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <!-- Formulaire pour ajouter un professeur -->
                        <div class="mb-3">
                            <label for="professeurName" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="professeurName" required>
                        </div>
                        <div class="mb-3">
                            <label for="professeurEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="professeurEmail" required>
                        </div>
                        <!-- Ajoutez d'autres champs selon vos besoins -->
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAdminModalLabel">Ajouter un administrateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <!-- Formulaire pour ajouter un administrateur -->
                        <div class="mb-3">
                            <label for="adminName" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="adminName" required>
                        </div>
                        <div class="mb-3">
                            <label for="adminEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="adminEmail" required>
                        </div>
                        <!-- Ajoutez d'autres champs selon vos besoins -->
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
