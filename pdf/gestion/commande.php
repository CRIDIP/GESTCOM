<?php
require "../../application/classe.php";
$num_commande = $_GET['num_commande'];
$sql_commande = $DB->query("SELECT * FROM commande, client WHERE commande.idclient = client.idclient AND num_commande = :num_commande", array('num_commande' => $num_commande));
$commande = $sql_commande[0];
ob_start();
?>
    <page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
        <page_header>
            <table style="width: 100%;">
                <tr>
                    <td style="width: 50%;"><img src="<?= $constante->getUrl(array('images', 'logo/')); ?>logo-cridip.png" width="300" alt=""></td>
                    <td style="width: 50%; text-align: right; font-size: 25px; padding-right: 15px; color: #bdc3c7;">COMMANDE</td>
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
                                        <td style="font-weight: bold; width: 50%;">Commande:</td>
                                        <td style="width: 50%;"><?= $num_commande; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold; width: 50%;">Date:</td>
                                        <td style="width: 50%;"><?= $date_format->formatage("d/m/Y", $commande->date_commande); ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold; width: 50%;">N° Client:</td>
                                        <td style="width: 50%;"><?= $commande->num_client; ?></td>
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
                                        <?php if(empty($commande->societe)): ?>
                                            <td style="font-weight: bold; width: 100%;">
                                                <?= $commande->nom_client; ?> <?= $commande->prenom_client; ?><br>
                                                <?= html_entity_decode($commande->adresse_client); ?><br>
                                                <?= $commande->code_postal; ?> <?= html_entity_decode($commande->ville_client); ?>
                                            </td>
                                        <?php else: ?>
                                            <td style="font-weight: bold; width: 100%;">
                                                <strong><?= html_entity_decode($commande->societe); ?></strong><br>
                                                <i><?= $commande->nom_client; ?> <?= $commande->prenom_client; ?></i><br>
                                                <?= html_entity_decode($commande->adresse_client); ?><br>
                                                <?= $commande->code_postal; ?> <?= html_entity_decode($commande->ville_client); ?>
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
                <td style="width: 100%; font-size: 15px;">COMMANDE N° <strong><?= $num_commande; ?></strong> du <?= date("d", $commande->date_commande); ?> <?= $date_format->formatage_sequenciel("m", $commande->date_commande); ?> <?= date("Y", $commande->date_commande); ?></td>
            </tr>
            <tr>
                <td style="width: 100%;">
                    <table style="width: 100%;" cellpadding="0" cellspacing="0">
                        <tr style="background-color: #2980b9; color: white; font-weight: bold;">
                            <td style="width: 100%; padding: 5px;" colspan="2">Article & Service</td>
                        </tr>
                        <?php
                        $sql_article = $DB->query("SELECT * FROM commande_article, article WHERE commande_article.idarticle = article.idarticle AND num_commande = :num_commande", array("num_commande" => $num_commande));
                        foreach ($sql_article as $article):
                        ?>
                        <tr style="background-color: #95a5a6; color: #2e2e2e;">
                            <td style="width: 50%; padding: 5px; padding-left: 15px;"><?= html_entity_decode($article->designation_article); ?></td>
                            <td style="width: 50%; padding: 5px; text-align: right;"><?= $fonction->number_decimal($article->total_ligne); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr style="background-color: #7f8c8d; color: #000; font-weight: bold;">
                            <td style="width: 50%; padding: 5px;">Total de la commande HT</td>
                            <td style="width: 50%; padding: 5px; text-align: right;"><?= $fonction->number_decimal($commande->total_commande); ?></td>
                        </tr>
                        <tr style="background-color: #95a5a6; color: #2e2e2e;">
                            <td style="width: 50%; padding: 5px; padding-left: 15px;">TVA (20,00%)</td>
                            <td style="width: 50%; padding: 5px; text-align: right;"><?= $fonction->number_decimal($tva->calc_tva($commande->total_commande)); ?></td>
                        </tr>
                        <tr style="background-color: #7f8c8d; color: #000; font-weight: bold;">
                            <td style="width: 50%; padding: 5px;">Total Taxes</td>
                            <td style="width: 50%; padding: 5px; text-align: right;"><?= $fonction->number_decimal($tva->calc_tva($commande->total_commande)); ?></td>
                        </tr>
                        <tr style="background-color: #2c3e50; color: #ecf0f1; font-weight: bold; font-size: 20px;">
                            <td style="width: 50%; padding: 20px;">Total du devis TTC*</td>
                            <td style="width: 50%; padding: 5px; text-align: right;"><?= $fonction->number_decimal($tva->calc_ttc($commande->total_commande)); ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div style="margin-top: 15px; margin-bottom: 15px;"></div>
        <table style="width: 100%; border: solid 1px #34495e;">
            <tr>
                <td style="width: 100%; padding: 15px; ">
                    * Cette commande ne peut être executer que par votre acceptation définitive sur votre espace et le paiement de la facture correspondante.
                </td>
            </tr>
        </table>

    </page>
<?php
$content = ob_get_clean();
$html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 3);
$html2pdf->pdf->SetDisplayMode('fullpage');
$html2pdf->writeHTML($content);
$html2pdf->Output($num_commande.'.pdf');


