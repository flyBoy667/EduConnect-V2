@foreach($annonces as $annonce)
    <div class="modal fade" id="editAnnonceModal-{{ $annonce->id }}" tabindex="-1"
         aria-labelledby="editAnnonceModalLabel-{{ $annonce->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.annonces.update', $annonce) }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAnnonceModalLabel-{{ $annonce->id }}">Modifier l'Annonce</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="titre-{{ $annonce->id }}" class="form-label">Titre</label>
                            <input type="text" class="form-control" id="titre-{{ $annonce->id }}" name="titre"
                                   value="{{ $annonce->titre }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="contenu-{{ $annonce->id }}" class="form-label">Contenu</label>
                            <textarea class="form-control" id="contenu-{{ $annonce->id }}" name="contenu" rows="3"
                                      required>{{ $annonce->contenu }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="dateDebut-{{ $annonce->id }}" class="form-label">Date de Début</label>
                            <input type="date" class="form-control" id="dateDebut-{{ $annonce->id }}" name="dateDebut"
                                   value="{{ $annonce->dateDebut }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="dateFin-{{ $annonce->id }}" class="form-label">Date de Fin</label>
                            <input type="date" class="form-control" id="dateFin-{{ $annonce->id }}" name="dateFin"
                                   value="{{ $annonce->dateFin }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="filieres" class="form-label">Filières</label>
                            <select class="form-control" id="filieres" name="filieres[]" required>
                                @foreach($filieres as $k => $v)
                                    <option value="{{ $k }}"
                                            @if(in_array($k, $annonce->filiere()->pluck('id')->toArray()))
                                                selected
                                        @endif>
                                        {{ $v }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image-{{ $annonce->id }}" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image-{{ $annonce->id }}" name="image">
                            @if($annonce->image)
                                <img src="{{ asset('storage/' . $annonce->image) }}" alt="{{ $annonce->titre }}"
                                     class="mt-2" style="height: 100px;">
                            @endif
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
@endforeach
