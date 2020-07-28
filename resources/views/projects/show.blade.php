@extends('layouts.authenticated')

@section('title', $project->name)

@section('content')
    <h1 class="page__title">{{ $project->name }}</h1>
    <p>{{ $project->email }} | {{ $project->phone }}</p>
@endsection
