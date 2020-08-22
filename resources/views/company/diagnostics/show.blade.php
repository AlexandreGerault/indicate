@extends('layouts.authenticated')

@section('title', 'Diagnostic du ' . Date::parse($diagnostic->created_at)->format('l j F Y') )

@section('content')
    <article class="diagnostic">
        <header class="diagnostic__header">
            <h1 class="diagnostic__header__date">Diagnostic du {{ Date::parse($diagnostic->created_at)->format('l j F Y') }}</h1>
            <div class="diagnostic__header__information">
                <p class="diagnostic__header__status">{{ $diagnostic->status }}</p>
                <p class="diagnostic__header__uuid">N°{{ $diagnostic->uuid }}</p>
            </div>
        </header>


        <h2 class="diagnostic__section__title">Entreprise</h2>
        @if(is_null($diagnostic->company))
            @if(auth()->user()->companies->count() > 0)
            Sélectionner une entreprise existante
            <form method="post" action="{{ route('company.diagnostics.set-company', ['diagnostic' => $diagnostic]) }}">
                @csrf
                <select name="company">
                @foreach(auth()->user()->companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
                </select>
                <input type="submit" value="Choisir">
            </form>
            @endif
            <a href="{{ route('companies.create') }}">Je n'ai pas encore ajouté mon entreprise</a>
        @else
            {{ $diagnostic->company->name }}
        @endif
        <section class="diagnostic__section">
            <h2 class="diagnostic__section__title">Vos besoins</h2>
            <div class="need__category__grid">
            @foreach($categories as $category)
                <div>
                    <div class="need__category">
                        <h4 class="need__category__title">{{ $category->name }}</h4>
                        @if($category->needs->count() > 0)
                        <ul class="need__category__list">
                            @foreach($category->needs as $need)
                                <li class="need__category__list__item">{{ $need->name }}</li>
                            @endforeach
                        </ul>
                        @else
                            Aucun besoin
                        @endif
                        <p class="need__category__comment">
                            @if(($comment = $diagnostic->commentOfCategory($category)) != null)
                                {{ $comment->content }}
                            @else
                                Aucune précision
                            @endif
                        </p>
                    </div>
                </div>
            @endforeach
            </div>
        </section>
    </article>
@endsection
