<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Life Automation') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

</head>
<body>
    <div id="app">

        <navigation inline-template>
            <nav class="navigation">
                <aside class="navigation__sidebar">
                    <div class="sidebar__logo">
                        <h4>{{ config('app.name', 'Life Automation') }}</h4>
                    </div>
                    <ul class="sidebar__list">
                        <li class="sidebar__list-item"><a href="{{ route("dashboard") }}">Dashboard</a></li>
                        <li class="sidebar__list-item"><a href="{{ route("news") }}">News</a></li>
                        <li class="sidebar__list-item sidebar-dropdown-menu">
                            <a href="#">Shopping</a>
                            <ul class="dropdown">
                                <li><a href="{{ route('shopping.categories') }}">Categories</a></li>
                                <li><a href="{{ route('shopping.items') }}">Items</a></li>
                            </ul>
                        </li>
                        <li class="sidebar__list-item"><a href="{{ route("devices") }}">Device</a></li>
                        <li class="sidebar__list-item"><a href="{{ route("devices.jobs") }}">Device Jobs</a></li>
                        <li class="sidebar__list-item"><a href="{{ route("oauth.personal") }}">Personal Access Token</a></li>
                    </ul>
                </aside>

                <div class="navigation__mobile">
                    <div class="mobile__logo">
                        <a href="{{ url('/') }}">{{ config('app.name', 'Life Automation') }}</a>
                    </div>
                    <div class="mobile__menu">
                        <button v-on:click="toggle">Menu</button>
                    </div>
                    <ul class="mobile__list" v-if="showNavigation">
                        <li class="mobile__list-item"><a href="{{ route("devices") }}">Device</a></li>
                        <li class="mobile__list-item"><a href="{{ route("devices.jobs") }}">Device Jobs</a></li>
                        <li class="mobile__list-item"><a href="{{ route("oauth.personal") }}">Personal Access Token</a></li>
                        <li class="mobile__list-item">
                            <a href="{{ route("devices.jobs") }}">Shopping</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </navigation>

        @if(Auth::check())
            <header>
                Hello <a href="{{route('settings.account')}}">{{ Auth::user()->name }}</a>
            </header>
        @endif

        <main class="main">
            @yield('content')
        </main>
    </div>
</body>
</html>
