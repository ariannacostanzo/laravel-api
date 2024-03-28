@extends('layouts.app')

@section('content')

@section('title', 'Edit Project')
    
<h1>Modifica il progetto</h1>
<hr>

@include('includes.projects.form')

@section('scripts')
@vite('resources/js/form/image_preview.js')
@endsection

@endsection
