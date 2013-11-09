@extends('layouts.default')
@section('content')

	<h1 class="heading">{{$user->first_name." ".$user->last_name;}}</h1>
	<a href="{{ URL::to('user/edit_profile')}}" class="btn btn-primary">Edit Profile</a>
	<div class="photo">{{ HTML::image($profile_pic , null , array('class' => 'thumb')) }}</div>
	<?php if(!empty($user->company)): ?>
	<div class="occupation">
		<p>
			{{ $user->company. '&nbsp;&nbsp;|&nbsp;&nbsp;' .$country; }}
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

	<?php if (isset($profile_pics) && count($profile_pics)): ?>
	<h1 class="heading">{{ trans('user_auth.my_profile_my_photos'); }}</h1>
		<div>
			<?php foreach ($profile_pics as $pic): ?>
				{{ HTML::image($pic , null , array('class' => 'thumb')) }}
			<?php endforeach; ?>
		</div>
	<?php endif ?>


@stop