<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/checkbox.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/moment/moment.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>




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
    <title>Storage.Online Система управления складом онлайн</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('font/icomoon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-extended.css') }}">

    




</head>
<body>
    <div id="app">
        <div class="navmenu navmenu-default navmenu-fixed-left offcanvas-sm scrollBar">
            <a class="navmenu-brand visible-md visible-lg hidden-sm alert-success" href="/home">Storage.Online</a>
            <div class="flags">
                <a class="navmenu-brand visible-md visible-lg eng" href="/setlocale/en" data-toggle="flags" title="{{ trans('menu.eng') }}"></a>
                <a class="navmenu-brand visible-md visible-lg ua" href="/setlocale/ua" data-toggle="flags" title="{{ trans('menu.ukr') }}"></a>
                <a class="navmenu-brand visible-md visible-lg rus" href="/setlocale/ru" data-toggle="flags" title="{{ trans('menu.rus') }}"></a>
            </div>
            
            <ul class="nav navmenu-nav">
                <li class="products"><a href="{{ route('products') }}"><i class="icon icon-shop2"></i> {{ trans('menu.products') }}</a></li>
                <li class="counterparty"><a href="{{ route('counterparty') }}"><i class="icon icon-address-book"></i> {{ trans('menu.counterparty') }}</a></li>
                <li class="incoming-payment-order"><a href="{{ route('incoming-payment-order') }}"><i class="icon icon-box-add"></i> {{ trans('menu.incoming_order') }}</a></li>
                <li class="outgoing-payment-order"><a href="{{ route('outgoing-payment-order') }}"><i class="icon icon-box-remove"></i> {{ trans('menu.outgoing_order') }}</a></li>
                <li class="reports"><a href="{{ route('reports') }}"><i class="icon icon-clipboard"></i> {{ trans('menu.reports') }}</a></li>
                <li class="storage"><a href="{{ route('storage') }}"><i class="icon icon-truck"></i> {{ trans('menu.storage') }}</a></li>
                <li class="users"><a href="{{ route('users') }}"><i class="icon icon-users"></i> {{ trans('menu.users') }}</a></li>
                <li class="log"><a href="{{ route('log') }}"><i class="icon icon-book"></i> {{ trans('menu.log') }}</a></li>
                <div class="nav-bottom clearfix" style="height: 385px;">
                    <a href="#" style="border-right: 0px;" data-toggle="tooltip" title="{{ trans('menu.exit') }}" onclick="document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    <a href="#" style="border-right: 0px;" data-toggle="tooltip" title="{{ trans('menu.calc') }}"><i class="fa fa-calculator"></i></a>
                    <a href="{{ route('settings') }}" style="border-right: 0px;" data-toggle="tooltip" title="{{ trans('menu.settings') }}"><i class="fa fa-gears"></i></a>
                    <a href="#" style="border-right: 0px;" data-toggle="tooltip" title="{{ trans('menu.game') }}"><i class="fa fa-rocket"></i></a>
                </div>
            </ul>
        </div>

        <div class="navbar navbar-default navbar-fixed-top hidden-md hidden-lg">
            <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navmenu">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand alert-success" href="/home">Storage.Online</a>
            <div class="flags-sm">
                <a class="navmenu-brand visible-md visible-lg eng" href="/setlocale/en" data-toggle="flags" title="Английский"></a>
                <a class="navmenu-brand visible-md visible-lg ua" href="/setlocale/ua" data-toggle="flags" title="Украинский"></a>
                <a class="navmenu-brand visible-md visible-lg rus" href="/setlocale/ru" data-toggle="flags" title="Русский"></a> 
            </div>
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
                        <li><a href="{{ route('products') }}"><i class="icon icon-cart"></i> Товары</a></li>
                        <li><a href="{{ route('counterparty') }}"><i class="icon"></i> Контрагенты</a></li>
                        <li><a href="{{ route('incoming-payment-order') }}"><i class="icon"></i> Приходный ордер</a></li>
                        <li><a href="{{ route('outgoing-payment-order') }}"><i class="icon"></i> Расходный ордер</a></li>
                        <li><a href="{{ route('reports') }}"><i class="icon"></i> Отчеты</a></li>
                        <li><a href="{{ route('storage') }}"><i class="icon"></i> Склад</a></li>
                        <li><a href="{{ route('users') }}"><i class="icon"></i> Пользователи</a></li>
                        <li><a href="{{ route('log') }}"><i class="icon"></i> Журнал</a></li>
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
    <script>
       

  

        $(function () {
            if(location.pathname == "/products") $('.products').addClass('active-li-menu');
            if(location.pathname == "/counterparty") $('.counterparty').addClass('active-li-menu');
            if(location.pathname == "/incoming-payment-order") $('.incoming-payment-order').addClass('active-li-menu');
            if(location.pathname == "/outgoing-payment-order") $('.outgoing-payment-order').addClass('active-li-menu');
            if(location.pathname == "/reports") $('.reports').addClass('active-li-menu');
            if(location.pathname == "/storage") $('.storage').addClass('active-li-menu');
            if(location.pathname == "/users") $('.users').addClass('active-li-menu');
            if(location.pathname == "/log") $('.log').addClass('active-li-menu');

            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip({
                    placement : 'top'
                });
                 $('[data-toggle="flags"]').tooltip({
                    placement : 'bottom'
                });
            });


        });
    
    </script>
</body>
</html>

