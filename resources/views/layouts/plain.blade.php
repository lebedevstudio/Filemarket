<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layouts.partials.head')
    </head>
    <body>
        <div id="root">
            @yield('content')
        </div>

        @include('layouts.partials.scripts')
    </body>
</html>
