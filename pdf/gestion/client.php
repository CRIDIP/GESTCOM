<?php
require "../../application/classe.php";
$num_client = $_GET['num_client'];
$sql_client = $DB->query("SELECT * FROM client, client_info_default, conf_annuaire_cat_client WHERE client_info_default.idclient = client.idclient AND client.cat_client = conf_annuaire_cat_client.idcatclient AND client.num_client = :num_client", array("num_client" => $num_client));
$client = $sql_client[0];
ob_start();
?>
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <page_header>
        <table style="width: 100%;">
            <tr>
                <td style="width: 50%;"><img src="<?= $constante->getUrl(array('images', 'logo/')); ?>logo-cridip.png" width="300" alt=""></td>
                <td style="width: 50%; text-align: right; font-size: 25px; padding-right: 15px; color: #bdc3c7;">FICHE CLIENT</td>
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
            <td style="font-size: 30px; font-weight: bold; text-decoration: underline;">IDENTITE</td>
        </tr>
        <tr>
            <td>
                <table style="width: 100%; border: 1px solid; border-radius: 10px; margin-top: 30px;" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="width: 50%; padding: 10px; font-weight: bold; border-right: 1px solid; border-bottom: 1px solid;">NUMERO CLIENT:</td>
                        <td style="width: 50%; padding: 10px; border-bottom: 1px solid;"><?= $client->num_client; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 50%; padding: 10px; font-weight: bold; border-right: 1px solid; border-bottom: 1px solid;">CATEGORIE:</td>
                        <td style="width: 50%; padding: 10px; border-bottom: 1px solid;"><?= $client->libelle_cat_client; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 50%; padding: 10px; font-weight: bold; border-right: 1px solid; border-bottom: 1px solid;">NOM:</td>
                        <td style="width: 50%; padding: 10px; border-bottom: 1px solid;"><?= $client->nom_client; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 50%; padding: 10px; font-weight: bold; border-right: 1px solid;border-bottom: 1px solid;">PRENOM:</td>
                        <td style="width: 50%; padding: 10px;border-bottom: 1px solid;"><?= $client->prenom_client; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 50%; padding: 10px; font-weight: bold; border-right: 1px solid; border-bottom: 1px solid;">ADRESSE POSTAL:</td>
                        <td style="width: 50%; padding: 10px; border-bottom: 1px solid;">
                            <?php if(!empty($client->societe)): ?>
                            <strong><?= $client->societe; ?></strong><br>
                            <?php endif; ?>
                            <?= html_entity_decode($client->adresse_client); ?><br>
                            <?= $client->code_postal; ?> <?= html_entity_decode($client->ville_client); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%; padding: 10px; font-weight: bold; border-right: 1px solid;">COORDONNEES:</td>
                        <td style="width: 50%; padding: 10px;">
                            <?php if(!empty($client->tel_client)): ?>
                                <strong>TEL:</strong> <?= $client->tel_client; ?><br>
                            <?php endif; ?>
                            <?php if(!empty($client->mail_client)): ?>
                                <strong>MAIL:</strong> <?= $client->mail_client; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table style="width: 100%; position: relative; margin-top: 30px;">
        <tr>
            <td style="font-size: 30px; font-weight: bold; text-decoration: underline;">INFORMATION COMMERCIAL</td>
        </tr>
        <tr>
            <td>
                <table style="width: 100%; border: 1px solid; border-radius: 10px; margin-top: 30px;" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="width: 50%; padding: 10px; font-weight: bold; border-right: 1px solid; border-bottom: 1px solid;">TYPE DE FACTURATION:</td>
                        <td style="width: 50%; padding: 10px; border-bottom: 1px solid;">
                            <?php
                            switch($client->type_facturation){
                                case 1:
                                    echo "IMMEDIATE";
                                    break;
                                case 2:
                                    echo "Quotidient";
                                    break;
                                case 3:
                                    echo "Hebdomadaire";
                                    break;
                                case 4:
                                    echo "Bimensuel";
                                    break;
                                case 5:
                                    echo "Mensuel";
                                    break;
                                case 6:
                                    echo "Trimestriel";
                                    break;
                                case 7:
                                    echo "SEMESTRIEL";
                                    break;
                                case 8:
                                    echo "ANNUEL";
                                    break;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%; padding: 10px; font-weight: bold; border-right: 1px solid; border-bottom: 1px solid;">TYPE DE REGLEMENT (Default):</td>
                        <td style="width: 50%; padding: 10px; border-bottom: 1px solid;">
                            <?php
                            switch($client->type_reglement){
                                case 1:
                                    echo "ESPECES";
                                    break;
                                case 2:
                                    echo "CHEQUE";
                                    break;
                                case 3:
                                    echo "CB";
                                    break;
                                case 4:
                                    echo "VIREMENT";
                                    break;
                                case 5:
                                    echo "TNA (Traite non accepté)";
                                    break;
                                case 6:
                                    echo "PRLV (Prélèvement)";
                                    break;
                                case 7:
                                    echo "TA (Traite Accepté)";
                                    break;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%; padding: 10px; font-weight: bold; border-right: 1px solid; border-bottom: 1px solid;">ENCOURS AUTORISE:</td>
                        <td style="width: 50%; padding: 10px; border-bottom: 1px solid;"><?= $fonction->number_decimal($client->encours); ?></td>
                    </tr>
                    <tr>
                        <td style="width: 50%; padding: 10px; font-weight: bold; border-right: 1px solid; border-bottom: 1px solid;">SOLDE COMPTABLE:</td>
                        <td style="width: 50%; padding: 10px; border-bottom: 1px solid;"><?= $fonction->number_decimal($client->encours); ?></td>
                    </tr>
                    <tr>
                        <td style="width: 50%; padding: 10px; font-weight: bold; border-right: 1px solid;">DELAI DE REGLEMENT:</td>
                        <td style="width: 50%; padding: 10px;">
                            <?= $client->delai_reglement; ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</page>
<?php
$content = ob_get_clean();
$html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 3);
$html2pdf->pdf->SetDisplayMode('fullpage');
$html2pdf->writeHTML($content);
$html2pdf->Output("Fiche Client ".$client->nom_client.' '.$client->prenom_client.'.pdf');
