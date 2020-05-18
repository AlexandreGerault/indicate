<!-- Navbar -->
<nav class="navbar">
    <!-- Left part of navbar -->
    <div class="navbar__left">
        <a href="{{ route('landing_page') }}" title="Page d'accueil">
            <svg xmlns="http://www.w3.org/2000/svg" width="39.827" height="44.43" viewBox="0 0 39.827 44.43">
                <g id="IndicateLogo" transform="translate(-3.001 9.066)">
                    <g id="IndicateLogo-2" data-name="IndicateLogo" transform="translate(3.001 -9.066)">
                        <g id="OutterPart">
                            <g id="OutterCircles">
                                <path id="Tracé_164" data-name="Tracé 164" d="M9.039,36.121a5.038,5.038,0,1,1,5.038-5.038A5.044,5.044,0,0,1,9.039,36.121Zm0-8.371a3.333,3.333,0,1,0,3.333,3.333A3.336,3.336,0,0,0,9.039,27.75Z" transform="translate(-4.001 -17.511)" fill="currentColor"/>
                                <path id="Tracé_165" data-name="Tracé 165" d="M9.039,86.831a5.038,5.038,0,1,1,5.038-5.038A5.044,5.044,0,0,1,9.039,86.831Zm0-8.371a3.333,3.333,0,1,0,3.333,3.333A3.337,3.337,0,0,0,9.039,78.46Z" transform="translate(-4.001 -50.989)" fill="currentColor"/>
                                <path id="Tracé_166" data-name="Tracé 166" d="M52.813,112.1a5.038,5.038,0,1,1,5.039-5.038A5.044,5.044,0,0,1,52.813,112.1Zm0-8.371a3.333,3.333,0,1,0,3.333,3.333A3.336,3.336,0,0,0,52.813,103.733Z" transform="translate(-32.9 -67.674)" fill="currentColor"/>
                                <path id="Tracé_167" data-name="Tracé 167" d="M52.813,11.011a5.038,5.038,0,1,1,5.039-5.038A5.044,5.044,0,0,1,52.813,11.011Zm0-8.371a3.333,3.333,0,1,0,3.333,3.333A3.336,3.336,0,0,0,52.813,2.64Z" transform="translate(-32.9 -0.934)" fill="currentColor"/>
                                <path id="Tracé_168" data-name="Tracé 168" d="M96.587,36.284a5.038,5.038,0,1,1,5.038-5.038A5.044,5.044,0,0,1,96.587,36.284Zm0-8.371a3.333,3.333,0,1,0,3.333,3.333A3.336,3.336,0,0,0,96.587,27.913Z" transform="translate(-61.799 -17.619)" fill="currentColor"/>
                                <path id="Tracé_169" data-name="Tracé 169" d="M96.587,86.831a5.038,5.038,0,1,1,5.038-5.038A5.044,5.044,0,0,1,96.587,86.831Zm0-8.371a3.333,3.333,0,1,0,3.333,3.333A3.336,3.336,0,0,0,96.587,78.46Z" transform="translate(-61.799 -50.989)" fill="currentColor"/>
                            </g>
                        </g>
                        <g id="InnerPart" transform="translate(10.646 13.946)">
                            <path id="InnerPolygon" d="M44.4,60.223h7.452l3.726-6.453-3.726-6.453H44.4L40.674,53.77Z" transform="translate(-38.858 -45.501)" fill="none"/>
                            <g id="OutterCircles-2" data-name="OutterCircles">
                                <circle id="Ellipse_107" data-name="Ellipse 107" cx="1.816" cy="1.816" r="1.816" transform="translate(11.201)" fill="#f59331"/>
                                <circle id="Ellipse_108" data-name="Ellipse 108" cx="1.816" cy="1.816" r="1.816" transform="translate(3.726 0)" fill="#f59331"/>
                                <circle id="Ellipse_109" data-name="Ellipse 109" cx="1.816" cy="1.816" r="1.816" transform="translate(0 6.453)" fill="#f59331"/>
                                <circle id="Ellipse_110" data-name="Ellipse 110" cx="1.816" cy="1.816" r="1.816" transform="translate(14.903 6.453)" fill="#f59331"/>
                                <circle id="Ellipse_111" data-name="Ellipse 111" cx="1.816" cy="1.816" r="1.816" transform="translate(11.177 12.906)" fill="#f59331"/>
                                <circle id="Ellipse_112" data-name="Ellipse 112" cx="1.816" cy="1.816" r="1.816" transform="translate(3.726 12.906)" fill="#f59331"/>
                            </g>
                        </g>
                    </g>
                </g>
            </svg>
            Indicate
        </a>
    </div>
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
                    <a class="" href="{{ route('company.diagnostics.create') }}">
                        Créer un diagnostic
                    </a>
                </li>
                <li class="navbar__menu__link">
                    <a class="" href="{{ route('dashboard') }}">
                        Tableau de bord
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
