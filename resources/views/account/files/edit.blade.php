@extends('account.layouts.default')

@section('account.content')
    <h1 class="title">
        Редактирование: {{ $file->title }}
    </h1>

    <form action="{{ route('account.files.store', compact('file')) }}" method="post" class="form">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="field">
            <p class="control">
                <label for="live" class="checkbox">
                    <input type="checkbox" name="live" id="live" {{ $file->live ? 'checked' : '' }}>
                    Опубликовано
                </label>
            </p>
        </div>

        <div class="field">
            <label for="title" class="label">Название</label>
            <p class="control">
                <input type="text" name="title" id="title" class="input{{ $errors->has('title') ? ' is-danger' : '' }}"
                       value="{{ old('title') ? old('title') : $file->title }}">
            </p>
            @if($errors->has('title'))
                <p class="help is-danger">{{ $errors->first('title') }}</p>
            @endif
        </div>

        <div class="field">
            <label for="overview_short" class="label">Краткое описание</label>
            <p class="control">
                <input type="text" name="overview_short" id="overview_short"
                       class="input{{ $errors->has('overview_short') ? ' is-danger' : '' }}"
                       value="{{ old('overview_short') ? old('overview_short') : $file->overview_short }}">
            </p>
            @if($errors->has('overview_short'))
                <p class="help is-danger">{{ $errors->first('overview_short') }}</p>
            @endif
        </div>

        <div class="field">
            <label for="overview" class="label">Описание</label>
            <p class="control">
                <textarea name="overview" id="overview"
                          class="textarea{{ $errors->has('overview') ? ' is-danger' : '' }}">{{ old('overview') ? old('overview') : $file->overview }}</textarea>
            </p>
            @if($errors->has('overview'))
                <p class="help is-danger">{{ $errors->first('overview') }}</p>
            @endif
        </div>

        <div class="field">
            <label for="price" class="label">Цена (в рублях)</label>
            <p class="control">
                <input type="number" name="price" id="price"
                       class="input{{ $errors->has('price') ? ' is-danger' : '' }}"
                       value="{{ old('price') ? old('price') : $file->price }}">
            </p>
            @if($errors->has('price'))
                <p class="help is-danger">{{ $errors->first('price') }}</p>
            @endif
        </div>

        <div class="field is-grouped">
            <p class="control">
                <button class="button is-primary" type="submit">Обновить</button>
            </p>

            <p>Прежде чем ваш курс будет обновлен, все изменения будут рассмотрены нашими администраторами.</p>
        </div>
    </form>
@endsection