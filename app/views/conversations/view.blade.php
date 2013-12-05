@extends('layouts.default')
@section('content')
	<div class="row">
		@include('_partials.messages.sidebar')
		<div class="col-md-9" role="main">
			@if(count($conversation->messages) > 0)
				<ul class="list-group">
					@foreach($conversation->messages as $message)
						<li class="list-group-item">
							<span>{{ $message->message.' - '.$message->user->name }}</span>
						</li>
					@endforeach
				</ul>
			@endif
			{{ Form::open(array('route' => array('message.send', $conversation->id))) }}
			<div class='form-group'>
				{{ Form::text('message' , null , array('class' => 'form-control')); }}
			</div>
			{{ Form::submit('Submit' , array('class' => 'btn btn-primary')); }}
			{{ Form::close() }}
		</div>
	</div>
@stop

