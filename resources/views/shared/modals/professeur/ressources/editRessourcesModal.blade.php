<!-- Modal pour éditer une ressource -->
<div class="modal fade" id="editResourceModal-{{ $resource->id }}" tabindex="-1"
     aria-labelledby="editResourceModalLabel-{{ $resource->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editResourceModalLabel-{{ $resource->id }}">Éditer Ressource</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Affichage des erreurs -->
                <div id="errorMessages-{{ $resource->id }}" class="alert alert-danger d-none"></div>

                <form id="editResourceForm-{{ $resource->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nom-{{ $resource->id }}" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom-{{ $resource->id }}" name="nom"
                                       value="{{ old('nom', $resource->nom) }}" required>
                                <div id="error-nom-{{ $resource->id }}" class="text-danger"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="module_id-{{ $resource->id }}" class="form-label">Module</label>
                                <select name="module_id" id="module_id-{{ $resource->id }}" class="form-select"
                                        required>
                                    @foreach($modules as $module)
                                        <option
                                            value="{{ $module->id }}" {{ old('module_id', $resource->module_id) == $module->id ? 'selected' : '' }}>
                                            {{ $module->nom_module }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="error-module_id-{{ $resource->id }}" class="text-danger"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="fichier-{{ $resource->id }}" class="form-label">Fichier</label>
                                <input type="file" class="form-control" id="fichier-{{ $resource->id }}"
                                       name="fichier">
                                <div id="error-fichier-{{ $resource->id }}" class="text-danger"></div>
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
        const form = document.getElementById('editResourceForm-{{ $resource->id }}');

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            let formData = new FormData(form);

            fetch('{{ route('professeur.ressources.update', $resource->id) }}', {
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
                    let errorMessages = document.getElementById('errorMessages-{{ $resource->id }}');
                    let errorFields = document.querySelectorAll('[id^=error-]');
                    errorFields.forEach(field => field.innerHTML = '');

                    if (obj.status === 422) { // Validation errors
                        errorMessages.classList.remove('d-none');
                        errorMessages.innerHTML = '';
                        for (let field in obj.body.errors) {
                            let errors = obj.body.errors[field];
                            errors.forEach(error => {
                                let errorElement = document.getElementById('error-' + field + '-{{ $resource->id }}');
                                if (errorElement) {
                                    errorElement.innerHTML += `<p>${error}</p>`;
                                }
                            });
                        }
                    } else if (obj.status === 200) { // Success
                        $('#editResourceModal-{{ $resource->id }}').modal('hide');
                        location.reload(); // Rafraîchit la page après la modification
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>
