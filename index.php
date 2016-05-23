<?php
session_start();
require "application/classe.php";
$_SESSION['lieu'] = "collab";

if(isset($_GET['view']))
{
    $view = $_GET['view'];
}else{
    $view = "dashboard";
}

ob_start();
if($view === 'dashboard'){require "view/index.php";}
if($view === 'error'){require "view/error.php";}
if($view === 'notification'){require "view/notification.php";}
if($view === 'profil'){require "view/profil.php";}
if($view === 'calendar'){require "view/calendar.php";}
if($view === 'mailbox'){require "view/mailbox.php";}
if($view === 'tasks'){require "view/tasks.php";}

if($view === 'test'){require "view/test.php";}

if($view === 'gestion'){header("Location: view/gestion/index.php?view=dashboard");}

$content = ob_get_clean();
if($view === 'login'){
    require "view/login.php";
}elseif($view === 'lockscreen'){
    require "view/lockscreen.php";
}elseif($view === 'maintenance'){
    require "view/maintenance.php";
}else{
    require "view/default.php";
}


