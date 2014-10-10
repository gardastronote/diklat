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
		@if(Auth::check())
	
		<ul class="nav navbar-nav">
			@if(Auth::user()->access == PP || Auth::user()->access == ADMIN )
			<li class="add-memo add-memo-hover"><a href="{{url('data-memo/add')}}"><span class="glyphicon glyphicon-edit"></span> Buat Memo</a></li>
			@endif
			<?php
			$total = Notification::where('id_to','=',Auth::user()->id)->where('status','=',0)->count();
			if($total == 0)
				$total = '';
			?>
			<li><a href="{{url('/notif')}}"><span class="glyphicon glyphicon-globe"></span> <span style="background-color:rgb(255,0,0)" class="badge">{{$total}}</a></li>r
			<li class="dropdown add-memo-hover2">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Memo <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="{{url('/data-memo')}}">Daftar memo</a></li>
					<li><a href="{{url('/data-memo/unchecked')}}">Memo belum di cek</a></li>
					<li class="divider"></li>
					<li class="data-accept"><a href="{{url('/data-memo/accepted')}}">Memo di setujui</a></li>
					<li class="data-edit"><a href="{{url('/data-memo/edit')}}">Memo harus di ubah</a></li>
					<li class="data-reject"><a href="{{url('/data-memo/rejected')}}">Memo di tolak</a></li>
				</ul>
			</li>
		</ul>
			@if(Auth::user()->access == ADMIN)
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">User <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="{{url('data-user/add')}}">Tambah User</a></li>
					<li><a href="{{url('data-user/')}}">Data User</a></li>
				</ul>
			</li>
			@endif			
		</ul>
		@endif
		@if(Auth::check())
		<ul class="nav navbar-nav navbar-right">
		 <li class="lightred-hover"><a href="{{url('/notif')}}"><span class="glyphicon glyphicon-bell"></span> </span> Pemberitahuan <span style="background-color:rgb(255,0,0)" class="badge">{{$total}}</a></li>				
			<li class="dropdown add-memo-hover">
				<a class="dropdown-toggle ava-menu" data-toggle="dropdown" href="#">
					 <b class="caret"></b> {{Auth::user()->full_name}}
					 <img class="avatar" src="{{asset('avatar/'.Auth::user()->avatar)}}">
				</a>
				<ul class="dropdown-menu">
					<li><a href="{{url('data-user/data/'.Auth::user()->id)}}"><span class="glyphicon glyphicon-user"></span> {{Auth::user()->username}}</a></li>
					<li><a href="{{url('data-user/edit/'.Auth::user()->id)}}"><span class="glyphicon glyphicon-cog"></span> Pengaturan</a></li>
					<li><a href="{{url('/logout')}}"><span class="glyphicon glyphicon-log-out"></span> Keluar</a></li>
				</ul>
			</li>
		</ul>
		@endif
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