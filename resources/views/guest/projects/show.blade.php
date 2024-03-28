@extends('layouts.app')

@section('title', 'Home')
@section('content')

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
            <a href="{{ route('guest.home') }}" class="btn btn-primary"><i
                    class="fa-solid fa-arrow-left me-2"></i>Torna alla lista</a>
        </div>
    </div>
</div>
@endsection