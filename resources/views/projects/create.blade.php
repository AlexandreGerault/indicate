@extends('layouts.authenticated')

@section('title', 'Nouveau projet')

@section('content')
    <h1 class="page__title">Je démarre un projet</h1>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    @include('projects.form', ['action' => route('projects.store'), 'project' => new \App\Models\Consulting(), 'submit' => 'Nouveau projetf'])
@endsection
