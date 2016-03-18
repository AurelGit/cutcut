$(function() {
	$.ajax({
		url: '/rest/game/stat.json',
		data: $.param({
			'game_id' : $('[name="game_id"]').val() 
		}),
		dataType: 'json',
		type: 'post',
	}).done(function(data) {
		if (!data.error) {
			var graph = new Array();
			for (var user_id in data.actions) {
				var d = new Array();
				
				for (var i in data.actions[user_id]) {
					var action = data.actions[user_id][i];
					d.push([action.date, action.score]);
				}
				
				graph.push({label: data.users[user_id], data: d});
			}
			
			$.plot("#score", graph, {
				legend: {
				    show: true
				},
			});
		}
	});
});