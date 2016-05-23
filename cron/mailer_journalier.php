<?php
require dirname(__DIR__)."/application/classe.php";
$sql_user = $DB->query("SELECt * FROM users WHERE groupe = 1");
foreach ($sql_user as $user){
    //Import des Evenement Journalier
    $sql_event = $DB->query("SELECT * FROM collab_event WHERE iduser = :iduser", array("iduser" => $user->iduser));
    
    //Count des Mails non lu
    $sql_inbox = $DB->count("SELECT COUNT(idinbox) FROM collab_inbox WHERE destinataire = :destinataire AND lu = 0", array("destinataire" => $user->iduser));
    $inbox = $sql_inbox[0];
    //Mise en Place du Mail
    $to = $user->email_user;
    $sujet = "[GESTION CRIDIP] RAPPEL & STATISTIQUE DU JOUR:".$date_format->formatage_long($date_format->date_jour_strt());

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    $headers .= 'From: CRIDIP <no-reply@cridip.com>' . "\r\n";
    ob_start();
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns:v="urn:schemas-microsoft-com:vml">
    <head>

        <!-- Define Charset -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <!-- Responsive Meta Tag -->
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />

        <link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <table style="background-color: rgba(0, 11, 60, 1);" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tbody><tr><td style="font-size: 90px; line-height: 90px;" height="90">&nbsp;</td></tr>
            <tr>
                <td>
                    <table class="container590 bodybg_color" style="background-image: url(http://themastermail.com/alerta/notif7/img/bg.png); background-size: 100% 100%; background-position: top center; background-repeat: no-repeat;" align="center" background="http://themastermail.com/alerta/notif7/img/bg.png" border="0" cellpadding="0" cellspacing="0" width="537">

                        <tbody><tr><td style="font-size: 40px; line-height: 40px;" height="40">&nbsp;</td></tr>

                        <tr>
                            <td>
                                <table align="center" border="0" cellpadding="0" cellspacing="0">
                                    <tbody><tr>
                                        <!-- ======= logo ======= -->
                                        <td align="center">
                                            <a href="" style="display: block; border-style: none !important; border: 0 !important;" class="editable_img"><img class="" style="display: block; width: 35px;" src="https://gestcom.cridip.com/assets//images/logo/logo-white.png" alt="logo" border="0" width="35"></a>
                                        </td>
                                    </tr>
                                    </tbody></table>
                            </td>
                        </tr>

                        <tr><td style="font-size: 60px; line-height: 60px;" height="60">&nbsp;</td></tr>

                        <tr>
                            <td style="color: #181c27; font-size: 30px; font-family: 'Questrial', sans-serif; mso-line-height-rule: exactly; line-height: 30px;" class="title_color main-header" align="center">

                                <!-- ======= section header ======= -->

                                <div class="editable_text" style="line-height: 30px;">
                                    <span class="text_container">BONJOUR <strong><?= $user->nom_user; ?> <?= $user->prenom_user; ?></strong></span>
                                </div>
                            </td>
                        </tr>

                        <tr><td style="font-size: 55px; line-height: 55px;" height="55">&nbsp;</td></tr>

                        <tr>
                            <td>
                                <table class="container580" align="center" border="0" cellpadding="0" cellspacing="0" width="440">
                                    <tbody><tr>
                                        <td style="color: #8d94a3; font-size: 16px; font-family: 'Questrial', sans-serif; mso-line-height-rule: exactly; line-height: 24px;" class="resize-text text_color" align="center">
                                            <div class="editable_text" style="line-height: 24px">

                                                <!-- ======= section text ======= -->
                                                <div class="text_container">
                                                    <p>Voici un rapide rappel de votre journée du <?= $date_format->formatage_long($date_format->date_jour_strt()); ?>.</p>
                                                    <h2>Vos Rendez-vous de la journée:</h2>
                                                    <ul>
                                                        <?php foreach ($sql_event as $event): ?>
                                                        <li><strong><?= html_entity_decode($event->titre_event); ?></strong> de <strong><?= $date_format->formatage("H:i", $event->start_event); ?></strong> à <strong><?= $date_format->formatage("H:i", $event->end_event); ?></strong></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                    <br>
                                                    <h2>Nombre de Mail interne non lu: <strong><?= $inbox; ?></strong></h2>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody></table>
                            </td>
                        </tr>

                        <tr><td style="font-size: 35px; line-height: 35px;" height="35">&nbsp;</td></tr>

                        <tr>
                            <td align="center">

                                <table style="border-radius: 50px; box-shadow: 0 2px 0 2px #ca5168;" class="cta-button button_color" align="center" bgcolor="ea667f" border="0" cellpadding="0" cellspacing="0" width="300">

                                    <tbody><tr><td style="font-size: 17px; line-height: 17px;" height="17">&nbsp;</td></tr>

                                    <tr>

                                        <td style="color: #ffffff; font-size: 18px; font-family: 'Questrial', sans-serif;" class="cta-text" align="center">
                                            <!-- ======= main section button ======= -->

                                            <div class="editable_text" style="line-height: 24px;">
                                                <span class="text_container"><a href="https://gestcom.cridip.com" style="color: #ffffff; text-decoration: none;">Acceder au logiciel GESTCOM de CRIDIP</a></span>
                                            </div>
                                        </td>

                                    </tr>

                                    <tr><td style="font-size: 17px; line-height: 17px;" height="17">&nbsp;</td></tr>

                                    </tbody></table>
                            </td>
                        </tr>

                        <tr><td style="font-size: 55px; line-height: 55px;" height="55">&nbsp;</td></tr>

                        <tr>
                            <td>
                                <table class="container580" align="center" border="0" cellpadding="0" cellspacing="0" width="440">
                                    <tbody><tr>
                                        <td style="color: #8d94a3; font-size: 14px; font-family: 'Questrial', sans-serif; line-height: 22px;" class="text_color" align="center">
                                            <!-- ======= section subtitle ====== -->

                                            <div class="editable_text" style="line-height: 22px;">
                                                <span class="text_container"></span>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody></table>
                            </td>
                        </tr>

                        <tr><td style="font-size: 60px; line-height: 60px;" height="60">&nbsp;</td></tr>

                        </tbody></table>
                </td>
            </tr>
        </table>
    </body>
    </html>
    <?php
    $message = ob_get_clean();
    $mail = mail($to, $sujet, $message, $headers);
}