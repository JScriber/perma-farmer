<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Perma farmer</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if(Auth::user())
                            @if(Auth::user()->role->name =="Membre du staff")
                                <li></li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/panier') }}">{{ __('Panier') }}</a>
                                </li>
                            @endif
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @if(Auth::user())
                            @if(Auth::user()->role->name =="Membre du staff")
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/admin') }}">{{ __('Admin') }}</a>
                                </li>
                            @elseif(Auth::user()->role->name=="Client simple")
                            <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/') }}">{{ __('Mon Compte') }}</a>
                                </li>
                            @endif
                        @endif
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Se connecter') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('S\'inscrire') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->firstname .' '.Auth::user()->lastname }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
            @yield('content')
        @if(Auth::user())
            @if(Auth::user()->role->name =="Membre du staff")
                <div></div>
            @else
            <footer>
                <hr>
                <div class="liste-contact">
                    <div class="unit-contact">
                        <div class="logo-footer" id="logo-footer-1"></div>
                        <div class="text" id="text-footer-1">Horaire du mardi au samedi de 14h à 20h</div>
                    </div>
                    <div class="unit-contact">
                        <div class="logo-footer" id="logo-footer-2"></div>
                        <div class="text" id="text-footer-2">permafarmer@gmail.com</div>
                    </div>
                    <div class="unit-contact" id="unit-contact-3">
                        <div class="logo-footer" id="logo-footer-3"></div>
                        <div class="text" id="text-footer-3">0555034355</div>
                    </div>
                    <div class="unit-contact">
                        <div class="logo-footer" id="logo-footer-4"></div>
                        <div class="text" id="text-footer-4">Perma-Farmer 13 rue de la ferme 35000 RENNES </div>
                    </div>
                </div>
            </footer>
            @endif
        @else
        <footer>
            <hr>
            <div class="liste-contact">
                <div class="unit-contact">
                    <div class="logo-footer" id="logo-footer-1"></div>
                    <div class="text" id="text-footer-1">Horaire du mardi au samedi de 14h à 20h</div>
                </div>
                <div class="unit-contact">
                    <div class="logo-footer" id="logo-footer-2"></div>
                    <div class="text" id="text-footer-2">permafarmer@gmail.com</div>
                </div>
                <div class="unit-contact" id="unit-contact-3">
                    <div class="logo-footer" id="logo-footer-3"></div>
                    <div class="text" id="text-footer-3">0555034355</div>
                </div>
                <div class="unit-contact">
                    <div class="logo-footer" id="logo-footer-4"></div>
                    <div class="text" id="text-footer-4">Perma-Farmer 13 rue de la ferme 35000 RENNES </div>
                </div>
            </div>
        </footer>
        @endif
    </div>
</body>
</html>
