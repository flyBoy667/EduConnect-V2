@extends('admin.base')

@section('title', 'Liste des modules')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">@yield('title')</h1>

        <!-- Bouton pour ouvrir le modal d'ajout -->
        <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addModuleModal">
            Ajouter un modules
        </button>

        <!-- Modal pour ajouter une annonce -->
        @include('shared.modals.modules.addModuleModale')

        <div class="row">
            @foreach($modules as $module)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $module->nom_module }}</h5>
                            <p class="card-text">
                                @if($module->description)
                                    {{ $module->description }}
                                @endif
                                <br>
                                <strong>Filieres:</strong> {{ $module->filiere->nom_filiere }} <br>
                                <strong>Professeur:</strong> {{ $module->professeur->user->prenom }} {{ $module->professeur->user->nom }}
                            </p>
                            <a href="#" class="btn btn-primary">Voir Détails</a>
                            <button class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#editModuleModal-{{ $module->id }}">Modifier
                            </button>
                            <!-- Formulaire pour supprimer le module -->
                            <form action="{{ route('admin.modules.destroy', $module) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('etes-vous sur de vouloir supprimer ce module ?')">
                                    Supprimer
                                </button>
                            </form>

                            <!-- Modal pour modifier une annonce -->
                            @include('shared.modals.modules.editModule', ['module' => $module])
                            @endforeach
                        </div>
                    </div>

    @include('admin.pagination', ['data' => $modules])
@endsection
