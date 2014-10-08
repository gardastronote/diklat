@extends('layout.main-layout')
@section('content')
<div class="row row-white">
	<div class="col-md-12">
		<div class="text-center">
			<h1><img class="avatar" src="{{asset('avatar/'.$user->avatar)}}"> {{$user->full_name}}</h1>
			<h2><small>{{$user->username}}</small></h2>
		</div>
	</div>
</div>
@stop