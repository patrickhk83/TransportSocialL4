@extends('layouts.default')

<?php
	Asset::container('assets')->add('modalJS','js/modal.js');
	Asset::container('assets')->add('manageuserJS','js/manageuser.js');
	Asset::container('assets')->add('multifileJS','js/multifile.js');
	Asset::container('assets')->add('fileuploadCSS','css/jquery.fileupload.css');
	Asset::container('assets')->add('fileuploadUICSS','css/jquery.fileupload-ui.css');
?>

@section('content')
	<div>
		<h1>{{$user->first_name." ".$user->last_name;}}</h1>
		@if($isUser)
			{{ link_to_route('user.edit_profile', 'Edit Profile', null, array('class' => 'btn btn-primary')) }}
		@endif
	</div>
	<div class="photo">
		{{ HTML::image($profile_pic, null , array('class' => 'thumb')) }}
		@if($isUser)
			{{ link_to_route('user.edit_profile', 'Edit Profile Pic', null, array('class' => 'btn btn-primary' , 'data-toggle' => 'modal' , 'data-target' => '#profile_pic_form' , 'data-remote' => 'false')) }}
		@endif
	</div>
	@if(!empty($user->company))
		<div class="occupation">
			<p>{{ $user->company. ' | ' .$country->name; }}</p>
		</div>
	@endif

	@if(!empty($user->about_me))
		<h1 class="heading">{{ trans('user_auth.my_profile_about_me'); }}</h1>
		<p class="content">{{ $user->about_me; }}</p>
	@endif

	@if(!empty($user->hobbies))
		<h1 class="heading">{{ trans('user_auth.my_profile_hobbies'); }}</h1>
		<p class="content">{{ $user->hobbies; }}</p>
	@endif

	@if(!empty($user->musics))
		<h1 class="heading">{{ trans('user_auth.my_profile_musics'); }}</h1>
		<p class="content">{{ $user->musics; }}</p>
	@endif

	@if(!empty($user->movies))
		<h1 class="heading">{{ trans('user_auth.my_profile_movies'); }}</h1>
		<p class="content">{{ $user->movies; }}</p>
	@endif
	@if(!empty($user->books))
		<h1 class="heading">{{ trans('user_auth.my_profile_books'); }}</h1>
		<p class="content">{{ $user->books; }}</p>
	@endif

	@if (isset($photos) && count($photos) > 0)
	<h1 class="heading">{{ trans('user_auth.my_profile_my_photos'); }}</h1>
		<div class="row">
			@foreach ($photos as $photo)
					<div class="col-md-3">
						{{ HTML::image($photo->path , null , array('class' => 'thumb img-thumbnail')) }}
					</div>
			@endforeach
		</div>
	@endif
	@if($isUser)
		{{ link_to_route('user.add_photo', 'Add My Photo', null, array('class' => 'btn btn-primary' , 'data-toggle' => 'modal' , 'data-target' => '#upload_photo_dialog' , 'data-remote' => 'false')) }}
	@endif

@include('users.profile_pic')
@stop