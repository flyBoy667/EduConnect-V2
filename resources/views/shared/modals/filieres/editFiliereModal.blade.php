<div class="modal fade" id="editFiliereModal-{{ $filiere->id }}" tabindex="-1"
     aria-labelledby="editFiliereModalLabel-{{ $filiere->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.filieres.update', $filiere) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editFiliereModalLabel-{{ $filiere->id }}">Modifier la
                        Filière</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nom_filiere-{{ $filiere->id }}" class="form-label">Nom de la
                            Filière</label>
                        <input type="text" class="form-control" id="nom_filiere-{{ $filiere->id }}"
                               name="nom_filiere"
                               value="{{ $filiere->nom_filiere }}" required>
                        <div id="error-nom_filiere-{{ $filiere->id }}" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="description-{{ $filiere->id }}"
                               class="form-label">Description</label>
                        <textarea class="form-control" id="description-{{ $filiere->id }}"
                                  name="description" rows="3">{{ $filiere->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="montant_formation-{{ $filiere->id }}" class="form-label">Montant de
                            la Formation</label>
                        <input type="number" step="0.01" class="form-control"
                               id="montant_formation-{{ $filiere->id }}" name="montant_formation"
                               value="{{ $filiere->montant_formation }}" required>
                        <div id="error-montant_formation-{{ $filiere->id }}" class="text-danger"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer
                    </button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
