$(document).ready(function() { 
	$('a[id^="toggled-"').each(function(){
		var id = $(this).attr('id');
		var sid = id.split("-");

		$(this).click(function(){
			var group = sid[2];
			var link = group + $('#url_pop_' + sid[1]).text();

			$.ajax({
				type: 'GET',
				url: '/api/group/assign/' + link,
				beforeSend: function(){
					$("#spinner-pop-" + sid[1] + '-' + group).show();
					$("#" + id).hide();
				},
				success: function(Result){
					$("#spinner-pop-" + sid[1] + '-' + group).hide();
					$("#toggled-push-" + sid[1] + '-' + group).show();
				}
			});
		});
	});

	$('a[id^="toggled-push-"').each(function(){
		var id = $(this).attr('id');
		var sid = id.split("-");

		$(this).click(function(){
			var group = sid[3];
			var link_push = group + $('#url_push_' + sid[2]).text();

			$.ajax({
				type: 'GET',
				url: '/api/group/assign/' + link_push,
				beforeSend: function(){
					$("#spinner-pop-" + sid[2] + '-' + group).show();
					$("#" + id).hide();
				},
				success: function(Result){
					$("#spinner-pop-" + sid[2] + '-' + group).hide();
					$("#toggled-" + sid[2] + '-' + group).show();
				}
			});
		});
	});
});