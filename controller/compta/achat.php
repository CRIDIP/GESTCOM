<?php
if(isset($_POST['action']) && $_POST['action'] == 'add_achat'){
    require "../../application/classe.php";
    $date_mouvement = strtotime($_POST['date_mouvement']);
    $code_charge = $_POST['code_charge'];
    $code_tiers = $_POST['code_tiers'];
    $libelle_mouvement = htmlentities(addslashes($_POST['libelle_mouvement']));
    $debit = $_POST['debit'];
    $num_mouvement = rand(100000,99999999999);


    $sql_sousclasse = $DB->query("SELECT code_sousclasse FROM compta_compte WHERE code_compte = :code", array('code' => $code_charge));
    $code_sousclasse = $sql_sousclasse[0];

    $code_ssc = $code_sousclasse->code_sousclasse;

    //Calcul
    $ht = $tva->calc_ht($debit);
    $tva = $tva->calc_tva($ht);

    //Insertion JV
    $jv_i = $DB->execute("INSERT INTO compta_achat(code_compte, date_mouvement, num_mouvement, libelle_mouvement, debit) VALUES (:code, :date, :num_mouvement, :libelle_mouvement, :debit)", array(
        "code"              => $code_charge,
        "date"              => $date_mouvement,
        "num_mouvement"     => $num_mouvement,
        "libelle_mouvement" => $libelle_mouvement,
        "debit"             => $debit
    ));

    $update_cpt_produit = $DB->execute("UPDATE compta_compte SET total_compte = :total WHERE code_compte = :code", array("total" => $cpt_gen->solde_compte_produit($ht, $code_charge), "code"  => $code_charge));
    $update_sc_produit = $DB->execute("UPDATE compta_sousclasse SET total_sousclasse = :total WHERE code_sousclasse = :code", array("total" => $cpt_gen->solde_sousclasse_produit_2($ht, $code_charge), "code"  => $code_ssc));
    $update_c_produit = $DB->execute("UPDATE compta_classe SET total_classe = :total WHERE code_classe = :code", array("total" => $cpt_gen->solde_classe_produit($ht), "code"  => 6));

    $update_cpt_tva = $DB->execute("UPDATE compta_compte SET total_compte = :total WHERE code_compte = :code", array("total" => $cpt_gen->solde_compte_tva($tva), "code"  => 44566));
    $update_sc_tva = $DB->execute("UPDATE compta_sousclasse SET total_sousclasse = :total WHERE code_sousclasse = :code", array("total" => $cpt_gen->solde_sousclasse_tva($tva), "code"  => 445));
    $update_c_tva = $DB->execute("UPDATE compta_classe SET total_classe = :total WHERE code_classe = :code", array("total" => $cpt_gen->solde_classe_tva($tva), "code"  => 4));

    $update_cpt_tiers = $DB->execute("UPDATE compta_compte SET total_compte = :total WHERE code_compte = :code", array("total" => $cpt_gen->solde_compte_tiers($debit, $code_tiers), "code"  => $code_tiers));
    $update_sc_tiers = $DB->execute("UPDATE compta_sousclasse SET total_sousclasse = :total WHERE code_sousclasse = :code", array("total" => $cpt_gen->solde_sousclasse_tiers($debit), "code"  => 410));
    $update_c_tiers = $DB->execute("UPDATE compta_classe SET total_classe = :total WHERE code_classe = :code", array("total" => $cpt_gen->solde_classe_tiers($debit), "code"  => 4));

    if($jv_i == 1){
        $text="La vente à été enregistrer";
        header("Location: ../../view/compta/index.php?view=journal_achat&success=add_achat&text=$text");
    }else{
        var_dump($jv_i);
        die("Veuillez contacter l'administrateur par mail à support@cridip.com et lui envoyer ce log ci-dessus");
    }
}