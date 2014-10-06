@extends('layout.main')
@section('content')
<div class="container">
<section class="row">
	<section class="col-md-12">
		<div class="col-md-12 head-task">
			<button class="btn btn-lg btn-block btn-info disabled">User</button>
		</div>
		@include('user.user-result')
		@if(count($users)>0)
		<div class="col-md-12 head-task"><a class="btn btn-lg btn-block btn-info" href="{{action('UserController@admin_user')}}">Lihat Semua</a></div>
		@endif
	</section>
	<section class="col-md-12">
		<div class="col-md-12 head-task">
			<button class="btn btn-lg btn-block btn-danger disabled">Memo</button>
		</div>
		@include('diklat.task.memo.memo-result')
		@if(count($memos)>0)
		<div class="col-md-12 head-task"><a class="btn btn-lg btn-block btn-danger" href="{{action('MemoController@index')}}">Lihat Semua</a></div>
		@endif
	</section>
	<section class="col-md-12">
		<div class="col-md-12 head-task">
			<button class="btn btn-lg btn-block btn-success disabled">Komentar</button>
		</div>
		@include('diklat.task.memo.comment-result')
		@if(count($comments)>0)
		<div class="col-md-12 head-task"><a class="btn btn-block btn-lg btn-success" href="{{action('CommentController@index')}}">Lihat Semua</a></div>
		@endif
	</section>
</section>
</div>
@stop