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
<nav class="p-6 shadow">
    <div class="flex container mx-auto px-4 lg:px-0">
        {{-- Left part of navbar --}}
        <img src="{{ asset('img/logo_blue.svg') }}" alt="Logo d'Indicate" class="mr-auto"/>
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
                        <a class="" href="{{ route('diagnostics.create') }}">
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

<main class="mx-auto max-w-4xl px-2 lg:px-0">
    @yield('content')
</main>

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
