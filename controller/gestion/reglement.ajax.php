<?php
function is_ajax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
if(is_ajax()) {
    if (isset($_GET['action']) && $_GET['action'] == 'supp_rglt') {
        require "../../application/classe.php";
        $num_facture = $_GET['num_facture'];
        $idreglementfacture = $_GET['idreglementfacture'];

        $sql_reglement = $DB->query("SELECT * FROM reglement_facture WHERE idreglementfacture = :idreglement", array("idreglement" => $idreglementfacture));
        $rglt = $sql_reglement[0];

        if ($rglt->type_reglement != 3) {
            $rglt_d = $DB->execute("DELETE FROM reglement_facture WHERE idreglementfacture = :idreglement", array("idreglement" => $idreglementfacture));
            $facture_u = $DB->execute("UPDATE facture SET etat_facture = 2 WHERE num_facture = :num_facture", array("num_facture" => $num_facture));
            if($rglt_d == 1){
                echo json_encode(200);
            }else{
                echo json_encode(500);
            }
        }
    }
}