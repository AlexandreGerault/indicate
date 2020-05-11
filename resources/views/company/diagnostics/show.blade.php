@extends('layouts.authenticated')

@section('title', 'Diagnostic du ' . Date::parse($diagnostic->created_at)->format('l j F Y') )

@section('content')
    <article class="diagnostic">
        <header class="diagnostic__header">
            <h1 class="diagnostic__header__date">Diagnostic du {{ Date::parse($diagnostic->created_at)->format('l j F Y') }}</h1>
            <div class="diagnostic__header__information">
                <p class="diagnostic__header__status">{{ $diagnostic->status }}</p>
                <p class="diagnostic__header__uuid">N° {{ $diagnostic->uuid }}</p>
            </div>
        </header>

        @if(is_null($diagnostic->company))
            <h2 class="diagnostic__section__title">Entreprise</h2>
            @if(auth()->user()->companies->count() > 0)
            Sélectionner une entreprise existante
            <form method="post" action="{{ route('company.diagnostics.set-company', ['diagnostic' => $diagnostic]) }}">
                <select name="company">
                @foreach(auth()->user()->companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
                </select>
                <input type="submit" value="Choisir">
            </form>
            @endif
            <a href="{{ route('companies.create') }}">Je n'ai pas encore ajouté mon entreprise</a>
        @endif
        <section class="diagnostic__section">
            <h2 class="diagnostic__section__title">Vos besoins</h2>
            <div class="need__category__grid">
            @foreach($groupedNeeds as $group)
                <div>
                    <div class="need__category">
                        <h4 class="need__category__title">{{ $group->first()->category->name }}</h4>
                        <ul class="need__category__list">
                            @foreach($group as $need)
                                <li class="need__category__list__item">{{ $need->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
            </div>
        </section>
    </article>
@endsection
