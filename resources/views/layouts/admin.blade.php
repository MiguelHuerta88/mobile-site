<html>
    <head>
        <title>
            @yield('title')
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <link href="//fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
        <link rel='stylesheet' type="text/css" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/site.css') }}">

        <link rel="icon" type="image/png" href="{{ asset('images/favicon-16x16.png') }}" sizes="16x16">
       
        <script src="//code.jquery.com/jquery-latest.js"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        @include('site.admin_navigation_view')
    </head>
    <body>
        <div class='row content'>
            <div class="text-center">{!! Notification::all() !!}</div>
            @yield('content')
        </div>
        
        @include('site.footer')
    </body>
</html>

