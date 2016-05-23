<?php
require "../../application/classe.php";
$idclientmessage = $_GET['idclientmessage'];
$sql_message = $DB->query("SELECT * FROM client_communication, client WHERE client_communication.idclient = client.idclient AND idclientmessage = :idclientmessage", array("idclientmessage" => $idclientmessage));
$message = $sql_message[0];
ob_start();
?>
    <page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm">
        <page_header>
            <table style="width: 100%;">
                <tr>
                    <td style="width: 50%;"><img src="<?= $constante->getUrl(array('images', 'logo/')); ?>logo-cridip.png" width="300" alt=""></td>
                    <td style="width: 50%; text-align: right; font-size: 25px; padding-right: 15px; color: #bdc3c7;">COURRIER</td>
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
        <table style="width: 100%; position: relative; top: 200px;">
            <tr>
                <td style="width: 60%;">
                    &nbsp;
                </td>
                <td style="width: 40%;">
                    <table style="width: 100%; border: solid 1px #95a5a6; border-radius: 5px;">
                        <tr>
                            <?php if(!empty($message->societe)): ?>
                                <td style="width: 100%; padding: 10px;">
                                    <strong><?= html_entity_decode($message->societe); ?></strong><br>
                                    <i><?= $message->nom_client; ?> <?= $message->prenom_client; ?></i><br>
                                    <?= html_entity_decode($message->adresse_client); ?><br>
                                    <?= $message->code_postal; ?> <?= html_entity_decode($message->ville_client); ?>
                                </td>
                            <?php else: ?>
                                <td style="width: 100%; padding: 10px;">
                                    <?= $message->nom_client; ?> <?= $message->prenom_client; ?><br>
                                    <?= html_entity_decode($message->adresse_client); ?><br>
                                    <?= $message->code_postal; ?> <?= html_entity_decode($message->ville_client); ?>
                                </td>
                            <?php endif; ?>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div style="margin-top: 20px; margin-bottom: 20px;"></div>
        <table style="width: 100%;">
            <tr>
                <td style="width: 60%;">
                    <span style="text-decoration: underline;">Objet</span>:<br>
                    <?= html_entity_decode($message->objet); ?>
                </td>
                <td style="width: 40%;">
                    Aux Sables d'Olonne,<br>
                    le <?= $date_format->formatage("d/m/Y", $message->date_expedition); ?>
                </td>
            </tr>
        </table>
        <div style="margin-top: 30px; margin-bottom: 15px;"></div>
        <table style="width: 100%;">
            <tr>
                <td style="width: 100%;">
                    <?= html_entity_decode($message->message); ?>
                </td>
            </tr>
        </table>
    </page>
<?php
$content = ob_get_clean();
$html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 3);
$html2pdf->pdf->SetDisplayMode('fullpage');
$html2pdf->writeHTML($content);
$html2pdf->Output($message->objet.'.pdf');
