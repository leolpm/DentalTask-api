<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      data-theme="light"
      data-layout="vertical"
      data-nav="default"
      data-menu="light"
      data-footer="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'DentalTask AI') }}</title>

        @include('partials.pwa')

        @routes

        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead

        <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/theme-dark.min.css') }}">
    </head>
    <body>
        @inertia

        <script src="{{ asset('assets/js/config.js') }}"></script>
        <script src="{{ asset('assets/js/theme.js') }}"></script>
        <script src="{{ asset('assets/js/phoenix.js') }}"></script>
    </body>
</html>
