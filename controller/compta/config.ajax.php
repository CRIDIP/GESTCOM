<?php
function is_ajax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
if(is_ajax()){
    if(isset($_GET['action']) && $_GET['action'] == 'supp_classe')
    {
        require "../../application/classe.php";
        $code_classe = $_GET['code_classe'];

        if($plan_cls->count_sousclasse($code_classe) != 0){
            echo json_encode(300);
        }

        $classe_d = $DB->execute("DELETE FROM compta_classe WHERE code_classe = :code_classe", array("code_classe" => $code_classe));

        if($classe_d == 1){
            echo json_encode(200);
        }else{
            echo json_encode(500);
        }
    }
    if(isset($_GET['action']) && $_GET['action'] == 'supp_sousclasse')
    {
        require "../../application/classe.php";
        $code_sousclasse = $_GET['code_sousclasse'];

        if($plan_cls->count_compte($code_sousclasse) != 0){
            echo json_encode(300);
        }

        $classe_d = $DB->execute("DELETE FROM compta_sousclasse WHERE code_sousclasse = :code_sousclasse", array("code_sousclasse" => $code_sousclasse));

        if($classe_d == 1){
            echo json_encode(200);
        }else{
            echo json_encode(500);
        }
    }
    if(isset($_GET['action']) && $_GET['action'] == 'supp_compte')
    {
        require "../../application/classe.php";
        $code_compte = $_GET['code_compte'];

        $classe_d = $DB->execute("DELETE FROM compta_compte WHERE code_compte = :code", array("code" => $code_compte));

        if($classe_d == 1){
            echo json_encode(200);
        }else{
            echo json_encode(500);
        }
    }
}