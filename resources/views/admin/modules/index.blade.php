@extends('admin.base')

@section('title', 'Liste des modules')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">@yield('title')</h1>

        <!-- Bouton pour ouvrir le modal d'ajout -->
        <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addModuleModal">
            Ajouter un module
        </button>

        <!-- Modal pour ajouter un module -->
        @include('shared.modals.modules.addModuleModale')

        <div class="row">
            @foreach($modules as $module)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $module->nom_module }}</h5>
                            <p class="card-text">
                                @if($module->description)
                                    <small class="text-muted">{{ $module->description }}</small>
                                @endif
                                <br>
                                <strong>Filière:</strong> {{ $module->filiere->nom_filiere }} <br>
                                <strong>Professeur:</strong> {{ $module->professeur->user->prenom }} {{ $module->professeur->user->nom }}
                            </p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="#" class="btn btn-primary btn-sm">Voir Détails</a>
                            <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModuleModal-{{ $module->id }}">Modifier</button>
                            <!-- Formulaire pour supprimer le module -->
                            <form action="{{ route('admin.modules.destroy', $module) }}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce module ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </div>
                    </div>

                    <!-- Modal pour modifier un module -->
                    @include('shared.modals.modules.editModule', ['module' => $module])
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @include('admin.pagination', ['data' => $modules])
    </div>
@endsection
