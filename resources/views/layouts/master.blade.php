<html>
    <head>
        <title>
            @yield('title')
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <link rel='stylesheet' type="text/css" href="{{ asset('css/app.css') }}">
        <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"> </script>
    </head>
    <body>
        <!-- this will be the nav used throughout site-->
        @include('site.navigation_view')
        <div class='col-lg-12'>
            @section('content')
        </div>
        
        <!--@include('site.footer')-->
    </body>
</html>
