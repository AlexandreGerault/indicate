<!DOCTYPE html>
<html>
<head>
@include('includes.head')

<!-- Styles -->
    <link href="{{ asset('css/guest.css') }}" rel="stylesheet">
</head>

<body class="landpage">
<header class="hero">
    <!-- Navbar -->
    <nav class="navbar navbar__dark">
        <div class="wrapper">
            <!-- Left part of navbar -->
            <a href="{{ route('landing_page') }}" title="Page d'accueil">
                <img src="{{ asset('img/logo_white.svg') }}" alt="Logo d'Indicate" class="navbar__link navbar__left"/>
            </a>
            <!-- End of left navbar part-->

            <!-- Right part of navbar-->
            <div class="navbar__right">
                <div class="navbar__hamburger">
                </div>

                <ul class="navbar__menu">

                    <li class="navbar__menu__link">
                        <a class="" href="{{ route('landing_page') }}">
                            Accueil
                        </a>
                    </li>
                    @auth()

                        <li class="navbar__menu__link">
                            <a class="" href="{{ route('diagnostics.create') }}">
                                Créer un diagnostic
                            </a>
                        </li>
                        <li class="navbar__menu__link">
                            <a class="" href="{{ route('diagnostics.index') }}">
                                Mes diagnostics
                            </a>
                        </li>
                        <li class="navbar__menu__link">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button>Déconnexion</button>
                            </form>
                        </li>

                    @elseguest()

                        <li class="navbar__menu__link">
                            <a href="{{ route('login') }}">
                                Connexion
                            </a>
                        </li>

                        <li class="navbar__menu__link">
                            <a href="{{ route('register') }}">
                                Inscription
                            </a>
                        </li>
                    @endauth

                </ul>
            </div>
            <!-- End of right navbar part-->
        </div>
    </nav>
    <!-- End of navbar -->

    <!-- Marketing text -->
    <div class="hero__content wrapper">
        <h1 class="hero__title">Indicate</h1>
        <p class="hero__catchphrase">Trouvez les bons interlocuteurs et améliorez votre résultat.</p>
    </div>
    <!-- End of Marketing text-->

    <!-- Call to action -->
    <div class="hero__cta">
        <a class=" button button__secondary" href="#">
            Essayez maintenant
        </a>
    </div>
    <!-- End of Call to action-->
</header>

<!-- Main -->
<main>
    <!-- Our services -->
    <section class="services__section">
        <div class="wrapper">
            <h2>Nos services</h2>
            <div class="services">
                <div class="services__item">
                    <h3>Projet de création</h3>
                    <div class="services__item__desc">
                        <p>Recevez de l'aide pour créer votre entreprise !</p>
                    </div>
                    <p><a class="" href="#">Réaliser un diagnostic</a></p>
                </div>

                <div class="services__item">
                    <h3>Entreprise</h3>
                    <div class="services__item__desc">
                        <p>Trouvez les meilleurs structures de conseils pour votre développement !</p>
                    </div>
                    <p><a class="" href="#">Réaliser un diagnostic</a></p>
                </div>

                <div class="services__item">
                    <h3>Donneur de conseils</h3>
                    <div class="services__item__desc">
                        <p>Inscrivez-vous et apportez votre expertise en conseils !</p>
                    </div>
                    <p><a class="" href="#">Je crée une structure de conseils</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- End of our services -->

    <!-- Context section -->
    <section class="context__section">
        <div class="wrapper">
            <h2>Contexte</h2>
            <div class="context">
                <div>
                    <img src="/img/graphic.jpg" alt="Graphique illustratif"/>
                </div>
                <div>
                    <p>
                        Le nombre de création d'entreprises ne cesse de croître. Aujourd'hui, plus de 40% des
                        entreprises
                        disparaissent après 3 ans d'existence et ce taux monte à 50% au bout de 5 ans. Pour l'éviter et
                        pour
                        permettre une croissance des entreprises l'accès aux conseils et aux accompagnements doit être
                        simplififé.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- End of presentation section -->

    <!-- Behavior description -->
    <section class="behavior__section">
        <div class="wrapper">
            <h2>Comment ça marche ?</h2>

            <div class="behavior__grid">
                <div>
                    <div class="behavior__item">
                        <p class="behavior__item__icon"><img src="{{ asset('img/pen.svg') }}" alt="Un logo de crayon"/></p>
                        <h3>Réalisez un diagnostic</h3>
                        <p>Pour nous permettre de
                            cibler les structures en
                            fonction de vos besoins</p>
                    </div>
                </div>

                <div>
                    <div class="behavior__item">
                        <p class="behavior__item__icon"><img src="{{ asset('img/list.svg') }}" alt="Un logo de liste"/></p>
                        <h3>Compte rendu</h3>
                        <p>Compte rendu du diagnostic
                            d'orientation et mise en relation
                            avec les structures choisies</p>
                    </div>
                </div>

                <div>
                    <div class="behavior__item">
                        <p class="behavior__item__icon"><img src="{{ asset('img/curve.svg') }}" alt="Un logo de courbe"/></p>
                        <h3>Développez-vous</h3>
                        <p>Trouvez le bon interlocuteur
                            pour répondre à ses besoins
                            permet d'augmenter le résultat
                            net d'une entreprise</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of behavior description -->

    <section class="contact__section">
        <div class="wrapper">
            <h2>Contactez-nous</h2>
            <form class="contact__form">
                <input type="email" name="sender" placeholder="john.doe@example.com" class="flat"/>
                <input type="text" name="fullname" placeholder="John Doe" class="flat"/>
                <textarea placeholder="Bonsoir, je souhaite vous contacter au sujet de..." class="flat"></textarea>
                <div class="contact__submit">
                    <input type="submit" value="Valider" class="button button__secondary"/>
                </div>
            </form>
        </div>
    </section>
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
