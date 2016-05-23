(function($){
    $('#affiche_cheque').hide();
    $('#affiche_paypal').hide();
    $('table #supp_rglt').on('click', function(e){
        e.preventDefault();
        var a = $(this);
        var url = a.attr('href');
        a.html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax(url)
            .done(function(data){
                if(data == 200){
                    a.parents('tr').fadeOut();
                    toastr.success("Le reglement à été supprimer");
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
function changeType(){
    var type = document.getElementById("type_reglement").value;

    if(type == "2")
    {
        $('#affiche_cheque').show();
    }else{
        $("#affiche_cheque").hide();
    }

    if(type == "3"){
        $('#affiche_paypal').show();
    }else{
        $("#affiche_paypal").hide();
    }
}