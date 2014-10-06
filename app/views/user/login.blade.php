@extends('layout.main')
@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}">
@stop
@section('content')
<div class="container">
<section class="row">
<div class="col-md-8 info">
		<h1>Diklat BJB</h1>
		<p>Service Excellent - Profesionalism - Integrity - Respect - Intelligence - Trust</p> 
</div>
<div class="col-md-4 login">
	@if(Session::has('alert'))
	<div class="has-error">
		<p class="help-block error-info">{{Session::pull('alert')}}</p>
	</div>
	@endif
	{{ Form::open(['url'=>'/login','class'=>'form-horizontal']) }}
	<div class="form-group @if($errors->has('username')) has-error @endif">
		<div class="col-md-12">
			{{ Form::text('username','',['class'=>'form-control','placeholder'=>'User Name']) }}
			@if($errors->has('username'))<p class="help-block">{{$errors->first('username')}}</p>@endif
		</div>
	</div>
	<div class="form-group @if($errors->has('password')) has-error @endif">
		<div class="col-md-8"> 
			{{ Form::password('password',['class'=>'form-control','placeholder'=>'Password']) }}
			@if($errors->has('password'))<p class="help-block">{{$errors->first('password')}}</p>@endif
		</div>
		<div class="col-md-4 ">
			{{ Form::submit('Login',['class'=>'btn btn-primary btn-block']) }}
		</div>
	</div>
	{{ Form::close() }}
</div>
</section>
</div>
@stop