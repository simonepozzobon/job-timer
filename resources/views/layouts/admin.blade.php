<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @yield('stylesheets')
    </head>

    <body>
        @include('layouts.admin._menu')
        @include('layouts.admin._sidebar')

        <div class="container py-5">
            @yield('content')
        </div>

        @include('layouts.admin._footer')

        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/app.js') }}"></script>
        @yield('scripts')
    </body>
</html>
