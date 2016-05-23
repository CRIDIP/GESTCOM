<?php
/**
 * Created by PhpStorm.
 * User: SWD
 * Date: 24/03/2016
 * Time: 20:28
 */

namespace App\gestion;


use App\general\db;

class reglement
{
    public function total_rglt_facture($num_facture){
        $db = new db();
        $sql = $db->query("SELECT SUM(montant) as total_reglement FROM reglement_facture WHERE num_facture = :num_facture", array("num_facture" => $num_facture));
        $sm = $sql[0]->total_reglement;
        return $sm;
    }
}