@extends('layouts.default')

@section('content')
	<div class="row">
		@include('_partials.messages.sidebar')
		<div class="col-md-9" role="main">
			<ul class="list-group">
			@foreach($user->conversations as $conversation)
				<a class="list-group-item" href="{{ route('conversation.view', array($conversation->id))}}">
					<p>{{ $conversation->name }}</p>
					@foreach($conversation->users as $user)
						@if($user->profilePicture['path'] != '')
							<img src="{{ $user->profilePicture['path'] }}" width="20" height="20" />
						@else
							<img src="/images/default-profile-pic.png" width="20" height="20" />
						@endif
					@endforeach
				</a>
			@endforeach
			</ul>
		</div>
	</div>
@stop