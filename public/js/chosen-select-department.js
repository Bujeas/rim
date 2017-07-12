$(document).ready(function(){
    var host = $('#base_url').val();
    !function ($) {
        $(function(){
            var dept = new Bloodhound({
                datumTokenizer: function (datum) {
                    return Bloodhound.tokenizers.whitespace(datum.value);
                },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                limit: 10,
                prefetch: {
                    // url: 'http://localhost:8000/api/alldepartment',
                    url: host+'/api/alldepartment',
                    filter: function (dept) {
                        return $.map(dept, function (vendor) {
                            return {
                                id: vendor.id,
                                code: vendor.code,
                                value: vendor.name
                            };
                        });
                    }
                }
            });
            dept.clear();
            dept.clearPrefetchCache();
            dept.clearRemoteCache();
            dept.initialize(true);
            $('#temp_dept').typeahead(null, {
                name: 'dept',
                displayKey: 'value',
                source: dept.ttAdapter()
            }).on('typeahead:selected', function(event, data){
                $('#temp_dept_id').val(data.id);
                // $('#temp_format_prefix').html(data.code + ' /');
                $('#temp_format_dept').html(data.code + ' /');
                $('#f_dept').val(data.code);
                $('#temp_default').hide();
                console.log(data.id);
                console.log(data.code);
            });

        });
    }(window.jQuery);
});