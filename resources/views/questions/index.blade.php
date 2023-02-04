@extends('layouts.app')
@section('body')
    <div class="row mb-4 justify-content-between align-items-center gy-3">
        <div class="col-auto">
            <h4 class="m-0">Lista pytań</h4>
        </div>
        <div class="col-12 col-md-6 col-lg-4 col-xxl-3">
            <div class="row g-3">
                <div class="col">
                    <a class="btn btn-secondary w-100" href="{{ route('surveysIndex') }}" role="button">Cofnij</a>
                </div>
                <div class="col">
                    <a class="btn btn-success w-100" href="{{ route('createQuestion', $survey) }}" role="button">Dodaj
                        pytanie</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse ($questions as $question)
            <div class="col">
                <div class="card h-100 text-center ">
                    <div class="card-header text-truncate bg-body-secondary">
                        {{ $loop->iteration }}
                    </div>
                    <div class="card-body text-start">
                        <p class="card-text text-truncate">Pozycja: {{ $question->position }}</p>
                        <p class="card-text text-truncate">Typ: {{ $question->typeName() }}</p>
                        <p class="card-text">Treść: {{ $question->title }}</p>
                    </div>
                    <div class="card-footer text-muted">
                        <div class="row g-3 py-2">
                            <div class="col">
                                <a class="btn btn-primary w-100"
                                    href="{{ route('questionOptionsIndex', ['survey' => $survey, 'question' => $question]) }}"
                                    role="button">Odpowiedzi</a>
                            </div>
                            <div class="col">
                                <a class="btn btn-warning w-100"
                                    href="{{ route('editQuestion', ['survey' => $survey, 'question' => $question]) }}"
                                    role="button">Edytuj</a>
                            </div>
                            <div class="col">
                                <form method="POST" action="{{ route('deleteQuestion', $question) }}">
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
                Brak pytań.
            </div>
        @endforelse
    </div>
@endsection
