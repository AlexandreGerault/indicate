<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Indicate - La boussole du développement</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<header class="hero text-white">
    <div class="container mx-auto px-4 lg:px-0 flex flex-col justify-between">
        <!-- Navbar -->
        <nav class="py-6">
            <div class="flex">
                {{-- Left part of navbar --}}
                <img src="{{ asset('img/logo_white.svg') }}" alt="Logo d'Indicate" class="mr-auto"/>
                {{-- End of left navbar part--}}

                {{-- Right part of navbar--}}
                <div class="self-center">
                    <div class="lg:hidden">
                        <button
                            class="flex items-center px-3 py-2 border rounded text-white-200 border-white-400 hover:text-white hover:border-white">
                            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <title>Menu</title>
                                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                            </svg>
                        </button>
                    </div>

                    <ul class="hidden lg:flex lg:-mx-4">
                        <li class="px-4">
                            <a class="" href="{{ route('landing_page') }}">
                                Accueil
                            </a>
                        </li>
                        @auth()
                            <li class="px-4">
                                <a class="" href="{{route('diagnostics.create')}}">
                                    Créer un diagnostic
                                </a>
                            </li>
                            <li class="px-4">
                                <a class="" href="{{ route('diagnostics.index') }}">
                                    Mes diagnostics
                                </a>
                            </li>
                            <li class="px-4">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                 <button>Déconnexion</button>
                                </form>
                            </li>
                        @elseguest()
                            <li class="px-4">
                                <a class="" href="{{ route('login') }}">
                                    Connexion
                                </a>
                            </li>
                            <li class="px-4">
                                <a class="" href="{{ route('register') }}">
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

        {{-- Marketing text --}}
        <div class="mt-6 mb-12">
            <h1 class="text-4xl lg:text-6xl">Indicate</h1>
            <p>Trouvez les bons interlocuteurs et améliorez votre résultat.</p>
        </div>
        {{-- End of Marketing text--}}

        {{-- Call to action --}}
        <div class="self-center translate-y-1/2">
            <a class=" button button-secondary " href="{{ route('register') }}">
                Essayez maintenant
            </a>
        </div>
        {{-- End of Call to action--}}
    </div>
</header>

<!-- Main -->
<main>

    <!-- Presentation section -->
    <section class="bg-white">
        <div class="container mx-auto px-4 text-gray-900">
            <h2 class="landing-h2 mt-6">Qu'est-ce qu'Indicate ?</h2>
            <div class="flex flex-col lg:flex-row lg:justify-between lg:-mx-6 leading-loose">
                <p class="my-6 lg:flex-1 lg:mx-6">Indicate est une plateforme
                    d'orientation des acteurs qui
                    permet à tout les acteurs de se
                    trouver et de travailler en
                    synergie.</p>

                <p class="my-6 lg:flex-1 lg:mx-6">Nous avons pour vocation de créer
                    un écosystème favorable au développement des entreprises,
                    dans un premier temps en Normandie.</p>

                <p class="my-6 lg:flex-1 lg:mx-6">Grâce à un système d'indicateurs
                    vous serez orienté selon vos
                    besoins vers le bon interlocuteur</p>

            </div>
        </div>
    </section>
    <!-- End of presentation section -->

    <section class="bg-blue-500">
        <div class="container mx-auto px-4">
            <h2 class="landing-h2 text-white">Comment ça marche ?</h2>

            <div class="lg:flex lg:-mx-6 leading-loose">
                <div class="process-item">
                    <img src="{{ asset('img/pen.svg') }}" alt="Un logo de crayon"/>
                    <h4>Réalisez un diagnostic</h4>
                    <p>Pour nous permettre de
                        cibler les structures en
                        fonction de vos besoins</p>
                </div>

                <div class="process-item">
                    <img src="{{ asset('img/list.svg') }}" alt="Un logo de liste"/>
                    <h4>Compte rendu</h4>
                    <p>Compte rendu du diagnostic
                        d'orientation et mise en relation
                        avec les structures choisies</p>
                </div>

                <div class="process-item">
                    <img src="{{ asset('img/curve.svg') }}" alt="Un logo de courbe"/>
                    <h4>Développez-vous</h4>
                    <p>Trouvez le bon interlocuteur
                        pour répondre à ses besoins
                        permet d'augmenter le résultat
                        net d'une entreprise</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-blue-800">
        <div class="container mx-auto px-4">
            <h2 class="landing-h2 text-white">Contactez-nous</h2>
            <form class="flex flex-col lg:flex-row lg:flex-wrap lg:-mx-4">
                <input type="email" name="sender" placeholder="john.doe@example.com" class="lg:mx-4 flex-1"/>
                <input type="text" name="fullname" placeholder="John Doe" class="lg:mx-4 flex-1"/>
                <textarea placeholder="Bonsoir, je souhaite vous contacter au sujet de..." class="lg:w-full lg:mx-4"></textarea>
                <input type="submit" value="Valider" class="lg:mx-4 button button-secondary lg:w-64"/>
            </form>
        </div>
    </section>
</main>
<!-- End of main -->

<footer class="bg-grey-800 text-white py-12">
    <h3 class="text-center text-2xl font-semibold">{{ config('app.name') }}</h3>
    <nav class="container mx-auto px-4">
        <ul>
            <li class="bg-grey-700 lg:bg-grey-800 rounded p-1 my-2 text-center">
                <a class="" href="{{ route('landing_page') }}">
                    Accueil
                </a>
            </li>
            @auth()
                <li class="bg-grey-700 lg:bg-grey-800 rounded p-1 my-2 text-center">
                    <a href="{{ route('diagnostics.create') }}">
                        Créer un diagnostic
                    </a>
                </li>
            @endauth
            <li class="bg-grey-700 lg:bg-grey-800  rounded p-1 my-2 text-center">
                <a href="#">
                    Mentions légales
                </a>
            </li>
        </ul>
    </nav>
</footer>

</body>
</html>
