$(document).ready(function(){
    var host = $('#base_url').val();
    !function ($) {
        $(function(){
            var unit = new Bloodhound({
                datumTokenizer: function (datum) {
                    return Bloodhound.tokenizers.whitespace(datum.value);
                },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                limit: 10,
                prefetch: {
                    // url: 'http://localhost:8000/api/allunit',
                    url: host+'/api/allunit',
                    filter: function (unit) {
                        return $.map(unit, function (vendor) {
                            return {
                                id: vendor.id,
                                code: vendor.code,
                                value: vendor.name
                            };
                        });
                    }
                }
            });
            unit.clear();
            unit.clearPrefetchCache();
            unit.clearRemoteCache();
            unit.initialize(true);
            $('#temp_unit').typeahead(null, {
                name: 'unit',
                displayKey: 'value',
                source: unit.ttAdapter()
            }).on('typeahead:selected', function(event, data){
                $('#temp_unit_id').val(data.id);
                $('#temp_format_unit').html(data.code + ' /');
                $('#f_unit').val(data.code);
                $('#temp_default').hide();
                console.log(data.id);
                console.log(data.code);
            });

        });
    }(window.jQuery);
});