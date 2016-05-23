<?php
function is_ajax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
if(is_ajax()){
    if(isset($_GET['action']) && $_GET['action'] == 'defcon'){
        require "../../application/classe.php";
        $code_tiers = $_GET['code_tiers'];
        $sql = $DB->query("SELECT SUM(total_compte) as total_compte FROM compta_compte WHERE code_compte = :code", array("code" => $code_tiers));
        $sum = $sql[0];
        echo $fonction->number_decimal($sum->total_compte);
    }
}