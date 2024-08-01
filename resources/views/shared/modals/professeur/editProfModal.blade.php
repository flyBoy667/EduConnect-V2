<!-- Modal pour la modification de l'étudiant -->
<div class="modal fade" id="editProfModal-{{ $professeur->id }}" tabindex="-1"
     aria-labelledby="editProfModalLabel-{{ $professeur->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfModalLabel-{{ $professeur->id }}">Modifier Étudiant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Affichage des erreurs -->
                <div id="errorMessages-{{ $professeur->id }}" class="alert alert-danger d-none"></div>

                <form id="editProfForm-{{ $professeur->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nom-{{ $professeur->id }}" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom-{{ $professeur->id }}" name="nom"
                                       value="{{ old('nom', $professeur->user->nom) }}" required>
                                <div id="error-nom-{{ $professeur->id }}" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="prenom-{{ $professeur->id }}" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="prenom-{{ $professeur->id }}" name="prenom"
                                       value="{{ old('prenom', $professeur->user->prenom) }}" required>
                                <div id="error-prenom-{{ $professeur->id }}" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="login-{{ $professeur->id }}" class="form-label">Login</label>
                                <input type="text" class="form-control" id="login-{{ $professeur->id }}" name="login"
                                       value="{{ old('login', $professeur->user->login) }}" required>
                                <div id="error-login-{{ $professeur->id }}" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email-{{ $professeur->id }}" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email-{{ $professeur->id }}" name="email"
                                       value="{{ old('email', $professeur->user->email) }}" required>
                                <div id="error-email-{{ $professeur->id }}" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="telephone-{{ $professeur->id }}" class="form-label">Téléphone</label>
                                <input type="text" class="form-control" id="telephone-{{ $professeur->id }}"
                                       name="telephone" value="{{ old('telephone', $professeur->user->telephone) }}"
                                       required>
                                <div id="error-telephone-{{ $professeur->id }}" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="specialites" class="form-label">Specialites</label>
                                <input type="text" class="form-control" id="specialites" name="specialites"
                                       value="{{ old('specialites', implode(',', json_decode($professeur->specialites))) }}">
                            </div>
                            <div id=" error-specialites-{{ $professeur->id }}" class="text-danger">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="image-{{ $professeur->id }}" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image-{{ $professeur->id }}"
                                       name="image">
                                <div id="error-image-{{ $professeur->id }}" class="text-danger"></div>
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
        const form = document.getElementById('editProfForm-{{ $professeur->id }}');

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            let formData = new FormData(form);

            fetch('{{ route('admin.professeur.update', $professeur) }}', {
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
                    let errorMessages = document.getElementById('errorMessages-{{ $professeur->id }}');
                    let errorFields = document.querySelectorAll('[id^=error-]');
                    errorFields.forEach(field => field.innerHTML = '');

                    if (obj.status === 422) { // Validation errors
                        errorMessages.classList.remove('d-none');
                        errorMessages.innerHTML = '';
                        for (let field in obj.body.errors) {
                            let errors = obj.body.errors[field];
                            errors.forEach(error => {
                                let errorElement = document.getElementById('error-' + field + '-{{ $professeur->id }}');
                                if (errorElement) {
                                    errorElement.innerHTML += `<p>${error}</p>`;
                                }
                            });
                        }
                    } else if (obj.status === 200) { // Success
                        $('#editProfModal-{{ $professeur->id }}').modal('hide');
                        location.reload(); // Rafraîchit la page après la modification
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>
