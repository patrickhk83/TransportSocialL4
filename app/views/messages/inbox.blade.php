@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-3">
			<ul class="nav nav-pills nav-stacked">
				<li class="active">
					{{ link_to_route('messages.inbox', trans('messages.message_inbox')) }}
				</li>	
				<li>
					{{ link_to_route('messages.inbox', trans('messages.message_write_message')) }}
				</li>	
				<li>
					{{ link_to_route('messages.inbox', trans('messages.message_sending_lists')) }}
				</li>	
				<li>
					{{ link_to_route('messages.contacts', trans('messages.message_contacts')) }}
				</li>	

			</ul>	
		</div>
		<div class="col-md-9" role="main">
			{{ Form::open(array('route' => 'messages.inbox' , 'id' => 'inbox_form')); }}
				<fieldset  id="inbox_item_info">
					{{ form::hidden('box' , '0'); }}
					<div class="row">
						<table class="table tavle-striped">
							<thead>
								<tr>
									<th>{{ trans('messages.message_table_header_messages'); }}</th>
									<th>{{ trans('messages.message_table_header_sender'); }}</th>
									<th>{{ trans('messages.message_table_header_last_post'); }}</th>
									<th>
										<label style="display: inline; white-space: nowrap;">
											{{ trans('messages.message_table_header_select'); }}
											 <input type="checkbox" id="checkAllButon" value="1" onclick="checkAll('selected_messages[]','checkAllButon');" />
										</label>
									</th>
								</tr>
							</thead>
						</table>	
					</div>	
				</fieldset>	
			{{ Form::close(); }}
		</div>	
	</div>	
@stop