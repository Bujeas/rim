<!DOCTYPE html>
<html>

<head>

    @include ('partials.header_form')

</head>

<body>
	<?php $base_url = url('/'); ?>
	{{ Form::hidden('base_url', $base_url, array('id' => 'base_url')) }}
    <div id="wrapper">
        @include ('partials.menu')
        @include ('partials.topmenu_form')
        @yield ('content')   
        @include ('partials.footer')
    </div>
    </div>

    <!-- Mainly scripts -->
    @include ('partials.footer_js')

    <!-- Data Tables -->
    <script src="{{ asset('/js/plugins/dataTables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('/js/plugins/dataTables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('/js/plugins/dataTables/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('/js/plugins/dataTables/dataTables.tableTools.min.js') }}"></script>

    <!-- Typeahead -->
    <script src="{{ asset('/js/typeahead/typeahead.js') }}"></script>

    <!-- Data picker -->
	<script src="{{ asset('/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>

    <!-- Custom and plugin javascript -->
	{{-- <script src="{{ asset('/js/inspinia.js') }}"></script>
	<script src="{{ asset('/js/plugins/pace/pace.min.js') }}"></script> --}}

	<!-- iCheck -->
	<script src="{{ asset('/js/plugins/iCheck/icheck.min.js') }}"></script>
	<script>
	    $(document).ready(function () {
	        $('.i-checks').iCheck({
	            checkboxClass: 'icheckbox_square-green',
	            radioClass: 'iradio_square-green',
	        });
	    });
	</script>
    <script>
        $(document).ready(function() {
            $("body").tooltip({ selector: '[data-toggle=tooltip]' });
        });
    </script>

	<!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            $('.dataTables-example').dataTable({
                responsive: true,
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                }
            });
        });
    </script>
	<style>
	    body.DTTT_Print {
	        background: #fff;

	    }
	    .DTTT_Print #page-wrapper {
	        margin: 0;
	        background:#fff;
	    }

	    button.DTTT_button, div.DTTT_button, a.DTTT_button {
	        border: 1px solid #e7eaec;
	        background: #fff;
	        color: #676a6c;
	        box-shadow: none;
	        padding: 6px 8px;
	    }
	    button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
	        border: 1px solid #d2d2d2;
	        background: #fff;
	        color: #676a6c;
	        box-shadow: none;
	        padding: 6px 8px;
	    }

	    .dataTables_filter label {
	        margin-right: 5px;

	    }
	</style>
	<script>
	$(document).ready(function(){
		$('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            dateFormat: 'yy-mm-dd'
        });
	});
	</script>

</body>

</html>
