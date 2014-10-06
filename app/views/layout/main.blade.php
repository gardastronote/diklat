<!DOCTYPE html>
<html>
<head>
	<title>Diklat BJB</title>
	<link rel="icon" type="image/icon" href="{{asset('images/favicon.ico')}}">
	{{ HTML::style('bootstrap/css/bootstrap.min.css') }}
	{{ HTML::style('css/layout.css') }}
	@yield('style')
	
	{{ HTML::script('js/jquery-2.1.1.min.js') }}
	{{ HTML::script('bootstrap/js/bootstrap.min.js') }}
	{{ HTML::script('js/layout.js') }}
	@yield('script')



</head>
<body>
<nav class="navbar navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">

			<a href="{{route('root')}}" class="bjb-brand navbar-brand"><img src="{{asset('images/logo.png')}}"></a>
		    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		      <span class="glyphicon glyphicon-align-justify"></span>
		    </button>
		</div>
		@if(Auth::check())
		<div class="collapse navbar-collapse">
			<ul class="main-nav nav navbar-nav navbar-left">
				<li><a href="{{route('root')}}">Home</a></li>
				<li><a href="{{route('task')}}">Tugas</a></li>
				@if(Auth::user()->access == ADMIN)
				<li><a href="{{route('admin_user')}}">User</a></li>
				@endif
				<li><a href="{{route('task_memo')}}">Memo</a></li>
				<li><a href="{{route('task_comment')}}">Komentar</a>
			</ul>
			<ul class="nav navbar-nav navbar-right avatar">
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<span><strong class="caret"></strong> {{Auth::user()->full_name}}</span>
						<img src="{{asset('avatar/'.Auth::user()->avatar)}}">
					</a>
					<ul class="dropdown-menu">
						<li><a href="{{action('UserController@profile',Auth::user()->id)}}"><span class="glyphicon glyphicon-user"></span>{{Auth::user()->username}}</a></li>
						<li><a href="{{route('setting')}}"><span class="glyphicon glyphicon-cog"></span>Setting</a></li>
						<li class="divider"></li>
						<li><a href="{{route('logout')}}"><span class="glyphicon glyphicon-off"></span>Log Out</a></li>
					</ul>
				</li>
			</ul>
		</div>
		@endif
	</div>
	<span class="bjb">
		<span id="one"></span>
		<span id="two"></span>
		<span id="three"></span>
	</span>
</nav>
<div class="container">
@if(Session::has('alert-success'))
<div class="row">
		<div class="alert data-center alert-success"><span class="glyphicon glyphicon-bullhorn"></span>  {{Session::pull('alert-success')}}</div>
</div>
@endif

@if(Session::has('alert-error'))
<div class="row">
		<div class="alert data-center alert-danger"><span class="glyphicon glyphicon-bullhorn"></span> {{Session::pull('alert-error')}}</div>
</div>
</div>
@endif
@yield('content')
</body>
</html>