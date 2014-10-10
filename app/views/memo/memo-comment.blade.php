@extends('layout.main-layout')
@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2 form-comment">
		{{Form::open(['url'=>'/data-memo/data/comment/edit','method'=>'POST'])}}
		<div class="form-group @if($errors->has('comment')) has-error @endif">
			{{Form::textarea('comment',$comment->comment,['class'=>'form-control','rows'=>3])}}
			@if($errors->has('comment'))<p class="help-block text-center" >{{$errors->first('comment')}}</p>@endif
		</div>
		<div class="form-group">
			{{Form::hidden('id_memo',$comment->id_memo)}}
			{{Form::hidden('id',$comment->id)}}
			<button class="btn btn-primary btn-flat" type="submit">Ubah</button>
		</div>
		{{Form::close()}}
	</div>
</div>
@stop