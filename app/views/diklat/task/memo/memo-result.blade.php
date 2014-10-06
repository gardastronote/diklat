<div class="container search-add">
	<div class="row">
<div class="col-md-2">
	<a class="btn btn-lg btn-success" href="{{action('MemoController@add')}}">Tambah</a>
</div>
<div class="col-md-10">
	<div class="form-search"> 
		{{Form::open(['url'=>'search/memo','class'=>'form-inline','method'=>'GET'])}}
		<div class="form-group">
			{{Form::select('type',[
			'nomor_memo'=>'Nomor Memo',
			'nama_memo'=>'Nama memo',
			'karakter'=>'Karakteristik',
			'rbb'=>'RBB'
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
@if(count($memos)>0)
	@foreach($memos as $memo)
	<?php
	$date = date('l d F Y',strtotime($memo->created_at));
	?>
	<div class="data-result">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="ava">
						{{HTML::image(asset('avatar/'.$memo->user->avatar))}}
						<h3>
							<a href="{{action('UserController@profile',$memo->id_user)}}">{{$memo->user->full_name}}</a>
							<small class="detail-data">{{$date}}</small>
						</h3>
					<span class="merge-data hidden-xs">
						<a class="btn btn-danger circle {{empty($memo->memo)?'disabled':''}}" target="_blank" href="{{asset('memo/'.$memo->memo)}}"><span class="glyphicon glyphicon-file"></span></a>
						<a class="btn btn-info glyphicon glyphicon-search circle" href="{{action('MemoController@view',$memo->id)}}"></a>
						@if($user->id == $memo->id_user || $user->access == ADMIN)
						<a class="btn btn-primary glyphicon glyphicon-pencil circle" href="{{action('MemoController@edit',$memo->id)}}"></a>
						<a class="btn btn-danger glyphicon glyphicon-trash circle" href="{{action('MemoController@delete',$memo->id)}}"></a>
						@endif
					</span>
					<span class="merge-data visible-xs">
						<a class="btn btn-danger circle-sm {{empty($memo->memo)?'disabled':''}}" target="_blank" href="{{asset('memo/'.$memo->memo)}}"><span class="glyphicon glyphicon-file"></span></a>
						<a class="btn btn-info glyphicon glyphicon-search circle-sm" href="{{action('MemoController@view',$memo->id)}}"></a>
						@if($user->id == $memo->id_user || $user->access == ADMIN)
						<a class="btn btn-primary glyphicon glyphicon-pencil circle-sm" href="{{action('MemoController@edit',$memo->id)}}"></a>
						<a class="btn btn-danger glyphicon glyphicon-trash circle-sm" href="{{action('MemoController@delete',$memo->id)}}"></a>
						@endif
					</span>
				</div>
				<div class="panel-body">
					<ul>
						<li><strong>Nomor Memo:</strong> {{$memo->nomor_memo}}</li>
						<li><strong>Nama Memo:</strong> {{$memo->nama_memo}}</li>
						<li><strong>Karakteristik:</strong> {{$memo->karakter}}</li>
						<li><strong>RBB:</strong> {{$memo->rbb->rbb}}</li>
						<li><strong>Status:</strong> {{$memo->status}}</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	@endforeach
@else
<div class="col-md-12 data-center"><h1>Tidak ada memo yang di buat</h1></div>
@endif