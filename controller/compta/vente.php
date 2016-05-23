<?php
if(isset($_POST['action']) && $_POST['action'] == 'add_vente'){
    require "../../application/classe.php";
    $date_mouvement = strtotime($_POST['date_mouvement']);
    $type = $_POST['type'];
    $code_produit = $_POST['code_produit'];
    $code_tiers = $_POST['code_tiers'];
    $libelle_mouvement = htmlentities(addslashes($_POST['libelle_mouvement']));
    $credit = $_POST['credit'];
    $num_mouvement = rand(100000,99999999999);
    if($type == 7){
        $code_ssc = "707";
    }else{
        $code_ssc = "706";
    }

    //Calcul
    $ht = $tva->calc_ht($credit);
    $tva = $tva->calc_tva($ht);

    //Insertion JV
    $jv_i = $DB->execute("INSERT INTO compta_vente(code_compte, date_mouvement, num_mouvement, libelle_mouvement, credit) VALUES (:code, :date, :num_mouvement, :libelle_mouvement, :credit)", array(
        "code"              => $code_produit,
        "date"              => $date_mouvement,
        "num_mouvement"     => $num_mouvement,
        "libelle_mouvement" => $libelle_mouvement,
        "credit"            => $credit
    ));

    $update_cpt_produit = $DB->execute("UPDATE compta_compte SET total_compte = :total WHERE code_compte = :code", array("total" => $cpt_gen->solde_compte_produit($ht, $code_produit), "code"  => $code_produit));
    $update_sc_produit = $DB->execute("UPDATE compta_sousclasse SET total_sousclasse = :total WHERE code_sousclasse = :code", array("total" => $cpt_gen->solde_sousclasse_produit($ht, $type), "code"  => $code_ssc));
    $update_c_produit = $DB->execute("UPDATE compta_classe SET total_classe = :total WHERE code_classe = :code", array("total" => $cpt_gen->solde_classe_produit($ht), "code"  => 7));

    $update_cpt_tva = $DB->execute("UPDATE compta_compte SET total_compte = :total WHERE code_compte = :code", array("total" => $cpt_gen->solde_compte_tva($tva), "code"  => 44571));
    $update_sc_tva = $DB->execute("UPDATE compta_sousclasse SET total_sousclasse = :total WHERE code_sousclasse = :code", array("total" => $cpt_gen->solde_sousclasse_tva($tva), "code"  => 445));
    $update_c_tva = $DB->execute("UPDATE compta_classe SET total_classe = :total WHERE code_classe = :code", array("total" => $cpt_gen->solde_classe_tva($tva), "code"  => 4));

    $update_cpt_tiers = $DB->execute("UPDATE compta_compte SET total_compte = :total WHERE code_compte = :code", array("total" => $cpt_gen->solde_compte_tiers($credit, $code_tiers), "code"  => $code_tiers));
    $update_sc_tiers = $DB->execute("UPDATE compta_sousclasse SET total_sousclasse = :total WHERE code_sousclasse = :code", array("total" => $cpt_gen->solde_sousclasse_tiers($credit), "code"  => 410));
    $update_c_tiers = $DB->execute("UPDATE compta_classe SET total_classe = :total WHERE code_classe = :code", array("total" => $cpt_gen->solde_classe_tiers($credit), "code"  => 4));

    if($jv_i == 1){
        $text="La vente à été enregistrer";
        header("Location: ../../view/compta/index.php?view=journal_vente&success=add_vente&text=$text");
    }else{
        var_dump($jv_i);
        die("Veuillez contacter l'administrateur par mail à support@cridip.com et lui envoyer ce log ci-dessus");
    }
}