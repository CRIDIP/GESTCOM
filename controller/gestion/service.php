<?php
if(isset($_POST['action']) && $_POST['action'] == 'add_service'){
    require "../../application/classe.php";
    $idclient = $_POST['idclient'];
    $nom_service = htmlentities(addslashes($_POST['nom_service']));
    $desc_service = htmlentities(addslashes($_POST['desc_service']));
    $num_serie = $_POST['num_serie'];
    $serial_key = $_POST['serial_key'];
    $date_debut = strtotime($_POST['date_debut']);
    $date_fin = strtotime($_POST['date_fin']);
    $etat_service = $_POST['etat_service'];

    $service_i = $DB->execute("INSERT INTO client_service(idclient, nom_service, desc_service, num_serie, serial_key, date_debut, date_fin, etat_service) VALUE(:idclient, :nom_service, :desc_service, :num_serie, :serial_key, :date_debut, :date_fin, :etat_service)", array(
        "idclient"          => $idclient,
        "nom_service"       => $nom_service,
        "desc_service"      => $desc_service,
        "num_serie"         => $num_serie,
        "serial_key"        => $serial_key,
        "date_debut"        => $date_debut,
        "date_fin"          => $date_fin,
        "etat_service"      => $etat_service
    ));

    if($service_i == 1){
        $text = "Le Service <strong>$nom_service</strong> à été ajouter.";
        header("Location: ../../view/gestion/index.php?view=service&sub=view&num_serie=$num_serie&success=add_service&text=$text");
    }else{
        var_dump($service_i);
        die("Veuillez contacter l'administrateur par mail à support@cridip.com et lui envoyer ce log ci-dessus");
    }

}