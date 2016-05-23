<?php
session_start();
require "../../application/classe.php";
$_SESSION['lieu'] = "projet";

if(isset($_GET['view']))
{
    $view = $_GET['view'];
}else{
    $view = "dashboard";
}

ob_start();

if($view === 'dashboard'){require "dashboard.php";}
if($view === 'projet'){require "projet.php";}
if($view === 'bugs'){require "bugs.php";}
if($view === 'tickets'){require "tickets.php";}


$content = ob_get_clean();
if($view === 'login')
{
    require "../login.php";
}else{
    require "../default.php";
}