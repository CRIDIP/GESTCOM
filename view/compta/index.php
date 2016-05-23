<?php
session_start();
require "../../application/classe.php";
$_SESSION['lieu'] = "compta";

if(isset($_GET['view']))
{
    $view = $_GET['view'];
}else{
    $view = "dashboard";
}

ob_start();

if($view === 'dashboard'){require "dashboard.php";}
if($view === 'journal_vente'){require "journal_vente.php";}
if($view === 'journal_achat'){require "journal_achat.php";}
if($view === 'journal_banque'){require "journal_banque.php";}

if($view === 'situation_client'){require "situation_client.php";}

if($view === 'etat_balance'){require "etat_balance.php";}
if($view === 'etat_bilan'){require "etat_bilan.php";}
if($view === 'etat_resultat'){require "etat_resultat.php";}

if($view === 'compte'){require "config_compte.php";}

$content = ob_get_clean();
if($view === 'login')
{
    require "../login.php";
}else{
    require "../default.php";
}