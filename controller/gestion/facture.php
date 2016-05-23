<?php
if(isset($_POST['action']) && $_POST['action'] == 'add_facture')
{
    session_start();
    require "../../application/classe.php";
    $idclient = $_POST['idclient'];
    $num_facture = "FCT".date("Ym").rand(100,999);
    $date_facture = strtotime($_POST['date_facture']);
    $total_facture = 0;
    $etat_facture = 0;
    

    $facture_i = $DB->execute("INSERT INTO facture(num_commande, num_facture, idclient, date_facture, total_facture, etat_facture) VALUES (:num_commande, :num_facture, :idclient, :date_facture, :total_facture, :etat_facture)", array(
        "num_commande"  => "",
        "num_facture"   => $num_facture,
        "idclient"      => $idclient,
        "date_facture"  => $date_facture,
        "total_facture" => $total_facture,
        "etat_facture"  => $etat_facture
    ));

    if($facture_i == 1){
        $text = "La facture <strong>$num_facture</strong> à été ajouter.";
        header("Location: ../../view/gestion/index.php?view=facture&sub=view&num_facture=$num_facture&success=add_facture&text=$text");
    }else{
        var_dump($facture_i);
        die("Veuillez contacter l'administrateur par mail à support@cridip.com et lui envoyer ce log ci-dessus");
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'add_article')
{
    require "../../application/classe.php";
    $num_facture = $_POST['num_facture'];
    $idarticle = $_POST['idarticle'];
    $qte = $_POST['qte'];
    $description_sup = htmlentities(addslashes($_POST['description_sup']));

    $facture = $DB->query("SELECT * FROM facture WHERE num_facture = :num_facture", array("num_facture" => $num_facture));
    $total_facture = $facture[0]->total_facture;

    $article = $DB->query("SELECT * FROM article WHERE idarticle = :idarticle", array("idarticle" => $idarticle));
    $total_ligne = $article[0]->prix_ht * $qte;

    $article_i = $DB->execute("INSERT INTO facture_article(num_facture, idarticle, description_sup, qte, total_ligne) VALUES (:num_facture, :idarticle, :description_sup, :qte, :total_ligne)", array(
        "num_facture"   => $num_facture,
        "idarticle"     => $idarticle,
        "description_sup"=> $description_sup,
        "qte"           => $qte,
        "total_ligne"   => $total_ligne
    ));

    $facture_u = $DB->execute("UPDATE facture SET total_facture = :total_facture WHERE num_facture = :num_facture", array(
        "num_facture"     => $num_facture,
        "total_facture"   => $total_facture + $total_ligne
    ));

    if($article_i == 1){
        $text = "L'article <strong></strong> à été ajouté à la facture.";
        header("Location: ../../view/gestion/index.php?view=facture&sub=view&num_facture=$num_facture&success=add_article&text=$text");
    }else{
        var_dump($article_i);
        die("Veuillez contacter l'administrateur par mail à support@cridip.com et lui envoyer ce log ci-dessus");
    }


}