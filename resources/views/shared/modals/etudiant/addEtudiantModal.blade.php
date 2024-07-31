<!-- Modal pour l'ajout d'un étudiant -->
<div class="modal fade" id="addEtudiantModal" tabindex="-1" aria-labelledby="addEtudiantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEtudiantModalLabel">Ajouter un Étudiant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addEtudiantForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}">
                                <div id="error-nom" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom">
                                <div id="error-prenom" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="login" class="form-label">Login</label>
                                <input type="text" class="form-control" id="login" name="login">
                                <div id="error-login" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                                <div id="error-email" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="telephone" class="form-label">Téléphone</label>
                                <input type="text" class="form-control" id="telephone" name="telephone">
                                <div id="error-telephone" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="filiere_id" class="form-label">Filière</label>
                                <select name="filiere_id" id="filiere_id" class="form-select">
                                    @foreach($filieres as $id => $nom)
                                        <option value="{{ $id }}" {{ old('filiere_id') == $id ? 'selected' : '' }}>
                                            {{ $nom }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="error-filiere_id" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="etat_paiement" class="form-label">État de Paiement</label>
                                <input type="text" class="form-control" id="etat_paiement" name="etat_paiement">
                                <div id="error-etat_paiement" class="text-danger"></div>
                            </div>
                        </div>
                    </div>
                    <div id="errorMessages" class="alert alert-danger d-none"></div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript pour la gestion AJAX -->
<script>
    document.getElementById('addEtudiantForm').addEventListener('submit', function (event) {
        event.preventDefault();
        let form = this;
        let formData = new FormData(form);

        fetch("{{ route('admin.etudiant.store') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                let errorMessages = document.getElementById('errorMessages');
                let errorFields = document.querySelectorAll('[id^=error-]');
                errorFields.forEach(field => field.innerHTML = '');

                if (data.errors) {
                    errorMessages.classList.remove('d-none');
                    errorMessages.innerHTML = '';
                    for (let field in data.errors) {
                        let errors = data.errors[field];
                        errors.forEach(error => {
                            let errorElement = document.getElementById('error-' + field);
                            if (errorElement) {
                                errorElement.innerHTML += `<p>${error}</p>`;
                            }
                        });
                    }
                } else {
                    form.reset();
                    $('#addEtudiantModal').modal('hide');
                    errorMessages.classList.add('d-none');
                    location.reload(); // Optionnel: Rafraîchit la page après l'ajout
                }
            })
            .catch(error => {
                console.error('Error:', error);
                let errorMessages = document.getElementById('errorMessages');
                errorMessages.classList.remove('d-none');
                errorMessages.innerHTML = `<p>Une erreur s'est produite. Veuillez réessayer.</p>`;
            });
    });
</script>
