@extends("layouts.default")
@section("content")
	<h1>Create a New Post</h1>

	@include ('_partials.errors')

	{{ Form::open(array('route' => 'posts.store')) }}
		<p>{{ Form::text('title') }}</p>
		<p>{{ Form::textarea('body') }}</p>
		<p>{{ Form::submit() }}</p>
	{{ Form::close() }}
@stop
