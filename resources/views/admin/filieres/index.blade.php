@extends('admin.base')

@section('title', 'Liste des Filières')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">@yield('title')</h1>

        <!-- Bouton pour ouvrir le modal d'ajout -->
        <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addFiliereModal">
            Ajouter une Filière
        </button>

        <div class="row">
            @foreach($filieres as $filiere)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $filiere->nom_filiere }}</h5>
                            <p class="card-text">
                                <strong>Description:</strong> {{ $filiere->description }}<br>
                                <strong>Montant de la
                                    Formation:</strong> {{ number_format($filiere->montant_formation, 2, ',', ' ') }} € <br>
                                <strong>Modules:</strong> @foreach($filiere->modules as $module)
                                                              {{ $module->nom_module}}
                                @endforeach
                            </p>
                            <button class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#editFiliereModal-{{ $filiere->id }}">Modifier
                            </button>
                            <!-- Formulaire pour supprimer la filière -->
                            <form action="{{ route('admin.filieres.destroy', $filiere) }}" method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette filière ?')">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal pour modifier une filière -->
                @include('shared.modals.filieres.editFiliereModal')
            @endforeach
        </div>
        @include('shared.modals.filieres.addFiliereModal')
        @include('admin.pagination', ['data' => $filieres])
    </div>
@endsection
