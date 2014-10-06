@extends('layout.main')
@section('content')
@include('layout.nav')
<section>
	<h1>PP</h1>
	<section>
		<section>
		<a href="{{route('task')}}">Task</a>
		</section>
		<section>
			<a href="{{route('memo')}}">Memo</a>
		</section>
		<section>
			<a href="{{route('comment')}}">Komentar</a>
		</section>
	</section>
</section>
@stop