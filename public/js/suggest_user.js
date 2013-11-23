$("document").ready(function(){

	$('#user_name').autocomplete({ minLength: 1,
		source:function( request, response ) {
	  		$.ajax({
	  			type : "POST" ,
	  			url:  url,
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