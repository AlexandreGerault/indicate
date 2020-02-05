@extends('layouts.authenticated')

@section('title', 'Éditer un diagnostic')

@section('content')
    <div class="container mx-auto">
        <h1>Mettre à jour le diagnostic</h1>
        <p class="text-sm">Sélectionnez les besoins ci-dessous qui vous correspondent.</p>
        <div class="container mx-auto">
            @include('diagnostics.form', ['method' => 'PATCH', 'action' => $diagnostic->path(), 'submit' => 'Valider'])
        </div>
    </div>
@endsection
