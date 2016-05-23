<?php
function is_ajax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
if(is_ajax()){
    if(isset($_GET['action']) && $_GET['action'] == 'supp-client')
    {
        session_start();
        require "../../application/classe.php";
        $idclient = $_GET['idclient'];

        $client_d = $DB->execute("DELETE FROM client WHERE idclient = :idclient", array("idclient" => $idclient));
        $user_d = $DB->execute("DELETE FROM users WHERE idclient = :idclient", array("idclient" => $idclient));

        if($client_d == 1 AND $user_d == 1){
            echo json_encode(1);
        }elseif($client_d == 1 AND $user_d == 0){
            echo json_encode(2);
        }elseif($client_d == 0 AND $user_d == 1){
            echo json_encode(3);
        }else{
            echo json_encode(4);
        }
    }
    if(isset($_GET['action']) && $_GET['action'] == 'supp-comm')
    {
        session_start();
        require "../../application/classe.php";
        $idclientmessage = $_GET['idclientmessage'];

        $message_d = $DB->execute("DELETE FROM client_communication WHERE idclientmessage = :idclientmessage", array("idclientmessage" => $idclientmessage));

        if($message_d == 0){
            header("500 Internal Server Error", true, "500");
            die("Erreur envoie ordre serveur");
        }
    }
    if(isset($_GET['action']) && $_GET['action'] == 'call_customer')
    {
        require "../../application/classe.php";
        $tel = $_GET['tel'];
        $content = (object) array(
            "calledNumber"      => "0033633134330"
        );
        $job = $ovh->post("/telephony/ovhtel-32816764-1/line/0033972527971/click2Call", $content);
        echo json_encode($job);
    }
}