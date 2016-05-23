<?php
/**
 * Created by PhpStorm.
 * User: MAX
 * Date: 11/12/2015
 * Time: 16:43
 */

namespace App;


class autoloader
{

    /**
     * Enregistre notre autoloader
     */
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Inclue le fichier correspondant à notre classe
     * @param $class string Le nom de la classe à charger
     */
    static function autoload($class){
        if (strpos($class, __NAMESPACE__ . '\\') === 0){
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            $class = str_replace('\\', '/', $class);
            require __DIR__.'/' . $class . '.php';
        }
    }
}