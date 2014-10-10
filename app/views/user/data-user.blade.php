@extends('layout.main-layout')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="text-center">
			<h1><img class="avatar" src="{{asset('avatar/'.$user->avatar)}}"> {{$user->full_name}}</h1>
			<h2><small>{{$user->username}}</small></h2>
		</div>
		@include('memo.list-memo')
	</div>
</div>
@stop