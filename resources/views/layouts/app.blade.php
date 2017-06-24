<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layouts.partials.head')
    </head>
    <body>
        <div id="root">
            @include('layouts.partials.navigation')

            @yield('content')
        </div>

        @include('layouts.partials.scripts')
        @yield('scripts')
    </body>
</html>
