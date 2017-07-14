$(document).ready(function() { 
    // $('#hr_format').hide();
    // $('#group_format').hide();

    //onChange Division
    // $('#temp_div').change(function() {
    //   getDivision($('#temp_div').val());

    //   $("#hr-template").fadeOut();
    //   $("#seq_temp").fadeOut();

    //   var text = $(this).find("option:selected").text();
    //   var newText = text.replace(/[^a-z0-9]+/gi , "");
    //   var val = $(this).find('option:selected').val();
    //   var url = '/api/listDepartment.json/' + val;

    //   $.getJSON(url, function(json){
    //     var array = json;
    //     var options;

    //     if(array != 'null')
    //     {
    //       var arr = eval('array.'+newText);
    //       console.log(arr);
    //       $.each(arr, function(k, v){
    //           options += '<option value="'+arr[k]+'">'+v[1]+'</option>';
    //       });
    //       // $('#hr_format').show();
    //       // $('#group_format').show();
    //         $('#temp_dept').html(options);
    //         $('#temp_format_dept').html(' ');
    //         $('#temp_format_sec').html(' ');
    //     }else{
    //         options = '<option value="">Select Department</option>';
    //         $('#temp_dept').html(options);
    //         $('#temp_format_dept').html(' ');
    //         // $('#temp_format_year').html(' ');
    //     }
    //   });

    // });

    //onChange Department
    // $('#temp_dept').change(function() {
    //   getDepartment($('#temp_dept').val());

    //   $("#hr-template").fadeOut();
    //   $("#seq_temp").fadeOut();

    //   var text = $(this).find("option:selected").text();
    //   var newText = text.replace(/[^a-z0-9]+/gi , "");
    //   var val = $(this).find('option:selected').val();
    //   var url = '/api/listSection.json/' + val;

    //   $.getJSON(url, function(json){
    //     var array = json;
    //     var options;

    //     if(array != 'null')
    //     {
    //       var arr = eval('array.'+newText);
    //       console.log(arr);
    //       $.each(arr, function(k, v){
    //           options += '<option value="'+arr[k]+'">'+v[1]+'</option>';
    //       });
    //       $('#temp_sec').html(options);
    //     }else{
    //       options = '<option value="">Select Section</option>';
    //       $('#temp_sec').html(options);
    //       $('#temp_format_sec').html(' ');
    //     }
    //   });

    // });

    //onChange Section
    $('#temp_sec').change(function() {
        getSection($('#temp_sec').val());

        $("#hr-template").fadeOut();
        $("#seq_temp").fadeOut();
    });

    //onChange Sequence Document
    $('#sequence_doc_name').change(function() {
        $('#seq_doc_name').val($('#sequence_doc_name :selected').text());
    });

    //onChange Prefix
    $('#temp_prefix').keyup(function() {
        $('#temp_format_prefix').html($('#temp_prefix').val() + ' /');
        $('#temp_default').hide();
    });

    //onChange Division
    $('#temp_div').keyup(function(){
        $('#temp_format_div').html($('#temp_div').val());
        $('#f_div').val($('#temp_div').val());
        $('#temp_div_id').val($('#temp_div').val());
    });

     //onChange Department
    $('#temp_dept').keyup(function() {
        $('#temp_format_dept').html($('#temp_dept').val());
        $('#f_dept').val($('#temp_dept').val());
        $('#temp_dept_id').val($('#temp_dept').val());
    });

    //onChange Section
    $('#temp_section').keyup(function() {
        $('#temp_format_sec').html($('#temp_section').val());
        $('#f_sec').val($('#temp_section').val());
        $('#temp_section_id').val($('#temp_section').val());
    });

    //onChange Unit
    $('#temp_unit').keyup(function() {
        $('#temp_format_unit').html($('#temp_unit').val());
        $('#f_unit').val($('#temp_unit').val());
        $('#temp_unit_id').val($('$temp_unit').val());
    });

    //onChange Sub Unit
    $('#temp_subunit').keyup(function() {
        $('#temp_format_subunit').html($('#temp_subunit').val());
        $('#f_subunit').val($('#temp_subunit').val());
        $('#temp_subunit_id').val($('#temp_subunit').val());
    });

    //onChange Postfix
    $('#temp_postfix').keyup(function() {
        $('#temp_format_postfix').html($('#temp_postfix').val());
        // $('#temp_format_sequence').show();
        // $('#temp_format_year').show();
        $('#temp_default').hide();
    });

    //onClick Button Reset
    $('#btn-reset').click(function() {
        $('#temp_format_div').html(' ');

        // options_dept = '<option value="">Select Department</option>';
        // $('#temp_dept').html(options_dept);
        // $('#temp_format_dept').html(' ');

        // options_sec = '<option value="">Select Section</option>';
        // $('#temp_sec').html(options_sec);
        // $('#temp_format_sec').html(' ');

        $('#temp_doc option:first').prop('selected',true);
        $('#temp_format_doc').html(' ');

        $('#temp_prefix').val(' ');
        $('#temp_format_prefix').html(' ');

        $('#temp_format_dept').html(' ');
        $('#temp_format_sec').html(' ');
        $('#temp_format_unit').html(' ');
        $('#temp_format_subunit').html(' ');

        $('#temp_postfix').val(' ');
        $('#temp_format_postfix').html(' ');

        // $('#temp_format_sequence').hide();
        // $('#temp_format_year').hide();

        $('#temp_default').show();

      // $('#hr_format').hide();
      // $('#group_format').hide();
    });
});


function getDivision(selectedValue){
$.ajax({
        type: "GET",
        url: '/api/division',
        data: { value: selectedValue },
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: false,
        success: function (Result) {
            $('#temp_format_div').html(Result);
            $('#f_div').val(Result);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // alert(errorThrown);
            $('#temp_format_div').html(' ');

            options_dept = '<option value="">Select Department</option>';
            $('#temp_dept').html(options_dept);
            $('#temp_format_dept').html(' ');

            options_sec = '<option value="">Select Section</option>';
            $('#temp_sec').html(options_sec);
            $('#temp_format_sec').html(' ');

            $('#temp_doc option:first').prop('selected',true);
            $('#temp_format_doc').html(' ');

            $('#temp_prefix').val(' ');
            $('#temp_format_prefix').html(' ');

            $('#temp_postfix').val(' ');
            $('#temp_format_postfix').html(' ');

            // $('#temp_format_year').html(' ');

            // $('#hr_format').hide();
            // $('#group_format').hide();
        }
    });
}

function getDepartment(selectedValue){
$.ajax({
        type: "GET",
        url: '/api/department',
        data: { value: selectedValue },
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: false,
        success: function (Result) {
           $('#temp_format_dept').html(Result);
           $('#f_dept').val(Result);
        },
        error: function (jqXHR, textStatus, errorThrown) {
              alert(errorThrown);
        }
    });
}

function getSection(selectedValue){
$.ajax({
        type: "GET",
        url: '/api/section',
        data: { value: selectedValue },
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: false,
        success: function (Result) {
           $('#temp_format_sec').html(Result);
           $('#f_sec').val(Result);
        },
        error: function (jqXHR, textStatus, errorThrown) {
              alert(errorThrown);
        }
    });
}