@extends('layouts.app')

@section('content')

    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-center align-items-center mb-3">
                    <img class="mx-3" src="{{ secure_asset('img/logo_nav.png') }}">
                    <h1 class="text-blue font-weight-bold mb-3 text-center my-auto">MM Rentas<br></h1>
                </div>
                <h3 class="text-center font-weight-bold">
                    Comienza a publicar tus departamentos <br> rápido, fácil y seguro
                </h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="login-clean">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <h1 class="font-weight-bold text-hover mb-3">Iniciar Sesión<br></h1>
                        <div class="form-group">
                            <label class="font-weight-bold" for="email">Correo
                                Electrónico<br></label>
                            <input class="form-control rounded-lg @error('email') is-invalid @enderror" type="email"
                                name="email" id="email" placeholder="Correo Electrónicio" value="{{ old('email') }}"
                                required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="password">Contraseña</label>
                            <input class="form-control @error('password') is-invalid @enderror" type="password"
                                name="password" id="password" placeholder="Contraseña" required
                                autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Recordar credenciales') }}
                                </label>

                            </div>
                        </div>


                        <button class="btn btn-primary btn-block search-button mb-3" type="submit">Ingresar</button>
                        <p class="text-center text-hover">
                            <a href="{{ route('register') }}">¿Aún no estas registrado?
                                Regístrate y comienza a publicar
                            </a>
                        </p>
                        @if (Route::has('password.request'))
                            <div class="d-flex">
                                <a class="btn btn-link ml-auto text-hover" href="{{ route('password.request') }}">
                                    {{ __('Olvidé mi contraseña') }}
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
