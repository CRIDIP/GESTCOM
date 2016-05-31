<?php
/**
 * Created by PhpStorm.
 * User: Maxime
 * Date: 29/02/2016
 * Time: 23:20
 */

namespace App\general;


class constante
{
    const HTTP              = "https://";
    const URL               = "gestcom.cridip.com/";
    const ASSETS            = "assets/";
    const NOM_SITE          = "GESTCOM";
    const SOURCES           = "https://ns342142.ip-5-196-76.eu/gc/";
    public $controller      = "controller/";
    public $view            = "view/";


    /**
     * @param $dos array Permet de parser sous forme string le tableau array=$dos
     * @return string retourne un format standard de link HTML
     */
    private static function parseArray($dos)
    {
        return implode("/", $dos);
    }

    /**
     * @param array $dos Il permet d'envoyer à la fonction la liste des dossiers à parcourir sous forme de tableau
     * @param bool|true $assets Permet d'insérer de manière automatique le dossier 'assets'
     * @param bool $sources Renvoie les informations vers le fichiers DataSources de CRIDIP
     * @return string Suivant le bool $assets, il retourne la redirection sous format de lien(string)
     */
    public static function getUrl($dos = array(), $assets = true, $sources = false)
    {
        if($assets === true)
        {
            return static::HTTP.static::URL.static::ASSETS.static::parseArray($dos);
        }elseif($sources === true){
            return static::SOURCES;
        }else{
            return static::HTTP.static::URL.static::parseArray($dos);
        }

    }
    
}