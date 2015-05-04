<!DOCTYPE html>
<html>
    <head>
        @include('layouts._headtag')
    </head>
    <body id='{{{ $route_controller }}}' class='{{{ $route_method }}}'>
        @include('layouts.tx._header')
        <div class="row">
            <div class="columns content">
                @yield('content')
            </div>
        </div>
        @include('layouts._footer')
    </body>
</html>
