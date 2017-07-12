$(document).ready(function(){
    var host = $('#base_url').val();
    !function ($) {
        $(function(){
            var div = new Bloodhound({
                datumTokenizer: function (datum) {
                    return Bloodhound.tokenizers.whitespace(datum.value);
                },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                limit: 10,
                prefetch: {
                    // url: 'http://localhost:8000/api/alldivision',
                    url: host+'/api/alldivision',
                    filter: function (div) {
                        return $.map(div, function (vendor) {
                            return {
                                id: vendor.id,
                                code: vendor.code,
                                value: vendor.name
                            };
                        });
                    }
                }
            });
            div.clear();
            div.clearPrefetchCache();
            div.clearRemoteCache();
            div.initialize(true);
            $('#temp_div').typeahead(null, {
                name: 'div',
                displayKey: 'value',
                source: div.ttAdapter()
            }).on('typeahead:selected', function(event, data){
                $('#temp_div_id').val(data.id);
                // $('#temp_format_prefix').html(data.code+' /');
                $('#temp_format_div').html(data.code + ' /');
                $('#f_div').val(data.code);
                $('#temp_default').hide();
                console.log(data.id);
                console.log(data.code);
            });

        });
    }(window.jQuery);
});