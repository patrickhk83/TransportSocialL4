$("document").ready(function(){
	$('#multifile_input').change(function(evt)
	{
		var files = evt.target.files;
		var file = files[0];
		var id = this;
		if(!file.type.match('image/gif') && !file.type.match('image/jpg') && !file.type.match('image/png') && !file.type.match('image/jpeg'))
		{
			return;
		}

		new_input = $(id).clone(true);
		new_input.off();
		$(new_input).hide();
		$(id.parentNode).append(new_input);

		var reader = new FileReader();

		reader.onload = (function(theFile) 
		{
			return function(e) {
				var new_li = document.createElement('li');
				//new_li.classList.add('template-upload fade in');
				var new_img = document.createElement('img');
				new_img.src = e.target.result;
				new_img.classList.add('thumb');
				var new_name = document.createElement('span');
				new_name.innerHTML = escape(theFile.name);

				var delete_link = document.createElement('a');
				delete_link.innerHTML = "<span class='btn btn-danger delete'><i class='glyphicon glyphicon-trash'></i><span>Delete</span></span>";

				delete_link.href = "#";
				delete_link.input_reference = new_input;
			
				$(delete_link).click(function() {
					$(this.input_reference).remove();
					$(this.parentNode).remove();
				});

				$(new_li).prepend(delete_link);
				$(new_li).prepend(new_name);
				$(new_li).prepend(new_img);
				
				
				$('#multifile_list').append(new_li);
				id.value = '';

			}
		})(file);

		reader.readAsDataURL(file);
	});	
});