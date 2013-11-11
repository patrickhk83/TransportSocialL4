@extends('layouts.default')

@section('content')

	{{ HTML::script('js/modal.js'); }}
	{{ HTML::script('js/manageuser.js'); }}
	<div>
		<h1>{{$user->first_name." ".$user->last_name;}}</h1>
		{{ link_to_route('user.edit_profile', 'Edit Profile', null, array('class' => 'btn btn-primary')) }}
	</div>	
	<div class="photo">
		{{ HTML::image($profile_pic , null , array('class' => 'thumb')) }}
		{{ link_to_route('user.edit_profile', 'Edit Profile Pic', null, array('class' => 'btn btn-primary' , 'data-toggle' => 'modal' , 'data-target' => '#profile_pic_form' , 'data-remote' => 'false')) }}
	</div>
	<?php if(!empty($user->company)): ?>
	<div class="occupation">
		<p>
			{{ $user->company. ' | ' .$country->name; }}
		</p>
	</div>
	<?php endif; ?>
	
	<?php if(!empty($user->about_me)): ?>
		<h1 class="heading">{{ trans('user_auth.my_profile_about_me'); }}</h1>
		<p class="content">{{ $user->about_me; }}</p>
	<?php endif; ?>
	
	<?php if(!empty($user->hobbies)): ?>
		<h1 class="heading">{{ trans('user_auth.my_profile_hobbies'); }}</h1>
		<p class="content">{{ $user->hobbies; }}</p>
	<?php endif; ?>
	
	<?php if(!empty($user->musics)): ?>
		<h1 class="heading">{{ trans('user_auth.my_profile_musics'); }}</h1>
		<p class="content">{{ $user->musics; }}</p>
	<?php endif; ?>
	
	<?php if(!empty($user->movies)): ?>
		<h1 class="heading">{{ trans('user_auth.my_profile_movies'); }}</h1>
		<p class="content">{{ $user->movies; }}</p>
	<?php endif; ?>
	<?php if(!empty($user->books)): ?>
		<h1 class="heading">{{ trans('user_auth.my_profile_books'); }}</h1>
		<p class="content">{{ $user->books; }}</p>
	<?php endif; ?>

	<?php if (isset($photos) && count($photos) > 0): ?>
	<h1 class="heading">{{ trans('user_auth.my_profile_my_photos'); }}</h1>
		<div>
			<?php foreach ($photos as $photo): ?>
				{{ HTML::image($photo , null , array('class' => 'thumb')) }}
			<?php endforeach; ?>
		</div>
	<?php endif ?>
	
@include('users.profile_pic');
@stop