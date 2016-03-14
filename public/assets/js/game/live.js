$(function() {
	start_timer();
	
	$('button[name="action"]').click(function() {
		loading();
		
		var button = $(this);
		
		$.ajax({
			url: '/rest/game/action.json',
			data: $.param({
				'player_id'	: button.data('player'),
				'game_id'	: button.data('game'),
				'action'	: button.data('action'),
			}),
			dataType: 'json',
			type: 'post',
			success: function(data) {
				if (!data.error) {
	        		window.location.replace(data.redirect);
				}
				
				loading(false);
			}
		});
	});
});


function start_timer()
{
	if (typeof(Worker) == 'undefined') {
		return false;
	}
	
	if (typeof(w) == 'undefined') {
		w = new Worker('/assets/js/game/timer.js');
	}
	
	w.onmessage = function (event) {
		$('#timer-value').html(event.data);
	};
}