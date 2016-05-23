/**
 * Created by SWD on 08/03/2016.
 */
(function($){
   $('#compte_classe').dataTable({
       "aoColumnDefs": [{
           "bSortable": false,
           "aTargets": [0]
       }],
       language:{
           url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
       }
   })
    $('#compte_sousclasse').dataTable({
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0]
        }],
        language:{
            url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
        }
    })
    $('#compte').dataTable({
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0]
        }],
        language:{
            url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
        }
    });

    //AJAX
    $('table #supp-classe').on('click', function(e){
        e.preventDefault();
        var a = $(this);
        var url = a.attr('href');
        a.html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax(url)
            .done(function(data){
                a.parents('tr').fadeOut();
                if(data == 300){toastr.warning("Cette classe ne peut pas être supprimer car elle comporte des sous classes !")}
                if(data == 200){toastr.success("La classe à bien été supprimé")}
                if(data == 500){toastr.error("Une erreur à eu lieu lors de l'exécution du script !")}
            })
            .fail(function(jqxhr){
                toastr.error("Une erreur à eu lieu lors de l'envoie des paramètres de la requète !");
                console.log(jqxhr.responseText);
            })
            .always(function(){
                a.html('<i class="icon-trash"></i>');
            })
    });
    $('table #supp-sousclasse').on('click', function(e){
        e.preventDefault();
        var a = $(this);
        var url = a.attr('href');
        a.html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax(url)
            .done(function(data){
                a.parents('tr').fadeOut();
                if(data == 300){toastr.warning("Cette sous classe ne peut pas être supprimer car elle comporte des comptes !")}
                if(data == 200){
                    toastr.success("La sous classe à bien été supprimé")}
                if(data == 500){toastr.error("Une erreur à eu lieu lors de l'exécution du script !")}
            })
            .fail(function(jqxhr){
                toastr.error("Une erreur à eu lieu lors de l'envoie des paramètres de la requète !");
                console.log(jqxhr.responseText);
            })
            .always(function(){
                a.html('<i class="icon-trash"></i>');
            })
    })
    $('table #supp-compte').on('click', function(e){
        e.preventDefault();
        var a = $(this);
        var url = a.attr('href');
        a.html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax(url)
            .done(function(data){
                a.parents('tr').fadeOut();
                if(data == 200){
                    toastr.success("Le compte à bien été supprimé")}
                if(data == 500){toastr.error("Une erreur à eu lieu lors de l'exécution du script !")}
            })
            .fail(function(jqxhr){
                toastr.error("Une erreur à eu lieu lors de l'envoie des paramètres de la requète !");
                console.log(jqxhr.responseText);
            })
            .always(function(){
                a.html('<i class="icon-trash"></i>');
            })
    })
})(jQuery);