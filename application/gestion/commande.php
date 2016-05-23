<?php
/**
 * Created by PhpStorm.
 * User: SWD
 * Date: 22/03/2016
 * Time: 20:05
 */

namespace App\gestion;


use App\general\db;

class commande
{
    public function nb_article_commande($num_commande){
        $db = new db();
        $sm = $db->count("SELECT COUNT(idcommandearticle) FROM commande_article WHERE num_commande = :num_commande", array("num_commande" => $num_commande));
        return $sm[0];
    }

    public function etat_article_commande($num_commande){
        $db = new db();
        $sql_article = $db->count("SELECT COUNT(commande_article.idarticle) FROM commande_article, article WHERE commande_article.idarticle = article.idarticle AND stock = 1 AND article.nb_stock = 0 AND commande_article.num_commande = :num_commande", array("num_commande" => $num_commande));
        $art = $sql_article[0];
        return $art;
    }
    
    public function total_article_famille($idfamille, $num_commande){
        $db = new db();
        $sql = $db->count("SELECt COUNT(idcommandearticle) FROM commande_article, article, famille_article WHERE commande_article.idarticle = article.idarticle AND article.idfamille = famille_article.idfamille AND article.idfamille = :idfamille AND commande_article.num_commande = :num_commande", array(
            "num_commande"     => $num_commande,
            "idfamille"     => $idfamille
        ));
        $sm = $sql[0];
        return $sm;
    }

    public function total_famille_article($idfamille, $num_commande){
        $db = new db();
        $sql = $db->query("SELECT SUM(total_ligne) as total_ligne FROM commande_article, article WHERE commande_article.idarticle = article.idarticle AND article.idfamille = :idfamille AND commande_article.num_commande = :num_commande", array("idfamille" => $idfamille, "num_commande" => $num_commande));
        $sm = $sql[0]->total_ligne;
        return $sm;
    }
}