@extends('layout.main')
@section('content')
@include('layout.nav')
<section>
	<div>
		<a class="btn btn-primary" href="{{ action('MemoController@add') }}">Tambah</a>
	</div>
	<div class="col-md-8">
		@if(count($memos) > 0)
		<table class="table table-condensed">
			<tr>
				<th>Nomor Memo</th>
				<th>Nama Memo</th>
				<th>Keterangan</th>
				<th>Tanggal</th>
				<th>RBB</th>
				<th>Status</th>
				<th>Detail</th>
				<th colspan="2">Action</th>
			</tr>
			@foreach($memos as $memo)
			<tr>
				<td>{{$memo->nomor_memo}}</td>
				<td>{{$memo->nama_memo}}</td>
				<td>{{$memo->keterangan}}</td>
				<td>{{$memo->tanggal}}</td>
				<td>{{$memo->rbb->rbb}}</td>
				<td>{{$memo->status}}</td>
				<td><a href="{{action('MemoController@memo',$memo->id)}}">Detail</a></td>
				<td><a href="{{action('MemoController@edit',$memo->id)}}">Edit</a></td>
				<td><a href="{{action('MemoController@delete',$memo->id)}}">Delete</a></td>
			</tr>
			@endforeach
		</table>
		@else
		<h1>Tidak ada Memo yang di buat</h1>
		@endif
	</div>
</section>
@stop