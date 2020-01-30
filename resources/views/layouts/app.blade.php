<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/img_upload.js') }}" defer></script>
    <!-- Fonts -->
       <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/update_post.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="loader">
    <img src="/image/loading01.gif" alt="Loading..." />
</div>
    @include('layouts.header')
        <main class="py-4">
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>
    <script>
    window.addEventListener("load", function () {
    const loader = document.querySelector(".loader");
    loader.className += " hidden"; // class "loader hidden"
});
    </script>
</body>
</html>
