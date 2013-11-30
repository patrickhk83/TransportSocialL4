@extends('layouts.default')
@section('content')
	@if(count($conversation->messages) > 0)
		@foreach($conversation->messages as $message)
			<li>
				<span>{{ $message->message.' - '.$message->user->first_name.' '.$message->user->last_name }}</span>
			</li>
		@endforeach
	@endif
	{{ Form::open(array('route' => array('message.send', $conversation->id))) }}
	<div class='form-group'>
		{{ Form::text('message' , null , array('class' => 'form-control')); }}
	</div>
	{{ Form::submit('Submit' , array('class' => 'btn btn-primary')); }}
	{{ Form::close() }}
@stop

