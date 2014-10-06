@extends('layout.main')
@section('content')
<div class="container">
<section class="row">
	<div class="col-md-12">
	<div class="col-md-6 col-md-offset-3">
		<h1>Ubah komentar</h1>
		{{Form::open(['url'=>'/task/memo/comment/edit','class'=>'form-horizontal'])}}
		<div class="form-group">
			{{Form::label('comment','Komentar',['class'=>'control-label'])}}
			{{Form::textarea('comment',$comment->comment,['rows'=>4,'class'=>'form-control'])}}
		</div>
		<div class="form-group">
			{{Form::hidden('id',$comment->id)}}
			{{Form::hidden('id_memo',$comment->id_memo)}}
			{{Form::submit('Ubah',['class'=>'btn btn-block btn-primary'])}}
		</div>
		{{Form::close()}}
	</div>
	</div>
</section>
</div>
@stop