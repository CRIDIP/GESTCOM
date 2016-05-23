<?php
function is_ajax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
if(is_ajax()){
    if(isset($_GET['action']) && $_GET['action'] == 'renew_service'){
        require "../../application/classe.php";
        $idclientservice = $_GET['idclientservice'];

        $sql_service = $DB->query("SELECt * FROM client_service WHERE idclientservice = :idclientservice", array("idclientservice" => $idclientservice));
        $service = $sql_service[0];

        $sql_renew = $DB->execute("UPDATE client_service SET date_debut = :date_debut, date_fin = :date_fin WHERE idclientservice = :idclientservice", array(
            "date_debut"        => $date_format->date_jour_strt(),
            "date_fin"          => $date_format->ech_365($date_format->date_jour_strt()),
            "idclientservice"   => $idclientservice
        ));

        if($sql_renew == 1){
            $service_u = $DB->execute("UPDATE client_service SET etat_service = 1 WHERE idclientservice = :idclientservice", array("idclientservice" => $idclientservice));
            echo json_encode(200);
        }else{
            echo json_encode(300);
        }
    }
}