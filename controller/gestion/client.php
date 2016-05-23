<?php
use App\noctus\encrypt;

if(isset($_POST['action']) && $_POST['action'] == 'add_client')
{
    session_start();
    require "../../application/classe.php";
    $iduser = $user->iduser;

    $societe = htmlentities(addslashes($_POST['societe']));
    $nom_client = htmlentities(addslashes($_POST['nom_client']));
    $prenom_client = htmlentities(addslashes($_POST['prenom_client']));
    $adresse_client = htmlentities(addslashes($_POST['adresse_client']));
    $code_postal = $_POST['code_postal'];
    $ville_client = htmlentities(addslashes($_POST['ville_client']));
    $tel_client = substr($_POST['tel_client'], 3);
    $mail_client = $_POST['mail_client'];
    $num_client = "CLS".rand(1000000,9999999);
    $cat_client = $_POST['cat_client'];
    $type_facturation = $_POST['type_facturation'];
    $type_reglement = $_POST['type_reglement'];

    $client_i = $DB->execute("INSERT INTO client(idclient, societe, nom_client, prenom_client, adresse_client, code_postal, ville_client, tel_client, mail_client, num_client, cat_client) VALUES
                            (NULL, :societe, :nom_client, :prenom_client, :adresse_client, :code_postal, :ville_client, :tel_client, :mail_client, :num_client, :cat_client)", array(
        "nom_client"    => $nom_client,
        "prenom_client" => $prenom_client,
        "adresse_client"=> $adresse_client,
        "code_postal"   => $code_postal,
        "ville_client"  => $ville_client,
        "tel_client"    => $tel_client,
        "mail_client"   => $mail_client,
        "num_client"    => $num_client,
        "cat_client"    => $cat_client,
        "societe"       => $societe
    ));

    $user_q = $DB->query("SELECT * FROM client WHERE num_client = :num_client", array("num_client" => $num_client));
    $conf_client = $DB->query("SELECT * FROM conf_annuaire_cat_client WHERE idcatclient = :idcatclient", array("idcatclient" => $cat_client));

    $username = $fonction->gen_username($nom_client, $prenom_client);
    $pass = $fonction->gen_password();
    $encrypt = new encrypt($username, $pass);
    $pass_crypt = $encrypt->encrypt();
    $idclient = $user_q[0]->idclient;

    $user_info_i = $DB->execute("INSERT INTO client_info_default(idclientinfo, idclient, type_facturation, type_reglement, encours, delai_reglement) VALUES
        (NULL, :idclient, :type_facturation, :type_reglement, :encours, :delai_reglement)", array(
        "idclient"  => $idclient,
        "type_facturation"  => $type_facturation,
        "type_reglement"    => $type_reglement,
        "encours"           => $conf_client[0]->encours,
        "delai_reglement"   => $conf_client[0]->delai_rglt
    ));


    $user_client_insert = $DB->execute("INSERT INTO users(iduser, groupe, username, password, nom_user, prenom_user, connect, last_connect, poste_user, date_naissance, num_tel_poste, commentaire, totp, totp_token, idclient) VALUES
        (NULL, :groupe, :username, :password, :nom_user, :prenom_user, '0', '', 'Client', '', '', '', '0', NULL, :idclient)", array(
        "groupe"        => 4,
        "username"      => $username,
        "password"      => $pass_crypt,
        "nom_user"      => $nom_client,
        "prenom_user"   => $prenom_client,
        "idclient"      => $idclient
    ));

    // ENVOIE MAIL
    $to = $mail_client;
    $sujet = "Création de votre Espace - CRIDIP";

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    $headers .= 'From: CRIDIP <contact@cridip.com>' . "\r\n";

    ob_start();
    ?>
    <!doctype html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-Equiv="Cache-Control" Content="cache">
        <meta http-Equiv="Pragma" Content="cache">
        <meta http-Equiv="Expires" Content="1000">
        <style type="text/css">
            @import url(http://fonts.googleapis.com/css?family=Open+Sans);
            body{overflow: hidden}
            img{max-width:600px;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic}
            a{text-decoration:none;border:0;outline:none;color:#bbb}
            a img{border:none}
            p{margin-top: 0;margin-bottom: 0;text-align:left;}
            td,h1,h2,h3{font-family:Helvetica,Arial,sans-serif;font-weight:400}
            td{text-align:center}
            body{-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;width:100%;height:100%;color:#37302d;background:#fff;font-size:16px}
            table{border-collapse:collapse!important}
            .headline{color:#fff;font-size:36px}
            .force-full-width{width:100%!important}
            .force-width-80{width:80%!important}
            .force-width-40{width:50%!important}
            @media screen {
                td,h1,h2,h3{font-family:'Open Sans','Helvetica Neue','Arial','sans-serif'!important}
            }
            @media only screen and (max-width: 600px) {
                table[class="w290"]{width:290px!important}
                table[class="w300"]{width:300px!important}
                table[class="w320"]{width:480px!important}
                table[class*="w100p"]{width:100%!important}
                td[class="w320"]{width:4800px!important}
                td[class="mobile-center"]{text-align:center!important}
                td[class*="mobile-padding"]{padding-left:20px!important;padding-right:20px!important;padding-bottom:20px!important}
                td[class*="mobile-block"]{display:block!important;width:100%!important;text-align:left!important;padding-bottom:20px!important}
                td[class*="mobile-border"]{border:0!important}
                td[class*="reveal"]{display:block!important}
                td[class*="mobile-spacing"]{padding-top:10px!important;padding-bottom:10px!important}
                *[class*="mobile-hide"]{display:none!important}
                *[class*="mobile-br"]{font-size:12px!important}
                td[class*="mobile-w20"]{width:20px!important}
                img[class*="mobile-w20"]{width:20px!important}
                img[class*="w320"]{width:250px!important;height:67px!important}
                .mobile-padding {padding:10px 30px !important;;}
            }
            @media only screen and (max-width: 480px) {
                table[class="w290"]{width:290px!important}
                table[class="w300"]{width:300px!important}
                table[class="w320"]{width:300px!important}
                table[class*="w100p"]{width:100%!important}
                td[class="w320"]{width:300px!important}
                td[class="mobile-center"]{text-align:center!important}
                td[class*="mobile-padding"]{padding-left:20px!important;padding-right:20px!important;padding-bottom:20px!important}
                td[class*="mobile-block"]{display:block!important;width:100%!important;text-align:left!important;padding-bottom:20px!important}
                td[class*="mobile-border"]{border:0!important}
                td[class*="reveal"]{display:block!important}
                td[class*="mobile-spacing"]{padding-top:10px!important;padding-bottom:10px!important}
                *[class*="mobile-hide"]{display:none!important}
                *[class*="mobile-br"]{font-size:12px!important}
                td[class*="mobile-w20"]{width:20px!important}
                img[class*="mobile-w20"]{width:20px!important}
                img[class*="w320"]{width:250px!important;height:67px!important}
                td[class*="activate-now"]{padding-right:0!important;padding-top:20px!important}
                td[class*="mobile-align"]{text-align:left!important}
                td[class*="mobile-center"]{text-align:center!important}
                .mobile-padding {padding:10px 10px !important;}
            }
        </style>
    </head>
    <body  offset="0" class="body" style="padding:0; margin:0; display:block; background:#eeebeb; -webkit-text-size-adjust:none" bgcolor="#eeebeb">
    <table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%" >
        <tr>
            <td align="center" valign="top" style="background-image: url(<?= $constante->getUrl(array(), false, false); ?>view/include/template/images/background/13.jpg);background-size: auto 100%;background-position: top center;background-repeat:no-repeat" width="100%">
                <center>
                    <table style="margin:0 auto;" cellspacing="0" height="60" cellpadding="0" width="100%">
                        <tr>
                            <td style="text-align: center;">
                                <a href="#"><img width="91" height="28" src="<?= $constante->getUrl(array(), false, false); ?>images/logo/logo-white.png" alt="SAS CRIDIP" /></a>
                            </td>
                        </tr>
                    </table>
                    <table cellspacing="0" cellpadding="0" width="600" class="w320" style="border-radius: 4px;overflow: hidden;">
                        <tr>
                            <td align="center" valign="top">
                                <table cellspacing="0" cellpadding="0" class="force-full-width">
                                    <tr>
                                        <td class="bg bg1" style="background-color:#F1F2F5;">
                                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                                                <tr>
                                                    <td style="font-size:24px; font-weight: 600; color: #121212; text-align:center;" class="mobile-spacing">
                                                        <div class="mobile-br">&nbsp;</div>
                                                        <span>Bienvenue sur le portail de SAS CRIDIP</span>
                                                            <br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:17px; text-align:center; padding: 10px 75px 0; color:#6E6E6E;" class="w320 mobile-spacing mobile-padding">
                                                        <span>Suivez votre facturation et vos services</span><br><br>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table cellspacing="0" cellpadding="0" width="100%" style="background-color:#F1F2F5">
                                                <tr>
                                                    <td>
                                                        <img src="<?= $constante->getUrl(array(), false, false); ?>view/include/template/images/signup.png" style="max-width:100%; display:block;">
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table cellspacing="0" cellpadding="0" class="force-full-width">
                                    <tr>
                                        <td class="bg bg1" style="background-color:#F1F2F5;">
                                            <center>
                                                <table style="margin: 0 auto" cellpadding="0" cellspacing="0" class="force-width-80">
                                                    <tr>
                                                        <br><br>
                                                        <td class="mobile-resize" style="color:#172838; font-size: 20px; font-weight: 600; text-align: left; vertical-align: top;">
                                                            <span>Vos Identifiants de connexion au service</span>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table style="margin: 0 auto;" cellspacing="0" cellpadding="0" class="force-width-80">
                                                    <tr>
                                                        <td style="text-align:left; color: #6f6f6f;">
                                                            <table style="width: 50%;">
                                                                <tr>
                                                                    <td style="width: 50%; font-weight: bold;">Identifiant:</td>
                                                                    <td style="width: 50%; font-weight: bold;"><?= $username; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 50%; font-weight: bold;">Mot de Passe:</td>
                                                                    <td style="width: 50%; font-weight: bold;"><?= $pass; ?></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </center>
                                            <table style="margin:0 auto;" cellspacing="0" cellpadding="10" width="100%">
                                                <tr>
                                                    <td style="text-align:center; margin:0 auto;">
                                                        <br>
                                                        <div>
                                                            <!--[if mso]>
                                                            <v:rect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://" style="height:45px;v-text-anchor:middle;width:240px;" stroke="f" fillcolor="#f5774e">
                                                                <w:anchorlock/>
                                                                <center>
                                                            <![endif]-->
                                                            <a class="btn" href="https://portail.cridip.com"
                                                               style="background-color:#172838;color:#ffffff;display:inline-block;font-family:'Source Sans Pro', Helvetica, Arial, sans-serif;font-size:18px;font-weight:400;line-height:45px;text-align:center;text-decoration:none;width:240px;-webkit-text-size-adjust:none;
                                    -webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;">Acceder au Portail</a>
                                                            <!--[if mso]>
                                                            </center>
                                                            </v:rect>
                                                            <![endif]-->
                                                        </div>
                                                        <br>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table cellspacing="0" cellpadding="0" width="600" class="w320" style="border-radius: 4px;overflow: hidden;">
                        <tr>
                            <td align="center" valign="top">
                                <table cellspacing="0" cellpadding="0" class="force-full-80" style="width:80%;margin:auto">
                                    <tr>
                                        <td style="text-align:center;">
                                            &nbsp;
                                    </tr>
                                    <tr>
                                        <td style="color:#D2D2D2;color:rgba(255,255,255,0.5); font-size: 14px;padding-bottom:4px;">
                                            <table border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="force-width-50">
                                                <tr>
                                                    <td style="height:21px;text-align:center;font-size:12px;" class="mobile-center">
                                                        <span>Copyright © 2016 SAS CRIDIP, All Right Reserved.</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="height:21px;text-align:center;font-size:12px;" class="mobile-center">
                                                        <span>8 Rue Octave Voyer - 85100 Les Sables d'Olonne - FRANCE</span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">
                                            &nbsp;
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table cellspacing="0" cellpadding="0" class="force-full-width">
                        <tr>
                            <td style="font-size:12px;">
                                &nbsp;
                                <br>
                            </td>
                        </tr>
                    </table>
                </center>
            </td>
        </tr>
    </table>
    </body>
    </html>

    <?php

    $message = ob_get_clean();
    $mail = mail($to, $sujet, $message, $headers);

    if($client_i == 1 AND $user_client_insert == 1){
        $text = "Le client à été créer avec succès !";
        header("Location: ../../view/gestion/index.php?view=client&sub=view&num_client=$num_client&success=add_client&text=$text");
    }elseif($client_i == 1 AND $user_client_insert == 0){
        $text = "Le client <strong>$nom_client $prenom_client</strong> à bien été créer mais son groupement de login/password n'à pas été définie !";
        header("Location: ../../view/gestion/index.php?view=client&sub=view&num_client=$num_client&warning=add_client&text=$text");
    }elseif($client_i == 0 AND $user_client_insert == 1){
        $text = "Le client <strong>$nom_client $prenom_client</strong> n'à pas été créer mais sont groupement login/password à été définie !";
        header("Location: ../../view/gestion/index.php?view=client&sub=view&num_client=$num_client&warning=add_client&text=$text");
    }else{
        var_dump($client_i, $user_client_insert);
    }

}
if(isset($_POST['action']) && $_POST['action'] == 'add_courrier')
{
    session_start();
    require "../../application/classe.php";
    $idclient = $_POST['idclient'];
    $iduser = $_POST['iduser'];
    $sujet = htmlentities(addslashes($_POST['sujet']));
    $message = htmlentities(addslashes($_POST['message']));
    $date_message = strtotime(date("d-m-Y h:i:s"));

    $courrier_i = $DB->execute("INSERT INTO client_communication(idclientmessage, idclient, objet, message, iduser, date_expedition) VALUES (NULL, :idclient, :objet, :message, :iduser, :date_expedition)", array(
        "idclient"          => $idclient,
        "objet"             => $sujet,
        "message"           => $message,
        "iduser"            => $iduser,
        "date_expedition"   => $date_message
    ));

    if($courrier_i == 1){
        $courrier = $DB->query("SELECT * FROM client_communication, users, client WHERE client_communication.iduser = users.iduser AND client_communication.idclient = client.idclient ORDER BY idclientmessage DESC LIMIT 1");
        $num_client = $courrier[0]->num_client;
        $text = "Le courrier à bien été éditer !";
        header("Location: ../../view/gestion/index.php?view=client&sub=view&num_client=$num_client&success=add_courrier&text=$text");
    }else{
        var_dump($courrier_i);
        die("Veuillez contacter l'administrateur par mail à support@cridip.com et lui envoyer ce log ci-dessus");
    }
}