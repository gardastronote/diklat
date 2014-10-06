@extends('layout.main-layout')
@section('content')
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
	<div class="col-md-12">
		<h1>Tidak ada Memo</h1>
	</div>
</div>
	@else
	@foreach($memos as $memo)
		@if($memo->status_memo == 1)
		<?php $status = 'accept' ?>
		@elseif($memo->status_memo == 2)
		<?php $status = 'reject' ?>
		@else
		<?php $status = 'uncheck' ?>
		@endif
<div class="row">
	<div class="col-md-12">
		<div class="memo-wrapper {{$status}}">
			<div class="dropdown memo-alter">
				<a data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-chevron-down"></span></a>
				<ul class="dropdown-menu pull-right">
					<li><a href="{{url('/data-memo/edit/'.$memo->id)}}">Ubah</a></li>
					<li class="data-delete"><a href="{{url('/data-memo/delete/'.$memo->id)}}">Hapus</a></li>
				</ul>
			</div>
			<div class="avatar"><img src="{{asset('avatar/'.$memo->user->avatar)}}"></div>
			<div class="username"><a href="#">{{$memo->user->username}}</a></div>
			<div><small>{{$memo->created_at}}</small></div>
			<ul class="memo-list">
				<li><a class="memo-link" href="{{url('/data-memo/data/'.$memo->id)}}">{{strtoupper($memo->nama_memo)}}</a></li>
				<li>{{$memo->keterangan}}</li>
				<li>{{$memo->rbb->rbb}}</li>
				<li>{{$memo->status}}</li>
			</ul>
		</div>
	</div>
</div>
@endforeach
@endif
<input type="color">
@stop