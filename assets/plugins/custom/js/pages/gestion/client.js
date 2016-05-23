/**
 * Created by SWD on 08/03/2016.
 */
(function($){
    //DATATABLE
    $('#client').dataTable({
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0]
        }],
        language:{
            url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
        }
    });
    $('#document_client').dataTable({
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0]
        }],
        language:{
            url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
        }
    });
    $('#devis_cours').dataTable({
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0]
        }],
        language:{
            url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
        }
    });
    $('#commande_cours').dataTable({
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0]
        }],
        language:{
            url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
        }
    });
    $('#facture_cours').dataTable({
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0]
        }],
        language:{
            url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
        }
    });

    $('#correspondance').dataTable({
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0]
        }],
        language:{
            url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
        }
    });

    //AJAX
    $('.table').on('click', '#supp-client', function(e){
        e.preventDefault();
        var a = $(this);
        var url = a.attr('href');
        a.html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax(url)
            .done(function(data){
                a.parents('tr').fadeOut();
                if(data == 1){toastr.success("Le client à bien été supprimer");}
                if(data == 2){toastr.warning("La fiche du salarié à bien été supprimer mais l'utilisateur affilier est toujours actif !");}
                if(data == 3){toastr.warning("L'utilisateur à été supprimer mais la fiche du salarié est toujours active !");}
                if(data == 4){toastr.error("Une erreur à eu lieu lors de la suppression du client ! Veuillez consulter les logs serveurs...");}
            })
            .fail(function(jqxhr){
                toastr.error("Une erreur à eu lieu lors de l'envoie des paramètres de la requète !");
                console.log(jqxhr.responseText);
            })
            .always(function(){
                a.html('<i class="fa fa-trash"></i>');
            })
    });

    $('#call_customer').on('click', function(e){
        e.preventDefault();
        var a = $(this);
        var url = a.attr('href');
        a.html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax(url)
            .done(function(data){
                console.log(data);
            })
            .fail(function(data){
                console.log(data);
            })
    });

    $("#add-correspondance").on('submit', function(e){
        e.preventDefault();
        var form = $(this);
        $.post(form.attr('action'), form.serializeArray())
            .done(function(data, text, jqxhr){
                $('table tbody').prepend(jqxhr.responseText);
                form.find('input').val('');
                toastr.success("L'article à bien été ajouter !", "Ajout d'un article");
            })
            .fail(function(jqxhr){
                toastr.error("Une erreur à eu lieu lors de l'ajour de l'article:<strong>"+jqxhr.responseText+"</strong>", "Ajout d'un article");
            })
            .always(function(){
                form.find('.btn-success').text("Valider");
            });
    });
    $(".table").on('click','#supp-correspondance',function(e){
        e.preventDefault();
        var a = $(this);
        var url = a.attr('href');
        a.html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax(url)
            .done(function(data){
                a.parents('tr').fadeOut();
                toastr.success("Le courrier à bien été supprimer !", "COURRIER")
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

