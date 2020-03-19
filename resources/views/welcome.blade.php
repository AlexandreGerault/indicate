<!DOCTYPE html>
<html>
<head>
@include('includes.head')

<!-- Styles -->
    <link href="{{ asset('css/landpage.css') }}" rel="stylesheet">
</head>
<body class="landpage">
<header class="hero">
    <!-- Navbar -->
@include('includes.navbar')
<!-- End of navbar -->

    <!-- Marketing text -->
    <div class="hero__content wrapper">
        <div>
            <h1 class="hero__title">Indicate</h1>
            <p class="hero__catchphrase">Trouvez les bons interlocuteurs et améliorez votre résultat.</p>

            <!-- Call to action -->
            <p class="hero__cta">
                <a class=" button button__secondary" href="#">
                    Essayez maintenant
                </a>
            </p>
            <!-- End of Call to action-->
        </div>
    </div>
    <!-- End of Marketing text-->

</header>

<!-- Main -->
<main>
    <!-- Our services -->
    <section class="services__section">
        <div class="wrapper">
            <h2>Nos services</h2>
            <div class="services">
                <div class="services__item">
                    <img src="/img/project.jpg" alt="Illustration de projet">
                    <h3>Projet de création</h3>
                    <div class="services__item__desc">
                        <p>Recevez de l'aide pour créer votre entreprise !</p>
                    </div>
                    <p class="services__item__cta"><a class="button button__dark" href="#">En savoir plus</a></p>
                </div>

                <div class="services__item">
                    <img src="/img/company.jpg" alt="Illustration d'entreprise">
                    <h3>Entreprise</h3>
                    <div class="services__item__desc">
                        <p>Trouvez les meilleurs structures de conseils pour votre développement !</p>
                    </div>
                    <p class="services__item__cta"><a class="button button__dark" href="#">En savoir plus</a></p>
                </div>

                <div class="services__item">
                    <img src="/img/consulting.jpg" alt="Illustration de consulting">
                    <h3>Donneur de conseils</h3>
                    <div class="services__item__desc">
                        <p>Inscrivez-vous et apportez votre expertise en conseils !</p>
                    </div>
                    <p class="services__item__cta"><a class="button button__dark" href="#">En savoir plus</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- End of our services -->

    <!-- Context section -->
    <section class="context__section">
        <div class="wrapper">
            <div class="context">
                <div>
                    <img src="/img/graphic.jpg" alt="Graphique illustratif"/>
                </div>
                <div>
                    <h2 class="align-left">Notre projet</h2>
                    <p>
                        Le nombre de création d'entreprises ne cesse de croître. Aujourd'hui, plus de 40% des
                        entreprises disparaissent après 3 ans d'existence et ce taux monte à 50% au bout de 5 ans. Pour
                        l'éviter et pour permettre une croissance des entreprises l'accès aux conseils et aux
                        accompagnements doit être simplifié.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- End of context section -->

    <!-- Contact section -->
    <section class="contact__section">
        <div class="wrapper">
            <h2>Contactez-nous</h2>
            @if ($errors->any())
                <div class="form__errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="contact__form" method="POST" action="{{ route('contact.store') }}" is="contact-form">
                @csrf
                <div class="input__email">
                    <label for="email">Adresse e-mail (champ obligatoire)</label>
                    <input id="email" type="email" name="email" placeholder="john.doe@example.com" class="flat"/>
                </div>
                <div class="input__fullname">
                    <label for="name">Votre nom</label>
                    <input id="name" type="text" name="name" placeholder="John Doe" class="flat"/>
                </div>
                <div class="input__message">
                    <label for="message">Votre message</label>
                    <textarea
                        id="message"
                        placeholder="Bonsoir, je souhaite vous contacter au sujet de..."
                        name="message"
                        class="flat"></textarea>
                </div>
                <div class="contact__submit">
                    <input type="submit" value="Envoyer" class="button button__secondary"/>
                </div>
            </form>
        </div>
    </section>
    <!-- End of contact section -->
</main>
<!-- End of main -->

<footer class="footer">
    <div class="wrapper">
        <h3 class="footer__title">{{ config('app.name') }}</h3>
        <nav class="footer__navigation">
            <ul class="footer__navigation__menu">
                <li class="footer__navigation__menu__item">
                    <a class="footer__navigation__menu__link" href="{{ route('landing_page') }}">
                        Accueil
                    </a>
                </li>
                @auth()
                    <li class="footer__navigation__menu__item">
                        <a class="footer__navigation__menu__link" href="{{ route('diagnostics.create') }}">
                            Créer un diagnostic
                        </a>
                    </li>
                @endauth
                <li class="footer__navigation__menu__item">
                    <a class="footer__navigation__menu__link" href="#">
                        Mentions légales
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</footer>

</body>
</html>
