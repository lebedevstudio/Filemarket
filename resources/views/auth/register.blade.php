@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-fluid">
            <div class="columns">
                <div class="column is-half is-offset-one-quarter">
                    <h1 class="title">Регистрация</h1>

                    <form action="{{ route('register') }}" method="post" class="form" autocomplete="off">
                        {{ csrf_field() }}

                        <div class="field">
                            <label for="email" class="label">Эл. почта</label>
                            <p class="control">
                                <input type="email" name="email" id="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" value="{{ old('email') }}" required placeholder="ivan@ivan.ru">
                            </p>
                            @if ($errors->has('email'))
                                <p class="help is-danger">
                                    {{ $errors->first('email') }}
                                </p>
                            @endif
                        </div>

                        <div class="field">
                            <label for="name" class="label">Ваше имя</label>
                            <p class="control">
                                <input type="text" name="name" id="name" class="input{{ $errors->has('name') ? ' is-danger' : '' }}" value="{{ old('name') }}" required placeholder="Иван">
                            </p>
                            @if ($errors->has('name'))
                                <p class="help is-danger">
                                    {{ $errors->first('name') }}
                                </p>
                            @endif
                        </div>

                        <div class="field">
                            <label for="password" class="label">Пароль</label>
                            <p class="control">
                                <input type="password" name="password" id="password" class="input{{ $errors->has('password') ? ' is-danger' : '' }}" required>
                            </p>
                            @if ($errors->has('password'))
                                <p class="help is-danger">
                                    {{ $errors->first('password') }}
                                </p>
                            @endif
                        </div>

                        <div class="field">
                            <p class="control">
                                <button class="button is-primary" type="submit">Войти</button>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
