@extends('layout.main-layout')
@section('style')
	@parent
	<link rel="stylesheet" type="text/css" href="{{asset('css/notif.css')}}">
@stop
@section('content')
<div class="row">
	<div class="col-md-12">
		@if(!count($notifs)>0)
		<h1 class="text-center">Tidak ada pemberitahuan</h1>
		@else
		<div class="list-group notif">
			{{-- Keterangan notifikasi --}}
			@foreach($notifs as $notif)
			@if($notif->obj == COMMENT)
			<?php
			$obj = 'Mengomentari Memo';
			$glyph = 'glyphicon glyphicon-comment';
			$color = 'comment-color';
			?>
			@elseif($notif->obj == ACCEPTED)
			<?php
			$obj = 'Menyetujui Memo';
			$glyph = 'glyphicon glyphicon-ok';
			$color = 'accepted-color';
			?>
			@elseif($notif->obj == EDIT)
			<?php
			$obj = 'Meminta utuk mengubah Memo';
			$glyph = 'glyphicon glyphicon-pencil';
			$color = 'edit-color';
			?>
			@else
			<?php
			$obj = 'Menolak Memo';
			$glyph = 'glyphicon glyphicon-remove';
			$color = 'rejected-color';
			?>
			@endif

			{{-- Cek notifikasi udah di cek atau belum --}}
			@if($notif->status == 0)
			<?php $status = 'active' ?>
			@else
			<?php $status = '' ?>
			@endif
			<a href="{{url('/data-memo/data/'.$notif->id_memo)}}" class="list-group-item {{$status}}">{{date('d M g:i A',strtotime($notif->created_at)).' <span class="'.$glyph.' '.$color.'"></span> <strong>'.$notif->from->username.'</strong> '.$obj.' '.$notif->memo->nama_memo}}</a>
			@endforeach
		</div>
		@endif
	</div>
</div>
@stop