@extends('layouts.default')
@section('content')
	@include('_partials.errors')
	{{ Form::open(array('route' => 'users.auth', 'id' => 'login_form'))}}
	<div class="form-group">
		<label for="username">Username</label>
		{{ Form::text('username', null, array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		<label for="passwords">Password</label>
		{{ Form::text('passwords', null, array('class' => 'form-control')) }}
	</div>
	{{ Form::submit('Login', array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop