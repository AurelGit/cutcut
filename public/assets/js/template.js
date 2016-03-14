function message(message, type)
{
	$('#message').removeClass('hide');
	$('#message').find('.callout').removeClass().addClass('callout').addClass(type);
	$('#message').find('.content').html(message);
}

function loading(run)
{
	if (arguments.length == 0) {
		var run = true;
	}
	
	if (!$('.loading-modal').length && run) {
		$('body').append('<div class="loading-modal">Loading&#8230;</div>');
	} else if (!run) {
		$('.loading-modal').remove();
	}
}