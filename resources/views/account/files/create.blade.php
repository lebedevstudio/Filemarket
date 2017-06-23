@extends('account.layouts.default')

@section('account.content')
	<h1 class="title">
		Продать файлы
	</h1>

	<form action="{{ route('account.files.store', compact('file')) }}" method="post" class="form">
		{{ csrf_field() }}

		<div class="field">
			<label for="title" class="label">Название</label>
			<p class="control">
				<input type="text" name="title" id="title" class="input{{ $errors->has('title') ? ' is-danger' : '' }}">
			</p>
			@if($errors->has('title'))
				<p class="help is-danger">{{ $errors->first('title') }}</p>
			@endif
		</div>

		<div class="field">
			<label for="overview_short" class="label">Краткое описание</label>
			<p class="control">
				<input type="text" name="overview_short" id="overview_short" class="input{{ $errors->has('overview_short') ? ' is-danger' : '' }}">
			</p>
			@if($errors->has('overview_short'))
				<p class="help is-danger">{{ $errors->first('overview_short') }}</p>
			@endif
		</div>

		<div class="field">
			<label for="overview" class="label">Описание</label>
			<p class="control">
				<textarea name="overview" id="overview" class="textarea{{ $errors->has('overview') ? ' is-danger' : '' }}"></textarea>
			</p>
			@if($errors->has('overview'))
				<p class="help is-danger">{{ $errors->first('overview') }}</p>
			@endif
		</div>

		<div class="field">
			<label for="price" class="label">Цена (в рублях)</label>
			<p class="control">
				<input type="number" name="price" id="price" class="input{{ $errors->has('price') ? ' is-danger' : '' }}">
			</p>
			@if($errors->has('price'))
				<p class="help is-danger">{{ $errors->first('price') }}</p>
			@endif
		</div>

		<div class="field is-grouped">
			<p class="control">
				<button class="button is-primary" type="submit">Отправить</button>
			</p>

			<p>Прежде чем ваш курс будет опубликован, он будет рассмотрен нашими администраторам.</p>
		</div>
	</form>
@endsection