@extends('layout.main-layout')
@section('content')
<div class="row row-white">
	<div class="col-md-9 memo-data text-center">
		@if(Auth::user()->access == ADMIN || Auth::user()->id == $memo->id_user )
		<div class="dropdown memo-edit-menu">
			<a data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-cog cog-hover"></span></a>
			<ul class="dropdown-menu">
				<li><a href="{{url('/data-memo/edit/'.$memo->id)}}">Ubah</a></li>
				<li class="data-delete"><a href="{{url('/data-memo/delete/'.$memo->id)}}">Hapus</a></li>
			</ul>
		</div>
		@endif
		<h1>{{$memo->nama_memo}}</h1>
		<h2><small>{{$memo->nomor_memo}}</small></h2>
		<h3><small>{{$memo->status}}</small></h3>
	</div>
	<div class="col-md-3 memo-ava">
		<h1><img class="avatar" src="{{asset('avatar/'.$memo->user->avatar)}}"/> {{$memo->user->full_name}} <small class="memo-date">{{date('d M g:i A',strtotime($memo->created_at))}}</small></h1>
	</div>
	@if($memo->status_memo == ACCEPTED)
		<?php
		$status = 'accepted';
		$glyph = 'glyphicon glyphicon-ok';
		?>
		@elseif($memo->status_memo == REJECTED)
		<?php
		$status = 'rejected';
		$glyph = 'glyphicon glyphicon-remove';
		?>
		@elseif($memo->status_memo == EDIT)
		<?php
		$status = 'edit';
		$glyph = 'glyphicon glyphicon-pencil';
		?>
		@else
		<?php
		$status = 'unchecked';
		$glyph = 'glyphicon glyphicon-question-sign';
		?>
	@endif
	<div class="col-md-3 memo-status {{$status}}">
		@if(Auth::user()->access == ADMIN || Auth::user()->access == PINGROUP)
		<div class="dropdown top-right-btn">
			<a class="memo-status-edit" href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-chevron-down"></span> </a>
			<ul class="dropdown-menu pull-right">
				<li class="data-accept"><a href="{{url('data-memo/status/'.$memo->id.'/'.ACCEPTED)}}"><span class="glyphicon glyphicon-ok"></span> Accept</a></li>
				<li class="data-edit"><a href="{{url('data-memo/status/'.$memo->id.'/'.EDIT)}}"><span class="glyphicon glyphicon-pencil"></span> Edit</a></li>
				<li class="data-reject"><a href="{{url('data-memo/status/'.$memo->id.'/'.REJECTED)}}"><span class="glyphicon glyphicon-remove"></span> Reject</a></li>
			</ul>
		</div>
		@endif
		<h1><span class="{{$glyph}}"></span> {{strtoupper($status)}}</h1>
	</div>
</div>
<div class="row row-white">
	<div class="col-md-9">
		<ul class="list-group">
			<li class="list-group-item">
				<h4 class="list-group-item-heading">RBB:</h4>
				<p class="list-group-item-text"><span class="glyphicon glyphicon-list-alt"></span> {{$memo->rbb->rbb}}</p>
			</li>
			<li class="list-group-item">
				<h4 class="list-group-item-heading">Karakter:</h4>
				<p class="list-group-item-text"><span class="glyphicon glyphicon-tasks"></span> {{$memo->karakter}}</p>
			</li>
			<li class="list-group-item">
				<h4 class="list-group-item-heading">Jumlah Peserta:</h4>
				<p class="list-group-item-text"><span class="glyphicon glyphicon-user"></span> {{$memo->jumlah}} Orang</p>
			</li>
			<li class="list-group-item">
				<h4 class="list-group-item-heading">Lama:</h4>
				<p class="list-group-item-text"><span class="glyphicon glyphicon-time"></span> {{$memo->lama}} Hari</p>
			</li>
			<li class="list-group-item">
				<h4 class="list-group-item-heading">Anggaran:</h4>
				<p class="list-group-item-text"><span class="glyphicon glyphicon-inbox"></span> Rp.{{$memo->anggaran}}</p>
			</li>
		</ul>
	</div>
	<div class="col-md-3 memo-pdf">
		@if($memo->memo === NULL)
		<?php
		$btn = 'disabled';
		$link = '#';
		?>
		@else
		<?php
		$btn = '';
		$link = asset('/memo/'.$memo->memo);
		?>
		@endif
		<a target="__blank" href="{{$link}}" class="btn btn-danger btn-flat {{$btn}}" href="#">
			<img src="{{asset('images/memo.png')}}">
		</a>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="up">
		</div>
	</div>
</div>
<div class="row row-white">
	<div class="container">
		<div class="row">
			<div class="col-md-9 form-comment">
				{{Form::open(['url'=>'/data-memo/data/comment/add','method'=>'POST'])}}
				<div class="form-group @if($errors->has('comment')) has-error @endif">
					{{Form::textarea('comment','',['class'=>'form-control','rows'=>3])}}
					@if($errors->has('comment'))<p class="help-block text-center">{{$errors->first('comment')}}</p>@endif
				</div>
				<div class="form-group">
					{{Form::hidden('id_memo',$memo->id)}}
					{{Form::hidden('id_user',Auth::user()->id)}}
					<button class="btn btn-primary btn-flat" type="submit">Komentar</button>
				</div>
				{{Form::close()}}
			</div>
		</div> 
		@if(!count($comments)>0)
		<div class="row">
			<div class="col-md-12">
				<h1>Belum ada Komentar</h1>
			</div>
		</div>
		@else
			@foreach($comments as $comment)
			<div class="row">
				<div class="col-md-12">
					@if(Auth::user()->access == ADMIN || Auth::user()->id == $comment->id_user)
					<div class="dropdown top-right-btn">
						<a href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-chevron-down"></span> </a>
						<ul class="dropdown-menu pull-right">
							<li><a href="{{url('data-memo/data/comment/'.$comment->id)}}">Ubah</a></li>
							<li class="data-delete"><a href="{{url('/data-memo/data/comment/delete/'.$comment->id)}}">Hapus</a></li>
						</ul>
					</div>
					@endif
					<h3><img class="avatar" src="{{asset('avatar/'.$comment->user->avatar)}}"> {{$comment->user->full_name}} <small>{{date('d M g:i A',strtotime($memo->created_at))}}</small></h3>
					<p>{{$comment->comment}}</p>
				</div>
			</div>
			<hr/>
			@endforeach
		@endif
	</div>
</div>
@stop