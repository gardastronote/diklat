@extends('layout.main')
@section('style')
{{HTML::style(asset('css/index-menu.css'))}}
@stop
@section('content')
<div class="container">
	<section class="row">
		<h1>Administrator</h1>
		<section class="col-md-4">
			<div id="home" class="panel panel-default menu-index">
				<div class="panel-body">
					<img class="img-panel" src="{{asset('images/home.png')}}">
					<a class="btn btn-primary btn-lg btn-block" class="btn btn-primary btn-lg btn-block" href="{{route('task')}}">Task</a>
				</div>
			</div>
		</section>
		<section class="col-md-4">
			<div id="memo" class="panel panel-default menu-index">
				<div class="panel-body">
					<img class="img-panel" src="{{asset('images/memo.png')}}">
					<a class="btn btn-primary btn-lg btn-block" href="{{route('task_memo')}}">Memo</a>
				</div>
			</div>
		</section>
		<section class="col-md-4">
			<div id="komentar" class="panel panel-default menu-index">
				<div class="panel-body">
					<img class="img-panel" src="{{asset('images/komentar.png')}}">
					<a class="btn btn-primary btn-lg btn-block" href="{{route('task_memo')}}">Memo</a>
				</div>
			</div>
		</section>
	</section>
</div>
@stop