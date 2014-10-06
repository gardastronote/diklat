@extends('layout.main')
@section('content')
<div class="container">
<section class="row">
	<section class="col-md-12">
		<div class="col-md-12"><h1>Cari user</h1></div>
		@include('user.user-result')
		<div class="col-md-12">{{$users->links()}}</div>
	</section>
</section>
</div>
@stop