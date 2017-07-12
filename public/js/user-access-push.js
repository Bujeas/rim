$(document).ready(function() { 
 	$('a[id^="push-"').each(function(){
		var id = $(this).attr('id');
		var sid = id.split("-");

		$(this).click(function(){
			var group = sid[2];
			var linked = group + $('#push_url_' + sid[1]).text();

			$.ajax({
				type: 'GET',
				url: '/api/group/assign/' + linked,
				beforeSend: function(){
					$("#spinner-push-" + sid[1] + '-' + group).show();
					$("#" + id).hide();
				},
				success: function(Result){
					$("#spinner-push-" + sid[1] + '-' + group).hide();
					$("#pop-toggled-" + sid[1] + '-' + group).show();
				}
			});
		});
	});

	$('a[id^="pop-toggled-"').each(function(){
		var id = $(this).attr('id');
		var sid = id.split("-");

		$(this).click(function(){
			var groupon = sid[3];
			var link_pop = groupon + $('#pop_url_' + sid[2]).text();

			$.ajax({
				type: 'GET',
				url: '/api/group/assign/' + link_pop,
				beforeSend: function(){
					$("#spinner-push-" + sid[2] + '-' + groupon).show();
					$("#" + id).hide();
				},
				success: function(Result){
					$("#spinner-push-" + sid[2] + '-' + groupon).hide();
					$("#push-" + sid[2] + '-' + groupon).show();
				}
			});
		});
	});
});