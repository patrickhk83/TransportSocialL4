$("document").ready(function(){
	$('#multifile_input').change(function(evt)
	{
		var files = evt.target.files;
        for(var i = 0; i < files.length; i++) {
            var file = files[i];
            var id = this;
            if(!file.type.match('image/gif') && !file.type.match('image/jpg') && !file.type.match('image/png') && !file.type.match('image/jpeg'))
            {
                return;
            }
            var reader = new FileReader();

            reader.onload = (function(theFile)
            {
                return function(e) {
                    var new_li = document.createElement('li');
                    var new_img = document.createElement('img');
                    new_img.src = e.target.result;
                    new_img.classList.add('thumb');
                    var new_name = document.createElement('span');
                    new_name.innerHTML = escape(theFile.name);

                    $(new_li).prepend(delete_link);
                    $(new_li).prepend(new_name);
                    $(new_li).prepend(new_img);


                    $('#multifile_list').append(new_li);
                }
            })(file);

            reader.readAsDataURL(file);
        }

	});
});