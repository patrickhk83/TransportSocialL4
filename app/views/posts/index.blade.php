<html>
	<head>
	</head>
	<body>
		<h2>All Posts</h2>
		@foreach ($posts as $post)
			<div>
				<span>{{ $post->title }}</span>
				<span>{{ $post->body }}</span>
			</div>
		@endforeach
	</body>
</html>
