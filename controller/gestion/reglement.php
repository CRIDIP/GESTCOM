<?php
if(isset($_POST['action']) && $_POST['action'] == 'add_reglement')
{
    require "../../application/classe.php";
    $num_facture = $_POST['num_facture'];
    $montant = $_POST['montant'];
    $date_reglement = strtotime($_POST['date_reglement']);
    $type_reglement = $_POST['type_reglement'];
    $num_reglement = "RGLTFCT".date("Ym").rand(100,999);

    $sql_facture = $DB->query("SELECT * FROM facture WHERE num_facture = :num_facture", array("num_facture" => $num_facture));
    $facture = $sql_facture[0];

    if($type_reglement == 2){
        $num_chq = $_POST['num_chq'];
        $banque_chq = $_POST['banque_chq'];
        $porteur_chq = $_POST['porteur_chq'];
    }
    if($type_reglement == 3){
        $type_carte = $_POST['type_carte'];
        $num_cb = $_POST['num_cb'];
        $expire_month = $_POST['expire_month'];
        $expire_year = $_POST['expire_year'];
        $cvv2 = $_POST['cvv2'];
        $porteur_chq = $_POST['porteur_chq'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
    }

    if($type_reglement != 2 OR $type_reglement != 3){
        $reglement_i = $DB->execute("INSERT INTO reglement_facture(num_facture, num_reglement, montant, date_reglement, type_reglement, idclient) VALUES (:num_facture, :num_reglement, :montant, :date_reglement, :type_reglement, :idclient)", array(
            "num_facture"   => $num_facture,
            "num_reglement" => $num_reglement,
            "montant"       => $montant,
            "date_reglement"=> $date_reglement,
            "type_reglement"=> $type_reglement,
            "idclient"      => $facture->idclient
        ));

        if($tva->calc_ttc($facture->total_facture) != $montant){
            $facture_u = $DB->execute("UPDATE facture SET etat_facture = 2 WHERE num_facture = :num_facture", array("num_facture" => $num_facture));
        }else{
            $facture_u = $DB->execute("UPDATE facture SET etat_facture = 3 WHERE num_facture = :num_facture", array("num_facture" => $num_facture));
        }
        if($reglement_i == 1){
            $text = "Le reglement pour référence <strong>".$num_reglement."</strong> à été ajouter !";
            header("Location: ../../view/gestion/index.php?view=facture&sub=view&num_facture=$num_facture&success=add_rglt&text=$text");
        }else{
            var_dump($reglement_i);
            die("Veuillez contacter l'administrateur par mail à support@cridip.com et lui envoyer ce log ci-dessus");
        }
    }else{
        if($type_reglement == 2){
            $reglement_i = $DB->execute("INSERT INTO reglement_facture(num_facture, num_reglement, montant, num_chq, banque_chq, porteur_chq, date_reglement, type_reglement, idclient) VALUES (:num_facture, :num_reglement, :montant, :num_chq, :banque_chq, :porteur_chq, :date_reglement, :type_reglement, :idclient)", array(
                "num_facture"   => $num_facture,
                "num_reglement" => $num_reglement,
                "montant"       => $montant,
                "num_chq"       => $num_chq,
                "banque_chq"    => $banque_chq,
                "porteur_chq"   => $porteur_chq,
                "date_reglement"=> $date_reglement,
                "type_reglement"=> $type_reglement,
                "idclient"      => $facture->idclient
            ));
            if($tva->calc_ttc($facture->total_facture) != $montant){
                $facture_u = $DB->execute("UPDATE facture SET etat_facture = 2 WHERE num_facture = :num_facture", array("num_facture" => $num_facture));
            }else{
                $facture_u = $DB->execute("UPDATE facture SET etat_facture = 3 WHERE num_facture = :num_facture", array("num_facture" => $num_facture));
            }
            if($reglement_i == 1){
                $text = "Le reglement pour référence <strong>".$num_reglement."</strong> à été ajouter !";
                header("Location: ../../view/gestion/index.php?view=facture&sub=view&num_facture=$num_facture&success=add_rglt&text=$text");
            }else{
                var_dump($reglement_i);
                die("Veuillez contacter l'administrateur par mail à support@cridip.com et lui envoyer ce log ci-dessus");
            }
        }
    }
}