(function($){
    /*
    Utilisation de plugin tiers
     */
    $('#description_input').maxlength({
        alwaysShow: true,
        warningClass: "label label-info",
        limitReachedClass: "label label-warning",
        placement: 'top',
        message: '%charsTyped% / %charsTotal% caractères.'
    });
    $("#edit-password-email").validate({
       rules: {
           password2: {equalTo: '#password'}
       },
       message:{
           password: {required: "Indiquer votre nouveau mot de passe"},
           password2: {required: "Indiquer votre nouveau mot de passe", equalTo: "Les mots de passes doivent être identique !"}
       }
    });
    /*
    Fin utilisation plugin tiers
     */

    $('li').on('click', '#ajax_cross',function (e) {
        e.preventDefault();
        var a = $(this);
        var url = a.attr('href');
        $('#ajax_email').html('<div class="loader text-center"></div>');
        $.getJSON(url)
            .done(function(data){
                $('#ajax_email').html(data);
            })
            .fail(function(data){
                console.log(data);
            })
    });

    $("#supp-email-account").on('click', function(e){
        e.preventDefault();
        var button = $(this);
        var url = button.attr("href");
        button.html("<img src='../../../../../images/preloader/loader_ajax.gif' />");
        $.ajax(url)
            .done(function(data){
                if(data == 200){
                    button.parents('tr').fadeOut();
                    toastr.success("Le compte email à bien été supprimer");
                }
                if(data == 300){
                    toastr.error("Erreur lors de la suppression du compte EMAIL !");
                }
            })
            .fail(function(jqxhr){
                console.log(jqxhr.responseText);
            })
    })
})(jQuery);