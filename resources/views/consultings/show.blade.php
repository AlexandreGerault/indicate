@extends('layouts.authenticated')

@section('title', $consulting->name)

@section('content')
    <article class="diagnostic">
        <header class="diagnostic__header">
            <h1 class="diagnostic__header__date">{{ $consulting->name }}</h1>
            <div class="diagnostic__header__information">
                <p class="diagnostic__header__status">Responsable : {{ $consulting->responsible }}</p>
                <p class="diagnostic__header__uuid">{{ $consulting->phone }}</p>
                <p class="diagnostic__header__uuid">{{ $consulting->email }}</p>
            </div>
        </header>

        <section class="diagnostic__section">
            <h2 class="diagnostic__section__title">Compétences</h2>
            <div class="need__category__grid">
            @foreach($categories as $category)
                <div>
                    <div class="need__category">
                        <h4 class="need__category__title">{{ $category->name }}</h4>
                        @if($category->skills->count() > 0)
                        <ul class="need__category__list">
                            @foreach($category->skills as $skill)
                                <li class="need__category__list__item">{{ $skill->name }}</li>
                            @endforeach
                        </ul>
                        @else
                            Aucune compétence dans cette catégorie
                        @endif
                        <p class="need__category__comment">
                            @if(($comment = $consulting->specificationOfCategory($category)) != null)
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
