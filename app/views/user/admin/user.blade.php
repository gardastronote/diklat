@extends('layout.main')
@section('content')
<div class="container">
	<section class="row">
		<div class="col-md-12">
		<div class="col-md-12 head-task">
			<button class="btn btn-lg btn-block btn-danger disabled">User</button>
		</div>
			@include('user.user-result')
			<div class="col-md-12">{{$users->links()}}</div>
		</div>
	</section>
</div>
@stop