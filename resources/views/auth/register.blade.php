@extends('layouts.app')

@section('content')

    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-center align-items-center mb-3"><img class="mx-3"
                        src="{{ asset('img/logo_nav.png') }}">
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
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <h1 class="font-weight-bold text-hover mb-3">Registrate<br></h1>
                        <div class="form-group">
                            <label class="font-weight-bold" for="name">Nombre(s)<br></label>
                            <input class="form-control rounded-lg @error('name') is-invalid @enderror" type="text"
                                name="name" id="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="surname">Apellido(s)</label>
                            <input class="form-control rounded-lg @error('surname') is-invalid @enderror" type="text"
                                name="surname" id="surname" value="{{ old('surname') }}" required "
                                                autofocus>
                                            @error('surname')
                                                                <span class=" invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="email">Email</label>
                            <input class="form-control rounded-lg  @error('email') is-invalid @enderror" type="email"
                                name="email" id="email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="phone">Teléfono</label>
                            <input class="form-control rounded-lg @error('phone') is-invalid @enderror" type="text"
                                name="phone" id="phone" value="{{ old('phone') }}" autofocus>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="password">Contraseña</label>
                            <input class="form-control @error('password') is-invalid @enderror" type="password"
                                name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="password-confirm">Repetir Contraseña</label>
                            <input class="form-control rounded-lg" type="password" id="password-confirm"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="form-group mb-5">
                            <label class="font-weight-bold" for="user_image">Imagen de
                                perfil</label>
                            <input class="form-control-file @error('user_image') is-invalid @enderror" id="user_image"
                                type="file" name="user_image" value="{{ old('user_image') }}" autofocus>
                            @error('user_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button class="btn btn-primary btn-block search-button mb-3" type="submit">Registrarse</button>
                        <p class="text-center text-hover"><a href="{{ route('login') }}">¿Ya tienes una cuenta? Inicia
                                sesión
                                aquí<br></a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
