@extends('layouts.app')

@section('content')

@section('title', 'Projects')

{{-- modal  --}}
@include('includes.projects.modal')

<div class="d-flex align-items-center justify-content-between">

    <h1>Progetti</h1>
    {{-- todo filtro per tipologie e tecnologie --}}
    <form action="{{route('admin.projects.index')}}" method="get">
        <div class="d-flex align-items-center gap-3">
            <select class="form-select" id="type_select" name="type_filter">
                <option value="" 
                {{-- @if() selected @endif --}}
                >Seleziona la tipologia</option>
                @foreach ($types as $type)
                <option value="{{$type->id}}" 
                    {{-- @if() selected @endif --}}
                    >{{$type->label}}</option>
                    @endforeach
                    
                </select>
                <button class="btn btn-primary">Cerca</button>
            </div>
    </form>
</div>
<hr>
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Titolo</th>
            <th scope="col">Creato</th>
            <th scope="col">Modificato</th>
            <th scope="col">Tipologie</th>
            <th scope="col">Tecnologie</th>
            <th>
                <div class="d-flex justify-content-end gap-3">
                    <a href="{{ route('admin.projects.trash') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-trash-can me-2"></i>
                        Vedi Cestino
                    </a>
                    <a href="{{ route('admin.projects.create') }}" class="btn btn-success">
                        <i class="fa-solid fa-plus me-2"></i>
                        Crea nuovo
                    </a>
                </div>
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse ($projects as $project)

            <tr>
                <th scope="row">{{ $project->id }}</th>
                <td>{{ $project->title }}</td>
                <td>{{ $project->getDate($project->created_at) }}</td>
                <td>{{ $project->getDate($project->updated_at) }}</td>
                <td>
                    @if ($project->type)
                        <span class="badge rounded-pill" style="background-color: {{ $project->type->color }}">
                            {{-- <a href="{{route('admin.types.show', $project->type->id)}}"></a> --}}
                            {{ $project->type->label }}
                        </span>
                    @else
                        Nessuno
                    @endif
                </td>
                <td>
                    @forelse($project->technologies as $tech)
                        <span class="badge" style="background-color: {{ $tech->color }}">{{ $tech->label }}</span>
                    @empty
                        Nessuna
                    @endforelse
                </td>
                <td>
                    <div class="d-flex justify-content-end gap-3">
                        <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-primary"><i
                                class="fa-regular fa-eye"></i></a>
                        <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning"><i
                                class="fa-solid fa-pen"></i></a>

                        <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST"
                            class="delete-form" data-bs-toggle="modal" data-bs-target="#delete-modal"
                            data-project="{{ $project->title }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger"><i class="fa-regular fa-trash-can"></i></button>
                        </form>

                    </div>
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="6">Non ci sono progetti da vedere</td>
            </tr>
        @endforelse

    </tbody>
</table>



@endsection

@section('scripts')
@vite('resources/js/modal.js')
@endsection

{{-- todo nuova colonna is_completed e cambiare per questo tutto quello che serve --}}
