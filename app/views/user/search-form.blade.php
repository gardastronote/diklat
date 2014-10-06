<div class="col-md-12">
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