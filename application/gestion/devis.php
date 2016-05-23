<?php
/**
 * Created by PhpStorm.
 * User: SWD
 * Date: 22/03/2016
 * Time: 20:05
 */

namespace App\gestion;


use App\general\db;

class devis
{
    public function nb_article_devis($num_devis){
        $db = new db();
        $sm = $db->count("SELECT COUNT(iddevisarticle) FROM devis_article WHERE num_devis = :num_devis", array("num_devis" => $num_devis));
        return $sm[0];
    }

    public function etat_article_devis($num_devis){
        $db = new db();
        $sql_article = $db->count("SELECT COUNT(devis_article.idarticle) FROM devis_article, article WHERE devis_article.idarticle = article.idarticle AND stock = 1 AND article.nb_stock = 0 AND devis_article.num_devis = :num_devis", array("num_devis" => $num_devis));
        $art = $sql_article[0];
        return $art;
    }
    
    public function total_article_famille($idfamille, $num_devis){
        $db = new db();
        $sql = $db->count("SELECt COUNT(iddevisarticle) FROM devis_article, article, famille_article WHERE devis_article.idarticle = article.idarticle AND article.idfamille = famille_article.idfamille AND article.idfamille = :idfamille AND devis_article.num_devis = :num_devis", array(
            "num_devis"     => $num_devis,
            "idfamille"     => $idfamille
        ));
        $sm = $sql[0];
        return $sm;
    }

    public function total_famille_article($idfamille, $num_devis){
        $db = new db();
        $sql = $db->query("SELECT SUM(total_ligne) as total_ligne FROM devis_article, article WHERE devis_article.idarticle = article.idarticle AND article.idfamille = :idfamille AND devis_article.num_devis = :num_devis", array("idfamille" => $idfamille, "num_devis" => $num_devis));
        $sm = $sql[0]->total_ligne;
        return $sm;
    }
}