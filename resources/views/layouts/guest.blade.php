<!DOCTYPE html>
<html>
<head>
    @include('includes.head')

    <!-- Styles -->
    <link href="{{ asset('css/guest.css') }}" rel="stylesheet">
</head>

<body>
@include('includes.navbar')

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
