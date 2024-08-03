@extends('professeur.base')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Créer un QCM</h1>

        <form action="{{ route('professeur.qcm.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="module_id" class="form-label">Module</label>
                <select name="module_id" id="module_id" class="form-select" required>
                    @foreach($modules as $module)
                        <option value="{{ $module->id }}">{{ $module->nom_module }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="theme" class="form-label">Thème</label>
                <input type="text" name="theme" id="theme" class="form-control" required>
            </div>

            <div class="form-group mb-3" id="questions-container">
                <label class="form-label">Questions</label>

                <div class="question-item mb-3 border p-3 rounded">
                    <input type="text" name="questions[0][question_text]" placeholder="Question" class="form-control mb-2" required>
                    <input type="number" name="questions[0][points]" placeholder="Points" class="form-control mb-2" required>

                    <div class="options-container">
                        <div class="option-item mb-2">
                            <input type="text" name="questions[0][options][0][option_text]" placeholder="Option 1" class="form-control mb-2" required>
                            <input type="checkbox" name="questions[0][options][0][is_correct]" value="1"> Correcte
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary btn-sm add-option-btn" data-question-index="0">Ajouter une option</button>
                </div>
            </div>

            <button type="button" class="btn btn-primary btn-sm add-question-btn">Ajouter une question</button>

            <div class="mt-4">
                <button type="submit" class="btn btn-success">Créer</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let questionIndex = 1;

            document.querySelector('.add-question-btn').addEventListener('click', function () {
                let questionsContainer = document.getElementById('questions-container');
                let questionItem = document.createElement('div');
                questionItem.className = 'question-item mb-3 border p-3 rounded';
                questionItem.innerHTML = `
                <input type="text" name="questions[${questionIndex}][question_text]" placeholder="Question" class="form-control mb-2" required>
                <input type="number" name="questions[${questionIndex}][points]" placeholder="Points" class="form-control mb-2" required>
                <div class="options-container">
                    <div class="option-item mb-2">
                        <input type="text" name="questions[${questionIndex}][options][0][option_text]" placeholder="Option 1" class="form-control mb-2" required>
                        <input type="checkbox" name="questions[${questionIndex}][options][0][is_correct]" value="1"> Correcte
                    </div>
                </div>
                <button type="button" class="btn btn-secondary btn-sm add-option-btn" data-question-index="${questionIndex}">Ajouter une option</button>
            `;
                questionsContainer.appendChild(questionItem);
                questionIndex++;
            });

            document.addEventListener('click', function (e) {
                if (e.target && e.target.classList.contains('add-option-btn')) {
                    let optionsContainer = e.target.previousElementSibling;
                    let optionIndex = optionsContainer.querySelectorAll('.option-item').length;
                    let questionIndex = e.target.getAttribute('data-question-index');
                    let optionItem = document.createElement('div');
                    optionItem.className = 'option-item mb-2';
                    optionItem.innerHTML = `
                    <input type="text" name="questions[${questionIndex}][options][${optionIndex}][option_text]" placeholder="Option ${optionIndex + 1}" class="form-control mb-2" required>
                    <input type="checkbox" name="questions[${questionIndex}][options][${optionIndex}][is_correct]" value="1"> Correcte
                `;
                    optionsContainer.appendChild(optionItem);
                }
            });
        });
    </script>
@endsection
