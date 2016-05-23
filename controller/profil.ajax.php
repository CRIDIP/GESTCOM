<?php
if(isset($_GET['action']) && $_GET['action'] == 'get_chart')
{
    session_start();
    require "../application/classe.php";
    $iduser = $user->iduser;

    $user_qu = $DB->query("SELECT * FROM user_average WHERE iduser = :iduser", array("iduser" => $iduser));

    $json = $user_qu[0];

    echo json_encode($json);
}