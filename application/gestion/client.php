<?php
/**
 * Created by PhpStorm.
 * User: SWD
 * Date: 10/03/2016
 * Time: 14:47
 */

namespace App\gestion;


use App\general\db;

class client
{
    public function total_facture($idclient)
    {
        $DB = new db();

        $sm = $DB->query("SELECT SUM(total_facture) as total_facture FROM facture WHERE idclient = :idclient", array("idclient" => $idclient));

        return $sm[0];
    }
    public function total_reglement($idclient)
    {
        $DB = new db();

        $sm = $DB->query("SELECT SUM(montant) as total_reglement FROM reglement_facture WHERE porteur_chq = :idclient", array("idclient" => $idclient));

        return $sm[0];
    }

    public function total_compta($idclient, $encours)
    {
        $fct_init = $this->total_facture($idclient);
        $rglt_init = $this->total_reglement($idclient);

        $total_fct = $fct_init->total_facture;
        $total_rglt = $rglt_init->total_reglement;

        $total = $total_rglt - $total_fct + $encours;
        return $total;
    }
}