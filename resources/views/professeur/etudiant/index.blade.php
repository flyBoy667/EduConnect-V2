@extends('professeur.base')

@section('title', 'Modules Enseignés')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">@yield('title')</h1>

        <div class="row">
            @foreach($professeur->modules as $module)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $module->nom_module }}</h5>
                            <p class="card-text">
                                @if($module->description)
                                    {{ $module->description }}
                                @else
                                    Pas de description disponible.
                                @endif
                            </p>
                            <a href="{{route('professeur.etudiant.index')}}" class="btn btn-primary"
                               data-bs-toggle="modal"
                               data-bs-target="#editModuleModal-{{ $module->id }}">Voir la classe</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
