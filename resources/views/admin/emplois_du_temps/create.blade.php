@extends('admin.base')

@section('content')
    <h1>Créer un Emploi du Temps</h1>

    <form action="{{ route('admin.emplois-du-temps.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="filiere_id">Filière</label>
            <select name="filiere_id" id="filiere_id" class="form-control" required>
                <option value="">Sélectionner une filière</option>
                @foreach($filieres as $filiere)
                    <option value="{{ $filiere->id }}">{{ $filiere->nom_filiere }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="module_id">Module</label>
            <select name="module_id" id="module_id" class="form-control" required>
                <!-- Les modules seront chargés via JavaScript en fonction de la filière sélectionnée -->
            </select>
        </div>

        <div class="form-group">
            <label for="professeur_id">Professeur</label>
            <select name="professeur_id" id="professeur_id" class="form-control" required>
                <!-- Les professeurs seront chargés via JavaScript en fonction du module sélectionné -->
            </select>
        </div>

        <div class="form-group">
            <label for="jour">Jour</label>
            <select name="jour" id="jour" class="form-control" required>
                <option value="lundi">Lundi</option>
                <option value="mardi">Mardi</option>
                <option value="mercredi">Mercredi</option>
                <option value="jeudi">Jeudi</option>
                <option value="vendredi">Vendredi</option>
                <option value="samedi">Samedi</option>
                <option value="dimanche">Dimanche</option>
            </select>
        </div>

        <div class="form-group">
            <label for="heure_debut">Heure Début</label>
            <input type="time" name="heure_debut" id="heure_debut" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="heure_fin">Heure Fin</label>
            <input type="time" name="heure_fin" id="heure_fin" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Créer</button>
    </form>

    <script>
        document.getElementById('filiere_id').addEventListener('change', function () {
            let filiereId = this.value;
            let moduleSelect = document.getElementById('module_id');
            let professeurSelect = document.getElementById('professeur_id');

            // Réinitialiser les sélecteurs
            moduleSelect.innerHTML = '<option value="">Sélectionner un module</option>';
            professeurSelect.innerHTML = '<option value="">Sélectionner un professeur</option>';

            if (filiereId) {
                fetch(`/api/modules/${filiereId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(module => {
                            let option = document.createElement('option');
                            option.value = module.id;
                            option.textContent = module.nom_module;
                            moduleSelect.appendChild(option);
                        });
                    });

                fetch(`/api/professeurs/${filiereId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(professeur => {
                            let option = document.createElement('option');
                            option.value = professeur.id;
                            option.textContent = professeur.user.nom; // Assurez-vous que `professeur.user.nom` est correct
                            professeurSelect.appendChild(option);
                        });
                    });
            }
        });

        document.getElementById('module_id').addEventListener('change', function () {
            let moduleId = this.value;
            let professeurSelect = document.getElementById('professeur_id');

            // Réinitialiser le sélecteur des professeurs
            professeurSelect.innerHTML = '<option value="">Sélectionner un professeur</option>';

            if (moduleId) {
                fetch(`/api/professeurs/module/${moduleId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.user) { // Assurez-vous que `data.user` est défini
                            let option = document.createElement('option');
                            option.value = data.id;
                            option.textContent = data.user.nom; // Assurez-vous que `data.user.nom` est correct
                            professeurSelect.appendChild(option);
                        }
                    });
            }
        });
    </script>
@endsection
