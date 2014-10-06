@extends('layout.main')
@include('layout.nav')
@section('content')
<section>
	<h1>User Profile</h1>
	@foreach($users as $user)
		@if($user->access == PP)
			<secton>
				<h1>{{$user->full_name}}</h1>
				<ul>
					<li>PP</li>
					<li class="ava">{{HTML::image('img/'.$user->avatar)}}</li>
					<li>{{$user->username}}</li>
					<li>{{$user->email}}</li>
					<li>{{Memo::where('id_user','=',$user->id)->count()}}</li>
				</ul>
			</secton>
		@elseif($user->access == PINGROUP_PP)
			<secton>
				<h1>{{$user->full_name}}</h1>
				<ul>
					<li>Pingrup PP</li>
					<li class="ava">{{HTML::image('img/'.$user->avatar)}}</li>
					<li>{{$user->username}}</li>
					<li>{{$user->email}}</li>
				</ul>
			</secton>
		@endif
	@endforeach
</section>
@stop