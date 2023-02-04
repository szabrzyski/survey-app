@extends('layouts.app')
@section('body')
    <div class="row mb-4 justify-content-between align-items-center gy-3">
        <div class="col-auto">
            <h4 class="m-0">Nowe badanie</h4>
        </div>
        <div class="col-12 col-sm-3 col-lg-2">
            <a class="btn btn-secondary w-100" href="{{ route('surveysIndex') }}" role="button">Cofnij</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form method="POST" action="{{ route('storeSurvey') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nazwa badania <span class="text-danger"
                            title="wymagane">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name') }}" minlength="1" maxlength="255" required>

                </div>
                @foreach ($errors->all() as $error)
                    <div class="mb-3 text-danger">
                        {{ $error }}.
                    </div>
                @endforeach
                <button type="submit" class="btn btn-success">Dodaj badanie</button>
            </form>
        </div>
    </div>
@endsection
