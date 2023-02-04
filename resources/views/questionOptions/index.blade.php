@extends('layouts.app')
@section('body')
    <div class="row mb-4 justify-content-between align-items-center gy-3">
        <div class="col-auto">
            <h4 class="m-0">Lista odpowiedzi</h4>
        </div>
        <div class="col-12 col-md-6 col-lg-5 col-xl-4">
            <div class="row g-3">
                <div class="col">
                    <a class="btn btn-secondary w-100" href="{{ route('questionsIndex', $question->survey_id) }}"
                        role="button">Cofnij</a>
                </div>
                <div class="col">
                    <a class="btn btn-success w-100"
                        href="{{ route('createQuestionOption', ['survey' => $question->survey_id, 'question' => $question]) }}"
                        role="button">Dodaj
                        odpowiedź</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse ($questionOptions as $questionOption)
            <div class="col">
                <div class="card h-100 text-center ">
                    <div class="card-header text-truncate bg-body-secondary">
                        {{ $loop->iteration }}
                    </div>
                    <div class="card-body text-start">
                        <p class="card-text text-truncate">Wartość: {{ $questionOption->value }}</p>
                        <p class="card-text">Treść: {{ $questionOption->title }}</p>
                    </div>
                    <div class="card-footer text-muted">
                        <div class="row g-3 py-2">
                            <div class="col">
                                <a class="btn btn-warning w-100"
                                    href="{{ route('editQuestionOption', ['survey' => $question->survey_id, 'question' => $question, 'questionOption' => $questionOption]) }}"
                                    role="button">Edytuj</a>
                            </div>
                            <div class="col">
                                <form method="POST" action="{{ route('deleteQuestionOption', $questionOption) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100">Usuń</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col text-secondary">
                Brak odpowiedzi.
            </div>
        @endforelse
    </div>
@endsection
