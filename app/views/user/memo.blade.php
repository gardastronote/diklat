@extends('layout.main')
@section('content')
<div class="container">
<section class="row">
	<section class="col-md-12">
		<div class="col-md-12 head-task">
			<button class="btn btn-lg btn-block btn-danger disabled">Memo</button>
		</div>
		@include('diklat.task.memo.memo-result')
		<div class="col-md-12">{{$memos->links()}}</div>
	</section>
</section>
</div>
@stop