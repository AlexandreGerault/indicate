<!DOCTYPE html>
<html>

<head>
    @include('includes.head')

    <title>Tableau de bord</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}"/>
</head>

<body>
@include('includes.auth_nav')

<div class="sidebar">
    <div class="sidebar__group">
        <h2>Mes derniers diagnostics</h2>
        <ul>
            <li>Un diagnostic</li>
        </ul>
    </div>
    <div class="sidebar__group">
        <h2>Mes structures</h2>
        <ul>
            <li>Une structure</li>
        </ul>
    </div>
</div>

<main>
    <section class="actions">
        <div class="actions__item">
            <h2>Je suis un porteur de projet</h2>
            <p>Je souhaite créer un diagnostic car j'ai un projet !</p>
            <a class="actions__item__next" href="">Remplir un diagnostic</a>
        </div>
        <div class="actions__item">
            <h2>Je suis une entreprise en difficulté</h2>
            <p>J'ai besoin de l'aide d'une entreprise pour résoudre quelques problèmes.</p>
            <a class="actions__item__next" href="">Créer un diagnostic</a>
        </div>
        <div class="actions__item">
            <h2>Je veux apporter mon aide</h2>
            <p>Je suis une structure qui peut apporter son expertise à des porteurs de projet ou à des entreprises en
                difficultées.</p>
            <a class="actions__item__next" href="">Renseigner mes services</a>
        </div>
    </section>
    <section class="recent_activities">
        <h2>Mes dernières activités</h2>
        <ul class="recent_activities__list">
            <li class="recent_activities__item">
                <strong>utilisateur</strong>  a action <strong>sujet</strong> <time>il y a 1 jour</time>
            </li>
        </ul>
    </section>
</main>

<footer>

</footer>
</body>
</html>