$(document).ready(function(){
    var host = $('#base_url').val();
    !function ($) {
        $(function(){
            var subunit = new Bloodhound({
                datumTokenizer: function (datum) {
                    return Bloodhound.tokenizers.whitespace(datum.value);
                },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                limit: 10,
                prefetch: {
                    // url: 'http://localhost:8000/api/allsubunit',
                    url: host+'/api/allsubunit',
                    filter: function (subunit) {
                        return $.map(subunit, function (vendor) {
                            return {
                                id: vendor.id,
                                code: vendor.code,
                                value: vendor.name
                            };
                        });
                    }
                }
            });
            subunit.clear();
            subunit.clearPrefetchCache();
            subunit.clearRemoteCache();
            subunit.initialize(true);
            $('#temp_subunit').typeahead(null, {
                name: 'subunit',
                displayKey: 'value',
                source: subunit.ttAdapter()
            }).on('typeahead:selected', function(event, data){
                $('#temp_subunit_id').val(data.id);
                $('#temp_format_subunit').html(data.code + ' /');
                $('#f_subunit').val(data.code);
                $('#temp_default').hide();
                console.log(data.id);
                console.log(data.code);
            });

        });
    }(window.jQuery);
});