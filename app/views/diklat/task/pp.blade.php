@extends('layout.main')
@section('content')
@include('layout.nav')
<div class="container">
<section class="row">
	<section class="col-md-12">
		<div class="col-md-12 head-task">
			<button class="btn btn-lg btn-block btn-primary disabled">Memo</button>
		</div>
		@include('diklat.task.memo.memo-result')
		<div class="col-md-12 head-task"><a class="btn btn-lg btn-block btn-primary" href="{{action('MemoController@index')}}">Lihat Semua</a></div>
	</section>
	<section class="col-md-12">
		<div class="col-md-12 head-task">
			<button class="btn btn-lg btn-block btn-success disabled">Komentar</button>
		</div>
		@include('diklat.task.memo.comment-result')
		<div class="col-md-12 head-task"><a class="btn btn-block btn-lg btn-primary" href="{{action('CommentController@index')}}">Lihat Semua</a></div>
	</section>
</section>
</div>
@stop