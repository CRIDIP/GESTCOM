<?php
/**
 * Created by PhpStorm.
 * User: SWD
 * Date: 25/03/2016
 * Time: 19:33
 */

namespace App\compta;


use App\general\db;

class plan
{
    public function count_sousclasse($code_classe){
        $db = new db();
        $sql = $db->count("SELECT COUNT(idsousclasse) FROM compta_sousclasse WHERE code_classe = :code_classe", array("code_classe" => $code_classe));
        $sm = $sql[0];
        return $sm;
    }
    public function count_compte($code_sousclasse){
        $db = new db();
        $sql = $db->count("SELECT COUNT(idcompte) FROM compta_compte WHERE code_sousclasse = :code_sousclasse", array("code_sousclasse" => $code_sousclasse));
        $sm = $sql[0];
        return $sm;
    }
}