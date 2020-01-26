@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <div class="card my-24 max-w-md mx-auto text-grey-900">
            <h1>Connexion</h1>
            <form method="POST" action="{{ route('login') }}" class="flex flex-col">
                @csrf
                <input id="email" type="email" class="flat @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                       placeholder="john.doe@example.com">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <input id="password" type="password" class="flat @error('password') is-invalid @enderror"
                       name="password" required autocomplete="current-password" placeholder="**********">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @if (Route::has('password.request'))
                    <a class="text-sm text-grey-500 mb-6" href="{{ route('password.request') }}">
                        Mot de passe oublié ?
                    </a>
                @endif


                <label class="mb-6" for="remember">
                    <input class="" type="checkbox" name="remember"
                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                    Se rappeler de moi
                </label>

                <button type="submit" class="button button-secondary">
                    Connexion
                </button>
            </form>
        </div>
@endsection
