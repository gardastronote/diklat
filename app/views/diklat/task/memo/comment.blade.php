@extends('layout.main')
@section('content')
<div class="container">
	<section class="row">
		<div class="col-md-12">
		<div class="col-md-12 head-task">
			<button class="btn btn-lg btn-block btn-success disabled">Komentar</button>
		</div>
		@include('diklat.task.memo.comment-result')
		<div class="col-md-12">{{$comments->links()}}</div>
		</div>
	</section>
</div>
@stop