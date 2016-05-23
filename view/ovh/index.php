<?php
session_start();
require "../../application/classe.php";
$_SESSION['lieu'] = "ovh";

if(isset($_GET['view']))
{
    $view = $_GET['view'];
}else{
    $view = "dashboard";
}

ob_start();

if($view === 'dashboard'){require "dashboard.php";}
if($view === 'cloud'){require "cloud.php";}
if($view === 'dedie'){require "dedie.php";}
if($view === 'domaine'){require "domaine.php";}
if($view === 'email'){require "email.php";}
if($view === 'fax'){require "fax.php";}
if($view === 'hebergement'){require "hebergement.php";}
if($view === 'license'){require "license.php";}
if($view === 'me'){require "me.php";}
if($view === 'order'){require "order.php";}
if($view === 'sms'){require "sms.php";}
if($view === 'support'){require "support.php";}
if($view === 'telephonie'){require "telephonie.php";}
if($view === 'vps'){require "vps.php";}
if($view === 'travaux'){require "travaux.php";}


$content = ob_get_clean();
if($view === 'login')
{
    require "../login.php";
}else{
    require "../default.php";
}