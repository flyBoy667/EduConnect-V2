<!-- Modal pour ajouter une annonce -->
<div class="modal fade" id="addAnnonceModal" tabindex="-1" aria-labelledby="addAnnonceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.annonces.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addAnnonceModalLabel">Ajouter une Annonce</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="titre" name="titre" required>
                    </div>
                    <div class="mb-3">
                        <label for="contenu" class="form-label">Contenu</label>
                        <textarea class="form-control" id="contenu" name="contenu" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="dateDebut" class="form-label">Date de Début</label>
                        <input type="date" class="form-control" id="dateDebut" name="dateDebut" required>
                    </div>
                    <div class="mb-3">
                        <label for="dateFin" class="form-label">Date de Fin</label>
                        <input type="date" class="form-control" id="dateFin" name="dateFin" required>
                    </div>
                    <div class="mb-3">
                        <label for="filieres" class="form-label">Filières</label>
                        <select class="form-control" id="filieres" name="filieres[]" multiple required>
                            @foreach($filieres as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
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
