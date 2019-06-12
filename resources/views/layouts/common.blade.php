<!DOCTYPE html>
<head>
    <title>@yield('title')</title>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script type="text/javascript" src="/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector : 'textarea',
            plugins  : 'jbimages link autolink preview',
            toolbar  : 'bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link jbimages | preview',
            menubar  : false,
            relative_urls : false
        });
    </script>
    <meta charset="utf-8"/>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            @yield('header')
        </div>

        @yield('h1_title')

        <div class="container">
            <div class="content">
                @yield('content')
            </div>
        </div>

        <div class="footer">
            <p>Atsushi Tohyama / atsushi.tohyama.160.333 at gmail.com</p>
        </div>
    </div>
</body>
