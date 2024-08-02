<!-- Modal pour modifier les notes -->
<div class="modal fade" id="editNotesModal-{{ $etudiant->id }}" tabindex="-1"
     aria-labelledby="editNotesModalLabel-{{ $etudiant->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editNotesModalLabel-{{ $etudiant->id }}">Modifier les notes
                    pour {{ $etudiant->user->nom }} {{ $etudiant->user->prenom }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('professeur.etudiant.notes.edit', [$etudiant->id, 'module' => $module]) }}"
                      method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="note_examen-{{ $etudiant->id }}" class="form-label">Note d'examen</label>
                        <input type="text" class="form-control" id="note_examen-{{ $etudiant->id }}" name="note_examen"
                               value="{{ old('note_examen', $notes->pivot->note_examen ?? '') }}">
                    </div>
                    <div class="mb-3">
                        <label for="note_classe-{{ $etudiant->id }}" class="form-label">Note de classe</label>
                        <input type="text" class="form-control" id="note_classe-{{ $etudiant->id }}" name="note_classe"
                               value="{{ old('note_classe', $notes->pivot->note_classe ?? '') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </form>
            </div>
        </div>
    </div>
</div>
