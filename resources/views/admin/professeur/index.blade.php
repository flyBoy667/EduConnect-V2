<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Liste des Professeurs</title>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Liste des Professeurs</h1>

    <!-- Bouton pour ouvrir la boîte modale -->
    <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#createProfModal">
        Ajouter un Professeur
    </button>

    <table class="table table-bordered table-striped table-hover">
        <thead class="thead-dark">
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Login</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Spécialités</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($professeurs as $professeur)
            <tr>
                <td>{{ $professeur->user->nom }}</td>
                <td>{{ $professeur->user->prenom }}</td>
                <td>{{ $professeur->user->login }}</td>
                <td>{{ $professeur->user->email }}</td>
                <td>{{ $professeur->user->telephone }}</td>
                <td>
                    @foreach (json_decode($professeur->specialites) as $specialite)
                        {{ $specialite }}<br>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('admin.professeur.show', $professeur->id) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('admin.professeur.edit', $professeur->id) }}" class="btn btn-warning btn-sm">Éditer</a>
                    <form action="{{ route('admin.professeur.destroy', $professeur->id) }}" method="POST"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce professeur ?')">Supprimer
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- Boîte modale pour créer un professeur -->
<div class="modal fade" id="createProfModal" tabindex="-1" role="dialog" aria-labelledby="createProfModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProfModalLabel">Créer un Nouveau Professeur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.professeur.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Affichage des erreurs de validation -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required>
                        @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" value="{{ old('prenom') }}" required>
                        @error('prenom')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="login">Login</label>
                        <input type="text" class="form-control @error('login') is-invalid @enderror" id="login" name="login" value="{{ old('login') }}" required>
                        @error('login')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="telephone">Téléphone</label>
                        <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{ old('telephone') }}" required>
                        @error('telephone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="specialites">Spécialités (séparées par des virgules)</label>
                        <input type="text" class="form-control @error('specialites') is-invalid @enderror" id="specialites" name="specialites" value="{{ old('specialites') }}" required>
                        @error('specialites')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
