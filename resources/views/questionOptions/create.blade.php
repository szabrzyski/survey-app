@extends('layouts.app')
@section('body')
    <div class="row mb-4 justify-content-between align-items-center gy-3">
        <div class="col-auto">
            <h4 class="m-0">Nowa odpowiedź</h4>
        </div>
        <div class="col-12 col-sm-3 col-lg-2">
            <a class="btn btn-secondary w-100"
                href="{{ route('questionOptionsIndex', ['survey' => $question->survey_id, 'question' => $question]) }}"
                role="button">Cofnij</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form method="POST" action="{{ route('storeQuestionOption', $question) }}">
                @csrf
                <div class="mb-3">
                    <label for="position" class="form-label">Wartość<span class="text-danger"
                            title="wymagane">*</span></label>
                    <input type="number" min="-2147483648" max="2147483647"
                        class="form-control @error('value') is-invalid @enderror" id="value" name="value"
                        value="{{ old('value') }}" required>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Treść <span class="text-danger"
                            title="wymagane">*</span></label>
                    <textarea class="form-control @error('title') is-invalid @enderror" id="title" name="title" minlength="1"
                        maxlength="65535" rows="3" required>{{ old('title') }}</textarea>
                </div>
                @foreach ($errors->all() as $error)
                    <div class="mb-3 text-danger">
                        {{ $error }}.
                    </div>
                @endforeach
                <button type="submit" class="btn btn-success">Dodaj odpowiedź</button>
            </form>
        </div>
    </div>
@endsection
