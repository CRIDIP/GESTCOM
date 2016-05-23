/**
 * Created by SWD on 29/02/2016.
 */
function ajax(){
    /** VERIFICATION A LA CONNEXION DE L'UTILISATEUR **/
    $.ajax({
        url: "../../../controller/user.ajax.php?action=check-message",
        dataType: "json",
        type: "GET",
        success:function(data){
            /*if(data >= 1){
             $('#count_mail').replaceWith('<span id="count_mail" class="badge badge-primary badge-header">'+data+'</span>');
             $('#count_mail_title').replaceWith('<p class="pull-left" id="count_mail_title">Vous avez '+data+' messages non lu</p>');
             toastr.info("Vous avez "+data+" Message non lu !", "MESSAGERIE");
             }else{
             $('#count_mail').remove();
             $('#count_mail_title').replaceWith('<p class="pull-left" id="count_mail_title">Aucun nouveau mail</p>');
             }*/
            if(count_message() != data){
                if(data >= 1){
                    $('#count_mail').replaceWith('<span id="count_mail" class="badge badge-primary badge-header">'+data+'</span>');
                    $('#count_mail_title').replaceWith('<p class="pull-left" id="count_mail_title">Vous avez '+data+' messages non lu</p>');
                    toastr.info("Vous avez "+data+" Message non lu !", "MESSAGERIE");
                }else{
                    $('#count_mail').remove();
                    $('#count_mail_title').replaceWith('<p class="pull-left" id="count_mail_title">Aucun nouveau mail</p>');
                }
            }else{
                return false;
            }
        },
        error:function(jqxhr){
            console.log(jqxhr.responseText);
        }
    });
    $.ajax({
        url: "../../../controller/user.ajax.php?action=check-notif",
        dataType: "json",
        type: "GET",
        success: function(data){
            /*if(data >= 1){
                $('#count_notif').replaceWith('<span id="count_notif" class="badge badge-danger badge-header">'+data+'</span>');
                $('#count_notif_title').replaceWith('<p class="pull-left" id="count_notif_title">'+data+' Notification en attente</p>');
                toastr.info("Vous avez une nouvelle notification !");
            }else{
                $('#count_notif').remove();
                $('#count_notif_title').replaceWith('<p class="pull-left" id="count_notif_title">'+data+' Notification en attente</p>');

            }*/
            if(count_notif() != data){
                if(data >= 1){
                    $('#count_notif').replaceWith('<span id="count_notif" class="badge badge-danger badge-header">'+data+'</span>');
                    $('#count_notif_title').replaceWith('<p class="pull-left" id="count_notif_title">'+data+' Notification en attente</p>');
                    toastr.info("Vous avez une nouvelle notification !");
                }else{
                    $('#count_notif').remove();
                    $('#count_notif_title').replaceWith('<p class="pull-left" id="count_notif_title">'+data+' Notification en attente</p>');

                }
            }else{
                return false;
            }
        },
        error: function(jqxhr){
            console.log(jqxhr.responseText);
        }
    });
}