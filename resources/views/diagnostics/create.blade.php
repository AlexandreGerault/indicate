@extends('layouts.app')

@section('title', 'Créer un diagnostic')

@section('content')
    <div class="container mx-auto px-6 lg:px-0">
        <h1>Créer un diagnostic</h1>
        <p class="-mt-6 text-center text-base">Étape 1/2</p>
        <p class="text-sm my-6">Sélectionnez les besoins ci-dessous qui vous correspondent.</p>
        @include('diagnostics.form', ['action' => route('diagnostics.store'), 'diagnostic' => new \App\Diagnostic(), 'submit' => 'Étape suivante'])
    </div>
@endsection
