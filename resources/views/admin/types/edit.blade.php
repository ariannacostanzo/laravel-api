@extends('layouts.app')

@section('content')

@section('title', 'Edit Type')
    
<h1>Modifica la tipologia</h1>
<hr>
<form action="{{route('admin.types.update', $type->id)}}" method="POST">
    @csrf
    @method('PATCH')
    <div class="row align-items-center justify-content-end">
        <div class="col-4">
            <label for="label" class="form-label">Etichetta</label>
            <input type="text"
                class="form-control @error('label') is-invalid @elseif(old('label', '')) is-valid  @enderror"
                id="label" name="label" placeholder="FrontEnd" value="{{ old('label', $type->label) }}">
        </div>
        <div class="col-2">
            <label for="color" class="form-label">Colore</label>
            <input type="color"
                class="form-control @error('color') is-invalid @elseif(old('color', '')) is-valid  @enderror"
                id="color" name="color" value="{{ old('color', $type->color) }}">
        </div>
        <div class="col d-flex justify-content-end gap-3">
                <a class="btn btn-primary" href="{{route('admin.types.index')}}"><i class="fa-solid fa-arrow-left me-2"></i>Torna indietro</a>
                <button class="btn btn-success"><i class="fa-solid fa-floppy-disk me-2"></i>Salva</button>
        </div>
    </div>

</form>

@endsection

