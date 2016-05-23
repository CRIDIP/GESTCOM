/**
 * Created by Maxime on 03/03/2016.
 */
(function($){
    $('#today2').dataTable({
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0]
        }],
        language:{
            url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
        }
    });
    $('#week2').dataTable({
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0]
        }],
        language:{
            url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
        }
    });
    $('#month2').dataTable({
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0]
        }],
        language:{
            url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
        }
    });
    $('.btn-danger').on('click', function(e){
        e.preventDefault();
        var a = $(this);
        var url = a.attr('href');
        a.html("<i class='fa fa-spinner fa-spin'></i>");
        $.ajax(url)
            .done(function(data, jqxhr){
                if(data == 200){
                    a.parents('tr').fadeOut();
                    toastr.success("L'évènement à été supprimer avec succès !", "CALENDRIER");
                }else{
                    toastr.warning("Une erreur serveur à eu lieu lors de la suppression", "CALENDRIER");
                }
            })
            .fail(function(jqxhr){
                toastr.error("Une erreur à eu lieu lors de la suppression de l'évènement:<strong>"+jqxhr.responseText+"</strong>", "CALENDRIER");
            })
    });
})(jQuery);