<script src="{{ asset('/js/jquery-2.1.1.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('/js/inspinia.js') }}"></script>
<script src="{{ asset('/js/plugins/pace/pace.min.js') }}"></script>

<!-- Jquery Validate -->
<script src="{{ asset('/js/plugins/validate/jquery.validate.min.js') }}"></script>
<script>
     $(document).ready(function(){

         $("#form").validate({
             rules: {
                 password: {
                     required: true,
                     minlength: 3
                 },
                 url: {
                     required: true,
                     url: true
                 },
                 number: {
                     required: true,
                     number: true
                 },
                 min: {
                     required: true,
                     minlength: 6
                 },
                 max: {
                     required: true,
                     maxlength: 4
                 }
             }
         });
    });
</script>

<script src="{{ asset('/js/custom.js') }}"></script>
<script src="{{ asset('/js/template.js') }}"></script>
<script src="{{ asset('/js/sequence.js') }}"></script>
<script src="{{ asset('/js/user-access-pop.js') }}"></script>
<script src="{{ asset('/js/user-access-push.js') }}"></script>
<script src="{{ asset('/js/chosen-select-division.js') }}"></script>
<script src="{{ asset('/js/chosen-select-department.js') }}"></script>
<script src="{{ asset('/js/chosen-select-section.js') }}"></script>
<script src="{{ asset('/js/chosen-select-unit.js') }}"></script>
<script src="{{ asset('/js/chosen-select-subunit.js') }}"></script>