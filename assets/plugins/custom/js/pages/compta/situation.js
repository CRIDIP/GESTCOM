/**
 * Created by SAS CRIDIP on 01/04/2016.
 */
(function($) {

})(jQuery);
function check_client(){
    var code_tiers = document.getElementById("select_client").value;
    var url = "https://gestcom.cridip.com/controller/compta/situation.ajax.php?action=defcon&code_tiers="+code_tiers;
    $.ajax(url)
        .done(function(data){
            $("#situation_result").html("" +
                "<div class='panel'>" +
                "<div class='panel-header'><h3>Situation client - Solde</h3></div>" +
                "<div class='panel-content text-center'><h1>"+data+"</h1></div>" +
                "</div>"
            )
        })
        .fail(function(jqxhr){
            console.log(jqxhr.responseText);
        })
}