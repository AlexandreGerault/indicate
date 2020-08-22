@extends('layouts.authenticated')

@section('title', 'Mes diagnostics')

@section('content')
<h1 class="page__title">Mes diagnostics</h1>

<div class="diagnostics__grid">
    @forelse(auth()->user()->diagnostics as $diagnostic)
    <a href="{{ $diagnostic->path() }}" title="Diagnositc du {{ $diagnostic->created_at }}">
    <div class="diagnostics__item">
        <header class="diagnostics__header">
            <p class="diagnostics__date">
                <time datetime="{{ $diagnostic->created_at }}">
                    {{ ucfirst(Date::parse($diagnostic->created_at)->format('l j F Y')) }}
                </time>
            </p>
            <p class="diagnostics__status">{{ $diagnostic->status }}</p>
        </header>
        <div class="diagnostics__serial_number">
            <p class="code">N° {{ $diagnostic->uuid }}</p>
        </div>
    </div>
    </a>
    @empty
    @endforelse
</div>
@endsection
