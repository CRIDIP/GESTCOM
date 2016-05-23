<?php
function is_ajax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
if(is_ajax()){
    if(isset($_GET['action']) && $_GET['action'] == 'view_hebergement'){
        require "../../application/classe.php";
        $hb = $_GET['hb'];
        $hosting = $ovh->get("/hosting/web");
        $service = $ovh->get("/hosting/web/".$hb);
        $info    = $ovh->get("/hosting/web/".$hb."/serviceInfos");
        ob_start();
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-header">
                        <div class="row">
                            <div class="col-md-4"><h2><strong>Hebergement:</strong> <?= $hb; ?></h2></div>
                            <div class="col-md-4">
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="width: 50%;font-weight: bold;padding-top: 5px;padding-bottom: 5px;">IPV4:</td>
                                        <td style="width: 50%;padding-top: 5px;padding-bottom: 5px;"><?= $service['countriesIp'][10]['ip']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;font-weight: bold;padding-top: 5px;padding-bottom: 5px;">IPV6:</td>
                                        <td style="width: 50%;padding-top: 5px;padding-bottom: 5px;"><?= $service['countriesIp'][10]['ipv6']; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <strong>Expiration:</strong>
                                <?php
                                $date_str = strtotime($info['expiration']);
                                echo $date_format->formatage("d-m-Y", $date_str);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel-content">
                        <h2>Information Général</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="width: 50%;font-weight: bold;padding-top: 5px;padding-bottom: 5px;">Etat du Service:</td>
                                        <td style="width: 50%;padding-top: 5px;padding-bottom: 5px;">
                                            <?php
                                            switch($service['state']){
                                                case 'active':
                                                    echo '<i data-rel="tooltip" type="button" class="fa fa-check text-success" data-toggle="tooltip" data-placement="top" title="Tooltip on top">';
                                                    break;
                                                case 'bloqued':
                                                    echo "<i class='fa fa-remove text-danger' data-toggle='tooltip' data-rel='tooltip' title='Bloqué'></i>";
                                                    break;
                                                case 'maintenance':
                                                    echo "<i class='fa fa-warning text-warning' data-placement=\"right\" data-toggle='tooltip' data-rel='tooltip' title='Maintenance'></i>";
                                                    break;
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;font-weight: bold;padding-top: 5px;padding-bottom: 5px;">Offre:</td>
                                        <td style="width: 50%;padding-top: 5px;padding-bottom: 5px;"><?= $service['offer']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;font-weight: bold;padding-top: 5px;padding-bottom: 5px;">Domaine principal:</td>
                                        <td style="width: 50%;padding-top: 5px;padding-bottom: 5px;"><?= $service['serviceName']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;font-weight: bold;padding-top: 5px;padding-bottom: 5px;">Accès au Cluster:</td>
                                        <td style="width: 50%;padding-top: 5px;padding-bottom: 5px;"><a href="ftp://ftp.<?= $service['cluster']; ?>.ovh.net">ftp.<?= $service['cluster']; ?>.ovh.net</a></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h3>Espace Disque</h3>
                                <div class="progress progress-bar-large">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                        <span class="sr-only">40% Complete (success)</span>
                                        40%
                                    </div>
                                </div>
                                <h3>Traffic utilisé</h3>
                                <div class="progress progress-bar-large">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100" style="width: 1%">
                                        <span class="sr-only">40% Complete (success)</span>
                                        1%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $json_html = ob_get_clean();
        echo json_encode($json_html);
    }
}