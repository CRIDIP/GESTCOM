/**
 * Created by SWD on 29/02/2016.
 */
$(document).ready(function(){
    $('.page-content').addClass("page-app page-profil");
    $('#edit-profil').validate({
        rules:{
            nom_user: "required",
            prenom_user: "required"
        }
    });
})(jQuery);