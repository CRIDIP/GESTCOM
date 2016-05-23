<?php
function is_ajax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
if(is_ajax()){
    if(isset($_GET['action']) && $_GET['action'] == 'supp-famille')
    {
        session_start();
        require "../../application/classe.php";
        $idfamille = $_GET['idfamille'];

        $count_article = $DB->count("SELECT COUNT(idarticle) FROM article WHERE idfamille = :idfamille", array("idfamille" => $idfamille));

        if($count_article != 0){
            echo json_encode(300);
        }else{
            $famille_d = $DB->execute("DELETE FROM famille_article WHERE idfamille = :idfamille", array("idfamille" => $idfamille));

            if($famille_d == 1){
                echo json_encode(200);
            }else{
                echo json_encode(600);
            }
        }
    }
    
    if(isset($_GET['action']) && $_GET['action'] == 'supp-article')
    {
        session_start();
        require "../../application/classe.php";
        $idarticle = $_GET['idarticle'];

        $count_devis = $DB->count("SELECT COUNT(idarticle) FROM devis_article WHERE idarticle = :idarticle", array("idarticle" => $idarticle));
        $count_cmd = $DB->count("SELECT COUNT(idarticle) FROM commande_article WHERE idarticle = :idarticle", array("idarticle" => $idarticle));
        $count_fct = $DB->count("SELECT COUNT(idarticle) FROM facture_article WHERE idarticle = :idarticle", array("idarticle" => $idarticle));

        if($count_devis != 0){echo json_encode(300);}
        if($count_cmd != 0){echo json_encode(301);}
        if($count_fct != 0){echo json_encode(302);}

        $article_d = $DB->execute("DELETE FROM article WHERE idarticle = :idarticle", array("idarticle" => $idarticle));

        if($article_d == 1){
            echo json_encode(200);
        }else{
            echo json_encode(600);
        }
    }
}