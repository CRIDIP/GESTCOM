<?php
function is_ajax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
if(is_ajax()){
    if(isset($_GET['action']) && $_GET['action'] == 'devis_saisie')
    {
        session_start();
        require "../../application/classe.php";

        $count_c = $DB->count("SELECT COUNT(iddevis) FROM devis WHERE etat_devis = 0");

        echo json_encode($count_c);
    }
    if(isset($_GET['action']) && $_GET['action'] == 'devis_reponse')
    {
        session_start();
        require "../../application/classe.php";

        $count_c = $DB->count("SELECT COUNT(iddevis) FROM devis WHERE etat_devis = 1");

        echo json_encode($count_c);
    }
    if(isset($_GET['action']) && $_GET['action'] == 'devis_valide')
    {
        session_start();
        require "../../application/classe.php";

        $count_c = $DB->count("SELECT COUNT(iddevis) FROM devis WHERE etat_devis = 2 OR etat_devis = 4");

        echo json_encode($count_c);
    }
    if(isset($_GET['action']) && $_GET['action'] == 'devis_refuse')
    {
        session_start();
        require "../../application/classe.php";

        $count_c = $DB->count("SELECT COUNT(iddevis) FROM devis WHERE etat_devis = 3");

        echo json_encode($count_c);
    }

    if(isset($_GET['action']) && $_GET['action'] == 'supp_devis')
    {
        session_start();
        require "../../application/classe.php";
        $num_devis = $_GET['num_devis'];

        $del_ligne = $DB->execute("DELETE FROM devis_article WHERE num_devis = :num_devis", array("num_devis" => $num_devis));
        $del_devis = $DB->execute("DELETE FROM devis WHERE num_devis = :num_devis", array("num_devis" => $num_devis));

        if($del_ligne >= 1 AND $del_devis == 1){
            echo json_encode(1);
        }elseif($del_ligne >= 1 AND $del_devis == 0){
            echo json_encode(2);
        }elseif($del_ligne == 0 AND $del_devis == 1){
            echo json_encode(3);
        }else{
            echo json_encode(4);
        }
    }
    if(isset($_GET['action']) && $_GET['action'] == 'edit_status')
    {
        require "../../application/classe.php";
        $etat = $_GET['etat'];
        $num_devis = $_GET['num_devis'];

        $devis_u = $DB->execute("UPDATE devis SET etat_devis = :etat_devis WHERE num_devis = :num_devis", array(
            "num_devis"     => $num_devis,
            "etat_devis"    => $etat
        ));

        $sql_client = $DB->query("SELECT * FROM devis, client WHERE devis.idclient = client.idclient AND num_devis = :num_devis", array("num_devis" => $num_devis));
        $client = $sql_client[0];
        
        if($etat == 1):
            $to = $client->mail_client;
            $sujet = "Votre devis N°".$num_devis." - SAS CRIDIP";

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            $headers .= 'From: CRIDIP <contact@cridip.com>' . "\r\n";

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

                <title>Notification 7 - Responsive Email Template</title><!-- Responsive Styles and Valid Styles -->

                <style type="text/css">

                    body{
                        width: 100%;
                        background-color: #ffffff;
                        margin:0;
                        padding:0;
                        -webkit-font-smoothing: antialiased;
                        mso-margin-top-alt:0px; mso-margin-bottom-alt:0px; mso-padding-alt: 0px 0px 0px 0px;
                    }

                    p,h1,h2,h3,h4{
                        margin-top:0;
                        margin-bottom:0;
                        padding-top:0;
                        padding-bottom:0;
                    }

                    span.preheader{display: none; font-size: 1px;}

                    html{
                        width: 100%;
                    }

                    table{
                        font-size: 14px;
                        border: 0;
                    }

                    /* ----------- responsivity ----------- */
                    @media only screen and (max-width: 640px){
                        /*------ top header ------ */
                        body[yahoo] .show{display: block !important;}
                        body[yahoo] .hide{display: none !important;}

                        /*----- main image -------*/
                        body[yahoo] .main-image img{width: 440px !important; height: auto !important;}

                        /* ====== divider ====== */
                        body[yahoo] .divider img{width: 440px !important;}

                        /*--------- banner ----------*/
                        body[yahoo] .banner img{width: 440px !important; height: auto !important;}
                        /*-------- container --------*/
                        body[yahoo] .container590{width: 440px !important;}
                        body[yahoo] .container580{width: 400px !important;}
                        body[yahoo] .container1{width: 420px !important;}
                        body[yahoo] .container2{width: 400px !important;}
                        body[yahoo] .container3{width: 380px !important;}

                        /*-------- secions ----------*/
                        body[yahoo] .section-item{width: 440px !important;}
                        body[yahoo] .section-img img{width: 440px !important; height: auto !important;}
                    }

                    @media only screen and (max-width: 479px){
                        /*------ top header ------ */
                        body[yahoo] .main-header{font-size: 24px !important;}
                        body[yahoo] .resize-text{font-size: 14px !important;}

                        /*----- main image -------*/
                        body[yahoo] .main-image img{width: 280px !important; height: auto !important;}

                        /* ====== divider ====== */
                        body[yahoo] .divider img{width: 280px !important;}
                        body[yahoo] .align-center{text-align: center !important;}


                        /*-------- container --------*/
                        body[yahoo] .container590{width: 280px !important;}
                        body[yahoo] .container580{width: 250px !important;}
                        body[yahoo] .container1{width: 260px !important;}
                        body[yahoo] .container2{width: 240px !important;}
                        body[yahoo] .container3{width: 220px !important;}

                        /*------- CTA -------------*/
                        body[yahoo] .cta-button{width: 200px !important;}
                        body[yahoo] .cta-text{font-size: 14px !important;}
                    }

                </style>
            </head>

            <body yahoo="fix" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">



            <table style="background-image: url(http://themastermail.com/alerta/notif7/img/main-bg.png); background-size: 100% 100%; background-position: top center;" class="main-bg" background="http://themastermail.com/alerta/notif7/img/main-bg.png" bgcolor="2b2e34" border="0" cellpadding="0" cellspacing="0" width="100%">

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
                                        <span class="text_container">VOTRE DEVIS EST PRET</span>
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
                                                    <span class="text_container">Votre Devis N° <strong><?= $num_devis; ?></strong> d'un montant de <strong><?= $fonction->number_decimal($tva->calc_ttc($client->total_devis)); ?></strong> est disponible sur votre espace personnel.</span>
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
                                                    <span class="text_container"><a href="https://portail.cridip.com" style="color: #ffffff; text-decoration: none;">Acceder au portail</a></span>
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

                <tr><td style="font-size: 40px; line-height: 40px;" height="40">&nbsp;</td></tr>

                <tr>
                    <td>
                        <table class="container590 bodybg_color" align="center" border="0" cellpadding="0" cellspacing="0" width="500">
                            <tbody><tr>
                                <td>
                                    <table style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590" align="left" border="0" cellpadding="0" cellspacing="0">

                                        <tbody><tr>
                                            <td style="color: #ffffff; font-size: 14px; font-family: 'Questrial', sans-serif; line-height: 22px;" class="text2_color" align="center">
                                                <div class="editable_text" style=" line-height: 22px;">
                                                    <span class="text_container">© 2016 SAS CRIDIP. All Rights Reserved.</span>
                                                </div>
                                            </td>
                                        </tr>

                                        </tbody></table>

                                    <table style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590" align="left" border="0" cellpadding="0" cellspacing="0" width="5">
                                        <tbody><tr><td style="font-size: 20px; line-height: 20px;" height="20" width="5">&nbsp;</td></tr>
                                        </tbody></table>

                                    <table style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590" align="right" border="0" cellpadding="0" cellspacing="0">
                                        <tbody><tr>
                                            <td align="center">
                                                <table align="center" border="0" cellpadding="0" cellspacing="0" width="75">
                                                    <tbody><tr><td style="font-size: 5px; line-height: 5px;" height="5">&nbsp;</td></tr>
                                                    <tr>
                                                        <td align="center">
                                                            <table align="center" border="0" cellpadding="0" cellspacing="0">
                                                                <tbody><tr>
                                                                    <td>
                                                                        <a style="display: block; width: 12px; height: 12px; border-style: none !important; border: 0 !important;" href="#" class="editable_img"><img style="display: block; width: 12px; height: 12px;" src="http://themastermail.com/alerta/notif7/img/instagram.png" alt="instagram" height="12" border="0" width="12"></a>
                                                                    </td>
                                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                    <td>
                                                                        <a style="display: block; width: 8px; height: 13px; border-style: none !important; border: 0 !important;" href="#" class="editable_img"><img style="display: block; width: 8px; height: 13px;" src="http://themastermail.com/alerta/notif7/img/facebook.png" alt="facebook" height="13" border="0" width="8"></a>
                                                                    </td>
                                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                    <td>
                                                                        <a style="display: block; width: 13px; height: 13px; border-style: none !important; border: 0 !important;" href="#" class="editable_img"><img style="display: block; width: 13px; height: 13px;" src="http://themastermail.com/alerta/notif7/img/google.png" alt="google" height="13" border="0" width="13"></a>
                                                                    </td>
                                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                    <td>
                                                                        <a style="display: block; width: 13px; height: 10px; border-style: none !important; border: 0 !important;" href="#" class="editable_img"><img class="" style="display: block; width: 13px; height: 10px;" src="http://themastermail.com/alerta/notif7/img/twitter.png" alt="twitter" height="10" border="0" width="13"></a>
                                                                    </td>
                                                                </tr>
                                                                </tbody></table>
                                                        </td>
                                                    </tr>
                                                    </tbody></table>
                                            </td>
                                        </tr>

                                        </tbody></table>
                                </td>
                            </tr>
                            </tbody></table>
                    </td>
                </tr>

                <tr><td style="font-size: 50px; line-height: 50px;" height="50">&nbsp;</td></tr>
                <tr><td style="font-size: 50px; line-height: 50px;" height="50">&nbsp;</td></tr>

                </tbody></table>


            </body>
            </html>
            <?php
            $message = ob_get_clean();
            $mail = mail($to, $sujet, $message, $headers);
            
        endif;
        if($etat == 4):
            //Transformation en commande
            $num_commande = "CMD".date("Ym").rand(100,999);
            $cmd_i = $DB->execute("INSERT INTO commande(num_devis, idclient, num_commande, date_commande, total_commande, etat_commande) VALUES (:num_devis, :idclient, :num_commande, :date_commande, :total_commande, :etat_commande)", array(
                "num_devis"     => $num_devis,
                "idclient"      => $client->idclient,
                "num_commande"  => $num_commande,
                "date_commande" => $date_format->date_jour_strt(),
                "total_commande"=> $client->total_devis,
                "etat_commande" => 1
            ));

            $cmd_q = $DB->query("SELECT * FROM commande WHERE num_commande = :num_commande", array("num_commande" => $num_commande));
            $commande = $cmd_q[0];

            $sql_devis_article = $DB->query("SELECT * FROM devis_article WHERE num_devis = :num_devis", array("num_devis" => $num_devis));
            foreach ($sql_devis_article as $article):
                $article_i = $DB->execute("INSERT INTO commande_article(num_commande, idarticle, qte, total_ligne) VALUES (:num_commande, :idarticle, :qte, :total_ligne)", array(
                    "num_commande"  => $num_commande,
                    "idarticle"     => $article->idarticle,
                    "qte"           => $article->qte,
                    "total_ligne"   => $article->total_ligne
                ));
            endforeach;

        endif;

        if($devis_u == 1){
            if($etat == 1){echo json_encode(200);}
            if($etat == 2){echo json_encode(201);}
            if($etat == 3){echo json_encode(202);}
            if($etat == 4){echo json_encode(203);}
        }else{
            echo json_encode(500);
        }
    }
    if(isset($_GET['action']) && $_GET['action'] == 'supp_article')
    {
        require "../../application/classe.php";
        $iddevisarticle = $_GET['iddevisarticle'];
        $num_devis = $_GET['num_devis'];

        $sql_article = $DB->query("SELECT * FROM devis_article WHERE iddevisarticle = :iddevisarticle", array("iddevisarticle" => $iddevisarticle));
        $sql_devis = $DB->query("SELECt * FROM devis WHERE num_devis = :num_devis", array("num_devis" => $num_devis));
        $total_devis = $sql_devis[0]->total_devis;

        $article_d = $DB->execute("DELETE FROM devis_article WHERE iddevisarticle = :iddevisarticle", array("iddevisarticle" => $iddevisarticle));
        $devis_up = $DB->execute("UPDATE devis SET total_devis = :total_devis WHERE num_devis = :num_devis", array(
            "num_devis"     => $num_devis,
            "total_devis"   => $total_devis - $sql_article[0]->total_ligne
        ));

        if($article_d == 1){
            echo json_encode(200);
        }else{
            echo json_encode(500);
        }


    }
}