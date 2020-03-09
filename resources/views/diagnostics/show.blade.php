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
