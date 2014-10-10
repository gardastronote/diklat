@extends('layout.main-layout')
@section('content')
<div class="row">
	<div class="col-md-12 text-center">
		{{Form::open(['url'=>'/data-memo/search','method'=>'GET','class'=>'form-inline'])}}
		<div class="form-group">
			{{Form::select('type',[
			'nama_memo'=>'Nama Memo',
			'nomor_memo'=>'Nomor Memo',
			'rbb'=>'RBB',
			'karakter'=>'Karakter',
			'username'=>'Username'
			],Input::get('type'),['class'=>'input-lg form-control'])}}
		</div>
		<div class="form-group">
			{{Form::text('query',Input::get('query'),['class'=>'input-lg form-control'])}}
		</div>
		<div class="form-group">
			<button class="btn btn-info btn-lg" type="submit"><span class="glyphicon glyphicon-search"></span></button>
		</div>
	</div>
</div>
@include('memo.list-memo')
@stop