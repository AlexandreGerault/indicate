@extends('layouts.app')

@section('title', 'Mes diagnostics')

@section('content')
<div class="container mx-auto">
    <h1>Mes diagnostics</h1>
    <div class="flex flex-col lg:-mx-2">
        @forelse(auth()->user()->diagnostics as $diagnostic)
        <a href="{{ $diagnostic->path() }}" class="flex-1">
        <div class="diagnostic-item lg:mx-2">
            <header class="flex -mx-2 justify-between mb-4">
                <p class="date mx-2">
                    <time datetime="{{ $diagnostic->created_at }}">
                        {{ ucfirst(Date::parse($diagnostic->created_at)->format('l j F Y')) }}
                    </time>
                </p>
                <p class="status  bg-blue-50 px-2 rounded text-grey-900 mx-2">{{ $diagnostic->status }}</p>
            </header>
            <div class="body flex justify-end text-blue-500">
                <p class="code">N° {{ $diagnostic->uuid }}</p>
            </div>
        </div>
        </a>
        @empty
        @endforelse
    </div>
</div>
@endsection
