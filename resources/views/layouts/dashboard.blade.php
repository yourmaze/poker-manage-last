<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>

    <title>@isset($title) {{ $title }} @else Minus30 Hold`em helper @endisset</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    @stack('styles')

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    @stack('scripts')

    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
</head>
<body class="@php if(Cookie::get('show_sidebar')) echo 'sidebar-show'; @endphp">
<div id="dashboard" class="uk-grid" uk-height-viewport="expand: true">
    <div class="dashboard-sidebar uk-visible@s">
        <div class="dashboard-sidebar-header">
            <span class="dashboard-sidebar-header__text">Minus30 Hold`em helper</span>
            <img class="dashboard-sidebar-header__img" src="/img/logo-small.png" alt="">
            <span id="sidebar-click" class="uk-margin-small-left uk-float-right uk-icon">
                <i class="fal fa-bars fa-lg"></i>
            </span>
        </div>

        <div class="dashboard-sidebar-menu uk-padding-small">
            <ul class="uk-nav-primary uk-nav" uk-nav>
                <li class="{{ request()->is('home') ? 'uk-active' : '' }}">
                    <a href="{{ route('home') }}" class="ripple">
                        <span class="uk-margin-small-right tournament-icon"><i class="fal fa-home-lg-alt fa-2x"></i></span> Главная
                    </a>
                </li>
                <li class="uk-parent {{ request()->is('tournament', 'tournament/*') ? 'uk-active uk-open' : '' }}">
                    <a href="{{ route('tournament.index') }}" class="ripple">
                        <span class="uk-margin-small-right tournament-icon icon">
                            <i class="fal fa-tv fa-2x"></i>
                        </span>
                        Турниры
                    </a>
                    <ul class="uk-nav-sub">
                        <li class="{{ request()->is('tournament') ? 'uk-active' : '' }}"><a
                                href="{{ route('tournament.index') }}">Список текущих турниров</a></li>
                        <li class="{{ request()->is('tournament/create') ? 'uk-active' : '' }}"><a href="{{ route('tournament.create') }}">Новый турнир</a></li>
                    </ul>
                </li>
                <li class="{{ request()->is('cash') ? 'uk-active' : '' }}">
                    <a href="{{ route('cash.index') }}" class="ripple">
                        <span class="uk-margin-small-right tournament-icon">
                            <i class="fal fa-money-bill-alt fa-2x"></i>
                        </span>
                        Кэш игры
                    </a>
                </li>
                @role('main-administrator', 'administrator')
                <li class="{{ request()->is('dealers') ? 'uk-active' : '' }}">
                    <a href="{{ route('dealer.web.index') }}" class="ripple">
                        <span class="uk-margin-small-right tournament-icon">
                            <i class="fal fa-users fa-2x"></i>
                        </span>
                        Дилера
                    </a>
                </li>
                @endrole
            </ul>
        </div>

    </div>

    <a id="modal-menu" class="uk-navbar-toggle uk-hidden@s" uk-toggle="target: #sidenav"  uk-navbar-toggle-icon></a>

    <div id="sidenav" uk-offcanvas="flip: true" class="uk-offcanvas uk-offcanvas-overlay">
        <button class="uk-offcanvas-close" type="button" uk-close></button>
        <div class="dashboard-sidebar-header">
            <img class="uk-margin-small-right" src="/img/logo-small.png" alt="">
            Minus30 Hold`em helper
        </div>
        <div class="dashboard-sidebar-menu uk-padding-small">
            <ul class="uk-nav-primary uk-nav" uk-nav>
                <li class="{{ request()->is('home') ? 'uk-active' : '' }}">
                    <a href="{{ route('home') }}" class="ripple">
                        Главная
                    </a>
                </li>
                <li class="uk-parent {{ request()->is('tournament', 'tournament/*') ? 'uk-active uk-open' : '' }}">
                    <a href="{{ route('tournament.index') }}" class="ripple">
                        Турниры
                    </a>
                    <ul class="uk-nav-sub">
                        <li class="{{ request()->is('tournament', 'clients/create') ? 'uk-active' : '' }}"><a
                                href="{{ route('tournament.index') }}">Список текущих турниров</a></li>
                        <li><a href="{{ route('tournament.create') }}" class="{{ request()->is('tournament/create') ? 'uk-active' : '' }}">Новый турнир</a></li>
                    </ul>
                </li>
                <li class="{{ request()->is('cash') ? 'uk-active' : '' }}">
                    <a href="{{ route('cash.index') }}" class="ripple">
                        Кэш игры
                    </a>
                </li>
                <li class="{{ request()->is('dealers') ? 'uk-active' : '' }}">
                    <a href="{{ route('dealer.web.index') }}" class="ripple">
                        Дилера
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="dashboard-main uk-width-expand">
        <div id="example"></div>
        <div class="dashboard-header" uk-sticky="top: 1;media: 960">

            <h1 id="page-title" class="uk-margin-remove-bottom">@isset($title) {{ $title }} @else Страница @endisset</h1>

            <!-- Authentication Links -->
            @guest
                <div class="header-links">
                    <div class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <span class="uk-margin-small-right uk-icon" uk-icon="sign-in"></span>
                            Вход
                        </a>
                    </div>
                </div>
            @else
                <div class="uk-flex uk-flex-middle">
                    <div class="header-user">
                        <button class="uk-button header-user-button" type="button">
                            <span class="header-user-img">{{ substr(Auth::user()->name, 0, 2) }}</span>
                            <span class="header-user-name">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="header-user-role">@foreach(Auth::user()->roles as $role) {{ $role->name }} @endforeach </div>
                            </span>
                        </button>
                        <div class="uk-dropdown" uk-dropdown="offset: 0">
                            <ul class="uk-nav uk-dropdown-nav">
                                <li class="uk-active"><a href="{{ route('company.edit', Auth::user()->company_id) }}"> <i class="fal fa-cog fa-lg uk-margin-small-right"></i> Настройки</a></li>
                                <li class="uk-nav-divider"></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();"><i class="fal fa-sign-out fa-lg uk-margin-small-right"></i> Выход
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endguest

        </div>
        <div class="dashboard-content">
            <main class="py-4">
                @yield('content')
            </main>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
    </div>
</div>

</body>
</html>
