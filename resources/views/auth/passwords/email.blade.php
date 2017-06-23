@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-fluid">
            <div class="columns">
                <div class="column is-half is-offset-one-quarter">
                    <h1 class="title">Восстановление пароля</h1>

                    @if(session('status'))
                        <div class="notification is-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('password.email') }}" method="post" class="form" autocomplete="off">
                        {{ csrf_field() }}

                        <div class="field">
                            <label for="email" class="label">Эл. почта</label>
                            <p class="control">
                                <input type="email" name="email" id="email"
                                       class="input{{ $errors->has('email') ? ' is-danger' : '' }}"
                                       value="{{ old('email') }}" required placeholder="ivan@ivan.ru">
                            </p>
                            @if ($errors->has('email'))
                                <p class="help is-danger">
                                    {{ $errors->first('email') }}
                                </p>
                            @endif
                        </div>

                        <div class="field">
                            <p class="control">
                                <button class="button is-primary" type="submit">Восстановить</button>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
