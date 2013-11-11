{{ Form::open(array('route' => 'user.edit_profile_pic' , 'files' => true , 'id' => 'edit_profile_pic_form')); }}
	<div id="profile_pic_form" class="modal fade"  role="dialog" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <a class="close" data-dismiss="modal">x</a>
	                <h4>Upload Your Picture</h4>
	            </div>
	            <div class="modal-body">
	            	<fieldset  id="user_photo_info">
	            		{{ Form::label('profile_pic' , trans('user_auth.create_user_my_profile_pic_info') , array('class' => 'form-control')); }}
	            		<div class="row">
	                        <div class="col-md-6 file-wrapper">
	                            <span class="btn btn-success fileinput-button"  >
	                                <span class="fileinput-button">
	                                    <i class="glyphicon glyphicon-plus"></i>
	                                    <span>Browse...</span>
	                                    <input type="file" class="profile-pic" name="profile_pic" id="profile_pic">
	                                </span>
	                            </span>
	                        </div>
	                        {{ HTML::image($profile_pic , null , array('class' => 'thumb')) }}
	                    </div>	
	            	</fieldset>
	            </div>
	            <div class="modal-footer">
	            	{{ Form::button('Close', array('class' => 'btn' , 'data-dismiss' => 'modal' , 'aria-hidden' => 'true')) }}
	            	{{ Form::submit('Submit' , array('class' => 'btn btn-primary')); }}
	            </div>
	        </div>
	    </div>
	</div>         
{{ Form::close(); }}