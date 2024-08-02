<!-- Modal pour la mise à jour d'un module -->
<div class="modal fade" id="editModuleModal-{{ $module->id }}" tabindex="-1" aria-labelledby="editModuleModalLabel-{{ $module->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModuleModalLabel-{{ $module->id }}">Modifier Module</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Affichage des erreurs -->
                <div id="errorMessages-{{ $module->id }}" class="alert alert-danger d-none"></div>

                <form id="editModuleForm-{{ $module->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nom_module-{{ $module->id }}" class="form-label">Nom du Module</label>
                                <input type="text" class="form-control" id="nom_module-{{ $module->id }}" name="nom_module" value="{{ old('nom_module', $module->nom_module) }}" required>
                                <div id="error-nom_module-{{ $module->id }}" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="description-{{ $module->id }}" class="form-label">Description</label>
                                <textarea class="form-control" id="description-{{ $module->id }}" name="description" rows="3" required>{{ old('description', $module->description) }}</textarea>
                                <div id="error-description-{{ $module->id }}" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="professeur_id-{{ $module->id }}" class="form-label">Professeur</label>
                                <select class="form-select" id="professeur_id-{{ $module->id }}" name="professeur_id" required>
                                    @foreach($professeurs as $professeur)
                                        <option value="{{ $professeur->id }}" {{ old('professeur_id', $module->professeur_id) == $professeur->id ? 'selected' : '' }}>
                                            {{ $professeur->user->nom }} {{ $professeur->user->prenom }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="error-professeur_id-{{ $module->id }}" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="filiere_id-{{ $module->id }}" class="form-label">Filière</label>
                                <select class="form-select" id="filiere_id-{{ $module->id }}" name="filiere_id" required>
                                    @foreach($filieres as $id => $nom)
                                        <option value="{{ $id }}" {{ old('filiere_id', $module->filiere_id) == $id ? 'selected' : '' }}>
                                            {{ $nom }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="error-filiere_id-{{ $module->id }}" class="text-danger"></div>
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
        const form = document.getElementById('editModuleForm-{{ $module->id }}');

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            let formData = new FormData(form);

            fetch('{{ route('admin.modules.update', $module) }}', {
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
                    let errorMessages = document.getElementById('errorMessages-{{ $module->id }}');
                    let errorFields = document.querySelectorAll('[id^=error-]');
                    errorFields.forEach(field => field.innerHTML = '');

                    if (obj.status === 422) { // Validation errors
                        errorMessages.classList.remove('d-none');
                        errorMessages.innerHTML = '';
                        for (let field in obj.body.errors) {
                            let errors = obj.body.errors[field];
                            errors.forEach(error => {
                                let errorElement = document.getElementById('error-' + field + '-{{ $module->id }}');
                                if (errorElement) {
                                    errorElement.innerHTML += `<p>${error}</p>`;
                                }
                            });
                        }
                    } else if (obj.status === 200) { // Success
                        $('#editModuleModal-{{ $module->id }}').modal('hide');
                        location.reload(); // Rafraîchit la page après la modification
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>
