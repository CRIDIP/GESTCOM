<?php
if(isset($_POST['action']) && $_POST['action'] == 'add_commande')
{
    session_start();
    require "../../application/classe.php";
    $idclient = $_POST['idclient'];
    $num_commande = "CMD".date("Ym").rand(100,999);
    $date_commande = strtotime($_POST['date_commande']);
    $total_commande = 0;
    $etat_commande = 0;
    

    $commande_i = $DB->execute("INSERT INTO commande(idcommande, num_devis, idclient, num_commande, date_commande, total_commande, etat_commande) VALUES (NULL, :num_devis, :idclient, :num_commande, :date_commande, :total_commande, :etat_commande)", array(
        "idclient"      => $idclient,
        "num_devis"     => "",
        "num_commande"  => $num_commande,
        "date_commande"    => $date_commande,
        "total_commande"   => $total_commande,
        "etat_commande"    => $etat_commande
    ));

    if($commande_i == 1){
        $text = "La commande <strong>$num_commande</strong> à été ajouter.";
        header("Location: ../../view/gestion/index.php?view=commande&sub=view&num_commande=$num_commande&success=add_commande&text=$text");
    }else{
        var_dump($commande_i);
        die("Veuillez contacter l'administrateur par mail à support@cridip.com et lui envoyer ce log ci-dessus");
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'add_article')
{
    require "../../application/classe.php";
    $num_commande = $_POST['num_commande'];
    $idarticle = $_POST['idarticle'];
    $qte = $_POST['qte'];

    $commande = $DB->query("SELECT * FROM commande WHERE num_commande = :num_commande", array("num_commande" => $num_commande));
    $total_commande = $devis[0]->total_commande;

    $article = $DB->query("SELECT * FROM article WHERE idarticle = :idarticle", array("idarticle" => $idarticle));
    $total_ligne = $article[0]->prix_ht * $qte;

    $article_i = $DB->execute("INSERT INTO commande_article(idcommandearticle, num_commande, idarticle, qte, total_ligne) VALUES (NULL, :num_commande, :idarticle, :qte, :total_ligne)", array(
        "num_commande"     => $num_commande,
        "idarticle"     => $idarticle,
        "qte"           => $qte,
        "total_ligne"   => $total_ligne
    ));

    $commande_u = $DB->execute("UPDATE commande SET total_commande = :total_commande WHERE num_commande = :num_commande", array(
        "num_commande"     => $num_commande,
        "total_commande"   => $total_commande + $total_ligne
    ));

    if($article_i == 1){
        $text = "L'article <strong></strong> à été ajouté à la commande.";
        header("Location: ../../view/gestion/index.php?view=commande&sub=view&num_commande=$num_commande&success=add_article&text=$text");
    }else{
        var_dump($article_i);
        die("Veuillez contacter l'administrateur par mail à support@cridip.com et lui envoyer ce log ci-dessus");
    }


}