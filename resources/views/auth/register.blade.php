@extends('layouts.app')

@section('content')
    @push('title') {{ $title }} @endpush
    {{--
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
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
                <p class=" text-white h2">ACCIÓN REGIONAL</p>
                <p class="white mb-0">
                    Utilice este formulario para registrarse.
                    <br>Si es miembro, por favor
                    <a href="{{ route('login') }}" class="white"><b>Inicar sessión</b></a>.
                </p>
            </div>
            <div class="form-side">
                <a href="Dashboard.Default.html">
{{--                    <span class="logo-single"></span>--}}
                </a>
                <h2 class="mb-4">{{ __('Crear una Cuenta') }}</h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <h6 class="mb-4">{{ __('Información personal') }}</h6>

                    <div class="form-group mb-4">
                        <div class="has-float-label">
                            <input id="user_firstname" type="text" class="form-control" name="user_firstname"
                                   value="{{ old('user_firstname') }}" autocomplete="user_firstname" autofocus>
                            <span>{{ __('Nombres') }}</span>
                        </div>
                        @error('user_firstname')
                        <div class="text-muted font-italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <div class="has-float-label">
                            <input id="user_lastname" type="text" class="form-control" name="user_lastname"
                                   value="{{ old('user_lastname') }}" autocomplete="user_lastname" autofocus>
                            <span>{{ __('Apellidos') }}</span>
                        </div>
                        @error('user_lastname')
                        <div class="text-muted font-italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <div class="has-float-label">
                            <input id="phone" type="text" class="form-control" name="phone"
                                   value="{{ old('phone') }}" autocomplete="phone" autofocus>
                            <span>{{ __('Celular') }}</span>
                        </div>
                        @error('phone')
                        <div class="text-muted font-italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <h6 class="mb-4">{{ __('Información personal') }}</h6>

                    <div class="form-group mb-4">
                        <div class="has-float-label">
                            <input id="username" type="text" class="form-control" name="username"
                                   value="{{ old('username') }}" autocomplete="username" autofocus>
                            <span>{{ __('Usuario') }}</span>
                        </div>
                        @error('username')
                        <div class="text-muted font-italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <div class="has-float-label">
                            <input id="email" type="text" class="form-control"
                                   name="email" value="{{ old('email') }}" autocomplete="email">
                            <span>{{ __('E-Mail') }}</span>
                        </div>
                        @error('email')
                        <div class="text-muted font-italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <div class="has-float-label">
                            <input id="password" type="password"
                                   class="form-control" name="password" autocomplete="new-password">
                            <span>{{ __('Contraseña') }}</span>
                        </div>
                        @error('password')
                        <div class="text-muted font-italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <div class="has-float-label">
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation"
                                   autocomplete="new-password">
                            <span>{{ __('Confirmar Contraseña') }}</span>
                        </div>
                        @error('password_confirmation')
                        <div class="text-muted font-italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end align-items-center">
                        <button class="btn btn-primary btn-lg btn-shadow" type="submit">{{ __('Register') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
