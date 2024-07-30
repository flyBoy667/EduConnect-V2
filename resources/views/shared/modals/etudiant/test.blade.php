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
            <!-- Autres cartes pour les professeurs, administrateurs, etc. -->
        </div>
    </div>

    <!-- Modal pour ajouter un étudiant -->
    <div class="modal fade" id="addEtudiantModal" tabindex="-1" aria-labelledby="addEtudiantModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEtudiantModalLabel">Ajouter un étudiant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addEtudiantForm">
                        <div class="mb-3">
                            <label for="etudiantName" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="etudiantName" name="etudiantName" required>
                        </div>
                        <div class="mb-3">
                            <label for="etudiantEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="etudiantEmail" name="etudiantEmail" required>
                        </div>
                        <div id="errorMessages" class="alert alert-danger d-none"></div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script AJAX pour gérer la soumission du formulaire -->
    <script>
        document.getElementById('addEtudiantForm').addEventListener('submit', function (event) {
            event.preventDefault();
            let form = this;
            let formData = new FormData(form);

            fetch("{{ route('etudiant.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.errors) {
                        let errorMessages = document.getElementById('errorMessages');
                        errorMessages.classList.remove('d-none');
                        errorMessages.innerHTML = '';
                        for (let field in data.errors) {
                            let error = data.errors[field][0];
                            errorMessages.innerHTML += `<p>${error}</p>`;
                        }
                    } else {
                        // Réinitialiser le formulaire et masquer la boîte modale
                        form.reset();
                        $('#addEtudiantModal').modal('hide');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
@endsection
