@extends('layouts.default')

@section('content')
	{{ HTML::script('js/modal.js'); }}
	{{ HTML::script('js/jquery-ui.js'); }}
	{{ HTML::style('css/jquery-ui.css'); }}

<style>
.pac-container {
    background-color: #FFF;
    z-index: 20;
    position: fixed;
    display: inline-block;
    float: left;
}
/*
.modal{
    z-index: 20;   
}
.modal-backdrop{
    z-index: 10;        
}​
*/
.ui-autocomplete {
    z-index: 1051 !important;
}
</style>
	<script>
		$("document").ready(function(){
			$('#user_name').click( function() {
				$(this).val('');
			});

			$('#user_name').autocomplete({ minLength: 1,
				source:function( request, response ) {
			  		$.ajax({
			  			type : "POST" ,
			  			url:  '{{ URL::route('messages.suggest_user'); }}',
			  			dataType: "json" ,
			  			data: {term:request.term} ,
			  			error : function(request, status, error) {
			  		         alert(error);
			  		        },
			  			success: function(data) {
			  				response(data);
			  			}
			  		});					
				}
			});
		});
	</script>
	<div class="row">
		<div class="col-md-3">
			<ul class="nav nav-pills nav-stacked">
				<li>
					{{ link_to_route('messages.inbox', trans('messages.message_inbox')) }}
				</li>	
				<li>
					{{ link_to_route('messages.inbox', trans('messages.message_write_message')) }}
				</li>	
				<li>
					{{ link_to_route('messages.inbox', trans('messages.message_sending_lists')) }}
				</li>	
				<li class="active">
					{{ link_to_route('messages.contacts', trans('messages.message_contacts')) }}
				</li>	

			</ul>	
		</div>
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
				<div class="panel-heading">{{ trans('messages.message_list_of_contact'); }}</div>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>
								{{ Form::checkbox('checkAllButon' , '1'); }}
							</th>
							<th>{{ trans('messages.message_table_header_contact_name'); }}</th>
							<th>{{ trans('messages.message_table_header_quick_message'); }}</th>

							<th>{{ trans('messages.message_table_header_delete'); }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach($contacts as $contact)
							<tr>
								<td>
									{{ Form::checkbox('check'.$contact->id , $contact->id); }}
								</td>
								<td>
									{{ $contact->contact_name; }}
								</td>	
								<td>11</td>
								<td>22</td>
							</tr>	
						@endforeach
					</tbody>	
				</table>	
			</div>		
		</div>	
	</div>	
@include('messages.add_contact')	
@stop