<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-1/css/all.min.css" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<!-- Navbar -->
<nav class="navbar navbar__light">
    <div class="wrapper">
        {{-- Left part of navbar --}}
        <a href="{{ route('landing_page') }}" title="Page d'accueil">
            <img src="{{ asset('img/logo_blue.svg') }}" alt="Logo d'Indicate" class="navbar__link navbar__left"/>
        </a>
        {{-- End of left navbar part--}}

        {{-- Right part of navbar--}}
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
        {{-- End of right navbar part--}}
    </div>
</nav>
<!-- End of navbar -->

<main>
    <div class="wrapper">
        @yield('content')
    </div>
</main>

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
