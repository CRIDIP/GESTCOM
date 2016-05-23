<?php
session_start();
require "../../application/classe.php";
$_SESSION['lieu'] = "intervention";

if(isset($_GET['view']))
{
    $view = $_GET['view'];
}else{
    $view = "dashboard";
}

ob_start();

if($view === 'dashboard'){require "dashboard.php";}
if($view === 'atelier'){require "atelier.php";}
if($view === 'deplacement'){require "deplacement.php";}
if($view === 'mobile'){require "mobile.php";}


$content = ob_get_clean();
if($view === 'login')
{
    require "../login.php";
}else{
    require "../default.php";
}