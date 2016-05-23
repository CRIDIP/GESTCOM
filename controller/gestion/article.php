<?php
if(isset($_POST['action']) && $_POST['action'] == 'add_famille')
{
    session_start();
    require "../../application/classe.php";
    $designation_famille = htmlentities(addslashes($_POST['designation_famille']));

    $article_i = $DB->execute("INSERT INTO famille_article(idfamille, designation_famille) VALUES (NULL, :designation_famille)", array(
        "designation_famille"   => $designation_famille
    ));

    if($article_i == 1){
        $text="La famille <strong></strong> à été ajouter avec succès";
        header("Location: ../../view/gestion/index.php?view=article&success=add_famille&text=$text");
    }else{
        var_dump($article_i);
        die("Veuillez contacter l'administrateur par mail à support@cridip.com et lui envoyer ce log ci-dessus");
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'add_article')
{
    session_start();
    require "../../application/classe.php";
    $idfamille = $_POST['idfamille'];
    $designation_article = htmlentities(addslashes($_POST['designation_article']));
    $prix_ht = $_POST['prix_ht'];

    $num_article = "ART".rand(100, 9999999);

    if($_POST['stock']){$stock = 1;}else{$stock = 0;}
    if($_POST['stock']){$nb_stock = $_POST['nb_stock'];}

    $article_i = $DB->execute("INSERT INTO article(idarticle, num_article, idfamille, designation_article, prix_ht, stock, nb_stock) VALUES (NULL, :num_article, :idfamille, :designation_article, :prix_ht, :stock, :nb_stock)", array(
        "num_article"           => $num_article,
        "idfamille"             => $idfamille,
        "designation_article"   => $designation_article,
        "prix_ht"               => $prix_ht,
        "stock"                 => $stock,
        "nb_stock"              => $nb_stock
    ));

    if($article_i == 1){
        $text="L'article <strong>".$designation_article."</strong> à été ajouter avec succès";
        header("Location: ../../view/gestion/index.php?view=article&success=add_article&text=$text");
    }else{
        var_dump($article_i);
        die("Veuillez contacter l'administrateur par mail à support@cridip.com et lui envoyer ce log ci-dessus");
    }
}