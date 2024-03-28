@extends('layouts.app')

@section('content')

@section('title', 'Edit Type')

<h1>Crea una nuova tipologia</h1>
<hr>

<form action="{{ route('admin.types.store') }}" method="POST">
    @csrf
    <div class="row align-items-center justify-content-end">
        <div class="col-4">
            <label for="label" class="form-label">Etichetta</label>
            <input type="text"
                class="form-control @error('label') is-invalid @elseif(old('label', '')) is-valid  @enderror"
                id="label" name="label" placeholder="FrontEnd" value="{{ old('label') }}">
            @error('label')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-2">
            <label for="color" class="form-label">Colore</label>
            <input type="color"
                class="form-control @error('color') is-invalid @elseif(old('color', '')) is-valid  @enderror"
                id="color" name="color" value="{{ old('color') }}">
            @error('color')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col d-flex justify-content-end gap-3">
            <a class="btn btn-primary" href="{{route('admin.types.index')}}"><i class="fa-solid fa-arrow-left me-2"></i>Torna alla lista</a>
            <button class="btn btn-success"><i class="fa-solid fa-plus me-2"></i>Crea</button>
        </div>
    </div>

</form>

@endsection
