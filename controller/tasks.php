<?php
if(isset($_POST['action']) && $_POST['action'] == 'add-task'){
    require "../application/classe.php";
    $iduser = $_POST['iduser'];
    $titre_tache = htmlentities(addslashes($_POST['titre_tache']));
    $desc_tache = htmlentities(addslashes($_POST['desc_tache']));
    $date_limit = strtotime($_POST['date_limit']);
    $urgence = $_POST['urgence'];

    $date_created = $date_format->date_jourheure_strt();
    $etat = 0;

    $task_add = $DB->execute("INSERT INTO collab_task(iduser, titre_tache, desc_tache, date_created, date_limit, urgence, etat) VALUES (:iduser, :titre_tache, :desc_tache, :date_created, :date_limit, :urgence, :etat)", array(
        "iduser"        => $iduser,
        "titre_tache"   => $titre_tache,
        "desc_tache"    => $desc_tache,
        "date_created"  => $date_created,
        "date_limit"    => $date_limit,
        "urgence"       => $urgence,
        "etat"          => $etat
    ));

    if($task_add == 1){
        $text = "La tache <strong>".$titre_tache."</strong> à été créer.";
        header("Location: ../../index.php?view=tasks&success=add-task&text=$text");
    }else{
        var_dump($task_add);
        die("ERREUR ! Envoyer ce log à l'administrateur Système");
    }
}
if(isset($_GET['action']) && $_GET['action'] == 'complete-task'){
    require "../application/classe.php";
    $idtask = $_GET['idtask'];

    $task_up = $DB->execute("UPDATE collab_task SET etat = 1 WHERE idtask = :idtask", array("idtask" => $idtask));

    if($task_up == 1){
        $text = "La tache <strong>".$idtask."</strong> à été Compléter.";
        header("Location: ../../index.php?view=tasks&success=complete-task&text=$text");
    }else{
        var_dump($task_up);
        die("ERREUR ! Envoyer ce log à l'administrateur Système");
    }
}
