@extends('layouts.app')
@section('body')
    <div class="row mb-4 justify-content-between align-items-center gy-3">
        <div class="col-auto">
            <h4 class="m-0">Lista badań</h4>
        </div>
        <div class="col-12 col-md-6 col-lg-4 col-xl-2">
            <a class="btn btn-success w-100" href="{{ route('createSurvey') }}" role="button">Dodaj badanie</a>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse ($surveys as $survey)
            <div class="col">
                <div class="card h-100 text-center ">
                    <a href="{{ route('showSurvey', $survey) }}"
                        class="text-decoration-none link-dark @if (!$survey->status->visible) pe-none @endif">
                        <div class="card-header text-truncate bg-body-secondary">
                            {{ $loop->iteration }}
                        </div>
                        <div class="card-body text-start">
                            <p class="card-text text-truncate">Nazwa: {{ $survey->name }}</p>
                            <p class="card-text text-truncate">Status: {{ $survey->statusName() }}</p>
                            <p class="card-text">Utworzono: {{ $survey->created_at }}</p>
                        </div>
                    </a>
                    <div class="card-footer text-muted">
                        <div class="row g-3 py-2">
                            <div class="col">
                                <a class="btn btn-primary w-100" href="{{ route('questionsIndex', $survey) }}"
                                    role="button">Pytania</a>
                            </div>
                            <div class="col">
                                <a class="btn btn-warning w-100" href="{{ route('editSurvey', $survey) }}"
                                    role="button">Edytuj</a>
                            </div>
                            <div class="col">
                                <form method="POST" action="{{ route('deleteSurvey', $survey) }}">
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
                Brak badań.
            </div>
        @endforelse
    </div>
@endsection
