(function ($) {
    $('li').on('click', '#ajax_cross',function (e) {
        e.preventDefault();
        var a = $(this);
        var url = a.attr('href');
        $('#ajax_dedie').html('<div class="loader text-center"></div>');
        $.getJSON(url)
            .done(function(data){
                $('#ajax_dedie').html(data);
            })
            .fail(function(data){
                console.log(data);
            })
    });
    $('#ftp_backup_cpt').dataTable({
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0]
        }],
        language:{
            url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
        }
    });
    $('#ovh_intervention').dataTable({
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0]
        }],
        language:{
            url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
        }
    });
})(jQuery);
