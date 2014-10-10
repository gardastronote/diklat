<div class="row">
	<div class="col-md-12 paginate text-center">
		{{$memos->links()}}
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
					<span class="memo-title"><strong>{{$memo->nama_memo}}</strong></span><span> <small>{{$memo->nomor_memo}}</small></span>
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