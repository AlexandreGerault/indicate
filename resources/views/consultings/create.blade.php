@extends('layouts.authenticated')

@section('title', 'Créer une société de conseil')

@section('content')
    <h1 class="page__title">Créer une société de conseil</h1>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    @include('consultings.form', ['action' => route('consultings.store'), 'consulting' => new \App\Models\Consulting(), 'submit' => 'Ajouter la société'])
@endsection
