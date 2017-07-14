$(document).ready(function(){
    var host = $('#base_url').val();
    !function ($) {
        $(function(){
            var sec = new Bloodhound({
                datumTokenizer: function (datum) {
                    return Bloodhound.tokenizers.whitespace(datum.value);
                },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                limit: 10,
                prefetch: {
                    // url: 'http://localhost:8000/api/allsection',
                    url: host+'/api/allsection',
                    filter: function (sec) {
                        return $.map(sec, function (vendor) {
                            return {
                                id: vendor.id,
                                code: vendor.code,
                                value: vendor.name
                            };
                        });
                    }
                }
            });
            sec.clear();
            sec.clearPrefetchCache();
            sec.clearRemoteCache();
            sec.initialize(true);
            $('#temp_section').typeahead(null, {
                name: 'sec',
                displayKey: 'value',
                source: sec.ttAdapter()
            }).on('typeahead:selected', function(event, data){
                $('#temp_section_id').val(data.id);
                $('#temp_format_sec').html(data.code + ' /');
                $('#f_sec').val(data.code + '/');
                $('#temp_default').hide();
                console.log(data.id);
                console.log(data.code);
            });

        });
    }(window.jQuery);
});