<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/main-layout.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}">
</head>
<body>
<div class="bg"></div>
<div class="container">
	<div class="row">
		<div class="col-md-12 text-center">
			<img class="logo-bjb" src="{{asset('images/logo.png')}}">
			<h2><small style="color:#FFF">Service Excellent - Profesionalism - Integrity - Respect - Intelligence - Trust</small></h2> 
		</div>
	</div>
	@if(Session::has('error.login') || $errors->has('password') || $errors->has('username'))
	<div class="row">
		<div class="col-md-8 col-md-offset-2 text-center">
			<div class="alert alert-danger">
				<p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span>
					@if(Session::has('error.login'))
						{{Session::pull('error.login')}}
					@else
						Username dan Password harus di isi
					@endif
				</p>
			</div>
		</div>
	</div>
	@endif
	<div class="row">
		<div class="col-md-8 col-md-offset-4">
			{{ Form::open(['url'=>'/login','class'=>'form-horizontal']) }}
			<div class="form-group">
				<div class="col-md-6">
				 <div class="input-group"> 
				  <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
					{{ Form::text('username','',['class'=>'form-control input-lg','placeholder'=>'User Name']) }}
				  </div>	
				 </div>
			</div>
			<div class="form-group">
				<div class="col-md-6"> 
				 <div class="input-group"> 
				  <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
					{{ Form::password('password',['class'=>'form-control input-lg','placeholder'=>'Password']) }}
				  </div>	
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
</div>
</body>
</html>