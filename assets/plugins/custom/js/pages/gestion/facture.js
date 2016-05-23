/**
 * Created by SWD on 21/03/2016.
 */
(function($){

    $('#liste_facture').dataTable({
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0]
        }],
        language:{
            url: "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
        }
    });
    
    $('table #supp_facture').on('click', function(e){
        e.preventDefault();
        var a = $(this);
        var url = a.attr('href');
        a.html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax(url)
            .done(function(data){
                a.parents('tr').fadeOut();
                if(data == 1){toastr.success("La facture à bien été supprimer", "SUCCES");}
                if(data == 2){toastr.warning("Les articles de la facture ont été supprimer mais la facture en elle même n'est pas supprimer !", "ATTENTION");}
                if(data == 3){toastr.warning("La facture à été supprimer mais les articles associés sont toujours présent en base de donnée !", "ATTENTION");}
                if(data == 4){toastr.error("Une erreur à eu lieu lors de la suppression de la facture et de ses articles associés !", "ERREUR");}
            })
            .fail(function(jqxhr){
                toastr.error("Une erreur à eu lieu lors de l'envoie des paramètres de la requète !");
                console.log(jqxhr.responseText);
            })
            .always(function(){
                a.html('<i class="icon-trash"></i>');
            })
    });

    function facture_saisie() {
        $.ajax('../../../../../controller/gestion/facture.ajax.php?action=facture_saisie', {
            dataType: "json",
            type: "GET",
            success: function(data){
                $('#facture_saisie').text(data);
            },
            error: function(jqxhr){
                console.log(jqxhr.responseText);
            }
        })
    }

    function facture_attente() {
        $.ajax('../../../../../controller/gestion/facture.ajax.php?action=facture_attente', {
            dataType: "json",
            type: "GET",
            success: function(data){
                $('#facture_attente').text(data);
            },
            error: function(jqxhr){
                console.log(jqxhr.responseText);
            }
        })
    }
    function facture_partiel_paye() {
        $.ajax('../../../../../controller/gestion/facture.ajax.php?action=facture_partiel_paye', {
            dataType: "json",
            type: "GET",
            success: function(data){
                $('#facture_partiel_paye').text(data);
            },
            error: function(jqxhr){
                console.log(jqxhr.responseText);
            }
        })
    }
    function facture_paye() {
        $.ajax('../../../../../controller/gestion/facture.ajax.php?action=facture_paye', {
            dataType: "json",
            type: "GET",
            success: function(data){
                $('#facture_paye').text(data);
            },
            error: function(jqxhr){
                console.log(jqxhr.responseText);
            }
        })
    }
    function facture_retard() {
        $.ajax('../../../../../controller/gestion/facture.ajax.php?action=facture_retard', {
            dataType: "json",
            type: "GET",
            success: function(data){
                $('#facture_retard').text(data);
            },
            error: function(jqxhr){
                console.log(jqxhr.responseText);
            }
        })
    }
    function facture_contentieux() {
        $.ajax('../../../../../controller/gestion/facture.ajax.php?action=facture_contentieux', {
            dataType: "json",
            type: "GET",
            success: function(data){
                $('#facture_contentieux').text(data);
            },
            error: function(jqxhr){
                console.log(jqxhr.responseText);
            }
        })
    }

    
    //VIEW
    $('#btn_valide_facture').on('click', function(e){
        e.preventDefault();
        var a = $(this);
        var url = a.attr('href');
        a.html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax(url)
            .done(function(data){
                if(data == 200){
                    toastr.success("La facture est maintenant <strong>en attente de reglement</strong>");
                    location.reload();
                }
                if(data == 201){
                    toastr.success("La facture est maintenant <strong>Partiellement payer</strong>");
                    location.reload();
                }
                if(data == 202){
                    toastr.success("La facture est maintenant <strong>Payer</strong>");
                    location.reload();
                }
                if(data == 203){
                    toastr.success("La facture est maintenant <strong>en retard de reglement</strong>");
                    location.reload();
                }
                if(data == 204){
                    toastr.success("La facture est <strong>envoyer au contentieux</strong>");
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