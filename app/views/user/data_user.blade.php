@extends('layout.main-layout')
@section('style')
	@parent
	<link rel="stylesheet" type="text/css" href="{{asset('css/data_user.css')}}">
@stop
@section('content')
<div class="row">
	<div class="col-md-12">
		<ul class="list-group">
			@foreach($users as $user)
			<li class="list-group-item">
				<img src="{{asset('avatar/'.$user->avatar)}}" class="avatar">
				<h3>{{$user->full_name}}</h3>
				<h3><small>{{$user->username}}</small></h3>
				<div class="dropdown top-right-btn pull-right">
					<a href="#" class=" dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span></a>
					<ul class="dropdown-menu">
						<li><a href="{{url('data-user/edit/'.$user->id)}}">Ubah</a></li>
						<li class="data-delete"><a href="{{url('data-user/delete/'.$user->id)}}">Hapus</a></li>
					</ul>
				</div>
			</li>
			@endforeach
		</ul>
	</div>
</div>
@stop