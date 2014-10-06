@extends('layout.main')
@section('content')
@include('layout.nav')
<section>
	<h1>Pinpinan Group PP</h1>
	<section>
		<h1>Memo</h1>
		@include('diklat.task.memo.memo-result')
		<a class="btn btn-primary" href="{{action('MemoController@index')}}">Lihat Semua</a>
	</section>
	<section>
		<h1>Komentar</h1>
		@include('diklat.task.memo.comment-result')
		<a class="btn btn-primary" href="{{action('CommentController@index')}}">Lihat Semua</a>
	</section>
</section>
@stop