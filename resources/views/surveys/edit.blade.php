@extends('layouts.app')
@section('body')
    <div class="row mb-4 justify-content-between align-items-center gy-3">
        <div class="col-auto">
            <h4 class="m-0">Edytuj badanie</h4>
        </div>
        <div class="col-12 col-sm-3 col-lg-2">
            <a class="btn btn-secondary w-100" href="{{ route('surveysIndex') }}" role="button">Cofnij</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form method="POST" action="{{ route('updateSurvey', $survey) }}">
                @method('PATCH')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nazwa badania <span class="text-danger"
                            title="wymagane">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $survey->name) }}" minlength="1" maxlength="255" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status <span class="text-danger"
                            title="wymagane">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                        @foreach ($statuses as $status)
                            <option @if (old('status', $survey->status_id) == $status->id) selected @endif value="{{ $status->id }}">
                                {{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>
                @foreach ($errors->all() as $error)
                    <div class="mb-3 text-danger">
                        {{ $error }}.
                    </div>
                @endforeach
                <button type="submit" class="btn btn-success">Zapisz badanie</button>
            </form>
        </div>
    </div>
@endsection
