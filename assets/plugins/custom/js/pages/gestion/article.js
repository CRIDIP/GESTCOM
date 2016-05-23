/**
 * Created by SWD on 15/03/2016.
 */
(function($){
    //DATATABLE
    $('#famille').dataTable({
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0]
        }],
        language:{
            url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
        }
    });
    $('#article').dataTable({
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0]
        }],
        language:{
            url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
        }
    });

    //AJAX
    $('table #supp-famille').on('click', function(e){
        e.preventDefault();
        var a = $(this);
        var url = a.attr('href');
        a.html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax(url)
            .done(function(data){
                a.parents('tr').fadeOut();
                if(data == 300){toastr.warning("Plusieurs articles sont encore disponible pour la famille choisie", "ATTENTION")}
                if(data == 200){toastr.success("La famille à été supprimer avec succès !", "SUCCES")}
                if(data == 600){toastr.error("Une erreur serveur à eu lieu lors de la suppression de la famille", "ERREUR")}
            })
            .fail(function(jqxhr){
                toastr.error("Une erreur à eu lieu lors de l'envoie des paramètres de la requète !");
                console.log(jqxhr.responseText);
            })
            .always(function(){
                a.html('<i class="fa fa-trash"></i>');
            })
    });
    $('table #supp-article').on('click', function(e){
        e.preventDefault();
        var a = $(this);
        var url = a.attr('href');
        a.html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax(url)
            .done(function(data){
                a.parents('tr').fadeOut();
                if(data == 300){toastr.warning("<strong>Suppression impossible</strong>: L'article est présent dans un ou plusieurs Devis !", "ATTENTION")}
                if(data == 301){toastr.warning("<strong>Suppression impossible</strong>: L'article est présent dans une ou plusieurs Commande !", "ATTENTION")}
                if(data == 302){toastr.warning("<strong>Suppression impossible</strong>: L'article est présent dans une ou plusieurs Facture !", "ATTENTION")}
                if(data == 200){toastr.success("L'article à bien été supprimer.", "SUCCES")}
                if(data == 600){toastr.error("Une erreur serveur à eu lieu lors de la suppression de l'article.", "ERREUR")}
            })
            .fail(function(jqxhr){
                toastr.error("Une erreur à eu lieu lors de l'envoie des paramètres de la requète !");
                console.log(jqxhr.responseText);
            })
            .always(function(){
                a.html('<i class="fa fa-trash"></i>');
            })
    });


})(jQuery);
