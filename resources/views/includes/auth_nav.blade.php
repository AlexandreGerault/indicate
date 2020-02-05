<!-- Navbar -->
<nav class="navbar navbar__light">
    <!-- Left part of navbar -->
    <a href="{{ route('landing_page') }}" title="Page d'accueil">
        <img src="{{ asset('img/logo_blue.svg') }}" alt="Logo d'Indicate" class="navbar__link navbar__left"/>
    </a>
    <!-- End of left navbar part-->

    <!-- Right part of navbar-->
    <div class="navbar__right">
        <div class="navbar__hamburger">
            <svg height="32px" viewBox="0 0 32 32"
                 width="32px" xmlns="http://www.w3.org/2000/svg">
                <path fill="currentColor" d="M4,10h24c1.104,0,2-0.896,2-2s-0.896-2-2-2H4C2.896,6,2,6.896,2,8S2.896,10,4,10z M28,14H4c-1.104,0-2,0.896-2,2  s0.896,2,2,2h24c1.104,0,2-0.896,2-2S29.104,14,28,14z M28,22H4c-1.104,0-2,0.896-2,2s0.896,2,2,2h24c1.104,0,2-0.896,2-2  S29.104,22,28,22z"/>
            </svg>
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
                        <input type="submit" value="Déconnexion">
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
</nav>
<!-- End of navbar -->
