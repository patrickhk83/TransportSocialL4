<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>{{ sprintf(trans('user_auth.create_user_activate_label') , $name);}}</h2>

		<div>
			{{ sprintf(trans('user_auth.create_user_activate_subheading') , URL::to('user.activate' , array('id' => $id , 'activation' => $activation)))}}
		</div>
	</body>
</html>