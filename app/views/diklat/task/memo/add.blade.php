@extends('layout.main')
@section('style')
{{HTML::style('bootstrap/datepicker/datepicker3.css')}}
@stop
@section('content')
<div class="container">
<section class="row">
	<div class="col-md-12">
		{{HTML::script('bootstrap/datepicker/bootstrap-datepicker.js')}}
		{{HTML::script('js/datepicker-script.js')}}
		<div class="col-md-6">
			{{ Form::open(['url'=>'/task/memo/add','class'=>'form-horizontal','files'=>true]) }}
			<div class="form-group @if($errors->has('nomor_memo')) has-error @endif">
				{{ Form::label('nomor_memo','Nomor Memo',['class'=>'col-md-4 control-label']) }}
				<div class="col-md-8"> 
					{{ Form::text('nomor_memo','',['class'=>'form-control','id'=>'nomor_memo']) }}
					@if($errors->has('nomor_memo'))<p class="help-block">{{$errors->first('nomor_memo')}}</p> @endif
				</div>
			</div>
			<div class="form-group @if($errors->has('nama_memo')) has-error @endif">
				{{ Form::label('nama_memo','Nama Memo',['class'=>'col-md-4 control-label']) }}
				<div class="col-md-8"> 
					{{ Form::text('nama_memo','',['class'=>'form-control','id'=>'nama_memo']) }}
					@if($errors->has('nama_memo'))<p class="help-block">{{$errors->first('nama_memo')}}</p> @endif
				</div>
			</div>
			<div class="form-group @if($errors->has('tanggal')) has-error @endif">
				{{ Form::label('tanggal','Tanggal',['class'=>'col-md-4 control-label']) }}
				<div class="col-md-8"> 
					{{ Form::text('tanggal','',['class'=>'form-control datepicker','id'=>'tanggal']) }}
					@if($errors->has('tanggal'))<p class="help-block">{{$errors->first('tanggal')}}</p> @endif
				</div>
			</div>
			<div class="form-group @if($errors->has('id_rbb')) has-error @endif">
				{{ Form::label('id_rbb','RBB',['class'=>'col-md-4 control-label']) }}
				<div class="col-md-8"> 
					{{ Form::select('id_rbb',Rbb::lists('rbb','id'),'',['class'=>'form-control','id'=>'rbb']) }}
					@if($errors->has('id_rbb'))<p class="help-block">{{$errors->first('id_rbb')}}</p> @endif
				</div>
			</div>
			<div class="form-group @if($errors->has('status')) has-error @endif">
				{{ Form::label('status','Status',['class'=>'col-md-4 control-label']) }}
				<div class="col-md-8"> 
					{{ Form::select('status',array('public'=>'Public','inhouse'=>'In House'),'',['class'=>'form-control','id'=>'status']) }}
					@if($errors->has('status'))<p class="help-block">{{$errors->first('status')}}</p> @endif
				</div>
			</div>
			<div class="form-group @if($errors->has('karakter')) has-error @endif">
				{{ Form::label('karakter','Karakter',['class'=>'col-md-4 control-label']) }}
				<div class="col-md-8"> 
					{{ Form::text('karakter','',['class'=>'form-control','id'=>'karakter']) }}
					@if($errors->has('karakter'))<p class="help-block">{{$errors->first('karakter')}}</p> @endif
				</div>
			</div>
			<div class="form-group @if($errors->has('lama')) has-error @endif">
				{{ Form::label('lama','Lama',['class'=>'col-md-4 control-label']) }}
				<div class="col-md-8"> 
					{{ Form::text('lama','',['class'=>'form-control','id'=>'lama']) }}
					@if($errors->has('lama'))<p class="help-block">{{$errors->first('lama')}}</p> @endif
				</div>
			</div>
			<div class="form-group @if($errors->has('jumlah')) has-error @endif">
				{{ Form::label('jumlah','Jumlah Peserta',['class'=>'col-md-4 control-label']) }}
				<div class="col-md-8"> 
					{{ Form::text('jumlah','',['class'=>'form-control','id'=>'jumlah']) }}
					@if($errors->has('jumlah'))<p class="help-block">{{$errors->first('jumlah')}}</p> @endif
				</div>
			</div>
			<div class="form-group @if($errors->has('anggaran')) has-error @endif">
				{{ Form::label('anggaran','Anggaran',['class'=>'col-md-4 control-label']) }}
				<div class="col-md-8"> 
					{{ Form::text('anggaran','',['class'=>'form-control','id'=>'anggaran']) }}
					@if($errors->has('anggaran'))<p class="help-block">{{$errors->first('anggaran')}}</p> @endif
				</div>
			</div>
			<div class="form-group @if($errors->has('file')) has-error @endif">
				{{ Form::label('memo','Memo',['class'=>'col-md-4 control-label']) }}
				<div class="col-md-8"> 
					{{ Form::file('memo',['class'=>'form-control','id'=>'memo']) }}
					@if($errors->has('memo'))<p class="help-block">{{$errors->first('memo')}}</p> @endif
				</div>
			</div>
			<div class="form-group @if($errors->has('keterangan')) has-error @endif">
				{{ Form::label('keterangan','Keterangan',['class'=>'col-md-4 control-label']) }}
				<div class="col-md-8"> 
					{{ Form::textarea('keterangan','',['class'=>'form-control','rows'=>'3','id'=>'keterangan']) }}
					@if($errors->has('keterangan'))<p class="help-block">{{$errors->first('keterangan')}}</p> @endif
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-offset-4 col-md-8">
					{{ Form::hidden('id_user',$user->id)}}
					{{ Form::submit('Tambah',['class'=>'btn btn-success']) }}
				</div>
			</div>
		</div>
	</div>
</section>
</div>
@stop