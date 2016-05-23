//****************** YOUR CUSTOMIZED JAVASCRIPT **********************//

(function($){
    /** AJAX USER */
    $('#connector').on('click', function(e){
        e.preventDefault();
        var a = $(this);
        var url = a.attr('href');
        var data = url;
        data = $(this).serializeArray(data);
        var stap = $("#stap");

        $.ajax({
            type: "GET",
            dataType: "json",
            url: url,
            data: data,
            success: function(data, jqxhr){
                if(data == 0){
                    stap.replaceWith('<i class="busy"></i><span>Hors Ligne</span><i class="fa fa-angle-down"></i>');
                    a.replaceWith('<a href="controller/user.ajax.php?action=connector&connect=2" id="connector"><i class="online"></i><span>En Ligne</span></a>');
                    toastr.info("Vous êtes maintenant Hors Ligne !");
                }
                if(data == 2){
                    stap.replaceWith('<i class="online"></i><span>En Ligne</span><i class="fa fa-angle-down"></i>');
                    a.replaceWith('<a href="controller/user.ajax.php?action=connector&connect=0" id="connector"><i class="busy"></i><span>Hors Ligne</span></a>');
                    toastr.info("Vous êtes maintenant En Ligne !");
                }


            },
            error: function(jqxhr){
                console.log(jqxhr);
            }
        })
    });

    /** AJAX NOTIF **/
    $('#notif-suppression').on('click', function(e){
        e.preventDefault();
        var a = $(this);
        var url = a.attr('href');
        var data = url;
        data = $(this).serializeArray(data);

        $.ajax({
            type: "GET",
            dataType: "json",
            url: url,
            data: data,
            success: function(data){
              while(data){
                  $('#timeline').fadeOut();
              }
              toastr.success("Les notification ont bien été supprimer !","Suppression des Notifications");
            },
            fail: function (jqxhr) {
                console.log(jqxhr);
            }
        })
    })

})(jQuery);