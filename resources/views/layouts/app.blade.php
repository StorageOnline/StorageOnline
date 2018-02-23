<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
    <!-- Подключение библиотеки построения графиков -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">


</head>
<body>
    <div id="app">
        <div class="navmenu navmenu-default navmenu-fixed-left offcanvas-sm">
            <a class="navmenu-brand visible-md visible-lg alert-success" href="/home">Storage.Online</a>
            <ul class="nav navmenu-nav">
                <li class="beta"><a href="{{ route('products') }}">Товары</a></li>
                <li class="beta"><a href="{{ route('counterparty') }}">Контрагенты</a></li>
                <li class="beta"><a href="{{ route('incoming-payment-order') }}">Приходный ордер</a></li>
                <li><a href="{{ route('outgoing-payment-order') }}">Расходный ордер</a></li>
                <li><a href="{{ route('reports') }}">Отчеты</a></li>
                <li class="beta"><a href="{{ route('storage') }}">Склад</a></li>
                <li><a href="{{ route('users') }}">Пользователи</a></li>
                <li><a href="{{ route('log') }}">Журнал</a></li>
            </ul>
        </div>

        <div class="navbar navbar-default navbar-fixed-top hidden-md hidden-lg">
            <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navmenu">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand alert-success" href="/home">Storage.Online</a>
        </div>


        {{--<nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('products') }}">Товары</a></li>
                        <li><a href="{{ route('counterparty') }}">Контрагенты</a></li>
                        <li><a href="{{ route('incoming-payment-order') }}">Приходный ордер</a></li>
                        <li><a href="{{ route('outgoing-payment-order') }}">Расходный ордер</a></li>
                        <li><a href="{{ route('reports') }}">Отчеты</a></li>
                        <li><a href="{{ route('storage') }}">Склад</a></li>
                        <li><a href="{{ route('users') }}">Пользователи</a></li>
                        <li><a href="{{ route('log') }}">Журнал</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>--}}
        <div class="container">
            @yield('content')
            @yield('modal')
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/ipr.js') }}" type="text/javascript"></script>
</body>
</html>
