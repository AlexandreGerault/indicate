@extends('layouts.authenticated')

@section('title', 'Ajouter mon entreprise')

@section('content')
    <h1>Ajouter mon entreprise</h1>

    <form action="{{ route('companies.store') }}" method="post">
        <label for="name">Nom de l'entreprise</label>
        <input id="name" name="name" required type="text">

        <label for="status">Status de l'entreprise</label>
        <input id="status" name="status" required type="text">

        <label for="founded_at">Date de création</label>
        <input id="founded_at" name="founded_at" required type="date">

        <label for="responsible">Nom du responsable</label>
        <input id="responsible" name="responsible" required type="text">

        <label for="phone">Numéro de téléphone</label>
        <input id="phone" name="phone" required type="tel">

        <label for="mail">Adresse mail de contact</label>
        <input id="mail" name="mail" required type="email">

        <input id="cgu" name="cgu" required type="checkbox"/>
        <label for="cgu">En cochant cette case j'accepte les conditions générales d'utilisation et la politique
            générale</label>

        <input id="rgpd" name="rgpd" required type="checkbox"/>
        <label for="rgpd">En cochant cette case j'accepte que mes données soient utilisées à des fins commerciales afin
            d'améliorer votre expérience. Pour plus d'informations cliquez ici</label>

        <input type="submit" value="Valider l'ajout"/>
    </form>
@endsection
