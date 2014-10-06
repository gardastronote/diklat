@extends('layout.main')
@section('content')
<div class="container">
<section class="row">
	<div class="col-md-12">
	<h1>{{$header}}</h1>
	@if(isset($data))
	<p>Jika password tidak di ubah, password tidak perlu di isi</p>
	@endif
	<div class="col-md-6">
		{{Form::open(['url'=>$action,'class'=>'form-horizontal','files'=>true])}}
		<div class="form-group @if($errors->has('username')) has-error @endif">
			{{Form::label('username','User Name',['class'=>'col-md-4 control-label'])}}
			<div class="col-md-8">
				{{Form::text('username',isset($data->username)?$data->username:'',['class'=>'form-control'])}}
				@if($errors->has('username'))<p class="help-block">{{$errors->first('username')}}</p>@endif
			</div>
		</div>
		<div class="form-group @if($errors->has('full_name')) has-error @endif">
			{{Form::label('full_name','Full Name',['class'=>'col-md-4 control-label'])}}
			<div class="col-md-8">
				{{Form::text('full_name',isset($data->full_name)?$data->full_name:'',['class'=>'form-control'])}}
				@if($errors->has('full_name'))<p class="help-block">{{$errors->first('full_name')}}</p>@endif
			</div>
		</div>
		<div class="form-group @if($errors->has('email')) has-error @endif">
			{{Form::label('email','Email',['class'=>'col-md-4 control-label'])}}
			<div class="col-md-8">
				{{Form::email('email',isset($data->email)?$data->email:'',['class'=>'form-control'])}}
				@if($errors->has('email'))<p class="help-block">{{$errors->first('email')}}</p>@endif
			</div>
		</div>
		<div class="form-group @if($errors->has('password')) has-error @endif">
			{{Form::label('password','Password',['class'=>'col-md-4 control-label'])}}
			<div class="col-md-8">
				{{Form::password('password',['class'=>'form-control'])}}
				@if($errors->has('password'))<p class="help-block">{{$errors->first('password')}}</p>@endif
			</div>
		</div>
		<div class="form-group @if($errors->has('re_password')) has-error @endif">
			{{Form::label('re_password','Repeat Password',['class'=>'col-md-4 control-label'])}}
			<div class="col-md-8">
				{{Form::password('re_password',['class'=>'form-control'])}}
				@if($errors->has('re_password'))<p class="help-block">{{$errors->first('re_password')}}</p>@endif
			</div>
		</div>
		@if(Auth::user()->access == ADMIN)
		<div class="form-group @if($errors->has('re_password')) has-error @endif">
			{{Form::label('access','Akses',['class'=>'col-md-4 control-label'])}}
			<div class="col-md-8">
				{{Form::select('access',[
				1=>'PP',
				2=>'Pingrup PP',
				99=>'Administrator'
				],isset($data->access)?$data->access:'',['class'=>'form-control'])}}
				@if($errors->has('access'))<p class="help-block">{{$errors->first('re_password')}}</p>@endif
			</div>
		</div>
		@endif
		@if(isset($data))
			@if($data->avatar !== 'default.png')
			<div class="col-md-offset-4 ava">
				{{HTML::image(asset('avatar/'.$data->avatar))}}
				<a href="{{action('UserController@deleteAvatar',$data->id)}}">Hapus</a>
			</div>
			@endif
		@endif
		<div class="form-group @if($errors->has('avatar')) has-error @endif">
			{{Form::label('avatar','Photo',['class'=>'col-md-4 control-label'])}}
			<div class="col-md-8">
				{{Form::file('avatar',['class'=>'form-control'])}}
				@if($errors->has('avatar'))<p class="help-block">{{$errors->first('avatar')}}</p>@endif
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-8 col-md-offset-4">
				@if(isset($data->id))
				{{Form::hidden('id',$data->id)}}
				@endif
				{{Form::submit($submit,['class'=>'btn btn-primary'])}}
			</div>
		</div>
		{{Form::close()}}
	</div>
</div>
</section>
</div>
@stop