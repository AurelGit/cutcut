$(function() {
	$('form').submit(function() {
		var form_data = new FormData($('form')[0]);
		
	    $.ajax({
	        url: '/rest/player/save.json',
	        type: 'POST',
	        data: form_data,
	        cache: false,
	        contentType: false,
	        processData: false,
	        success: function(data) {
	        	message(data.message, data.error ? 'alert' : 'success');
	        	
	        	if (!data.error) {
	        		window.location.replace(data.redirect);
	        	}
	        },
	    });
		
		return false;
	});
});