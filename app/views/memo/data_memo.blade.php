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
			'karakter'=>'Karakter'
			],'',['class'=>'input-lg form-control'])}}
		</div>
		<div class="form-group">
			{{Form::text('query','',['class'=>'input-lg form-control'])}}
		</div>
		<div class="form-group">
			<button class="btn btn-info btn-lg" type="submit"><span class="glyphicon glyphicon-search"></span></button>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-8 paginate text-left">
		{{$memos->links()}}
	</div>
	<div class="col-md-4 text-right">
		<a class="btn btn-success btn-flat" href="{{url('/data-memo/add')}}">Masukan Memo</a>
	</div>
</div>
@if(!count($memos)>0)
<div class="row">
	<div class="col-md-12 text-center">
		<h1>Tidak ada Memo</h1>
	</div>
</div>
@else
<div class="row memo-data">
	<div class="col-md-12">
		<div class="list-group">
			@foreach($memos as $memo)
			@if($memo->status_memo == 1)
			<?php
			$status = 'accepted-color';
			$glyph = 'glyphicon glyphicon-ok';
			?>
			@elseif($memo->status_memo == 2)
			<?php
			$status = 'edit-color';
			$glyph = 'glyphicon glyphicon-pencil';
			?>
			@elseif($memo->status_memo == 3)
			<?php
			$status = 'rejected-color';
			$glyph = 'glyphicon glyphicon-remove';
			?>
			@else
			<?php
			$status = 'unchecked';
			$glyph = 'glyphicon glyphicon-question-sign';
			?>
			@endif
			<a href="{{url('data-memo/data/'.$memo->id)}}" class="list-group-item">
				<h4 class="list-group-heading"><img class="avatar" src="{{asset('avatar/'.$memo->user->avatar)}}"> {{$memo->user->full_name}} <small>{{date('d M g:i A',strtotime($memo->created_at))}}</small></h4>
				<p class="list-group-item-text">
					<span>{{$memo->nama_memo}} <small>{{$memo->nomor_memo}}</small></span>
					<span class="badge">{{$memo->rbb->rbb}}</span>
					<span class="badge">{{$memo->karakter}}</span>
					<span class="badge">{{$memo->status}}</span>
				</p>
				<div class="list-status {{$status}}"><span class="{{$glyph}}"></span></div>
			</a>
			@endforeach
		</div>
	</div>	
</div>
@endif
@stop