@extends('layout.main')
@section('content')
<div class="container">
<section class="row">
	<?php
	$date = date('l d M Y',strtotime($memo->created_at))
	?>
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<span class="ava"> 
					{{HTML::image('avatar/'.$memo->user->avatar)}}
					<h3>
						<a href="{{action('UserController@profile',$memo->id_user)}}">{{$memo->user->full_name}}</a>
						<small>{{$date}}</small>
					</h3>
				</span>
				<span class="merge-data hidden-xs">
					<a class="btn btn-danger circle {{empty($memo->memo)?'disabled':''}}" target="_blank" href="{{ asset('/memo/'.$memo->memo) }}"><span class="glyphicon glyphicon-file"></span></a>
					<a class="btn btn-primary glyphicon glyphicon-pencil circle" href="{{action('MemoController@edit',$memo->id)}}"></a>
					<a class="btn btn-danger glyphicon glyphicon-trash circle" href="{{action('MemoController@delete',$memo->id)}}"></a>
				</span>
				<span class="merge-data visible-xs">
					<a class="btn btn-danger circle-sm {{empty($memo->memo)?'disabled':''}}" target="_blank" href="{{ asset('/memo/'.$memo->memo) }}"><span class="glyphicon glyphicon-file"></span></a>
					<a class="btn btn-primary glyphicon glyphicon-pencil circle-sm" href="{{action('MemoController@edit',$memo->id)}}"></a>
					<a class="btn btn-danger glyphicon glyphicon-trash circle-sm" href="{{action('MemoController@delete',$memo->id)}}"></a>
				</span>
					<h3>{{$memo->nama_memo}} <small>{{$memo->nomor_memo}}</small></h3>
				</div>
		<div class="panel-body data-result">
			<ul>
				<li><strong>RBB:</strong> {{$memo->rbb->rbb}}</li>
				<li><strong>Status:</strong> {{$memo->status}}</li>
				<li><strong>Karakter:</strong> {{$memo->karakter}}</li>
				<li><strong>Jumlah Peserta:</strong> {{$memo->jumlah}}</li>
				<li><strong>Lama:</strong> {{$memo->lama}}</li>
				<li><strong>Anggaran:</strong> Rp.{{$memo->anggaran}}</li>
			</ul>
		</div>
		</div>
	</div>
</section>
<section class="row">
	<div class="col-md-12 data-center @if($errors->has('comment')) has-error @endif">
			{{Form::open(['url'=>'/task/memo/comment','class'=>'form-inline'])}}
			<div class="form-group ">
				{{Form::textarea('comment','',['rows'=>3,'class'=>'form-control'])}}
				{{Form::hidden('id_user',$user->id)}}
				{{Form::hidden('id_memo',$memo->id)}}
				{{Form::submit('Komentar',['class'=>'btn btn-primary btn-block'])}}
			</div>
			@if($errors->has('comment'))<p class="help-block">{{$errors->first('comment')}}</p>@endif
			{{Form::close()}}
	</div>
</section>
<section class="row">
	<div class="data-result">
	<article class="col-md-12">
		@if(count($comments)>0)
			@foreach($comments as $comment)
			<?php
			$date = date('l d M Y',strtotime($comment->created_at))
			?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="ava">
						<img src="{{asset('avatar/'.$comment->user->avatar)}}">
						<h3>
							<a href="{{action('UserController@profile',$comment->id_user)}}">{{$comment->user->full_name}}</a>
							<small>{{$date}}</small>
						</h3>
					</span>
					<span class="merge-data hidden-xs">
						@if($comment->id_user == $user->id || $user->id == PINGROUP_PP || Auth::user()->access == ADMIN)
							<a class="btn circle btn-primary glyphicon glyphicon-pencil" href="{{action('CommentController@edit',$comment->id)}}"></a>
							<a class="btn circle glyphicon glyphicon-trash btn-danger" href="{{action('CommentController@delete',$comment->id)}}"></a>
						@endif
					</span>
					<span class="merge-data visible-xs">
						@if($comment->id_user == $user->id || $user->id == PINGROUP_PP || Auth::user()->access == ADMIN)
							<a class="btn circle-sm btn-primary glyphicon glyphicon-pencil" href="{{action('CommentController@edit',$comment->id)}}"></a>
							<a class="btn circle-sm glyphicon glyphicon-trash btn-danger" href="{{action('CommentController@delete',$comment->id)}}"></a>
						@endif
					</span>
				</div>
				<div class="panel-body">
					<div class="well">
							<p class="lead">{{$comment->comment}}</p>
					</div>
				</div>
			</div>
			@endforeach
		@else
		<h1 class="data-center">Tidak ada Komentar</h1>
		@endif
	</article>
	</div>
</section>
@stop