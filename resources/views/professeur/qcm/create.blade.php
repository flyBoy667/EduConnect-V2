@extends('professeur.base')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Créer un QCM</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('professeur.qcm.store') }}" method="POST" id="qcm-form">
            @csrf

            <div class="form-group mb-3">
                <label for="module_id" class="form-label">Module</label>
                <select name="module_id" id="module_id" class="form-select" required>
                    @foreach($modules as $module)
                        <option value="{{ $module->id }}" {{ old('module_id') == $module->id ? 'selected' : '' }}>{{ $module->nom_module }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="theme" class="form-label">Thème</label>
                <input type="text" name="theme" id="theme" class="form-control" value="{{ old('theme') }}" required>
            </div>

            <div class="form-group mb-3" id="questions-container">
                <label class="form-label">Questions</label>

                @if(old('questions'))
                    @foreach(old('questions') as $index => $question)
                        <div class="question-item mb-3 border p-3 rounded">
                            <input type="text" name="questions[{{ $index }}][question_text]" placeholder="Question" class="form-control mb-2" value="{{ $question['question_text'] }}" required>
                            <input type="number" name="questions[{{ $index }}][points]" placeholder="Points" class="form-control mb-2 points-input" value="{{ $question['points'] }}" min="0" max="20" required>

                            <div class="options-container">
                                @foreach($question['options'] as $optionIndex => $option)
                                    <div class="option-item mb-2">
                                        <input type="text" name="questions[{{ $index }}][options][{{ $optionIndex }}][option_text]" placeholder="Option {{ $optionIndex + 1 }}" class="form-control mb-2" value="{{ $option['option_text'] }}" required>
                                        <input type="checkbox" name="questions[{{ $index }}][options][{{ $optionIndex }}][is_correct]" value="1" {{ isset($option['is_correct']) && $option['is_correct'] ? 'checked' : '' }}> Correcte
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-secondary btn-sm add-option-btn" data-question-index="{{ $index }}">Ajouter une option</button>
                        </div>
                    @endforeach
                @else
                    <div class="question-item mb-3 border p-3 rounded">
                        <input type="text" name="questions[0][question_text]" placeholder="Question" class="form-control mb-2" required>
                        <input type="number" name="questions[0][points]" placeholder="Points" class="form-control mb-2 points-input" min="0" max="20" required>

                        <div class="options-container">
                            <div class="option-item mb-2">
                                <input type="text" name="questions[0][options][0][option_text]" placeholder="Option 1" class="form-control mb-2" required>
                                <input type="checkbox" name="questions[0][options][0][is_correct]" value="1"> Correcte
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary btn-sm add-option-btn" data-question-index="0">Ajouter une option</button>
                    </div>
                @endif
            </div>

            <button type="button" class="btn btn-primary btn-sm add-question-btn">Ajouter une question</button>

            <div class="mt-4">
                <p>Points restants : <span id="points-remaining">20</span></p>
                <button type="submit" class="btn btn-success">Créer</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let questionIndex = document.querySelectorAll('.question-item').length;
            const maxPoints = 20;
            const pointsRemainingElement = document.getElementById('points-remaining');
            const form = document.getElementById('qcm-form');

            document.querySelector('.add-question-btn').addEventListener('click', function () {
                let questionsContainer = document.getElementById('questions-container');
                let questionItem = document.createElement('div');
                questionItem.className = 'question-item mb-3 border p-3 rounded';
                questionItem.innerHTML = `
                <input type="text" name="questions[${questionIndex}][question_text]" placeholder="Question" class="form-control mb-2" required>
                <input type="number" name="questions[${questionIndex}][points]" placeholder="Points" class="form-control mb-2 points-input" min="0" max="20" required>
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
                updatePointsRemaining();
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

            document.addEventListener('input', function (e) {
                if (e.target && e.target.classList.contains('points-input')) {
                    updatePointsRemaining();
                }
            });

            form.addEventListener('submit', function (e) {
                const totalPoints = calculateTotalPoints();
                if (totalPoints > maxPoints) {
                    e.preventDefault();
                    alert('Le total des points ne doit pas dépasser 20.');
                }
            });

            function calculateTotalPoints() {
                let totalPoints = 0;
                document.querySelectorAll('.points-input').forEach(function (input) {
                    totalPoints += parseInt(input.value) || 0;
                });
                return totalPoints;
            }

            function updatePointsRemaining() {
                const totalPoints = calculateTotalPoints();
                pointsRemainingElement.textContent = maxPoints - totalPoints;
            }

            updatePointsRemaining();
        });
    </script>
@endsection
