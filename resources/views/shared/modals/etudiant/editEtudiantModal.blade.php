<!-- Modal pour la modification de l'étudiant -->
<div class="modal fade" id="editEtudiantModal-{{ $etudiant->id }}" tabindex="-1" aria-labelledby="editEtudiantModalLabel-{{ $etudiant->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEtudiantModalLabel-{{ $etudiant->id }}">Modifier Étudiant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Affichage des erreurs -->
                <div id="errorMessages-{{ $etudiant->id }}" class="alert alert-danger d-none"></div>

                <form id="editEtudiantForm-{{ $etudiant->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nom-{{ $etudiant->id }}" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom-{{ $etudiant->id }}" name="nom" value="{{ old('nom', $etudiant->user->nom) }}" required>
                                <div id="error-nom-{{ $etudiant->id }}" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="prenom-{{ $etudiant->id }}" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="prenom-{{ $etudiant->id }}" name="prenom" value="{{ old('prenom', $etudiant->user->prenom) }}" required>
                                <div id="error-prenom-{{ $etudiant->id }}" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="login-{{ $etudiant->id }}" class="form-label">Login</label>
                                <input type="text" class="form-control" id="login-{{ $etudiant->id }}" name="login" value="{{ old('login', $etudiant->user->login) }}" required>
                                <div id="error-login-{{ $etudiant->id }}" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email-{{ $etudiant->id }}" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email-{{ $etudiant->id }}" name="email" value="{{ old('email', $etudiant->user->email) }}" required>
                                <div id="error-email-{{ $etudiant->id }}" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="telephone-{{ $etudiant->id }}" class="form-label">Téléphone</label>
                                <input type="text" class="form-control" id="telephone-{{ $etudiant->id }}" name="telephone" value="{{ old('telephone', $etudiant->user->telephone) }}" required>
                                <div id="error-telephone-{{ $etudiant->id }}" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="filiere_id-{{ $etudiant->id }}" class="form-label">Filière</label>
                                <select name="filiere_id" id="filiere_id-{{ $etudiant->id }}" class="form-select">
                                    @foreach($filieres as $id => $nom)
                                        <option value="{{ $id }}" {{ old('filiere_id', $etudiant->filiere_id) == $id ? 'selected' : '' }}>
                                            {{ $nom }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="error-filiere_id-{{ $etudiant->id }}" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="etat_paiement-{{ $etudiant->id }}" class="form-label">État de Paiement</label>
                                <input type="text" class="form-control" id="etat_paiement-{{ $etudiant->id }}" name="etat_paiement" value="{{ old('etat_paiement', $etudiant->etat_paiement) }}" required>
                                <div id="error-etat_paiement-{{ $etudiant->id }}" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="image-{{ $etudiant->id }}" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image-{{ $etudiant->id }}" name="image">
                                <div id="error-image-{{ $etudiant->id }}" class="text-danger"></div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript pour la gestion AJAX -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('editEtudiantForm-{{ $etudiant->id }}');

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            let formData = new FormData(form);

            fetch('{{ route('admin.etudiant.update', $etudiant) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
                .then(response => response.json().then(data => ({
                    status: response.status,
                    body: data
                })))
                .then(obj => {
                    let errorMessages = document.getElementById('errorMessages-{{ $etudiant->id }}');
                    let errorFields = document.querySelectorAll('[id^=error-]');
                    errorFields.forEach(field => field.innerHTML = '');

                    if (obj.status === 422) { // Validation errors
                        errorMessages.classList.remove('d-none');
                        errorMessages.innerHTML = '';
                        for (let field in obj.body.errors) {
                            let errors = obj.body.errors[field];
                            errors.forEach(error => {
                                let errorElement = document.getElementById('error-' + field + '-{{ $etudiant->id }}');
                                if (errorElement) {
                                    errorElement.innerHTML += `<p>${error}</p>`;
                                }
                            });
                        }
                    } else if (obj.status === 200) { // Success
                        $('#editEtudiantModal-{{ $etudiant->id }}').modal('hide');
                        location.reload(); // Rafraîchit la page après la modification
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>
