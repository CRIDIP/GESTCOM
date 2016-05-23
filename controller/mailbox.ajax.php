<?php
function is_ajax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
if(is_ajax()){
    if(isset($_GET['action']) && $_GET['action'] == 'count_new_mail')
    {
        session_start();
        require "../application/classe.php";
        $iduser = $user->iduser;

        $user_q = $DB->count("SELECT COUNT(idinbox) FROM collab_inbox WHERE destinataire = :iduser AND lu = 0", array("iduser" => $iduser));

        echo json_encode($user_q);
    }
    if(isset($_GET['action']) && $_GET['action'] == 'view_message')
    {
        session_start();
        require "../application/classe.php";
        $idinbox = $_GET['idinbox'];

        $fonction->redirect("mailbox", "message&idinbox=$idinbox", "", "", "", "");
    }
    if(isset($_GET['action']) && $_GET['action'] == 'supp-mail')
    {
        session_start();
        require "../application/classe.php";
        $idinbox = $_GET['idinbox'];

        $mail_d = $DB->execute("DELETE FROM collab_inbox WHERE idinbox = :idinbox", array("idinbox" => $idinbox));

        if($mail_d == 1){
            echo json_encode(200);
        }else{
            echo json_encode(500);
        }
    }
    if(isset($_GET['action']) && $_GET['action'] == 'supp-mail-sent')
    {
        session_start();
        require "../application/classe.php";
        $idsentbox = $_GET['idsentbox'];

        $mail_d = $DB->execute("DELETE FROM collab_sentbox WHERE idsentbox = :idsentbox", array("idsentbox" => $idsentbox));

        if($mail_d == 1){
            echo json_encode(200);
        }else{
            echo json_encode(500);
        }
    }
    if(isset($_POST['action']) && $_POST['action'] == 'sent-mail')
    {
        session_start();
        require "../application/classe.php";

        $expediteur = $_POST['expediteur'];
        $destinataire = $_POST['destinataire'];
        $sujet = $_POST['sujet'];
        $message = $_POST['message'];
        $date_message = $date_format->date_jour_strt();

        $mailbox = $DB->execute("INSERT INTO collab_inbox(idinbox, destinataire, expediteur, sujet, message, date_message, importance, lu) VALUES (NULL, :destinataire, :expediteur, :sujet, :message, :date_message, :importance, :lu)", array(
            "destinataire"  => $destinataire,
            "expediteur"    => $expediteur,
            "sujet"         => $sujet,
            "message"       => $message,
            "date_message"  => $date_message,
            "importance"    => 0,
            "lu"            => 0
        ));

        $sentbox = $DB->execute("INSERT INTO collab_sentbox(idsentbox, destinataire, expediteur, sujet, message, date_message, importance) VALUES (NULL, :destinataire, :expediteur, :sujet, :message, :date_message, :importance)", array(
            "destinataire"  => $destinataire,
            "expediteur"    => $expediteur,
            "sujet"         => $sujet,
            "message"       => $message,
            "date_message"  => $date_message,
            "importance"    => 0
        ));

        if($mailbox == 1 AND $sentbox == 1){
            echo json_encode(200);
        }elseif($mailbox == 1 AND $sentbox == 0){
            echo json_encode(201);
        }elseif($mailbox == 0 AND $sentbox == 1){
            echo json_encode(202);
        }else{
            echo json_encode(500);
        }



    }
}