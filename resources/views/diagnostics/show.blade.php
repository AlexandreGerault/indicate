@extends('layouts.app')

@section('title', 'Diagnostic du ' . Date::parse($diagnostic->created_at)->format('l j F Y') )

@section('content')
    <div class="container mx-auto diagnostic-overview py-12">
        <!-- <h1>Aperçu du diagnostic</h1> -->
        <header class="border-b-2 border-blue-50 mb-12">
            <div class="flex justify-between mb-2">
                <p class="text-2xl font-bold text-blue-900">{{ ucfirst(Date::parse($diagnostic->created_at)->format('l j F Y')) }}</p>
                <p class="status bg-blue-50 p-2 rounded text-grey-900">{{ $diagnostic->status }}</p>
            </div>
            <p class="mb-2 text-grey-900">N° {{ $diagnostic->uuid }}</p>
        </header>
        <div class="diagnostic-content">
            <div class="your-needs">
                <h3 class="mb-6 text-2xl">Vos besoins</h3>

                @foreach($groupedNeeds as $group)
                    <div class="need-category-result card px-4">
                        <h4 class="text-2xl text-grey-900">{{ $group->first()->category->name }}</h4>
                        <ul class="text-blue-600 my-4">
                            @foreach($group as $need)
                                <li><i class="fas fa-check-circle mr-2"></i>{{ $need->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
