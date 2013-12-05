@extends('layouts.default')

@section('scripts')
	<script>
		var url = "{{ URL::route('messages.suggest_user') }}";
		var selector = "#user_name";
	</script>
@stop

<?php
	Asset::container('assets')->add('modal','js/modal.js');
	Asset::container('assets')->add('autocomplete','js/autocomplete.js');
?>

@section('content')

	<div class="row">
		@include('_partials.messages.sidebar')
		<div class="col-md-9" role="main">
			@include('_partials.errors')
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('messages.message_add_contact'); }}</div>
				<div class="panel-body">
					{{ Form::open(array('route' => 'messages.add_contact' , 'id' => 'add_contact_form' , 'class' => 'form-inline' , 'role' => 'form')); }}
						<div class="form-group">
							{{ Form::label('username' , trans('messages.message_user_name') , array('class' => 'sr-only')); }}
		    	    {{ Form::text('user_name' , null , array('class' => 'form-control' , 'id' => 'user_name' , 'placeholder' => trans('messages.message_enter_user_name'))); }}
  	        </div>
  	        <div class="form-group">
            	{{ Form::label('contactname' , trans('messages.message_contact_name') , array('class' => 'sr-only')); }}
              {{ Form::text('contact_name' , null , array('class' => 'form-control' , 'id' => 'contact_name' , 'placeholder' => trans('messages.message_enter_contact_name')));}}
  	        </div>
  	        <div class="form-group">
              {{ Form::label('contact_status' , trans('messages.message_contact_status') , array('class' => 'sr-only'));}}
              {{ Form::select('contact_status', array('1' => 'allow' , '2' => 'pending' , '3' => 'decline') , '1' , array('class' => 'form-control' , 'id' => 'contact_status')); }}
		        </div>
  	        {{ Form::submit(trans('messages.message_add_contact') , array('class' => 'btn btn-primary')); }}
					{{ Form::close();}}
				</div>
				@if(count($contacts) > 0)
					<div class="panel-heading">{{ trans('messages.message_list_of_contact'); }}</div>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>{{ trans('messages.message_table_header_contact_name'); }}</th>
								<th>{{ trans('messages.message_table_header_quick_message'); }}</th>
								<th>{{ trans('messages.message_table_header_delete'); }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($contacts as $contact)
								<tr>
									<td>{{ $contact->contact_name; }}</td>
									<td>{{ link_to_route('conversation.create', 'Send Message', array($contact->id), array('class' => 'btn btn-primary')) }}</td>
									<td>{{ link_to_route('user.delete_contact', 'Remove Contact', array($contact->id), array('class' => 'btn btn-primary')) }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@endif
				@if(count($pendingContacts) > 0)
					<div class="panel-heading">{{ trans('messages.message_pending_contacts'); }}</div>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>{{ trans('messages.message_table_header_contact_name'); }}</th>
								<th>{{ trans('messages.message_approve_contact'); }}</th>
								<th>{{ trans('messages.message_decline_contact'); }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($pendingContacts as $contact)
								<tr>
									<td>{{ $contact->contact_name }}</td>
									<td>{{ link_to_route('user.approve_contact', 'Approve', array($contact->id), array('class' => 'btn btn-primary')) }}</td>
									<td>{{ link_to_route('user.delete_contact', 'Decline', array($contact->id), array('class' => 'btn btn-primary')) }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@endif
			</div>
		</div>
	</div>
@stop