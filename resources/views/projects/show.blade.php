@extends('layouts.authenticated')

@section('title', $project->name)

@section('content')
    <h1 class="page__title">{{ $project->name }}</h1>
    <p>{{ $project->email }} | {{ $project->phone }}</p>
    @foreach($project->steps as $step)
        <div class="card">
            <h3>{{ $step->name }}</h3>
            <p>{{ $step->explanations }}</p>
            @if($step->pivot->validated_at === null)
                <form method="POST" action="{{ route('projects.steps.submit', ['project' => $project]) }}">
                    @csrf
                    <input type="submit" value="Valider cette étape" />
                </form>
            @endif
        </div>
    @endforeach
@endsection
