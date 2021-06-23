<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'mmRentas') }}</title>
    <link rel="icon" href="{!! secure_asset('img/logo_nav.png') !!}" />

    <!-- Scripts -->
    <script src="{{ secure_asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    @yield('custom_js')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/Drag-Drop-File-Input-Upload.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/Footer-Dark.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/Navigation-with-Button.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/Team-Boxed.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/Carousel.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />

</head>

<body>
    <div id="app">
        <div id="page-content">
            <nav class="navbar navbar-light navbar-expand-md navigation-clean-button" id="navbar">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <div class="d-flex flex-column align-items-center">
                            <img id="nav-logo" src="{{ secure_asset('img/logo_nav.png') }}" width="75%">
                            <span>MM. Rentas</span>
                        </div>
                    </a>
                    <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('search') }}">Buscar
                                    departamento</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">Acerca de
                                    nosotros</a></li>
                        </ul>
                        @if (Route::has('login'))
                            @auth

                                <div class="dropdown">
                                    <button class="btn btn-block text-left dropdown-button-filter nav_user"
                                        aria-expanded="false" data-toggle="dropdown" type="button">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle nav-circle-image"
                                                style="background: url({{ route('user.profile_image', Auth::user()->id) }}) center / cover no-repeat;">
                                            </div>
                                            <span class="font-weight-bold">{{ Auth::user()->name }}</span>
                                            <i class="fas fa-sort-down ml-2"></i>
                                        </div>
                                    </button>
                                    <div class="dropdown-menu dropdown-type">
                                        <a class="dropdown-item" href="{{ route('user.info', Auth::user()->id) }}">
                                            {{ __('info') }}
                                        </a>

                                        <a class="dropdown-item"
                                            href="{{ route('user.publications', Auth::user()->id) }}">
                                            {{ __('Publicaciones') }}
                                        </a>

                                        <a class="dropdown-item text-danger mt-3" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>

                            @else
                                <span class="navbar-text actions">
                                    <a class="login" href="{{ route('login') }}">Log In</a>
                                    @if (Route::has('register'))
                                        <a class="btn btn-primary rounded text-white" role="button" id="sign-up"
                                            href="{{ route('register') }}">Sign up</a>
                                    @endif
                                </span>
                            @endauth
                        @endif
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>

        </div>
        <footer class="footer-dark">
            <div class="container"><img class="mx-auto d-block" src="{{ secure_asset('img/rentas_logo.png') }}">
                <p class="copyright">MM Rentas</p>
            </div>
        </footer>

    </div>

</body>


</html>
