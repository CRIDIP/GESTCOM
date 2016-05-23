/**
 * Created by Maxime on 27/02/2016.
 */
/** VERIFICATION A LA CONNEXION DE L'UTILISATEUR **/
function check_message() {
    $.ajax({
        url: "../../../controller/user.ajax.php?action=check-message",
        dataType: "json",
        type: "GET",
        success: function (data) {
            if (data >= 1) {
                $('#count_mail').replaceWith('<span id="count_mail" class="badge badge-primary badge-header">' + data + '</span>');
                $('#count_mail_title').replaceWith('<p class="pull-left" id="count_mail_title">Vous avez ' + data + ' messages non lu</p>');
                toastr.info("Vous avez " + data + " Message non lu !", "MESSAGERIE");
            } else {
                $('#count_mail').remove();
                $('#count_mail_title').replaceWith('<p class="pull-left" id="count_mail_title">Aucun nouveau mail</p>');
            }
        },
        error: function (jqxhr) {
            console.log(jqxhr.responseText);
        }
    });
}
function check_notif() {
    $.ajax({
        url: "../../../controller/user.ajax.php?action=check-notif",
        dataType: "json",
        type: "GET",
        success: function (data) {
            if (data >= 1) {
                $('#count_notif').replaceWith('<span id="count_notif" class="badge badge-danger badge-header">' + data + '</span>');
                $('#count_notif_title').replaceWith('<p class="pull-left" id="count_notif_title">' + data + ' Notification en attente</p>');
                toastr.info("Vous avez une nouvelle notification !");
            } else {
                $('#count_notif').remove();
                $('#count_notif_title').replaceWith('<p class="pull-left" id="count_notif_title">' + data + ' Notification en attente</p>');
            }
        },
        error: function (jqxhr) {
            console.log(jqxhr.responseText);
        }
    });
}