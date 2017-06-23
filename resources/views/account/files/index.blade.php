@extends('account.layouts.default')

@section('account.content')
	<h1 class="title">Мои файлы</h1>

	@if($files->count())
		@each('account.partials.file', $files, 'file')
	@else
		<p>Не найдено файлов.</p>
	@endif
@endsection