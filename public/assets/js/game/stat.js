$(function() {
//	var d1 = [];
//	for (var i = 0; i < 14; i += 0.5) {
//		d1.push([i, Math.sin(i)]);
//	}
//
//	var d2 = [[0, 3], [4, 8], [8, 5], [9, 13]];
//
//	// A null signifies separate line segments
//
//	var d3 = [[0, 12], [7, 12], [7, 2.5], [12, 2.5]];
//
//	$.plot("#score", [ d1, d2, d3 ]);
	
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
				}
			});
		}
	});
});