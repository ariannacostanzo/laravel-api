@extends('layouts.app')

@section('content')

@section('title', 'Type')

{{-- modal  --}}
@include('includes.projects.modal')

<h1>Tipologie</h1>
<hr>
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Etichetta</th>
            <th scope="col">Creato</th>
            <th scope="col">Modificato</th>
            <th>
                <div class="d-flex justify-content-end gap-3">
                    <a href="{{ route('admin.types.create') }}" class="btn btn-success">
                        <i class="fa-solid fa-plus me-2"></i>
                        Crea nuovo
                    </a>
                </div>
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse ($types as $type)
            <tr>
                <th scope="row">{{ $type->id }}</th>
                <td>
                    <span class="badge rounded-pill "
                        style="background-color: {{ $type->color }}">{{ $type->label }}</span>
                </td>
                <td>{{ $type->getDate($type->created_at) }}</td>
                <td>{{ $type->getDate($type->updated_at) }}</td>
                <td>
                    <div class="d-flex justify-content-end gap-3">
                        <a href="{{ route('admin.types.show', $type->id) }}" class="btn btn-primary"><i
                                class="fa-regular fa-eye"></i></a>
                        <a href="{{ route('admin.types.edit', $type->id) }}" class="btn btn-warning"><i
                                class="fa-solid fa-pen"></i></a>

                        <form action="{{ route('admin.types.destroy', $type->id) }}" method="POST" class="delete-form"
                            data-bs-toggle="modal" data-bs-target="#delete-modal" data-type="{{ $type->label }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger"><i class="fa-regular fa-trash-can"></i></button>
                        </form>

                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Non ci sono tipi da vedere</td>
            </tr>
        @endforelse

    </tbody>
</table>
@endsection

@section('scripts')
@vite('resources/js/modal.js')
@endsection
