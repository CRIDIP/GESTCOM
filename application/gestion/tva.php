<?php
/**
 * Created by PhpStorm.
 * User: SWD
 * Date: 22/03/2016
 * Time: 20:26
 */

namespace App\gestion;


class tva
{
    public function calc_tva($ht){
        $ttc = $ht*1.2;
        $tva = $ttc - $ht;
        return round($tva, 2);
    }

    public function calc_ttc($ht){
        $ttc = $ht * 1.2;
        return round($ttc, 2);
    }

    public function calc_ht($ttc){
        $ht = $ttc / 1.2;
        return round($ht, 2);
    }
}