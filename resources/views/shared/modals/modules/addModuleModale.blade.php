<!-- Modal pour l'ajout d'un module -->
<div class="modal fade" id="addModuleModal" tabindex="-1" aria-labelledby="addModuleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModuleModalLabel">Ajouter un Module</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addModuleForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nom_module" class="form-label">Nom du Module</label>
                                <input type="text" class="form-control" id="nom_module" name="nom_module" value="{{ old('nom_module') }}">
                                <div id="error-nom_module" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                <div id="error-description" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="professeur_id" class="form-label">Professeur</label>
                                <select class="form-select" id="professeur_id" name="professeur_id">
                                    @foreach($professeurs as $professeur)
                                        <option value="{{ $professeur->id }}" {{ old('professeur_id') == $professeur->id ? 'selected' : '' }}>
                                            {{ $professeur->user->nom }} {{ $professeur->user->prenom }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="error-professeur_id" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="filiere_id" class="form-label">Filière</label>
                                <select class="form-select" id="filiere_id" name="filiere_id">
                                    @foreach($filieres as $id => $nom)
                                        <option value="{{ $id }}" {{ old('filiere_id') == $id ? 'selected' : '' }}>
                                            {{ $nom }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="error-filiere_id" class="text-danger"></div>
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

<script>
    document.getElementById('addModuleForm').addEventListener('submit', function (event) {
        event.preventDefault();
        let form = this;
        let formData = new FormData(form);

        fetch("{{ route('admin.modules.store') }}", {
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
                if (errorMessages) {
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
                        $('#addModuleModal').modal('hide');
                        errorMessages.classList.add('d-none');
                        location.reload(); // Optionnel: Rafraîchit la page après l'ajout
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                let errorMessages = document.getElementById('errorMessages');
                if (errorMessages) {
                    errorMessages.classList.remove('d-none');
                    errorMessages.innerHTML = `<p>Une erreur s'est produite. Veuillez réessayer.</p>`;
                }
            });
    });
</script>
