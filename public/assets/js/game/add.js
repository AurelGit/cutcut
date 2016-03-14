$(function() {
	$('input[name="players[]"]').change(function() {
		if ($(this).is(':checked')) {
			$(this).closest('.player-thumbnail').addClass('selected');
		} else {
			$(this).closest('.player-thumbnail').removeClass('selected');
		}
	});
});