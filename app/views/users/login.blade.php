@extends('layouts.default')
@section('content')
	{{ Form::open(array('action', 'UsersController@login'))}}
	<div class="form-group">
		<label for="username">Username</label>
		{{ Form::text('username', null, array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		{{ Form::text('password', null, array('class' => 'form-control')) }}
	</div>
	{{ Form::submit('Login', array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop