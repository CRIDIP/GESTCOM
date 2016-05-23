<?php
require "../../application/classe.php";
$num_facture = $_GET['num_facture'];
$sql_facture = $DB->query("SELECT * FROM facture, client, client_info_default, users WHERE facture.idclient = client.idclient AND client_info_default.idclient = client.idclient AND users.idclient = client.idclient AND num_facture = :num_facture", array('num_facture' => $num_facture));
$facture = $sql_facture[0];
$etat_rglt = $reglement_cls->total_rglt_facture($num_facture);
$date_echeance = $facture_cls->echeance_facture($facture->type_facturation, $facture->date_facture);
ob_start();


?>
    <page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
        <page_header>
            <table style="width: 100%;">
                <tr>
                    <td style="width: 50%;"><img src="<?= $constante->getUrl(array('images', 'logo/')); ?>logo-cridip.png" width="300" alt=""></td>
                    <td style="width: 50%; text-align: right; font-size: 25px; padding-right: 15px; color: #bdc3c7;">FACTURE</td>
                </tr>
                <tr>
                    <td colspan="2" style="width: 100%;"><img src="<?= $constante->getUrl(array('images/')); ?>dot.png" width="750" alt=""></td>
                </tr>
                <tr>
                    <td colspan="2" style="width: 40%;">
                        <strong>SAS CRIDIP</strong><br>
                        8 Rue Octave Voyer<br>
                        85100 Les Sables d'Olonne
                    </td>
                </tr>
            </table>
        </page_header>
        <page_footer>
            <table style="width: 100%; background-color: #95a5a6;">
                <tr>
                    <td style="width: 100%; padding: 10px; font-size: 10px;">
                        <h3><strong>Pour plus d'information:</strong></h3>
                        <ul>
                            <li><strong>Pour accéder à tous vos devis, commandes et factures, rendez-vous dans votre espace client > Mes Documents</strong></li>
                        </ul>
                    </td>
                </tr>
            </table>
            <table style="width: 100%;">
                <tr>
                    <td style="width: 100%; text-align: center">
                        <h6>SAS au capital de 100 € - RCS de la Roche Sur Yon 811 772 235 - N° TVA: FR 88 811 772 235 - Siège Social: 8 rue octave Voyer - 85100 Les Sables d'Olonne - FRANCE </h6>
                    </td>
                </tr>
            </table>
        </page_footer>
        <span style="padding-top: 15px; padding-bottom: 15px;"></span>
        <!-- HOOK: Identité du document -->
        <table style="width: 100%; position: relative; top: 150px;">
            <tr>
                <td style="width: 35%;">
                    <table style="width: 100%;">
                        <tr>
                            <td>
                                <table style="width: 100%; border: solid 1px #95a5a6; border-radius: 5px; padding: 15px;">
                                    <tr>
                                        <td style="font-weight: bold; width: 50%;">Facture:</td>
                                        <td style="width: 50%;"><?= $num_facture; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold; width: 50%;">Date:</td>
                                        <td style="width: 50%;"><?= $date_format->formatage("d/m/Y", $facture->date_facture); ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold; width: 50%;">Date d'échéance:</td>
                                        <td style="width: 50%;"><?= date("d/m/Y", $date_echeance); ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold; width: 50%;">N° Client:</td>
                                        <td style="width: 50%;"><?= $facture->num_client; ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width: 30%;">&nbsp;</td>
                <td style="width: 35%;">
                    <table style="width: 100%;">
                        <tr>
                            <td>
                                <table style="width: 100%;">
                                    <tr>
                                        <?php if(empty($facture->societe)): ?>
                                            <td style="font-weight: bold; width: 100%;">
                                                <?= $facture->nom_client; ?> <?= $facture->prenom_client; ?><br>
                                                <?= html_entity_decode($facture->adresse_client); ?><br>
                                                <?= $facture->code_postal; ?> <?= html_entity_decode($facture->ville_client); ?>
                                            </td>
                                        <?php else: ?>
                                            <td style="font-weight: bold; width: 100%;">
                                                <strong><?= html_entity_decode($facture->societe); ?></strong><br>
                                                <i><?= $facture->nom_client; ?> <?= $facture->prenom_client; ?></i><br>
                                                <?= html_entity_decode($facture->adresse_client); ?><br>
                                                <?= $facture->code_postal; ?> <?= html_entity_decode($facture->ville_client); ?>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div style="margin-top: 15px; margin-bottom: 15px;"></div>
        <!-- HOOK: Généralité du Document (Articles) -->
        <table style="width: 100%;">
            <tr>
                <td style="width: 100%; font-size: 15px;">FACTURE N° <strong><?= $num_facture; ?></strong> du <?= date("d", $facture->date_facture); ?> <?= $date_format->formatage_sequenciel("m", $facture->date_facture); ?> <?= date("Y", $facture->date_facture); ?></td>
            </tr>
            <tr>
                <td style="width: 100%;">
                    <table style="width: 100%;" cellpadding="0" cellspacing="0">
                        <tr style="background-color: #2980b9; color: white; font-weight: bold;">
                            <td style="width: 100%; padding: 5px;" colspan="2">Article & Service</td>
                        </tr>
                        <?php
                        $sql_article = $DB->query("SELECT * FROM facture_article, article WHERE facture_article.idarticle = article.idarticle AND num_facture = :num_facture", array("num_facture" => $num_facture));
                        foreach ($sql_article as $article):
                        ?>
                        <tr style="background-color: #95a5a6; color: #2e2e2e;">
                            <td style="width: 50%; padding: 5px; padding-left: 15px;"><?= html_entity_decode($article->designation_article); ?></td>
                            <td style="width: 50%; padding: 5px; text-align: right;"><?= $fonction->number_decimal($article->total_ligne); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr style="background-color: #7f8c8d; color: #000; font-weight: bold;">
                            <td style="width: 50%; padding: 5px;">Total de la commande HT</td>
                            <td style="width: 50%; padding: 5px; text-align: right;"><?= $fonction->number_decimal($facture->total_facture); ?></td>
                        </tr>
                        <tr style="background-color: #95a5a6; color: #2e2e2e;">
                            <td style="width: 50%; padding: 5px; padding-left: 15px;">TVA (20,00%)</td>
                            <td style="width: 50%; padding: 5px; text-align: right;"><?= $fonction->number_decimal($tva->calc_tva($facture->total_facture)); ?></td>
                        </tr>
                        <tr style="background-color: #7f8c8d; color: #000; font-weight: bold;">
                            <td style="width: 50%; padding: 5px;">Total Taxes</td>
                            <td style="width: 50%; padding: 5px; text-align: right;"><?= $fonction->number_decimal($tva->calc_tva($facture->total_facture)); ?></td>
                        </tr>
                        <tr style="background-color: #2c3e50; color: #ecf0f1; font-weight: bold; font-size: 20px;">
                            <td style="width: 50%; padding: 20px;">Total de la facture TTC*</td>
                            <td style="width: 50%; padding: 5px; text-align: right;"><?= $fonction->number_decimal($tva->calc_ttc($facture->total_facture)); ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div style="margin-top: 15px; margin-bottom: 15px;"></div>
        <?php if($etat_rglt != $facture->total_facture+$tva->calc_tva($facture->total_facture)): ?>
            <table style="width: 100%; border: solid 1px #34495e;">
                <tr>
                    <?php if($facture->type_reglement == 1): ?>
                        <td style="width: 100%; padding: 15px; ">
                            * Le montant de <strong><?= $fonction->number_decimal($tva->calc_ttc($facture->total_facture)); ?></strong> est à réglé avant le <?= date("d", $date_echeance); ?> <?= $date_format->formatage_sequenciel("m", $date_echeance); ?> <?= date("Y", $date_echeance); ?><br>par <strong>Espèces</strong> en notre bureau principal.
                        </td>
                    <?php elseif($facture->type_reglement == 2): ?>
                        <td style="width: 100%; padding: 15px; ">
                            * Le montant de <strong><?= $fonction->number_decimal($tva->calc_ttc($facture->total_facture)); ?></strong> est à réglé avant le <?= date("d", $date_echeance); ?> <?= $date_format->formatage_sequenciel("m", $date_echeance); ?> <?= date("Y", $date_echeance); ?><br>par <strong>Chèque</strong> en notre bureau principal.
                        </td>
                    <?php elseif($facture->type_reglement == 3): ?>
                        <td style="width: 100%; padding: 15px; ">
                            * Le montant de <strong><?= $fonction->number_decimal($tva->calc_ttc($facture->total_facture)); ?></strong> est à réglé avant le <?= date("d", $date_echeance); ?> <?= $date_format->formatage_sequenciel("m", $date_echeance); ?> <?= date("Y", $date_echeance); ?><br>par <strong>Carte bancaire</strong> en notre bureau principal ou via votre espace client.
                        </td>
                    <?php elseif($facture->type_reglement == 4): ?>
                        <td style="width: 100%; padding: 15px; ">
                            * Le montant de <strong><?= $fonction->number_decimal($tva->calc_ttc($facture->total_facture)); ?></strong> est à réglé avant le <?= date("d", $date_echeance); ?> <?= $date_format->formatage_sequenciel("m", $date_echeance); ?> <?= date("Y", $date_echeance); ?><br>par <strong>Virement bancaire</strong> sur le compte <strong>N° BIC: CMCIFR2A IBAN: FR76 1551 9390 4300 0231 7130 116 DENOMINATION: SAS CRIDIP</strong>.
                        </td>
                    <?php elseif($facture->type_reglement == 5): ?>
                        <td style="width: 100%; padding: 15px; ">
                            * Le montant de <strong><?= $fonction->number_decimal($tva->calc_ttc($facture->total_facture)); ?></strong> est à réglé avant le <?= date("d", $date_echeance); ?> <?= $date_format->formatage_sequenciel("m", $date_echeance); ?> <?= date("Y", $date_echeance); ?><br>par <strong>Traite Non Accepter</strong> Présenté à votre banque en date d'échéance.
                        </td>
                    <?php elseif($facture->type_reglement == 6): ?>
                        <td style="width: 100%; padding: 15px; ">
                            * Le montant de <strong><?= $fonction->number_decimal($tva->calc_ttc($facture->total_facture)); ?></strong> sera prélevé le <?= date("d", $date_echeance); ?> <?= $date_format->formatage_sequenciel("m", $date_echeance); ?> <?= date("Y", $date_echeance); ?><br>sur votre compte <strong>BIC: XXXXXXX IBAN: XXXXXXXXXXXXXXXXX</strong>.
                        </td>
                    <?php else: ?>
                        <td style="width: 100%; padding: 15px; ">
                            * Le montant de <strong><?= $fonction->number_decimal($tva->calc_ttc($facture->total_facture)); ?></strong> est à réglé avant le <?= date("d", $date_echeance); ?> <?= $date_format->formatage_sequenciel("m", $date_echeance); ?> <?= date("Y", $date_echeance); ?><br>par <strong>Traite Non Accepter</strong> Présenté à votre banque en date d'échéance.
                        </td>
                    <?php endif; ?>
                </tr>
            </table>
        <?php else: ?>
            <h2 style="font-weight: bold;">Mes Règlements</h2>
            <br>
            <table style="width: 100%; border: solid 1px #7f8c8d; border-radius: 5px;" cellpadding="0" cellspacing="0">
                <thead>
                    <tr style="text-align: center; background-color: #3498db; color: white;">
                        <th style="width: 25%; padding: 5px; border-bottom: solid 1px #7f8c8d; border-right: solid 1px #7f8c8d;">Numéro de Règlement</th>
                        <th style="width: 25%; padding: 5px; border-bottom: solid 1px #7f8c8d; border-right: solid 1px #7f8c8d;">Date du Règlement</th>
                        <th style="width: 25%; padding: 5px; border-bottom: solid 1px #7f8c8d; border-right: solid 1px #7f8c8d;">Type de Règlement</th>
                        <th style="width: 25%; padding: 5px; border-bottom: solid 1px #7f8c8d;">Montant du Règlement</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sq_rglt = $DB->query("SELECT * FROM reglement_facture WHERE num_facture = :num_facture", array("num_facture" => $num_facture));
                foreach ($sq_rglt as $rglt):
                ?>
                    <tr style="background-color: #95a5a6;">
                        <td style="width: 25%; padding: 5px; border-bottom: solid 1px #7f8c8d;border-right: solid 1px #7f8c8d;"><?= $rglt->num_reglement; ?></td>
                        <td style="width: 25%; padding: 5px; border-bottom: solid 1px #7f8c8d;border-right: solid 1px #7f8c8d;"><?= $date_format->formatage("d/m/Y", $rglt->date_reglement); ?></td>
                        <td style="width: 25%; padding: 5px; border-bottom: solid 1px #7f8c8d;border-right: solid 1px #7f8c8d; text-align: center;">
                            <?php
                            switch($rglt->type_reglement){
                                case 1:
                                    echo "Espèce";
                                    break;
                                case 2:
                                    echo "Chèque";
                                    break;
                                case 3:
                                    echo "CB - PAYPAL EUROPE";
                                    break;
                                case 4:
                                    echo "Virement bancaire";
                                    break;
                                case 5:
                                    echo "Traite Non Accepter";
                                    break;
                                case 6:
                                    echo "Prélèvement Bancaire";
                                    break;
                                case 7:
                                    echo "Traite Accepter";
                                    break;
                            }
                            ?>
                        </td>
                        <td style="width: 25%; padding: 5px; border-bottom: solid 1px #7f8c8d; text-align: right;"><?= $fonction->number_decimal($rglt->montant); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" style="text-align: right; padding: 25px;font-size: 20px;">Total des Règlements</td>
                        <td style="text-align: right; padding: 25px;font-size: 20px;font-weight: bold;"><?= $fonction->number_decimal($reglement_cls->total_rglt_facture($num_facture)); ?></td>
                    </tr>
                </tfoot>
            </table>
        <?php endif; ?>
    </page>
    <page>
        <page_header>
            <table style="width: 100%;">
                <tr>
                    <td style="width: 50%;"><img src="<?= $constante->getUrl(array('images', 'logo/')); ?>logo-cridip.png" width="300" alt=""></td>
                    <td style="width: 50%; text-align: right; font-size: 25px; padding-right: 15px; color: #bdc3c7;">FACTURE</td>
                </tr>
                <tr>
                    <td colspan="2" style="width: 100%;"><img src="<?= $constante->getUrl(array('images/')); ?>dot.png" width="750" alt=""></td>
                </tr>
                <tr>
                    <td colspan="2" style="width: 40%;">
                        <strong>SAS CRIDIP</strong><br>
                        8 Rue Octave Voyer<br>
                        85100 Les Sables d'Olonne
                    </td>
                </tr>
            </table>
        </page_header>
        <page_footer>
            <table style="width: 100%; background-color: #95a5a6;">
                <tr>
                    <td style="width: 100%; padding: 10px; font-size: 10px;">
                        <h3><strong>Pour plus d'information:</strong></h3>
                        <ul>
                            <li><strong>Pour accéder à tous vos devis, commandes et factures, rendez-vous dans votre espace client > Mes Documents</strong></li>
                        </ul>
                    </td>
                </tr>
            </table>
            <table style="width: 100%;">
                <tr>
                    <td style="width: 100%; text-align: center">
                        <h6>SAS au capital de 100 € - RCS de la Roche Sur Yon 811 772 235 - N° TVA: FR 88 811 772 235 - Siège Social: 8 rue octave Voyer - 85100 Les Sables d'Olonne - FRANCE </h6>
                    </td>
                </tr>
            </table>
        </page_footer>
        <table style="width: 100%; position: relative; top: 150px; margin: 5px; border: solid 1px #7f8c8d;">
            <tr>
                <td style="width: 25%; text-align: center;"><?= $facture->nom_client; ?></td>
                <td style="width: 25%; text-align: center;"><strong>Facture:</strong> <?= $num_facture; ?></td>
                <td style="width: 25%; text-align: center;"><strong>Date:</strong> <?= date("d/m/Y", $facture->date_facture); ?></td>
                <td style="width: 25%; text-align: center;"><strong>Identifiant:</strong> <?= $facture->username; ?></td>
            </tr>
        </table>
        <div style="margin-top: 30px; margin-bottom: 30px;"></div>
        <table style="width: 100%;">
            <tr>
                <td style="width: 100%; font-size: 15px;">Détails de votre facture n°<strong><?= $num_facture; ?></strong> du <?= date("d", $facture->date_facture); ?> <?= $date_format->formatage_sequenciel("m", $facture->date_facture); ?> <?= date("Y", $facture->date_facture); ?></td>
            </tr>
        </table>
        <div style="margin-top: 10px; margin-bottom: 10px;"></div>
        <table style="width: 100%; border: solid 1px #7f8c8d; border-radius: 5px;" cellpadding="0" cellspacing="0">
            <tr style="text-align: center; background-color: #3498db; color: white;">
                <th style="width: 25%; padding: 5px; border-bottom: solid 1px #7f8c8d; border-right: solid 1px #7f8c8d;">Service</th>
                <th style="width: 45%; padding: 5px; border-bottom: solid 1px #7f8c8d; border-right: solid 1px #7f8c8d;">Description</th>
                <th style="width: 5%; padding: 5px; border-bottom: solid 1px #7f8c8d; border-right: solid 1px #7f8c8d;">QTE</th>
                <th style="width: 25%; padding: 5px; border-bottom: solid 1px #7f8c8d;">Total</th>
            </tr>
            <?php
            $sql_article = $DB->query("SELECT * FROM facture_article, article WHERE facture_article.idarticle = article.idarticle AND facture_article.num_facture = :num_facture", array("num_facture" => $num_facture));
            foreach ($sql_article as $article):
            ?>
            <tr style="background-color: #95a5a6;">
                <td style="width: 25%; padding: 5px; border-bottom: solid 1px #7f8c8d;border-right: solid 1px #7f8c8d;"><?= html_entity_decode($article->designation_article); ?></td>
                <td style="width: 45%; padding: 5px; border-bottom: solid 1px #7f8c8d;border-right: solid 1px #7f8c8d;"><?= html_entity_decode($article->description_sup); ?></td>
                <td style="width: 5%; padding: 5px; border-bottom: solid 1px #7f8c8d;border-right: solid 1px #7f8c8d; text-align: center;"><?= $article->qte; ?></td>
                <td style="width: 25%; padding: 5px; border-bottom: solid 1px #7f8c8d; text-align: right;"><?= $fonction->number_decimal($article->total_ligne); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </page>
<?php
$content = ob_get_clean();
$html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 3);
$html2pdf->pdf->SetDisplayMode('fullpage');
$html2pdf->writeHTML($content);
$html2pdf->Output($num_facture.'.pdf');


