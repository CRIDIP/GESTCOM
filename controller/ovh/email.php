<?php
if(isset($_POST['action']) && $_POST['action'] == 'add-email-account'){
    require "../../application/classe.php";
    $domain = $_POST['domain'];

    if(!empty($_POST['size'])){
        $size = $_POST['size'];
    }else{
        $size = 5000000000;
    }

    $content = (object) array(
        "accountName"   => $_POST['accountName'],
        "description"   => $_POST['description'],
        "password"      => $_POST['new_password'],
        "size"          => $size
    );

    $ovh_post = $ovh->post("/email/domain/".$domain."/account", $content);

    if($ovh_post){
        $text = "Le compte mail <strong>".$content->accountName."</strong> à été créer pour le nom de domaine <strong>".$domain."</strong>";
        header("Location: ../../view/ovh/index.php?view=email&success=add-email-account&text=$text");
    }else{
        var_dump($ovh_put);
        die("Envoyer ce log à l'administrateur");
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'edit-email-account')
{
    require "../../application/classe.php";
    $domain = $_POST['domain'];
    $account = $_POST['accountName'];
    $content = (object) array(
        "description" => $_POST['description'],
        "size"        => $number->convertisseur_binaire("oct", $_POST['size'])
    );


    $ovh_put = $ovh->put("/email/domain/".$domain."/account/".$account, $content);

    if($ovh_put == NULL){
        $text = "Les Informations de compte on été modifier.";
        header("Location: ../../view/ovh/index.php?view=email&success=edit-email-account&text=$text");
    }else{
        var_dump($ovh_put);
        die("Envoyer ce log à l'administrateur");
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'edit-pass-account'){
    require "../../application/classe.php";
    $domain = $_POST['domain'];
    $accountName = $_POST['accountName'];

    $content = (object) array(
        "password"  => $_POST['new_password']
    );

    $ovh_post = $ovh->post("/email/domain/".$domain."/account/".$accountName."/changePassword", $content);

    $text = "Le mot de passe du compte <strong>".$accountName."</strong> à été modifier.";
    header("Location: ../../view/ovh/index.php?view=email&success=edit-pass-account&text=$text");
}