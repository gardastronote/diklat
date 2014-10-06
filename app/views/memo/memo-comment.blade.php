@extends('layout.main-layout')
@section('content')
<div class="row row-white">
	<div class="col-md-8 col-md-offset-2 form-comment">
		{{Form::open(['url'=>'/data-memo/data/comment','method'=>'POST'])}}
		<div class="form-group">
			{{Form::textarea('comment',$comment->comment,['class'=>'form-control','rows'=>3])}}
		</div>
		<div class="form-group">
			{{Form::hidden('id',$comment->id)}}
			<button class="btn btn-primary btn-flat" type="submit">Komentar</button>
		</div>
		{{Form::close()}}
	</div>
</div>
@stop