@extends('layout.main')
@section('style')
{{HTML::style(asset('css/index-menu.css'))}}
@stop
@section('content')
<div class="container">
	<section class="row">
		<div class="col-md-12">
		<div class="col-md-12"><h1>Administrator</h1></div>
		<a href="{{route('task')}}">
		<section class="col-md-4">
			<div class="slideMenu home">
				<div id="home" class="menu-index">
						<img  src="{{asset('images/task.png')}}">
				</div>
				<div class="slideUp data-center">
					<p><span class="glyphicon glyphicon-pencil"></span> Tugas</p>
					<p>
						@if(Auth::user()->access == ADMIN)
						<span class="glyphicon glyphicon-user"></span>
						@endif
						<span class="glyphicon glyphicon-file"></span>
						<span class="glyphicon glyphicon-comment"></span>
					</p>
				</div>
			</div>
		</section>
		</a>
		@if(Auth::user()->access == ADMIN)
		<a href="{{route('admin_user')}}">
		<section class="col-md-4">
			<div class="slideMenu user">
				<div id="user" class="menu-index">
					<img src="{{asset('images/user.png')}}">
				</div>
				<div class="slideUp data-center">
					<p><span class="glyphicon glyphicon-user"></span> User</p>
					<p><span class="glyphicon glyphicon-list-alt"></span> {{$users}}</p>
				</div>
			</div>
		</section>
		</a>
		@endif
		<a href="{{route('task_memo')}}">
		<section class="col-md-4">
			<div class="slideMenu memo">
				<div id="memo" class="menu-index">
					<img src="{{asset('images/memo.png')}}">
				</div>
				<div class="slideUp data-center">
					<p><span class="glyphicon glyphicon-file"></span> Memo</p>
					<p><span class="glyphicon glyphicon-list-alt"></span> {{$memos}}</p>
				</div>
			</div>
		</section>
		</a>
		<a href="{{route('task_memo')}}">
		<section class="col-md-4">
			<div class="slideMenu commentSlide">
				<div id="komentar" class="menu-index">
					<img src="{{asset('images/comment.png')}}">
				</div>
				<div class="slideUp data-center">
					<p><span class="glyphicon glyphicon-comment"></span> Komentar</p>
					<p><span class="glyphicon glyphicon-list-alt"></span> {{$comments}}</p>
				</div>
			</div>
		</section>
		</a>
	</div>
	</section>
</div>
@stop