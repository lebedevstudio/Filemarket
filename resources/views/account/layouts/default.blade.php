@extends('layouts.app')

@section('content')
    @include('account.layouts.partials.stats')

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-one-quarter">
                    @include('account.layouts.partials.navigation')
                </div>

                <div class="column">
                    @include('layouts.partials.flash')

                    @yield('account.content')
                </div>
            </div>
        </div>
    </section>
@endsection