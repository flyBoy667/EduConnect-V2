@extends('professeur.base')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Modifier le QCM</h1>

        <form action="{{ route('professeur.qcm.update', $qcm->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="module_id" class="form-label">Module</label>
                <select name="module_id" id="module_id" class="form-select" required>
                    @foreach($modules as $module)
                        <option
                            value="{{ $module->id }}" {{ $module->id == $qcm->module_id ? 'selected' : '' }}>{{ $module->nom_module }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="theme" class="form-label">Thème</label>
                <input type="text" name="theme" id="theme" class="form-control" value="{{ $qcm->theme }}" required>
            </div>

            <div class="form-group mb-3" id="questions-container">
                <label class="form-label">Questions</label>

                @foreach($qcm->questions as $index => $question)
                    <div class="question-item mb-3 border p-3 rounded">
                        <input type="text" name="questions[{{ $index }}][question_text]" placeholder="Question"
                               class="form-control mb-2" value="{{ $question->question_text }}" required>
                        <input type="number" name="questions[{{ $index }}][points]" placeholder="Points"
                               class="form-control mb-2" value="{{ $question->points }}" required>

                        <div class="options-container">
                            @foreach($question->options as $optionIndex => $option)
                                <div class="option-item mb-2">
                                    <input type="text"
                                           name="questions[{{ $index }}][options][{{ $optionIndex }}][option_text]"
                                           placeholder="Option" class="form-control mb-2"
                                           value="{{ $option->option_text }}" required>
                                    <input type="checkbox"
                                           name="questions[{{ $index }}][options][{{ $optionIndex }}][is_correct]"
                                           value="1" {{ $option->is_correct ? 'checked' : '' }}> Correcte
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-secondary btn-sm add-option-btn"
                                data-question-index="{{ $index }}">Ajouter une option
                        </button>
                    </div>
                @endforeach
            </div>

            <button type="button" class="btn btn-primary btn-sm add-question-btn">Ajouter une question</button>

            <div class="mt-4">
                <button type="submit" class="btn btn-success">Mettre à jour</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let questionIndex = {{ $qcm->questions->count() }};

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