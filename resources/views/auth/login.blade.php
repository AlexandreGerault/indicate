@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
    <form method="POST" action="{{ route('login') }}" class="form form__auth">
        <h1 class="form__auth__title">Connexion</h1>
        @csrf
        <input id="email" type="email" class="form__auth__input @error('email') form__auth__input__error @enderror"
               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
               placeholder="john.doe@example.com">

        @error('email')
        <span class="form__error" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <input id="password" type="password" class="form__auth__input @error('password') form__auth__input__error @enderror"
               name="password" required autocomplete="current-password" placeholder="**********">

        @error('password')
        <span class="form__error" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        @if (Route::has('password.request'))
            <a class="form__auth__secondary__action" href="{{ route('password.request') }}">
                Mot de passe oublié ?
            </a>
        @endif


        <label class="form__auth__checkbox" for="remember">
            <input class="" type="checkbox" name="remember"
                   id="remember" {{ old('remember') ? 'checked' : '' }}>
            Se rappeler de moi
        </label>

        <button type="submit" class="button button__secondary">
            Connexion
        </button>
    </form>
@endsection
