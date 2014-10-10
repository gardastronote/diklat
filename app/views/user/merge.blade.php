@extends('layout.main-layout')
@section('style')
	@parent
	<link rel="stylesheet" type="text/css" href="{{asset('css/merge-user.css')}}">
@stop
@section('content')
<section class="row">
	<div class="col-md-12">
	@if(isset($user))
	<div class="alert alert-default text-center">
		<p><span class="glyphicon glyphicon-exclamation-sign"></span> Jika password tidak di ubah, password tidak perlu di isi</p>
	</div>
	@endif
		{{Form::open(['url'=>$url,'class'=>'form-horizontal form-merge','files'=>true])}}
		<div class="form-group @if($errors->has('username')) has-error @endif">
			{{Form::label('username','User Name',['class'=>'col-md-4 control-label'])}}
			<div class="col-md-4">
				{{Form::text('username',isset($user->username)?$user->username:'',['class'=>'form-control'])}}
			</div>
			<div class="col-md-4">
				@if($errors->has('username'))<p class="help-block">{{$errors->first('username')}}</p>@endif
			</div>
		</div>
		<div class="form-group @if($errors->has('full_name')) has-error @endif">
			{{Form::label('full_name','Full Name',['class'=>'col-md-4 control-label'])}}
			<div class="col-md-4">
				{{Form::text('full_name',isset($user->full_name)?$user->full_name:'',['class'=>'form-control'])}}
			</div>
			<div class="col-md-4">
				@if($errors->has('full_name'))<p class="help-block">{{$errors->first('full_name')}}</p>@endif
			</div>
		</div>
		<div class="form-group @if($errors->has('email')) has-error @endif">
			{{Form::label('email','Email',['class'=>'col-md-4 control-label'])}}
			<div class="col-md-4">
				{{Form::email('email',isset($user->email)?$user->email:'',['class'=>'form-control'])}}
			</div>
			<div class="col-md-4">
				@if($errors->has('email'))<p class="help-block">{{$errors->first('email')}}</p>@endif
			</div>
		</div>
		<div class="form-group @if($errors->has('password')) has-error @endif">
			{{Form::label('password','Password',['class'=>'col-md-4 control-label'])}}
			<div class="col-md-4">
				{{Form::password('password',['class'=>'form-control'])}}
			</div>
			<div class="col-md-4">
				@if($errors->has('password'))<p class="help-block">{{$errors->first('password')}}</p>@endif
			</div>
		</div>
		<div class="form-group @if($errors->has('re_password')) has-error @endif">
			{{Form::label('re_password','Repeat Password',['class'=>'col-md-4 control-label'])}}
			<div class="col-md-4">
				{{Form::password('re_password',['class'=>'form-control'])}}
			</div>
			<div class="col-md-4">
				@if($errors->has('re_password'))<p class="help-block">{{$errors->first('re_password')}}</p>@endif
			</div>
		</div>
		@if(Auth::user()->access == ADMIN)
		<div class="form-group @if($errors->has('access')) has-error @endif">
			{{Form::label('access','Akses',['class'=>'col-md-4 control-label'])}}
			<div class="col-md-4">
				{{Form::select('access',[
				1=>'PP',
				2=>'Pingrup PP',
				99=>'Administrator'
				],isset($user->access)?$user->access:'',['class'=>'form-control'])}}
			</div>
			<div class="col-md-4">
				@if($errors->has('access'))<p class="help-block">{{$errors->first('re_password')}}</p>@endif
			</div>
		</div>
		@endif
		@if(isset($user))
			@if($user->avatar !== 'default.png')
			<div class="col-md-offset-4">
				{{HTML::image(asset('avatar/'.$user->avatar),'avatar',['class'=>'avatar'])}}
				<a href="{{action('UserController@deleteAvatar',$user->id)}}">Hapus</a>
			</div>
			@endif
		@endif
		<div class="form-group @if($errors->has('avatar')) has-error @endif">
			{{Form::label('avatar','Photo',['class'=>'col-md-4 control-label'])}}
			<div class="col-md-4">
				{{Form::file('avatar',['class'=>'form-control'])}}
			</div>
			<div class="col-md-4">
				@if($errors->has('avatar'))<p class="help-block">{{$errors->first('avatar')}}</p>@endif
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-4">
				@if(isset($user->id))
				{{Form::hidden('id',$user->id)}}
				@endif
				{{Form::submit($submit,['class'=>'btn btn-primary btn-flat'])}}
			</div>
		</div>
		{{Form::close()}}
</div>
</section>
@stop