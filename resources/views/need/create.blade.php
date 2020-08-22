@extends('layouts.guest')

@section('title', 'Créer un besoin')

@section('content')
    <div class="container mx-auto">
        @if($categories->count() > 0)
        <form method="POST" action="{{ route('company.needs.store') }}">
            <label for="need-name">Nom</label>
            <input class="flat" type="text" placeholder="Réduit des coûts marketing">

            <label for="category-select">Choose a pet:</label>
            <select name="category_id" id="category-select">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <input type="submit" class="button" />
        </form>
        @else
            <p class="my-12">Il n'existe aucune catégorie de besoin. Veuillez d'abord en créer une.</p>
        @endif
    </div>
@endsection
