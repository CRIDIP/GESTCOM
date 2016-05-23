<?php
use App\api\ovh;
use App\compta\general;
use App\compta\plan;
use App\general\constante;
use App\general\date;
use App\general\db;
use App\general\ErrorContext;
use App\general\fonction;
use App\general\geolocalize;
use App\general\insert;
use App\general\number;
use App\general\ssh;
use App\general\users;
use App\gestion\client;
use App\gestion\commande;
use App\gestion\devis;
use App\gestion\facture;
use App\gestion\reglement;
use App\gestion\tva;
use Ovh\Api;


require dirname(__DIR__)."/application/autoloader.php";
\App\autoloader::register();

//VENDOR COMPOSER
include dirname(__DIR__)."/vendor/autoload.php";


//NAMESPACE APP
$constante = new constante();
$date_format = new date();
$fonction = new fonction();
$DB = new db();
$ssh2 = new ssh();
$errorContext = new ErrorContext();
$insert = new insert();
$geo_ip = new geolocalize();
$number = new number();

/*
 * APP\GENERAL
 */
if(isset($_SESSION['account']['active']) && $_SESSION['account']['active'] == 1)
{
    $user_cls = new users($_SESSION['account']['username']);
    $user = $user_cls->info_user();
    $iduser = $user->iduser;
}

/*
 * APP GESTION
 */

$client_cls = new client();
$tva = new tva();
$devis_cls = new devis();
$commande_cls = new commande();
$facture_cls = new facture();
$reglement_cls = new reglement();

/*
 * APP COMPTA
 */

$plan_cls = new plan();
$cpt_gen = new general();

//COMPOSER

// OVH Principal mm294092
$applicationKey1         = "8P34qwBDKfx7Dl1o";
$applicationSecret1      = "HVbnDGf2qPQPjEUhmsnbIxNwt7VXXfx2";
$endpoint               = "ovh-eu";
$consumerKey1            = "Cdl9enc8DDPjxgULfmEnbNG9X5vgTSSa";

// OVH Secondaire mm278569
/*$applicationKey1         = "wJ9FbC428K2L3Mrz";
$applicationSecret1      = "IVfKjJxjrXlLUWabNyrjiNNnIHJQ0Ti3";
$endpoint               = "ovh-eu";
$consumerKey1            = "zL7Ok5LR3YS7Lwp6HMPzamrEsDDJx6PQ";*/

// OVH Tertiaire mm413076
/*$applicationKey1         = "zkF38mys2JPnGkFh";
$applicationSecret1      = "zhHRFHn9rd0DTD2ni7QMgrKt0Nojk9TP";
$endpoint               = "ovh-eu";
$consumerKey1            = "bd1KeOQbFCh65FBJEHmGm5I4SZMsFeA4";*/

$ovh = new Api($applicationKey1, $applicationSecret1, $endpoint, $consumerKey1);
/*
 * TEST UNITAIRE
 */



