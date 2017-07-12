$(document).ready(function() { 
	$('#btn-available').click(function() {
 	 	$("#hr-template").fadeOut();
  		$("#seq_temp").fadeOut();

	 	var div  = $('#f_div').val();
	 	var dept = $('#f_dept').val();
	 	var sec  = $('#f_sec').val();
	 	// var yy   = $('#f_year').val();

	 	// var str = div + '_' + dept + '_' + sec + '_00000000_' + yy;
	 	var str;

	 	if(div != '')
	 	{
	 		str = div;
	 	}

	 	if(div != '' && dept != '')
	 	{
	 		str = div + '_' + dept;
	 	}

	 	if(div != '' && dept != '' && sec != '')
	 	{
	 		str = div + '_' + dept + '_' + sec;
	 	}

	 	var obj_name = 'tempList';
	 	var url = '/api/listTemplate.json/' + str;

	 	$.ajax({
	 		type: "GET",
	 		url: '/api/listTemplate.json/' + str,
	 		contentType: "application/json; charset=utf-8",
	        dataType: "json",
	        beforeSend: function(){
				$("#temp_loader").fadeIn();
			},
			success: function(Result){
				var array = Result;
				var options;
				
				if(array != 'null')
				{
					var arr = eval('array.'+obj_name);
					$.each(arr, function(k, v){
		              	options += '<option value="'+arr[k][0]+'">'+v[1]+'</option>';
		          	});
		          	$('#sequence_name').html(options);
	          		$("#hr-template").fadeIn('slow');
	          		$("#seq_temp").fadeIn('slow');
	          		$("#temp_loader").fadeOut('slow');
	          		$("#sequence_name").fadeIn('slow');
				}else{
					options = '<option value="">Select Department</option>';
        			$('#sequence_name').html(options);
        			$("#hr-template").fadeIn('slow');
	          		$("#seq_temp").fadeIn('slow');
	          		$("#temp_loader").fadeOut('slow');
	          		$("#sequence_name").fadeIn('slow');
				}
			}
	 	});
	});

	// $('#sequence_action').change(function() {
	// 	var textVal = $(this).find("option:selected").val();
		
	// 	if(textVal == '0')
	// 	{
	// 		$('#line-seq-date').fadeOut();
	// 		$('#data_1').fadeOut();
	// 		$('#date_action').val('');

	// 		$('#line-seq-remarks').fadeOut();
	// 		$('#data_2').fadeOut();
	// 		$('#sequence_remarks').val('');
	// 	}

	// 	if(textVal == '1')
	// 	{
	// 		$('#line-seq-date').fadeIn();
	// 		$('#data_1').fadeIn();
			
	// 		$('#line-seq-remarks').fadeOut();
	// 		$('#data_2').fadeOut();
	// 		$('#sequence_remarks').val('');
	// 	}

	// 	if(textVal == '2')
	// 	{
	// 		$('#line-seq-date').fadeOut();
	// 		$('#data_1').fadeOut();
	// 		$('#date_action').val('');

	// 		$('#line-seq-remarks').fadeOut();
	// 		$('#data_2').fadeOut();
	// 		$('#sequence_remarks').val('');
	// 	}

	// 	if(textVal == '3')
	// 	{
	// 		$('#line-seq-date').fadeOut();
	// 		$('#data_1').fadeOut();
	// 		$('#date_action').val('');

	// 		$('#line-seq-remarks').fadeIn();
	// 		$('#data_2').fadeIn();
	// 	}
	// });
});