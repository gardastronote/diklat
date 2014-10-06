@if(count($comments)>0)
	@foreach($comments as $comment)
	<?php
	$date = date('l d F Y',strtotime($comment->created_at));
	?>
	<div class="data-result">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<span class="ava">
					{{HTML::image(asset('avatar/'.$comment->user->avatar))}}
					<h3>
						<a href="{{action('UserController@profile',$comment->id_user)}}">{{$comment->user->full_name}}</a>
						<small class="detal-data">{{$date}}</small>
					</h3>
				</span>
				<span class="merge-data hidden-xs">
					<a class="btn btn-danger circle {{empty($comment->memo->memo)?'disabled':''}}" target="_blank" href="{{asset('memo/'.$comment->id_memo)}}"><span class="glyphicon glyphicon-file"></span></a>
					<a class="btn btn-info glyphicon glyphicon-search circle" href="{{action('MemoController@view',$comment->id_memo)}}"></a>
					@if($user->id == $comment->id_user || $user->access == ADMIN)
					<a class="btn btn-primary glyphicon glyphicon-pencil circle" href="{{action('CommentController@edit',$comment->id)}}"></a>
					<a class="btn btn-danger glyphicon glyphicon-trash circle"  href="{{action('CommentController@delete',$comment->id)}}"></a>
					@endif
				</span>
				<span class="merge-data visible-xs">
					<a class="btn btn-danger circle-sm {{empty($comment->memo->memo)?'disabled':''}}" target="_blank" href="{{asset('memo/'.$comment->id_memo)}}"><span class="glyphicon glyphicon-file"></span></a>
					<a class="btn btn-info glyphicon glyphicon-search circle-sm" href="{{action('MemoController@view',$comment->id_memo)}}"></a>
					@if($user->id == $comment->id_user || $user->access == ADMIN)
					<a class="btn btn-primary glyphicon glyphicon-pencil circle-sm" href="{{action('CommentController@edit',$comment->id)}}"></a>
					<a class="btn btn-danger glyphicon glyphicon-trash circle-sm"  href="{{action('CommentController@delete',$comment->id)}}"></a>
					@endif
				</span>
			</div>
			<div class="panel-body">
				<ul>
					<li>
						<div class="ava comment">
							<img src="{{asset('avatar/'.$comment->memo->user->avatar)}}">
							<h3><a href="{{action('UserController@profile',$comment->id_user)}}">{{$comment->user->full_name}}</a></h3>
						</div>
					</li>
					<li><strong>Nomor Memo:</strong> {{$comment->memo->nomor_memo}}</li>
					<li><strong>Nama Memo:</strong> {{$comment->memo->nama_memo}}</li>
					<li><strong>RBB</strong> {{$comment->memo->rbb->rbb}}</li>
				</ul>
			</div>
			<div class="panel-body">
				<div class="well">
					<p class="lead">{{$comment->comment}}</p>
				</div>
			</div>
		</div>
	</div>
	</div>
	@endforeach
@else
<div class="col-md-12 data-center"><h1>Tidak ada komentar</h1></div>
@endif