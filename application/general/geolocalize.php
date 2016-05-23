<?php
/**
 * Created by PhpStorm.
 * User: Maxime
 * Date: 05/05/2016
 * Time: 01:44
 */

namespace App\general;


class geolocalize
{
    public function get_localize($adresse){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://maps.googleapis.com/maps/api/geocode/json?address=".$adresse,
            CURLOPT_RETURNTRANSFER => true
        ));
        $exec = curl_exec($curl);
        return $exec;
    }
}