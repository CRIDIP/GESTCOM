/**
 * Created by SWD on 08/03/2016.
 */
(function($){
    //DATATABLE
    $('#achat').dataTable({
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0]
        }],
        language:{
            url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
        }
    });
    $('#code_compte').select2({
        ajax:{
            url: "../../controller/compta/vente.ajax.php?action=code_compte",
            dataType: 'json',
            delay: 250,
            data: function (params){
                return {
                    q: params.term,
                    page: params.page
                }
            },
            processResults: function(data, params){
                params.page = params.page || 1;
                return{
                    results: data.items,
                    pagination:{
                        more: (params.page*30) < data.total_count
                    }
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 1
    })
})(jQuery);