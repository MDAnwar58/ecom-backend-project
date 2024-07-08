<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>
            @if (!Route::is('home'))
                @yield('title') -
            @endif Organichatt
        </title>
        <link rel='stylesheet'
            href='https://cdn-uicons.flaticon.com/2.3.0/uicons-bold-straight/css/uicons-bold-straight.css'>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @yield('links')
        <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
    </head>

    <body>
        @include('components.app-header')
        <div class=" sticky top-0 z-30">
            @include('components.app-navbar')
            @include('components.app-manu')
        </div>
        @yield('content')

        {{-- app mobile screen footer bar --}}
        @include('components.app-mobile-footer-bar')
        {{-- app footer --}}
        @include('components.app-footer')
        <!-- drawer component right cart -->
        @include('components.favorite-right-bar')


        <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
        <script>
            function getUrl() {
                const pathname = window.location.pathname;
                sessionStorage.setItem("sign_out_url", pathname);
            }
        </script>
        @yield('scripts')
    </body>

</html>
