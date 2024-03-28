@extends('layouts.app')

@section('content')

@section('title', "Project $project->id")

@include('includes.projects.modal')

<div class="d-flex justify-content-between align-items-center">
    <h1>{{ $project->title }}</h1>
    <div class="d-flex align-items-center gap-3">
        <div>
            @if ($project->type)
                <span> Tipologia: </span>
                <span class="badge rounded-pill"
                    style="background-color: {{ $project->type->color }}">{{ $project->type->label }}</span>
            @endif
        </div>
        <div>
            @if ($project->technologies)
                <span> Tecnologie: </span>
                @foreach ($project->technologies as $tech)
                    <span class="badge" style="background-color: {{ $tech->color }}">{{ $tech->label }}</span>
                @endforeach
            @endif
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-3">
        <img src="{{ $project->image ? $project->getImagePath() : 'https://bub.bh/wp-content/uploads/2018/02/image-placeholder.jpg' }}"
            class="card-img-top" alt="{{ $project->title }}" class="img-fluid">
    </div>
    <div class="col">{{ $project->description }}</div>
</div>
<div class="row my-5">
    <div class="col-4"><strong>Creato:</strong> {{ $project->getDate($project->created_at, 'd-m-Y H:m:s') }} </div>
    <div class="col-4"><strong>Modificato:</strong> {{ $project->getDate($project->updated_at, 'd-m-Y H:m:s') }}</div>
    <div class="col-4">
        <div class="d-flex justify-content-end gap-3">
            @if (!$project->trashed())
                <a href="{{ route('admin.projects.index') }}" class="btn btn-primary"><i
                        class="fa-solid fa-arrow-left me-2"></i>Torna alla lista</a>
            @else
                <a href="{{ route('admin.projects.trash') }}" class="btn btn-primary"><i
                        class="fa-solid fa-arrow-left me-2"></i>Torna al cestino</a>
            @endif
            <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning"><i
                    class="fa-solid fa-pen me-2"></i>Modifica</a>
            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="delete-form"
                data-bs-toggle="modal" data-bs-target="#delete-modal" data-project="{{ $project->title }}">
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
