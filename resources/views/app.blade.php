<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @include('partials.pwa')
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        <script src="https://kit.fontawesome.com/d6eaac7880.js" crossorigin="anonymous"></script>

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}" id="style-default">
        <link rel="stylesheet" href="{{ asset('assets/css/user.min.css') }}" id="user-style-default">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased" data-navbar-appearance="default">
        <main class="main" id="top">
            @inertia
        </main>
        <script src="{{ asset('assets/js/config.js') }}"></script>
        <script src="{{ asset('vendors/lodash/lodash.min.js') }}"></script>
        <script src="{{ asset('vendors/popper/popper.min.js') }}"></script>
        <script src="{{ asset('vendors/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/phoenix.js') }}"></script>
    </body>
</html>
