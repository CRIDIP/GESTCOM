<?php
function is_ajax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
if(is_ajax()){
    if(isset($_GET['action']) && $_GET['action'] == 'supp-event')
    {
        session_start();
        require "../application/classe.php";
        $iduser = $user->iduser;
        $idevent = $_GET['idevent'];

        $event_u = $DB->execute("DELETE FROM collab_event WHERE idevent = :idevent", array("idevent" => $idevent));

        if($event_u == 1)
        {
            echo json_encode(200);
        }else{
            echo json_encode(500);
        }
    }
}