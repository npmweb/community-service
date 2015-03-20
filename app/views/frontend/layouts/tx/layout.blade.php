<!DOCTYPE html>
<html>
    <head>
        @include('layouts._headtag')
    </head>
    <body id='{{{ $route_controller }}}' class='{{{ $route_method }}}'>
        @include('layouts._header')
        <div class="row">
            <div class="columns">
                @yield('content')
            </div>
        </div>
        @include('layouts._footer')
    </body>
</html>
