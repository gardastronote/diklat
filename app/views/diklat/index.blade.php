@extends('layout.main')
@section('content')
@include('layout.nav')
<section>
	<h1>Home</h1>
	<section>
		<h1>New Memo</h1>
		@if(count($memos)>0)
			@foreach($memos as $memo)
			<div>
				<a href="{{action('UserController@profile',$memo->id_user)}}" class="ava">
					{{HTML::image(asset('img/'.$memo->user->avatar))}}
					{{$memo->user->username}}
				</a>
			</div>
			<div>
				<ul>
					<li>{{$memo->nomor_memo}}</li>
					<li>{{$memo->nama_memo}}</li>
					<li>{{$memo->rbb->rbb}}</li>
					<li>{{$memo->keterangan}}</li>
					<li>
						<ul>
							<li><a class="btn circle btn-info glyphicon glyphicon-search" href="{{action('MemoController@view',$memo->id)}}"></a></li>
							@if($memo->id_user == $user->id | $user->id == PINGROUP_PP)
							<li><a class="btn circle btn-primary glyphicon glyphicon-pencil" href="{{action('MemoController@edit',$memo->id)}}"></a></li>
							<li><a class="btn circle btn-danger glyphicon glyphicon-trash" href="{{action('MemoController@delete',$memo->id)}}"></a></li>
							@endif
						</ul>
					</li>
				</ul>
			</div>
			@endforeach
			<a class="btn btn-primary btn-lg btn-block" href="{{route('memo')}}">Lihat Semua</a>
		@else
		<h1>Tidak ada memo</h1>
		@endif
	</section>
	<section>
		<h1>New Comment</h1>
		@if(count($comments)>0)
			@foreach($comments as $comment)
			<div>
			<a href="#" class="ava">
				{{HTML::image(asset('img/'.$comment->user->avatar))}}
				{{$comment->user->username}}
			</a>
			</div>
			<div> 
				<ul>
					<li>{{$comment->memo->nomor_memo}}</li>
					<li>{{$comment->memo->nama_memo}}</li>
					<li>{{$comment->comment}}</li>
					<li>
						<ul>
							<li><a class="btn circle btn-info glyphicon glyphicon-search" href=""></a></li>
						@if($comment->id_user == $user->id | $user->id == PINGROUP_PP)
							<li><a class="btn circle btn-primary glyphicon glyphicon-pencil" href="{{action('CommentController@edit',$comment->id)}}"></a></li>
							<li><a class="btn circle glyphicon glyphicon-trash btn-danger" href=""></a></li>
						@endif
						</ul>
					</li>
				</ul>
			</div>
			@endforeach
			<a class="btn btn-primary btn-lg btn-block" href="{{action('CommentController@index')}}">Lihat Semua</a>
		@else
		<h1>Tidak ada comment</h1>
		@endif
	</section>
</section>
@stop