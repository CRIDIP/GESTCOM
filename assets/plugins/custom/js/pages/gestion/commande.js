/**
 * Created by SWD on 21/03/2016.
 */
(function($){

    $('#liste_commande').dataTable({
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0]
        }],
        language:{
            url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
        }
    });
    
    $('table #supp_commande').on('click', function(e){
        e.preventDefault();
        var a = $(this);
        var url = a.attr('href');
        a.html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax(url)
            .done(function(data){
                a.parents('tr').fadeOut();
                if(data == 1){toastr.success("La commande à bien été supprimer", "SUCCES");}
                if(data == 2){toastr.warning("Les articles de la commande ont été supprimer mais la commande en elle même n'est pas supprimer !", "ATTENTION");}
                if(data == 3){toastr.warning("La commande à été supprimer mais les articles associés sont toujours présent en base de donnée !", "ATTENTION");}
                if(data == 4){toastr.error("Une erreur à eu lieu lors de la suppression de la commande et de ses articles associés !", "ERREUR");}
            })
            .fail(function(jqxhr){
                toastr.error("Une erreur à eu lieu lors de l'envoie des paramètres de la requète !");
                console.log(jqxhr.responseText);
            })
            .always(function(){
                a.html('<i class="icon-trash"></i>');
            })
    });

    function commande_saisie() {
        $.ajax('../../../../../controller/gestion/commande.ajax.php?action=commande_saisie', {
            dataType: "json",
            type: "GET",
            success: function(data){
                $('#commande_saisie').text(data);
            },
            error: function(jqxhr){
                console.log(jqxhr.responseText);
            }
        })
    }
    function commande_attente() {
        $.ajax('../../../../../controller/gestion/commande.ajax.php?action=commande_attente', {
            dataType: "json",
            type: "GET",
            success: function(data){
                $('#commande_attente').text(data);
            },
            error: function(jqxhr){
                console.log(jqxhr.responseText);
            }
        })
    }
    function commande_valide() {
        $.ajax('../../../../../controller/gestion/commande.ajax.php?action=commande_valide', {
            dataType: "json",
            type: "GET",
            success: function(data){
                $('#commande_valide').text(data);
            },
            error: function(jqxhr){
                console.log(jqxhr.responseText);
            }
        })
    }

    commande_saisie();
    commande_attente();
    commande_valide();
    
    //VIEW
    $('#btn_valide_commande').on('click', function(e){
        e.preventDefault();
        var a = $(this);
        var url = a.attr('href');
        a.html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax(url)
            .done(function(data){
                if(data == 200){
                    toastr.success("La commande est maintenant <strong>en attente</strong>");
                    location.reload();
                }
                if(data == 201){
                    toastr.success("La commande est maintenant <strong>Valider</strong>");
                    location.reload();
                }
                if(data == 202){
                    toastr.success("La commande est maintenant <strong>Transformer en facture</strong>");
                    location.reload();
                }
                if(data == 500){toastr.error("Une erreur de script Serveur à eu lieu.")}
            })
            .fail(function(jqxhr){
                toastr.error("Une erreur à eu lieu lors de l'envoie des paramètres de la requète !");
                console.log(jqxhr.responseText);
            })
            .always(function(){
                a.html(a);
            })
    });
    $('table #supp_article').on('click', function(e){
        e.preventDefault();
        var a = $(this);
        var url = a.attr('href');
        a.html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax(url)
            .done(function(data){
                if(data == 200){
                    a.parents('tr').fadeOut();
                    toastr.success("L'article à été supprimer");
                    location.reload();
                }
                if(data == 500){
                    toastr.error("Erreur de script PHP");
                    location.reload();
                }
            })
            .fail(function(jqxhr){
                toastr.error("Une erreur à eu lieu lors de l'envoie des paramètres de la requète !");
                console.log(jqxhr.responseText);
            });

    });
})(jQuery);