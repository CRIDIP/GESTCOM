<?php
/**
 * Created by PhpStorm.
 * User: SAS CRIDIP
 * Date: 31/03/2016
 * Time: 18:08
 */

namespace App\compta;


use App\general\db;

class general
{
    public $db;

    /**
     * general constructor.
     * Appel de la fonction de connexion à la base de donnée
     */
    public function __construct()
    {
        $db = new db();
        $this->db = $db;
    }


    /*
     * JOURNAL DE VENTE
     */
    /**
     * @param $montant //Montant HT
     * @param $code_produit // Code du compte possedant la fonction
     * @return mixed // Retourne le solde direct après calcul de l'incidence
     */
    public function solde_compte_produit($montant, $code_produit)
    {
        $sql = $this->db->query("SELECT total_compte FROM compta_compte WHERE code_compte = :code", array("code" => $code_produit));
        $solde = $sql[0]->total_compte;

        $new_solde = $solde + $montant;
        return $new_solde;
    }
    public function solde_sousclasse_produit($montant, $type)
    {
        if($type == 7){
            $sql = $this->db->query("SELECT total_sousclasse FROM compta_sousclasse WHERE code_sousclasse = :code", array("code" => '707'));
        }else{
            $sql = $this->db->query("SELECT total_sousclasse FROM compta_sousclasse WHERE code_sousclasse = :code", array("code" => '706'));
        }
        $solde = $sql[0]->total_sousclasse;

        $new_solde = $solde + $montant;
        return $new_solde;
    }
    public function solde_sousclasse_produit_2($montant, $code_charge)
    {
        $sql_sousclasse = $this->db->query("SELECT code_sousclasse FROM compta_compte WHERE code_compte = :code", array('code' => $code_charge));
        $code_sousclasse = $sql_sousclasse[0];
        
        $sql = $this->db->query("SELECT total_sousclasse FROM compta_sousclasse WHERE code_sousclasse = :code", array("code" => $code_sousclasse->code_sousclasse));
        $solde = $sql[0]->total_sousclasse;

        $new_solde = $solde + $montant;
        return $new_solde;
    }
    public function solde_classe_produit($montant)
    {
        $sql = $this->db->query("SELECT total_classe FROM compta_classe WHERE code_classe = :code", array("code" => '7'));
        $solde = $sql[0]->total_classe;

        $new_solde = $solde + $montant;
        return $new_solde;
    }

    public function solde_compte_tva($montant)
    {
        $sql = $this->db->query("SELECT total_compte FROM compta_compte WHERE code_compte = :code", array("code" => '44571'));
        $solde = $sql[0]->total_compte;

        $new_solde = $solde + $montant;
        return $new_solde;
    }
    public function solde_sousclasse_tva($montant)
    {
        $sql = $this->db->query("SELECT total_sousclasse FROM compta_sousclasse WHERE code_sousclasse = :code", array("code" => '445'));
        $solde = $sql[0]->total_sousclasse;

        $new_solde = $solde + $montant;
        return $new_solde;
    }
    public function solde_classe_tva($montant)
    {
        $sql = $this->db->query("SELECT total_classe FROM compta_classe WHERE code_classe = :code", array("code" => '4'));
        $solde = $sql[0]->total_classe;

        $new_solde = $solde + $montant;
        return $new_solde;
    }

    public function solde_compte_tiers($montant, $code_tiers)
    {
        $sql = $this->db->query("SELECT total_compte FROM compta_compte WHERE code_compte = :code", array("code" => $code_tiers));
        $solde = $sql[0]->total_compte;

        $new_solde = $solde + $montant;
        return $new_solde;
    }
    public function solde_sousclasse_tiers($montant)
    {
        $sql = $this->db->query("SELECT total_sousclasse FROM compta_sousclasse WHERE code_sousclasse = :code", array("code" => '410'));
        $solde = $sql[0]->total_sousclasse;

        $new_solde = $solde + $montant;
        return $new_solde;
    }
    public function solde_classe_tiers($montant)
    {
        $sql = $this->db->query("SELECT total_classe FROM compta_classe WHERE code_classe = :code", array("code" => '4'));
        $solde = $sql[0]->total_classe;

        $new_solde = $solde + $montant;
        return $new_solde;
    }
    


    public function solde_tva($montant, $code_tva)
    {
        $sql = $this->db->query("SELECT total_compte FROM compta_compte WHERE code_compte = :code", array("code" => $code_tva));
        $solde = $sql[0]->total_compte;

        $new_solde = $solde + $montant;
        return $new_solde;
    }
}