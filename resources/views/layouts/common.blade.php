<!DOCTYPE html>
<head>
    <title>@yield('title')</title>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta charset="utf-8"/>
</head>
<body>
    <div class="header">
        @yield('header')
    </div>

    @yield('h1_title')

    <div class="container">
        <div class="content">
            @yield('content')
        </div>
        
        <div class="footer">
            <p>Atsushi Tohyama / atsushi.tohyama.160.333 at gmail.com</p>
        </div>
    </div>
</body>
