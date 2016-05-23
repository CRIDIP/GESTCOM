/**
 * Created by SAS CRIDIP on 27/04/2016.
 */
(function ($) {
    $('#liste_service').dataTable({
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0]
        }],
        language:{
            url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
        }
    });
    $('table #renew_service').on('click', function(e){
        e.preventDefault();
        var a = $(this);
        var url = a.attr('href');
        a.html('<i class="fa fa-refresh fa-spin"></i>');
        $.ajax(url)
            .done(function(data){
                a.html('<i class="icon-refresh"></i>');
                if(data == 200){toastr.success("Le Renouvellement est maintenant effectif.");}
                if(data == 300){toastr.error("Une erreur à eu lieu lors du renouvellement du service");}
            })
            .fail(function(jqxhr){
                toastr.error("Une erreur à eu lieu lors de l'envoie des paramètres de la requète !");
                console.log(jqxhr.responseText);
            })
            .always(function(){
                a.html('<i class="icon-refresh"></i>');
            })
    });
})(jQuery);
