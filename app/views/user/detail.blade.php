@extends('layout.main')
@section('content')
<div class="container">
<section class="row">
	<div class="data-result">
	<div class="col-md-12">
		<div class="well">
		<span class="ava">
			{{HTML::image(asset('avatar/'.$profile->avatar))}}
			<h3>{{$profile->full_name}} <small>{{$profile->username}}</small></h3>
		</span>
		<span class="merge-data">
				{{$profile->email}}
				@if($profile->id == Auth::user()->id || Auth::user()->access == ADMIN)
				<a class="btn btn-primary glyphicon glyphicon-pencil circle" href="{{route('admin_user_edit',$profile->id)}}"></a>
				<a class="btn btn-danger glyphicon glyphicon-trash circle" href="{{route('admin_user_delete',$profile->id)}}"></a>
				@endif
		</span>
		</div>
	</div>
	</div>
</section>
	@if($profile->access == PP)
		<section class="row">
			<div class="col-md-12 head-task">
				<button class="btn btn-lg btn-primary btn-block disabled">Memo</button>
			</div>
			@include('diklat.task.memo.memo-result')
			@if(count($memos)>0)
			<div class="col-md-12 head-task"><a class="btn btn-lg btn-block btn-info" href="{{route('user_memo',$profile->id)}}">Lihat Semua</a></div>
			@endif
		</section>
		<section class="row">
			<div class="col-md-12 head-task">
				<button class="btn btn-lg btn-success btn-block disabled">Komentar</button>
			</div>
			@include('diklat.task.memo.comment-result')
			@if(count($comments)>0)
			<div class="col-md-12 head-task"><a class="btn btn-lg btn-block btn-success" href="{{route('user_comment',$profile->id)}}">Lihat Semua</a></div>
			@endif
		</section>
	@endif
</div>
</section>
</div>
@stop