@extends('layouts.authenticated')

@section('title', 'Créer une société de conseil')

@section('content')
    <h1 class="page__title">Créer une société de conseil</h1>
    @include('consultings.form', ['action' => route('consultings.store'), 'consulting' => new \App\Models\Consulting(), 'submit' => 'Ajouter la société'])
@endsection
