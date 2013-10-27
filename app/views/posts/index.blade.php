@extends("layouts.default")
@section("content")
	@foreach ($posts as $post)
		<div>
			<span>{{ $post->title }}</span>
			<span>{{ $post->body }}</span>
		</div>
	@endforeach
@stop
