@extends('layouts.authenticated')

@section('title', 'Créer un diagnostic')

@section('content')
    <h1 class="page__title">Créer un diagnostic (1/2)</h1>
    <p>Sélectionnez les besoins ci-dessous qui vous correspondent.</p>
    @include('diagnostics.form', ['action' => route('diagnostics.store'), 'diagnostic' => new \App\Diagnostic(), 'submit' => 'Étape suivante'])
@endsection
