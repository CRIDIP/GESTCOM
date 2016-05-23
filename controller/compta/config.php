<?php
if(isset($_POST['action']) && $_POST['action'] == 'add_classe')
{
    require "../../application/classe.php";
    $code_classe = $_POST['code_classe'];
    $libelle_classe = htmlentities(addslashes($_POST['libelle_classe']));

    $plan_i = $DB->execute("INSERT INTO compta_classe(code_classe, libelle_classe) VALUES (:code_classe, :libelle)", array(
        "code_classe"   => $code_classe,
        "libelle"       => $libelle_classe
    ));

    if($plan_i == 1){
        $text="La classe <strong>$libelle_classe</strong> à été créer";
        header("Location: ../../view/compta/index.php?view=compte&success=add_classe&text=$text");
    }else{
        var_dump($plan_i);
        die("Veuillez contacter l'administrateur par mail à support@cridip.com et lui envoyer ce log ci-dessus");
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'add_sousclasse')
{
    require "../../application/classe.php";
    $code_sousclasse = $_POST['code_sousclasse'];
    $code_classe = $_POST['code_classe'];
    $libelle_sousclasse = htmlentities(addslashes($_POST['libelle_sousclasse']));

    $plan_i = $DB->execute("INSERT INTO compta_sousclasse(code_classe, code_sousclasse, libelle_sousclasse) VALUES (:code_classe, :code_sousclasse, :libelle)", array(
        "code_sousclasse"   => $code_sousclasse,
        "code_classe"       => $code_classe,
        "libelle"       => $libelle_sousclasse
    ));

    if($plan_i == 1){
        $text="La classe <strong>$libelle_sousclasse</strong> à été créer";
        header("Location: ../../view/compta/index.php?view=compte&sub=sousclasse&code_classe=$code_classe&success=add_sousclasse&text=$text");
    }else{
        var_dump($plan_i);
        die("Veuillez contacter l'administrateur par mail à support@cridip.com et lui envoyer ce log ci-dessus");
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'add_compte')
{
    require "../../application/classe.php";
    $code_sousclasse = $_POST['code_sousclasse'];
    $code_compte = $_POST['code_compte'];
    $libelle_compte = htmlentities(addslashes($_POST['libelle_compte']));

    $plan_i = $DB->execute("INSERT INTO compta_compte(code_compte, code_sousclasse, libelle_compte) VALUES (:code_compte, :code_sousclasse, :libelle)", array(
        "code_compte"   => $code_compte,
        "code_sousclasse"       => $code_sousclasse,
        "libelle"       => $libelle_compte
    ));

    if($plan_i == 1){
        $text="La classe <strong>$libelle_compte</strong> à été créer";
        header("Location: ../../view/compta/index.php?view=compte&sub=compte&code_sousclasse=$code_sousclasse&success=add_compte&text=$text");
    }else{
        var_dump($plan_i);
        die("Veuillez contacter l'administrateur par mail à support@cridip.com et lui envoyer ce log ci-dessus");
    }
}