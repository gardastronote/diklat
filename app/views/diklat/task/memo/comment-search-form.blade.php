<div>
	<div>
		{{Form::open(['url'=>'/search/memo','class'=>'form-inline','method'=>'GET'])}}
		<div class="form-group">
			{{Form::select('type',[
			'nomor_memo'=>'Nomo Memo',
			'nama_memo'=>'Nama Memo',
			'pic'=>'PIC',
			'rbb'=>'RBB'
			],'',['class'=>'form-control'])}}
		</div>
		<div class="form-group">
			{{Form::text('query','',['class'=>'form-control'])}}
		<span class="glyphicon glyphicon-search"></span>
			
		</div>
	</div>
</div>