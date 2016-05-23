/**
 * Created by SWD on 29/02/2016.
 */
function count_message(){
    $.ajax({
        url: "../../../controller/user.ajax.php?action=check-message",
        dataType: "json",
        type: "GET",
        success: function (data) {
            return data;
        },
        error: function (jqxhr) {
            console.log(jqxhr.responseText);
        }
    });
}
function count_notif(){
    $.ajax({
        url: "../../../controller/user.ajax.php?action=check-notif",
        dataType: "json",
        type: "GET",
        success: function (data) {
            return data;
        },
        error: function (jqxhr) {
            console.log(jqxhr.responseText);
        }
    });
}