<!DOCTYPE html>
<html>
<head>
	<title> </title>
	@section('style')
	<link rel="stylesheet" type="text/css" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/main-layout.css')}}">
	@show
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top navbar-menu">
	<div class="container">
		<ul class="nav navbar-nav">
			<li class="active"><a href="{{url('/data-memo')}}">Home</a></li>
		</ul>
	</div>
</nav>
<div class="container">
	@yield('content')
</div>
@section('script')
<script type="text/javascript" src="{{asset('js/jquery-2.1.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
@show
</body>
</html>