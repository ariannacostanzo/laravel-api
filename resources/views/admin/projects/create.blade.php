@extends('layouts.app')

@section('content')

@section('title', 'Create Projects')


<h1>Crea un nuovo progetto</h1>
<hr>


@include('includes.projects.form')

@section('scripts')
@vite('resources/js/form/image_preview.js')
@endsection

@endsection
