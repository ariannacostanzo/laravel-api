@extends('layouts.app')

@section('content')

@section('title', 'Projects')

{{-- modal  --}}
@include('includes.projects.modal')

<h1>Progetti eliminati</h1>
<hr>
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Titolo</th>
            <th scope="col">Creato</th>
            <th scope="col">Modificato</th>
            <th>
                <div class="d-flex justify-content-end gap-3">
                    <a href="{{route('admin.projects.index')}}" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left me-2"></i>
                        {{-- todo rotta cestino --}}
                        Torna a tutti i Progetti
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
                    <div class="d-flex justify-content-end gap-3">
                        <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-primary"><i
                                class="fa-regular fa-eye"></i></a>
                        <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning"><i
                                class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('admin.projects.restore', $project->id) }}" method="POST" >
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-success"><i class="fa-solid fa-trash-arrow-up"></i></button>
                        </form>
                        
                        <form action="{{ route('admin.projects.drop', $project->id) }}" method="POST" class="delete-form" data-bs-toggle="modal" data-bs-target="#delete-modal" data-project="{{$project->title}}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger"><i class="fa-regular fa-trash-can"></i></button>
                        </form>

                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Non ci sono progetti da vedere</td>
            </tr>
        @endforelse

    </tbody>
</table>



@endsection

@section('scripts')
@vite('resources/js/modal.js')
@endsection