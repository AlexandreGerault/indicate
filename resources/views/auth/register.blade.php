@extends('layouts.guest')

@section('content')
        <form method="POST" action="{{ route('register') }}" class="form form__auth">
            <h1 class="form__auth__title">Inscription</h1>

            @csrf

            <input id="first-name" type="text" class="form__auth__input @error('first-name') form__auth__input__error @enderror" name="first-name"
                   value="{{ old('first-name') }}" required autocomplete="given-name" autofocus placeholder="John"/>

            @error('first-name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <input id="last-name" type="text" class="form__auth__input @error('last-name') form__auth__input__error @enderror" name="last-name"
                   value="{{ old('last-name') }}" required autocomplete="family-name" autofocus placeholder="Doe">

            @error('last-name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <input id="birth-date" type="date" class="form__auth__input @error('birth-date') form__auth__input__error @enderror" name="birth-date"
                   value="{{ old('birth-date') }}" required autocomplete="date" autofocus placeholder="19/02/1998">

            @error('birth-date')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <input id="email" type="email" class="form__auth__input @error('email') form__auth__input__error @enderror"
                   name="email" value="{{ old('email') }}" required autocomplete="email"
                   placeholder="john.doe@example.com">

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <input id="password" type="password" class="form__auth__input @error('password') form__auth__input__error @enderror"
                   name="password" required autocomplete="new-password" placeholder="************">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <input id="password-confirm" type="password" class="form__auth__input" name="password_confirmation"
                   required autocomplete="new-password" placeholder="************">

            <button type="submit" class="button button__secondary">
                Valider l'inscription
            </button>
        </form>
@endsection
