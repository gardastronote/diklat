<div class="container">
<div class="row search-add">
	<div class="col-md-2">
		<a class="btn btn-lg btn-success" href="{{route('admin_user_add')}}">Tambah User</a>
	</div>
	<div class="col-md-10">
		<div class="form-search"> 
			{{Form::open(['url'=>'search/user','class'=>'form-inline','method'=>'GET'])}}
			<div class="form-group">
				{{Form::select('type',[
				'full_name'=>'Full Name',
				'username'=>'User Name',
				'email'=>'Email',
				'access'=>'Posisi'
				],'',['class'=>'form-control input-lg'])}}
			</div>
			<div class="form-group">
				{{Form::text('query','',['class'=>'form-control input-lg'])}}
			</div>
			<div class="form-group">
				<button class="btn btn-primary btn-lg" type="submit"><span class="glyphicon glyphicon-search"></span></button>
			</div>
			{{Form::close()}}
		</div>
	</div>
</div>
</div>
@if(count($users)>0)
	@foreach($users as $user)
	<div class="data-result">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="ava"> 
						{{HTML::image(asset('avatar/'.$user->avatar))}}
						<a href="{{action('UserController@profile',$user->id)}}">{{$user->full_name}}</a>
					</span>
					<span class="merge-data">
						<a class="btn btn-primary glyphicon glyphicon-pencil circle" href="{{action('UserController@admin_user_edit',$user->id)}}"></a>
						<a class="btn btn-danger glyphicon glyphicon-trash circle" href="{{action('UserController@admin_user_delete',$user->id)}}"></a>
					</span>
				</div>
				<div class="panel-body">
					<ul>
						<li><strong>User Name:</strong> {{$user->username}}</li>
						<li><strong>Email:</strong> {{$user->email}}</li>
						@if($user->access == 1)
						<li><strong>Posisi:</strong> PP</li>
						@elseif($user->access == 2)
						<li><strong>Posisi:</strong> Pingrup PP</li>
						@elseif($user->access == 99)
						<li><strong>Posisi:</strong> Administrator</li>
						@endif
					</ul>
				</div>
			</div>
		</div>
	</div>
	@endforeach
@else
<div class="col-md-12">
<h1>Tidak ada User</h1>
</div>
@endif