<?php
function is_ajax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
if(is_ajax()){
    if(isset($_GET['action']) && $_GET['action'] == 'count_cloud'){
        sleep(4);
        require "../../application/classe.php";
        $cloud = $ovh->get("/cloud");
        $cloud_count = count($cloud);
        echo json_encode($cloud_count);
    }
    if(isset($_GET['action']) && $_GET['action'] == 'count_dedie'){
        sleep(4);
        require "../../application/classe.php";
        $dedie = $ovh->get("/dedicated/server");
        $dedie_count = count($dedie);
        echo json_encode($dedie_count);
    }
    if(isset($_GET['action']) && $_GET['action'] == 'count_domaine'){
        sleep(4);
        require "../../application/classe.php";
        $domain = $ovh->get("/domain");
        $domain_count = count($domain);
        echo json_encode($domain_count);
    }
    if(isset($_GET['action']) && $_GET['action'] == 'count_email'){
        sleep(4);
        require "../../application/classe.php";
        $domain = $ovh->get("/email/domain");
        $domain_count = count($domain);
        echo json_encode($domain_count);
    }
    if(isset($_GET['action']) && $_GET['action'] == 'count_fax'){
        sleep(4);
        require "../../application/classe.php";
        $domain = $ovh->get("/freefax");
        $domain_count = count($domain);
        echo json_encode($domain_count);
    }
    if(isset($_GET['action']) && $_GET['action'] == 'count_hebergement'){
        sleep(4);
        require "../../application/classe.php";
        $domain = $ovh->get("/hosting/web");
        $domain_count = count($domain);
        echo json_encode($domain_count);
    }
    if(isset($_GET['action']) && $_GET['action'] == 'count_license'){
        sleep(4);
        require "../../application/classe.php";
        $license = $ovh->get("/license/cloudLinux");
        $license += $ovh->get("/license/cpanel");
        $license += $ovh->get("/license/directadmin");
        $license += $ovh->get("/license/office");
        $license += $ovh->get("/license/plesk");
        $license += $ovh->get("/license/sqlserver");
        $license += $ovh->get("/license/virtuozzo");
        $license += $ovh->get("/license/windows");
        $license += $ovh->get("/license/worklight");
        $license_count = count($license);
        echo json_encode($license_count);
    }
}