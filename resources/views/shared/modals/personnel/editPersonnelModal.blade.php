<!-- Modal pour la modification du personnel administratif -->
<div class="modal fade" id="editPersonnelModal-{{ $personnel->id }}" tabindex="-1"
     aria-labelledby="editPersonnelModalLabel-{{ $personnel->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPersonnelModalLabel-{{ $personnel->id }}">Modifier Personnel
                    Administratif</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Affichage des erreurs -->
                <div id="errorMessages-{{ $personnel->id }}" class="alert alert-danger d-none"></div>

                <form id="editPersonnelForm-{{ $personnel->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nom-{{ $personnel->id }}" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom-{{ $personnel->id }}" name="nom"
                                       value="{{ old('nom', $personnel->user->nom) }}" required>
                                <div id="error-nom-{{ $personnel->id }}" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="prenom-{{ $personnel->id }}" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="prenom-{{ $personnel->id }}" name="prenom"
                                       value="{{ old('prenom', $personnel->user->prenom) }}" required>
                                <div id="error-prenom-{{ $personnel->id }}" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="login-{{ $personnel->id }}" class="form-label">Login</label>
                                <input type="text" class="form-control" id="login-{{ $personnel->id }}" name="login"
                                       value="{{ old('login', $personnel->user->login) }}" required>
                                <div id="error-login-{{ $personnel->id }}" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email-{{ $personnel->id }}" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email-{{ $personnel->id }}" name="email"
                                       value="{{ old('email', $personnel->user->email) }}" required>
                                <div id="error-email-{{ $personnel->id }}" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="telephone-{{ $personnel->id }}" class="form-label">Téléphone</label>
                                <input type="text" class="form-control" id="telephone-{{ $personnel->id }}"
                                       name="telephone" value="{{ old('telephone', $personnel->user->telephone) }}" required>
                                <div id="error-telephone-{{ $personnel->id }}" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="role_id-{{ $personnel->id }}" class="form-label">Rôle</label>
                                <select name="role_id" id="role_id-{{ $personnel->id }}" class="form-select">
                                    @foreach($roles as $id => $nom)
                                        <option value="{{ $id }}" {{ old('role_id', $personnel->role_id) == $id ? 'selected' : '' }}>
                                            {{ $nom }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="error-role_id-{{ $personnel->id }}" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="image-{{ $personnel->id }}" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image-{{ $personnel->id }}" name="image">
                                <div id="error-image-{{ $personnel->id }}" class="text-danger"></div>
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
        const form = document.getElementById('editPersonnelForm-{{ $personnel->id }}');

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            let formData = new FormData(form);

            fetch('{{ route('admin.personnel_administratifs.update', $personnel) }}', {
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
                    let errorMessages = document.getElementById('errorMessages-{{ $personnel->id }}');
                    let errorFields = document.querySelectorAll('[id^=error-]');
                    errorFields.forEach(field => field.innerHTML = '');

                    if (obj.status === 422) { // Validation errors
                        errorMessages.classList.remove('d-none');
                        errorMessages.innerHTML = '';
                        for (let field in obj.body.errors) {
                            let errors = obj.body.errors[field];
                            errors.forEach(error => {
                                let errorElement = document.getElementById('error-' + field + '-{{ $personnel->id }}');
                                if (errorElement) {
                                    errorElement.innerHTML += `<p>${error}</p>`;
                                }
                            });
                        }
                    } else if (obj.status === 200) { // Success
                        $('#editPersonnelModal-{{ $personnel->id }}').modal('hide');
                        location.reload(); // Rafraîchit la page après la modification
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>
