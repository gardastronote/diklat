@extends('layout.main-layout')
@section('content')
<div class="row">
	<div class="col-md-12 text-center">
		<h1>Diklat BJB</h1>
		<h2><small>Service Excellent - Profesionalism - Integrity - Respect - Intelligence - Trust</small></h2> 
	</div>
</div>
@if(Session::has('error.login'))
<div class="row">
	<div class="col-md-8 col-md-offset-2 text-center">
		<div class="alert alert-danger">
			<p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span>{{Session::pull('error.login')}}</p>
		</div>
	</div>
</div>
@endif
<div class="row">
	<div class="col-md-8 col-md-offset-4">
		{{ Form::open(['url'=>'/login','class'=>'form-horizontal']) }}
		<div class="form-group @if($errors->has('username')) has-error @endif">
			<div class="col-md-6"> 
				{{ Form::text('username','',['class'=>'form-control input-lg','placeholder'=>'User Name']) }}
			</div>
			<div class="col-md-6"> 
				@if($errors->has('username'))<p class="help-block">{{$errors->first('username')}}</p>@endif
			</div>
		</div>
		<div class="form-group @if($errors->has('password')) has-error @endif">
			<div class="col-md-6"> 
				{{ Form::password('password',['class'=>'form-control input-lg','placeholder'=>'Password']) }}
			</div>
			<div class="col-md-6">
				@if($errors->has('password'))<p class="help-block">{{$errors->first('password')}}</p>@endif
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-6">
				{{ Form::submit('Login',['class'=>'btn-flat btn btn-primary btn-block']) }}
			</div>
		</div>
		{{ Form::close() }}
	</div>
</div>
@stop