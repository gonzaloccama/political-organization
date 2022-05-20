@extends('layouts.app')

@section('content')
    @push('title') {{ $title }} @endpush
    {{--<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    --}}
    <div class="col-12 col-md-10 mx-auto my-auto">
        <div class="card auth-card">
            <div class="position-relative image-side ">

                <p class=" text-white h2">ACCION REGIONAL</p>

                <p class="white mb-0">
                    Utilice sus credenciales para iniciar sesión.
                    <br>Si no es miembro, por favor
                    <a href="{{ route('register') }}" class="white"><b>Registarme</b></a>.
                </p>
            </div>
            <div class="form-side">
                <a href="{{ route('home') }}">
{{--                    <span class="logo-single"></span>--}}
                </a>
                <h6 class="mb-4">{{ __('Login') }}</h6>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group mb-4">
                        <div class="has-float-label">
                            <input id="email" type="text" value="{{ old('email') }}" autofocus
                                   class="form-control" name="email"
                                   autocomplete="email">
                            <span>{{ __('E-Mail Address') }}</span>
                        </div>
                        @error('email')
                        <span class="text-muted font-italic" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <div class="has-float-label">
                            <input id="password" type="password" value="{{ old('password') }}" autofocus
                                   class="form-control" name="password"
                                   autocomplete="current-password">
                            <span>{{ __('Password') }}</span>
                        </div>
                        @error('password')
                        <span class="text-muted font-italic" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember"
                                   id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                        <button class="btn btn-primary btn-lg btn-shadow" type="submit">{{ __('Login') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
