<?php
if(isset($_POST['action']) && $_POST['action'] == 'add_devis')
{
    session_start();
    require "../../application/classe.php";
    $idclient = $_POST['idclient'];
    $num_devis = "DVS".date("Ym").rand(100,999);
    $date_devis = strtotime($_POST['date_devis']);
    $total_devis = 0;
    $etat_devis = 0;
    $explication = htmlentities(addslashes($_POST['explication']));
    

    $devis_i = $DB->execute("INSERT INTO devis(iddevis, idclient, num_devis, date_devis, total_devis, etat_devis, explication) VALUES (NULL, :idclient, :num_devis, :date_devis, :total_devis, :etat_devis, :explication)", array(
        "idclient"      => $idclient,
        "num_devis"     => $num_devis,
        "date_devis"    => $date_devis,
        "total_devis"   => $total_devis,
        "etat_devis"    => $etat_devis,
        "explication"   => $explication
    ));

    if($devis_i == 1){
        $text = "Le devis <strong>$num_devis</strong> à été ajouter.";
        header("Location: ../../view/gestion/index.php?view=devis&sub=view&num_devis=$num_devis&success=add_devis&text=$text");
    }else{
        var_dump($devis_i);
        die("Veuillez contacter l'administrateur par mail à support@cridip.com et lui envoyer ce log ci-dessus");
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'add_article')
{
    require "../../application/classe.php";
    $num_devis = $_POST['num_devis'];
    $idarticle = $_POST['idarticle'];
    $qte = $_POST['qte'];

    $devis = $DB->query("SELECT * FROM devis WHERE num_devis = :num_devis", array("num_devis" => $num_devis));
    $total_devis = $devis[0]->total_devis;

    $article = $DB->query("SELECT * FROM article WHERE idarticle = :idarticle", array("idarticle" => $idarticle));
    $total_ligne = $article[0]->prix_ht * $qte;

    $article_i = $DB->execute("INSERT INTO devis_article(iddevisarticle, num_devis, idarticle, qte, total_ligne) VALUES (NULL, :num_devis, :idarticle, :qte, :total_ligne)", array(
        "num_devis"     => $num_devis,
        "idarticle"     => $idarticle,
        "qte"           => $qte,
        "total_ligne"   => $total_ligne
    ));

    $devis_u = $DB->execute("UPDATE devis SET total_devis = :total_devis WHERE num_devis = :num_devis", array(
        "num_devis"     => $num_devis,
        "total_devis"   => $total_devis + $total_ligne
    ));

    if($article_i == 1){
        $text = "L'article <strong></strong> à été ajouté au devis.";
        header("Location: ../../view/gestion/index.php?view=devis&sub=view&num_devis=$num_devis&success=add_article&text=$text");
    }else{
        var_dump($article_i);
        die("Veuillez contacter l'administrateur par mail à support@cridip.com et lui envoyer ce log ci-dessus");
    }


}