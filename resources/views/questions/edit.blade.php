@extends('layouts.app')
@section('body')
    <div class="row mb-4 justify-content-between align-items-center gy-3">
        <div class="col-auto">
            <h4 class="m-0">Edytuj pytanie</h4>
        </div>
        <div class="col-12 col-sm-3 col-lg-2">
            <a class="btn btn-secondary w-100" href="{{ route('questionsIndex', $question->survey_id) }}"
                role="button">Cofnij</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form method="POST" action="{{ route('updateQuestion', $question) }}">
                @method('PATCH')
                @csrf
                <div class="mb-3">
                    <label for="type" class="form-label">Typ <span class="text-danger"
                            title="wymagane">*</span></label>
                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                        @foreach ($types as $type)
                            <option @if (old('type', $question->type_id) == $type->id) selected @endif value="{{ $type->id }}">
                                {{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="position" class="form-label">Pozycja<span class="text-danger"
                            title="wymagane">*</span></label>
                    <input type="number" min="1" max="4294967295"
                        class="form-control @error('position') is-invalid @enderror" id="position" name="position"
                        value="{{ old('position', $question->position) }}" required>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Treść <span class="text-danger"
                            title="wymagane">*</span></label>
                    <textarea class="form-control @error('title') is-invalid @enderror" id="title" name="title" minlength="1"
                        maxlength="65535" rows="3" required>{{ old('title', $question->title) }}</textarea>
                </div>
                @foreach ($errors->all() as $error)
                    <div class="mb-3 text-danger">
                        {{ $error }}.
                    </div>
                @endforeach
                <button type="submit" class="btn btn-success">Zapisz pytanie</button>
            </form>
        </div>
    </div>
@endsection
