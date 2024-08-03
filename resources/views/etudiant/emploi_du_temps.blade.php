@extends('etudiant.base')
<style>
    .table {
        margin: 0 auto; /* Centrer le tableau */
        width: 80%; /* Ajuster la largeur du tableau */
    }

    .table th, .table td {
        text-align: center; /* Centrer le texte dans les cellules */
        vertical-align: middle; /* Centrer verticalement le texte dans les cellules */
    }

    .thead-dark th {
        background-color: #343a40;
        color: #fff;
    }
</style>

@section('content')
    <h1 class="text-center my-4">Emploi du temps de la filière</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
            <tr>
                <th>Jour</th>
                <th>Heure de début</th>
                <th>Heure de fin</th>
                <th>Module</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($emploisDuTemps as $emploi)
                <tr>
                    <td>{{ ucfirst($emploi->jour) }}</td>
                    <td>{{ $emploi->heure_debut }}</td>
                    <td>{{ $emploi->heure_fin }}</td>
                    <td>{{ $emploi->module->nom_module }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
