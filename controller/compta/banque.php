<?php
if(isset($_POST['action']) && $_POST['action'] == 'add_banque_credit'){
    require "../../application/classe.php";
    $date_mouvement = strtotime($_POST['date_mouvement']);
    $code_banque = $_POST['code_banque'];
    $code_tiers = $_POST['code_tiers'];
    $libelle_mouvement = htmlentities(addslashes($_POST['libelle_mouvement']));
    $credit = $_POST['credit'];
    $num_mouvement = rand(1000000,999999999);

    $sql_sousclasse = $DB->query("SELECT code_sousclasse FROM compta_compte WHERE code_compte = :code", array('code' => $code_banque));
    $code_sousclasse = $sql_sousclasse[0];

    $code_ssc = $code_sousclasse->code_sousclasse;

    $jb_i = $DB->execute("INSERT INTO compta_banque(code_compte, date_mouvement, num_mouvement, libelle_mouvement, credit) VALUES (:code, :date, :num, :libelle, :credit)", array(
        "code"      => $code_banque,
        "date"      => $date_mouvement,
        "num"       => $num_mouvement,
        "libelle"   => $libelle_mouvement,
        "credit"    => $credit
    ));

    $update_cpt_banque = $DB->execute("UPDATE compta_compte SET total_compte = :total WHERE code_compte = :code", array("total" => $cpt_gen->solde_compte_produit($credit, $code_banque), "code"  => $code_banque));
    $update_sc_banque = $DB->execute("UPDATE compta_sousclasse SET total_sousclasse = :total WHERE code_sousclasse = :code", array("total" => $cpt_gen->solde_sousclasse_produit_2($credit, $code_banque), "code"  => $code_ssc));
    $update_c_banque = $DB->execute("UPDATE compta_classe SET total_classe = :total WHERE code_classe = :code", array("total" => $cpt_gen->solde_classe_produit($credit), "code"  => 5));

    $update_cpt_tiers = $DB->execute("UPDATE compta_compte SET total_compte = :total WHERE code_compte = :code", array("total" => $cpt_gen->solde_compte_tiers($credit, $code_tiers), "code"  => $code_tiers));
    $update_sc_tiers = $DB->execute("UPDATE compta_sousclasse SET total_sousclasse = :total WHERE code_sousclasse = :code", array("total" => $cpt_gen->solde_sousclasse_tiers($credit), "code"  => 400));
    $update_c_tiers = $DB->execute("UPDATE compta_classe SET total_classe = :total WHERE code_classe = :code", array("total" => $cpt_gen->solde_classe_tiers($debit), "code"  => 4));

    if($jb_i == 1){
        $text="Le mouvement à été enregistrer";
        header("Location: ../../view/compta/index.php?view=journal_banque&success=add_credit&text=$text");
    }else{
        var_dump($jb_i);
        die("Veuillez contacter l'administrateur par mail à support@cridip.com et lui envoyer ce log ci-dessus");
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'add_banque_debit'){
    require "../../application/classe.php";
    $date_mouvement = strtotime($_POST['date_mouvement']);
    $code_banque = $_POST['code_banque'];
    $code_tiers = $_POST['code_tiers'];
    $libelle_mouvement = htmlentities(addslashes($_POST['libelle_mouvement']));
    $debit = $_POST['debit'];
    $deb_format = "-".$debit;
    $num_mouvement = rand(1000000,999999999);

    $sql_sousclasse = $DB->query("SELECT code_sousclasse FROM compta_compte WHERE code_compte = :code", array('code' => $code_banque));
    $code_sousclasse = $sql_sousclasse[0];

    $code_ssc = $code_sousclasse->code_sousclasse;

    $jb_i = $DB->execute("INSERT INTO compta_banque(code_compte, date_mouvement, num_mouvement, libelle_mouvement, debit) VALUES (:code, :date, :num, :libelle, :debit)", array(
        "code"      => $code_banque,
        "date"      => $date_mouvement,
        "num"       => $num_mouvement,
        "libelle"   => $libelle_mouvement,
        "debit"     => $debit
    ));

    $update_cpt_banque = $DB->execute("UPDATE compta_compte SET total_compte = :total WHERE code_compte = :code", array("total" => $cpt_gen->solde_compte_produit($deb_format, $code_banque), "code"  => $code_banque));
    $update_sc_banque = $DB->execute("UPDATE compta_sousclasse SET total_sousclasse = :total WHERE code_sousclasse = :code", array("total" => $cpt_gen->solde_sousclasse_produit_2($deb_format, $code_banque), "code"  => $code_ssc));
    $update_c_banque = $DB->execute("UPDATE compta_classe SET total_classe = :total WHERE code_classe = :code", array("total" => $cpt_gen->solde_classe_produit($deb_format), "code"  => 5));

    $update_cpt_tiers = $DB->execute("UPDATE compta_compte SET total_compte = :total WHERE code_compte = :code", array("total" => $cpt_gen->solde_compte_tiers($deb_format, $code_tiers), "code"  => $code_tiers));
    $update_sc_tiers = $DB->execute("UPDATE compta_sousclasse SET total_sousclasse = :total WHERE code_sousclasse = :code", array("total" => $cpt_gen->solde_sousclasse_tiers($deb_format), "code"  => 410));
    $update_c_tiers = $DB->execute("UPDATE compta_classe SET total_classe = :total WHERE code_classe = :code", array("total" => $cpt_gen->solde_classe_tiers($deb_format), "code"  => 4));

    if($jb_i == 1){
        $text="Le mouvement à été enregistrer";
        header("Location: ../../view/compta/index.php?view=journal_banque&success=add_debit&text=$text");
    }else{
        var_dump($jb_i);
        die("Veuillez contacter l'administrateur par mail à support@cridip.com et lui envoyer ce log ci-dessus");
    }
}