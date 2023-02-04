@extends('layouts.app')
@section('body')
    <div class="row mb-4 justify-content-between align-items-center gy-3">
        <div class="col-auto">
            <h4 class="m-0">Szczegóły badania</h4>
        </div>
        <div class="col-12 col-sm-3 col-lg-2">
            <a class="btn btn-secondary w-100" href="{{ route('surveysIndex') }}" role="button">Cofnij</a>
        </div>
    </div>
    <form>
        <div class="row row-cols-1 g-3">
            @forelse ($survey->questions as $question)
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title fw-bold">{{ $loop->iteration }}. @if ($survey->status->additional_info)
                                    <span class="fw-normal small text-secondary">[{{ $question->id }}]</span>
                                @endif {{ $question->title }}</h6>
                            @forelse ($question->options as $option)
                                <div class="form-check">
                                    <input class="form-check-input"
                                        type="{{ $question->type->name == 'Jednokrotnego wyboru' ? 'radio' : 'checkbox' }}"
                                        value="{{ $option->value }}" id="{{ $option->id }}" name="{{ $question->id }}">
                                    <label class="form-check-label" for="{{ $option->id }}">
                                        @if ($survey->status->additional_info)
                                            <span class="fw-normal small text-secondary">[{{ $option->id }}]</span>
                                        @endif {{ $option->title }}
                                    </label>
                                </div>
                            @empty
                                <p class="card-text text-danger">Brak odpowiedzi.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            @empty
                <div class="col text-secondary">
                    Brak pytań.
                </div>
            @endforelse
        </div>
    </form>
@endsection
