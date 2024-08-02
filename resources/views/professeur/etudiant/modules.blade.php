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
                                <br>
                                <strong>Filière:</strong> {{ $module->filiere->nom_filiere }} <br>
                            </p>
                            <a href="{{route('professeur.etudiant.index', $module)}}" class="btn btn-primary">Voir la classe</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
