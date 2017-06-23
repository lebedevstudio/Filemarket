<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layouts.partials.head')
    </head>
    <body>
        <div id="root">
            <section class="hero is-info is-large">
                <div class="hero-head">
                    @include('layouts.partials.navigation')
                </div>

                @yield('content')
            </section>
        </div>

        @include('layouts.partials.scripts')
    </body>
</html>
