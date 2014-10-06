@extends('layout.main')
@section('content')
<div class="container">
<section class="row">
	<section class="col-md-12">
	<div class="col-md-12"><h1>Pencarian Memo</h1></div>
		@include('diklat.task.memo.memo-result')
		<div class="col-md-12"> {{$memos->links()}}</div>
	</sectio>
</section>
</div>
@stop