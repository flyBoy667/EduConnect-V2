<!-- Modal pour l'ajout d'une annonce -->
<div class="modal fade" id="addAnnonceModal" tabindex="-1" aria-labelledby="addAnnonceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAnnonceModalLabel">Ajouter une Annonce</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addAnnonceForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="titre" class="form-label">Titre</label>
                                <input type="text" class="form-control" id="titre" name="titre"
                                       value="{{ old('titre') }}">
                                <div id="error-titre" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="contenu" class="form-label">Contenu</label>
                                <textarea class="form-control" id="contenu" name="contenu"
                                          rows="3">{{ old('contenu') }}</textarea>
                                <div id="error-contenu" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="dateDebut" class="form-label">Date de Début</label>
                                <input type="date" class="form-control" id="dateDebut" name="dateDebut"
                                       value="{{ old('dateDebut') }}">
                                <div id="error-dateDebut" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="dateFin" class="form-label">Date de Fin</label>
                                <input type="date" class="form-control" id="dateFin" name="dateFin"
                                       value="{{ old('dateFin') }}">
                                <div id="error-dateFin" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="filieres" class="form-label">Filières</label>
                                <select class="form-select" id="filieres" name="filieres[]" multiple>
                                    @foreach($filieres as $id => $nom)
                                        <option
                                            value="{{ $id }}" {{ in_array($id, old('filieres', [])) ? 'selected' : '' }}>
                                            {{ $nom }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="error-filieres" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <div id="error-image" class="text-danger"></div>
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
    document.getElementById('addAnnonceForm').addEventListener('submit', function (event) {
        event.preventDefault();
        let form = this;
        let formData = new FormData(form);

        fetch("{{ route('admin.annonces.store') }}", {
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
                        $('#addAnnonceModal').modal('hide');
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
