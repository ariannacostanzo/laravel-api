@extends('layouts.app')

@section('content')

@section('title', 'Technologies')

{{-- modal  --}}
@include('includes.projects.modal')

<h1>Tecnologie</h1>
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
                    <a href="{{ route('admin.technologies.create') }}" class="btn btn-success">
                        <i class="fa-solid fa-plus me-2"></i>
                        Crea nuovo
                    </a>
                </div>
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse ($technologies as $tech)
            <tr>
                <th scope="row">{{ $tech->id }}</th>
                <td>
                    @if(Str::startsWith($tech->color, '#'))
                        <span class="badge" style="background-color: {{$tech->color}}">{{ $tech->label }}</span>
                    @else 
                        <span class="badge text-bg-{{$tech->color}}">{{ $tech->label }}</span>
                    @endif
                </td>
                <td>{{ $tech->getDate($tech->created_at) }}</td>
                <td>{{ $tech->getDate($tech->updated_at) }}</td>
                <td>
                    <div class="d-flex justify-content-end gap-3">
                        <a href="{{ route('admin.technologies.show', $tech->id) }}" class="btn btn-primary"><i
                                class="fa-regular fa-eye"></i></a>
                        <a href="{{ route('admin.technologies.edit', $tech->id) }}" class="btn btn-warning"><i
                                class="fa-solid fa-pen"></i></a>

                        <form action="{{ route('admin.technologies.destroy', $tech->id) }}" method="POST" class="delete-form"
                            data-bs-toggle="modal" data-bs-target="#delete-modal" data-type="{{ $tech->label }}">
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
