<?php
if(isset($_POST['action']) && $_POST['action'] == 'sent-mail')
{
    session_start();
    require "../application/classe.php";

    $expediteur = $_POST['expediteur'];
    $destinataire = $_POST['destinataire'];
    $sujet = htmlentities(addslashes($_POST['sujet']));
    $message = htmlentities(addslashes($_POST['message']));
    $date_message = $date_format->format_strt(date("d-m-Y H:i:s"));

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
        $fonction->redirect("mailbox", "", "", "success", "sent-mail", "Le mail à bien été envoyer");
    }elseif($mailbox == 1 AND $sentbox == 0){
        $fonction->redirect("mailbox", "", "", "warning", "sent-mail", "Le mail à bien été envoyer mais le systeme sentbox à retourner une erreur");
    }elseif($mailbox == 0 AND $sentbox == 1){
        $fonction->redirect("mailbox", "", "", "warning", "sent-mail", "Le mail à bien été enregistrer dans le systeme sentbox mais l'envoie inbox à retourner une erreur");
    }else{
        $fonction->redirect("mailbox", "", "", "error", "sent-mail", "Une erreur à eu lieu lors de l'envoie du mail");
    }

}