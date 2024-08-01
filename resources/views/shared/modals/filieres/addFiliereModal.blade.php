<div class="modal fade" id="addFiliereModal" tabindex="-1" aria-labelledby="addFiliereModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.filieres.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addFiliereModalLabel">Ajouter une Filière</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nom_filiere" class="form-label">Nom de la Filière</label>
                        <input type="text" class="form-control" id="nom_filiere" name="nom_filiere" required>
                        <div id="error-nom_filiere" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="montant_formation" class="form-label">Montant de la Formation</label>
                        <input type="number" step="0.01" class="form-control" id="montant_formation"
                               name="montant_formation" required>
                        <div id="error-montant_formation" class="text-danger"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
