<?php
function is_ajax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
if(is_ajax()){
    if(isset($_GET['action']) && $_GET['action'] == 'view_domaine'){
        require "../../application/classe.php";
        $dm = $_GET['dm'];
        $domaine = $ovh->get("/domain/".$dm);
        $service = $ovh->get("/domain/".$dm."/serviceInfos");
        $dns        = $ovh->get("/domain/zone/".$dm);
        ob_start();
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-header">
                        <h3><?= $dm; ?></h3>
                    </div>
                    <div class="panel-content">
                        <h2>Information général</h2>
                        <table style="width: 100%;">
                            <tr>
                                <td style="width: 50%;font-weight: bold; padding-top: 5px; padding-bottom: 5px;">Statut:</td>
                                <td style="width: 50%; padding-top: 5px; padding-bottom: 5px;">
                                    <?php
                                    switch($service['status']){
                                        case 'expired':
                                            echo "<span class='text-danger'>Expiré</span>";
                                            break;
                                        case 'inCreation':
                                            echo "<span class='text-info'>En cours de Création</span>";
                                            break;
                                        case 'ok':
                                            echo "<span class='text-success'>Fonctionnement Parfait</span>";
                                            break;
                                        case 'unPaid':
                                            echo "<span class='text-warning'>Reglement non effectuer</span>";
                                            break;
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%;font-weight: bold; padding-top: 5px; padding-bottom: 5px;">Offre:</td>
                                <td style="width: 50%; padding-top: 5px; padding-bottom: 5px;">
                                    <?php
                                    switch($domaine['offer']){
                                        case 'diamond':
                                            echo "Diamant";
                                            break;
                                        case 'gold':
                                            echo "Or";
                                            break;
                                        case 'platinum':
                                            echo "Platine";
                                            break;
                                        default:
                                            echo "Inconnue";
                                            break;
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%;font-weight: bold; padding-top: 5px; padding-bottom: 5px;">Autorisation de transfert:</td>
                                <td style="width: 50%; padding-top: 5px; padding-bottom: 5px;">
                                    <?php
                                    switch($domaine['transferLockStatus']){
                                        case 'locked':
                                            echo "Fermé";
                                            break;
                                        case 'locking':
                                            echo "Verouillage en cours...";
                                            break;
                                        case 'unavailable':
                                            echo "Indisponible";
                                            break;
                                        case 'unlocked':
                                            echo "Dévérouillez";
                                            break;
                                        case 'unlocking':
                                            echo "Dévérouillage en cours...";
                                            break;
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%;font-weight: bold; padding-top: 5px; padding-bottom: 5px;">Type de serveur DNS:</td>
                                <td style="width: 50%; padding-top: 5px; padding-bottom: 5px;">
                                    <?php
                                    switch($domaine['nameServerType']){
                                        case 'external':
                                            echo "Externe";
                                            break;
                                        case 'hosted':
                                            echo "Hebergé";
                                            break;
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%;font-weight: bold; padding-top: 5px; padding-bottom: 5px;">Renouvellement:</td>
                                <td style="width: 50%; padding-top: 5px; padding-bottom: 5px;">
                                    <table style="width: 100%;">
                                        <tr>
                                            <td style="width: 50%;font-weight: bold;">Période:</td>
                                            <td style="width: 50%;"><?= $service['renew']['period']; ?> Mois</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%;font-weight: bold;">Valeur de Forcing:</td>
                                            <td style="width: 50%;">
                                                <?php if($service['renew']['forced'] == false){echo "Non";}else{echo "Oui";} ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%;font-weight: bold;">Automatique:</td>
                                            <td style="width: 50%;">
                                                <?php if($service['renew']['automatic'] == false){echo "Non";}else{echo "Oui";} ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%;font-weight: bold;">Suppression à l'expiration:</td>
                                            <td style="width: 50%;">
                                                <?php if($service['renew']['deleteAtExpiration'] == false){echo "Non";}else{echo "Oui";} ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%;font-weight: bold; padding-top: 5px; padding-bottom: 5px;">Date d'expiration:</td>
                                <td style="width: 50%; padding-top: 5px; padding-bottom: 5px;">
                                    <?php
                                    $date_expire = strtotime($service['expiration']);
                                    echo $date_format->formatage_long($date_expire);
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-header">
                        <h3>Service DNS</h3>
                    </div>
                    <div class="panel-content">
                        <table style="width: 100%;">
                            <tr>
                                <td style="width: 50%;font-weight: bold;padding-top: 5px; padding-bottom: 5px;">DNS ANYCAST (Ovh Supply):</td>
                                <td style="width: 50%;padding-top: 5px; padding-bottom: 5px;">
                                    <?php if($dns['hasDnsAnycast'] == false){echo "<span class='text-danger'>Non</span>";}else{echo "<span class='text-success'>Oui</span>";} ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%;font-weight: bold;padding-top: 5px; padding-bottom: 5px;">Support DNSSEC:</td>
                                <td style="width: 50%;padding-top: 5px; padding-bottom: 5px;">
                                    <?php if($dns['dnssecSupported'] == false){echo "<span class='text-danger'>Non</span>";}else{echo "<span class='text-success'>Oui</span>";} ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%;font-weight: bold;padding-top: 5px; padding-bottom: 5px;">ENREGISTREMENT DNS:</td>
                                <td style="width: 50%;padding-top: 5px; padding-bottom: 5px;">
                                    <table style="width: 100%;">
                                        <?php foreach($dns['nameServers'] as $item): ?>
                                        <tr>
                                            <td style="width: 100%;"><?= $item; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $json_html = ob_get_clean();
        echo json_encode($json_html);
    }
}