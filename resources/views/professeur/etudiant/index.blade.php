@extends('professeur.base')

@section('title', 'Liste des étudiants et leurs notes dans le module')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">@yield('title')</h1>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Note d'examen</th>
                <th>Note de classe</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            @foreach($etudiants as $etudiant)
                <tr>
                    <td>{{ $etudiant->user->nom }}</td>
                    <td>{{ $etudiant->user->prenom }}</td>
                    @php
                        $notes = $etudiant->modules->where('id', $module->id)->first();
                    @endphp
                    <td>{{ $notes->pivot->note_examen ?? 'N/A' }}</td>
                    <td>{{ $notes->pivot->note_classe ?? 'N/A' }}</td>
                    <td>
                        <button class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#editNotesModal-{{ $etudiant->id }}">
                            Modifier les notes
                        </button>
                    </td>
                </tr>
                <!-- Modal pour modifier les notes -->
                @include('shared.modals.professeur.editNotes')
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
