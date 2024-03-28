@extends('layouts.app')

@section('content')

@section('title', "Tipologia $type->label")

@include('includes.projects.modal')

<div class="d-flex justify-content-between align-items-center">
    <h1>{{ $type->label }}</h1> 
</div>
<hr>
<div class="row">
    <div class="col d-flex align-items-center gap-3">
        <strong>
            Colore: 
        </strong>
        <div class="p-2 rounded display-color" style="background-color: {{$type->color}}"></div>
    </div>
</div>
<div class="row my-5">
    <div class="col-4"><strong>Creato:</strong> {{ $type->getDate($type->created_at, 'd-m-Y H:m:s') }} </div>
    <div class="col-4"><strong>Modificato:</strong> {{ $type->getDate($type->updated_at, 'd-m-Y H:m:s') }}</div>
    <div class="col-4">
        <div class="d-flex justify-content-end gap-3">
            <a href="{{ route('admin.types.index') }}" class="btn btn-primary"><i
                    class="fa-solid fa-arrow-left me-2"></i>Torna alla lista</a>
            <a href="{{ route('admin.types.edit', $type->id) }}" class="btn btn-warning"><i
                    class="fa-solid fa-pen me-2"></i>Modifica</a>
                    {{-- todo modifica del model --}}
            <form action="{{ route('admin.types.destroy', $type->id) }}" method="POST" class="delete-form"
                data-bs-toggle="modal" data-bs-target="#delete-modal" data-type="{{ $type->label }}">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger"><i class="fa-regular fa-trash-can me-2"></i>Elimina</button>
            </form>

        </div>
    </div>
</div>

@endsection

@section('scripts')
@vite('resources/js/modal.js')

@endsection
