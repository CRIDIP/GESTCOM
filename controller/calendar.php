<?php
if(isset($_POST['action']) && $_POST['action'] == 'add-event')
{
    session_start();
    require "../application/classe.php";
    $iduser = $_POST['iduser'];
    $titre_event = htmlentities(addslashes($_POST['titre_event']));
    $lieu_event = htmlentities(addslashes($_POST['lieu_event']));
    $desc_event = htmlentities(addslashes($_POST['desc_event']));
    $start_event = strtotime($_POST['start_event']);
    $end_event = strtotime($_POST['end_event']);

    if($iduser === 'all'){
        $user_q = $DB->query("SELECT * FROM users WHERE groupe != 4");
        $i=0;
        foreach($user_q as $users)
        {
            
        }
    }else{
        $user_i = $DB->execute("INSERT INTO collab_event(idevent, iduser, titre_event, lieu_event, desc_event, start_event, end_event) VALUES (NULL, :iduser, :titre_event, :lieu_event, :desc_event, :start_event, :end_event)", array(
            "iduser"        => $iduser,
            "titre_event"   => $titre_event,
            "lieu_event"    => $lieu_event,
            "desc_event"    => $desc_event,
            "start_event"   => $start_event,
            "end_event"     => $end_event
        ));
        if($user_i == 1) {
            $fonction->redirect("calendar", "", "", "success", "add-event", "L'évènement <strong>".$titre_event."</strong> à été ajouter avec succès !");
        }else{
            $fonction->redirect("error", "", "", "code", "USR6");
        }
    }
}