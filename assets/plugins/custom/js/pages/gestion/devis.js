/**
 * Created by SWD on 21/03/2016.
 */
(function($){

    $('#liste_devis').dataTable({
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0]
        }],
        language:{
            url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
        }
    });
    
    $('table #supp_devis').on('click', function(e){
        e.preventDefault();
        var a = $(this);
        var url = a.attr('href');
        a.html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax(url)
            .done(function(data){
                a.parents('tr').fadeOut();
                if(data == 1){toastr.success("Le devis à bien été supprimer", "SUCCES");}
                if(data == 2){toastr.warning("Les articles du devis ont été supprimer mais le devis en lui même n'est pas supprimer !", "ATTENTION");}
                if(data == 3){toastr.warning("Le devis à été supprimer mais les articles associés sont toujours présent en base de donnée !", "ATTENTION");}
                if(data == 4){toastr.error("Une erreur à eu lieu lors de la suppression du devis et de ses articles associés !", "ERREUR");}
            })
            .fail(function(jqxhr){
                toastr.error("Une erreur à eu lieu lors de l'envoie des paramètres de la requète !");
                console.log(jqxhr.responseText);
            })
            .always(function(){
                a.html('<i class="icon-trash"></i>');
            })
    });

    function devis_saisie() {
        $.ajax('../../../../../controller/gestion/devis.ajax.php?action=devis_saisie', {
            dataType: "json",
            type: "GET",
            success: function(data){
                $('#devis_saisie').text(data);
            },
            error: function(jqxhr){
                console.log(jqxhr.responseText);
            }
        })
    }
    function devis_reponse() {
        $.ajax('../../../../../controller/gestion/devis.ajax.php?action=devis_reponse', {
            dataType: "json",
            type: "GET",
            success: function(data){
                $('#devis_reponse').text(data);
            },
            error: function(jqxhr){
                console.log(jqxhr.responseText);
            }
        })
    }
    function devis_valide() {
        $.ajax('../../../../../controller/gestion/devis.ajax.php?action=devis_valide', {
            dataType: "json",
            type: "GET",
            success: function(data){
                $('#devis_valide').text(data);
            },
            error: function(jqxhr){
                console.log(jqxhr.responseText);
            }
        })
    }
    function devis_refuse() {
        $.ajax('../../../../../controller/gestion/devis.ajax.php?action=devis_refuse', {
            dataType: "json",
            type: "GET",
            success: function(data){
                $('#devis_refuse').text(data);
            },
            error: function(jqxhr){
                console.log(jqxhr.responseText);
            }
        })
    }

    devis_saisie();
    devis_reponse();
    devis_valide();
    devis_refuse();
    
    //VIEW
    $('#btn_valide_devis').on('click', function(e){
        e.preventDefault();
        var a = $(this);
        var url = a.attr('href');
        a.html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax(url)
            .done(function(data){
                if(data == 200){
                    toastr.success("Le devis est maintenant <strong>en attente de réponse Client</strong>");
                    location.reload();
                }
                if(data == 201){
                    toastr.success("Le devis est maintenant <strong>Accepter</strong>");
                    location.reload();
                }
                if(data == 202){
                    toastr.success("Le devis est maintenant <strong>Refuser</strong>");
                    location.reload();
                }
                if(data == 203){
                    toastr.success("Le devis est maintenant <strong>Transformer en devis</strong>");
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