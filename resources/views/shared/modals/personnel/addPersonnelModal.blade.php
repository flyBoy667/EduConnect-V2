<!-- Modal pour l'ajout d'un personnel administratif -->
<div class="modal fade" id="addPersonnelModal" tabindex="-1" aria-labelledby="addPersonnelModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPersonnelModalLabel">Ajouter un Personnel Administratif</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPersonnelForm" method="POST" enctype="multipart/form-data">
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
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom"
                                       value="{{ old('prenom') }}">
                                <div id="error-prenom" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="login" class="form-label">Login</label>
                                <input type="text" class="form-control" id="login" name="login"
                                       value="{{ old('login') }}">
                                <div id="error-login" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{{ old('email') }}">
                                <div id="error-email" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="telephone" class="form-label">Téléphone</label>
                                <input type="text" class="form-control" id="telephone" name="telephone"
                                       value="{{ old('telephone') }}">
                                <div id="error-telephone" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="role_id" class="form-label">Rôle</label>
                                <select name="role_id" id="role_id" class="form-select">
                                    @foreach($roles as $id => $nom)
                                        <option value="{{ $id }}" {{ old('role_id') == $id ? 'selected' : '' }}>
                                            {{ $nom }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="error-role_id" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div id="errorMessages" class="alert alert-danger d-none"></div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('addPersonnelForm').addEventListener('submit', function (event) {
        event.preventDefault();
        let form = this;
        let formData = new FormData(form);
        console.log(formData)

        fetch("{{ route('admin.personnel_administratifs.store') }}", {
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
                    $('#addPersonnelModal').modal('hide');
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
