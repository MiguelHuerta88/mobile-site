<html>
    <head>
        <title>
            @yield('title')
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <link rel='stylesheet' type="text/css" href="{{ asset('css/app.css') }}">
        {{--<link rel='stylesheet' type='text/css' href='{{ asset('css/lightbox.min.css') }}'--}}
        <script src="//code.jquery.com/jquery-latest.js"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
        {{--<script type="text/javascript" src="{{ asset('js/lightbox.js') }}"></script>--}}
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

