<?php
session_start();
require "../../application/classe.php";
$_SESSION['lieu'] = "gestion";

if(isset($_GET['view']))
{
    $view = $_GET['view'];
}else{
    $view = "dashboard";
}

ob_start();

if($view === 'dashboard'){require "dashboard.php";}
if($view === 'client'){require "client.php";}
if($view === 'article'){require "article.php";}
if($view === 'devis'){require "devis.php";}
if($view === 'commande'){require "commande.php";}
if($view === 'facture'){require "facture.php";}
if($view === 'avoir'){require "avoir.php";}
if($view === 'service'){require "service.php";}

$content = ob_get_clean();
if($view === 'login')
{
    require "../login.php";
}else{
    require "../default.php";
}