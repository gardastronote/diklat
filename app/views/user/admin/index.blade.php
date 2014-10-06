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
				<div class="slideUp">
					<p>Tugas</p>
				</div>
			</div>
		</section>
		</a>
		<a href="{{route('admin_user')}}">
		<section class="col-md-4">
			<div class="slideMenu user">
				<div id="user" class="menu-index">
					<img src="{{asset('images/user.png')}}">
				</div>
				<div class="slideUp">
					<p>User</p>
					<p><strong>Jumlah User:</strong> {{$users}}</p>
				</div>
			</div>
		</section>
		</a>
		<a href="{{route('task_memo')}}">
		<section class="col-md-4">
			<div class="slideMenu memo">
				<div id="memo" class="menu-index">
					<img src="{{asset('images/memo.png')}}">
				</div>
				<div class="slideUp">
					<p>Memo</p>
					<p><strong>Jumlah Memo:</strong> {{$memos}}</p>
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
				<div class="slideUp">
					<p>Komentar</p>
					<p><strong>Jumlah Komentar:</strong> {{$comments}}</p>
				</div>
			</div>
		</section>
		</a>
	</div>
	</section>
</div>
@stop