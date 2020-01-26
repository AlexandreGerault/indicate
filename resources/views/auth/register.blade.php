@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <div class="card my-24 max-w-md mx-auto text-grey-900">
            <h1>Inscription</h1>
            <form method="POST" action="{{ route('register') }}" class="flex flex-col">
                @csrf

                <input id="first-name" type="text" class="flat @error('first-name') is-invalid @enderror" name="first-name"
                       value="{{ old('first-name') }}" required autocomplete="given-name" autofocus placeholder="John"/>

                @error('first-name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <input id="last-name" type="text" class="flat @error('last-name') is-invalid @enderror" name="last-name"
                       value="{{ old('last-name') }}" required autocomplete="family-name" autofocus placeholder="Doe">

                @error('last-name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <input id="birth-date" type="date" class="flat @error('birth-date') is-invalid @enderror" name="birth-date"
                       value="{{ old('birth-date') }}" required autocomplete="date" autofocus placeholder="19/02/1998">

                @error('birth-date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <input id="email" type="email" class="flat @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required autocomplete="email"
                       placeholder="john.doe@example.com">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <input id="password" type="password" class="flat @error('password') is-invalid @enderror"
                       name="password" required autocomplete="new-password" placeholder="************">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <input id="password-confirm" type="password" class="flat" name="password_confirmation"
                       required autocomplete="new-password" placeholder="************">

                <button type="submit" class="button button-secondary">
                    Valider l'inscription
                </button>
            </form>
        </div>
    </div>
@endsection
