<?php
function is_ajax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
if(is_ajax()){
    if(isset($_GET['action']) && $_GET['action'] == 'count_client')
    {
        session_start();
        require "../../application/classe.php";

        $count_c = $DB->count("SELECT COUNT(idclient) FROM client");

        echo json_encode($count_c);
    }
    if(isset($_GET['action']) && $_GET['action'] == 'count_article')
    {
        session_start();
        require "../../application/classe.php";

        $count_c = $DB->count("SELECT COUNT(idarticle) FROM article");

        echo json_encode($count_c);
    }
    if(isset($_GET['action']) && $_GET['action'] == 'count_devis')
    {
        session_start();
        require "../../application/classe.php";

        $count_c = $DB->count("SELECT COUNT(iddevis) FROM devis");

        echo json_encode($count_c);
    }
    if(isset($_GET['action']) && $_GET['action'] == 'count_commande')
    {
        session_start();
        require "../../application/classe.php";

        $count_c = $DB->count("SELECT COUNT(idcommande) FROM commande");

        echo json_encode($count_c);
    }
    if(isset($_GET['action']) && $_GET['action'] == 'count_facture')
    {
        session_start();
        require "../../application/classe.php";

        $count_c = $DB->count("SELECT COUNT(idfacture) FROM facture");

        echo json_encode($count_c);
    }
}