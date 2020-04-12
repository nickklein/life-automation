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

        <aside class="sidebar">
            <div class="sidebar__logo">
                <img src="{{ asset('/images/logo.png') }}" alt="SteamCompanion">
            </div>
            <ul class="sidebar__list">
                <li class="sidebar__list-item"><a href="{{ route("devices") }}">Device</a></li>
                <li class="sidebar__list-item"><a href="{{ route("devices.jobs") }}">Device Jobs</a></li>
                <li class="sidebar__list-item"><a href="{{ route("oauth.personal") }}">Personal Access Token</a></li>
            </ul>
        </aside>

        <header>
            Hello
        </header>

        <main class="main">
            @yield('content')
        </main>
    </div>
</body>
</html>
