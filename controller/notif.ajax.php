<?php
function is_ajax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
if(is_ajax()){
    if(isset($_GET['action']) && $_GET['action'] == 'supp-notif')
    {
        require "../application/classe.php";
        $notif_purge = $DB->execute("DELETE FROM notif");

        echo json_encode($notif_purge);
    }
}