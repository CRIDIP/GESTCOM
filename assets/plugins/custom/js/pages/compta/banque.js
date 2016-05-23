/**
 * Created by SWD on 08/03/2016.
 */
(function($){
    //DATATABLE
    $('#banque').dataTable({
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0]
        }],
        language:{
            url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
        }
    });
})(jQuery);