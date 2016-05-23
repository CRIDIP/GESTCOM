<?php
/**
 * Created by PhpStorm.
 * User: SWD
 * Date: 22/03/2016
 * Time: 20:05
 */

namespace App\gestion;


use App\general\date;
use App\general\db;

class facture
{
    public function nb_article_facture($num_facture){
        $db = new db();
        $sm = $db->count("SELECT COUNT(idfacturearticle) FROM facture_article WHERE num_facture = :num_facture", array("num_facture" => $num_facture));
        return $sm[0];
    }

    public function etat_article_facture($num_facture){
        $db = new db();
        $sql_article = $db->count("SELECT COUNT(facture_article.idarticle) FROM facture_article, article WHERE facture_article.idarticle = article.idarticle AND stock = 1 AND article.nb_stock = 0 AND facture_article.num_facture = :num_facture", array("num_facture" => $num_facture));
        $art = $sql_article[0];
        return $art;
    }
    
    public function total_article_famille($idfamille, $num_facture){
        $db = new db();
        $sql = $db->count("SELECt COUNT(idfacturearticle) FROM facture_article, article, famille_article WHERE facture_article.idarticle = article.idarticle AND article.idfamille = famille_article.idfamille AND article.idfamille = :idfamille AND facture_article.num_facture = :num_facture", array(
            "num_facture"     => $num_facture,
            "idfamille"     => $idfamille
        ));
        $sm = $sql[0];
        return $sm;
    }

    public function total_famille_article($idfamille, $num_facture){
        $db = new db();
        $sql = $db->query("SELECT SUM(total_ligne) as total_ligne FROM facture_article, article WHERE facture_article.idarticle = article.idarticle AND article.idfamille = :idfamille AND facture_article.num_facture = :num_facture", array("idfamille" => $idfamille, "$num_facture" => $num_facture));
        $sm = $sql[0]->total_ligne;
        return $sm;
    }
    
    public function echeance_facture($type_facturation, $date_facture)
    {
        $date = new date();
        switch($type_facturation)
        {
            case 1:
               return $date_facture;
                break;
            case 2:
                return $date->ech_1($date_facture);
            break;
            case 3:
                return $date->ech_7($date_facture);
                break;
            case 4:
                return $date->ech_15($date_facture);
                break;
            case 5:
                return $date->ech_30($date_facture);
                break;
            case 6:
                return $date->ech_90($date_facture);
                break;
            case 7:
                return $date->ech_150($date_facture);
                break;
            case 8:
                return $date->ech_365($date_facture);
                break;
        }
    }
}