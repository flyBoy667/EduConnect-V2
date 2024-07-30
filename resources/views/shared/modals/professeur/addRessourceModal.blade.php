<!-- Modal pour ajouter une ressource -->
<div class="modal fade" id="addResourceModal" tabindex="-1" aria-labelledby="addResourceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addResourceModalLabel">Ajouter une Ressource</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addResourceForm" method="POST" enctype="multipart/form-data">
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
                                <label for="module_id" class="form-label">Module</label>
                                <select name="module_id" id="module_id" class="form-select">
                                    @foreach($modules as $module)
                                        <option value="{{ $module->id }}">{{ $module->nom_module }}</option>
                                    @endforeach
                                </select>
                                <div id="error-module_id" class="text-danger"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="fichier" class="form-label">Fichier</label>
                                <input type="file" class="form-control" id="fichier" name="fichier">
                                <div id="error-fichier" class="text-danger"></div>
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
    document.getElementById('addResourceForm').addEventListener('submit', function (event) {
        event.preventDefault();
        let form = this;
        let formData = new FormData(form);

        fetch("{{ route('professeur.ressources.store') }}", { // Assurez-vous que cette route correspond à celle de votre contrôleur
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
                    $('#addResourceModal').modal('hide');
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
