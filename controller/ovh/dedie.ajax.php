<?php
use App\ovh\dedie;

function is_ajax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
if(is_ajax()){
    if(isset($_GET['action']) && $_GET['action'] == 'view_dedie'){
        require "../../application/classe.php";
        $dedie_cls = new dedie();
        $ded = $_GET['ded'];
        $dedie = $ovh->get("/dedicated/server/".$ded); // Affiche les Propriété principal du serveur dédié
        $service = $ovh->get("/dedicated/server/".$ded."/serviceInfos"); // Affiche les propriété de service du serveur dédié
        $burst = $ovh->get("/dedicated/server/".$ded."/burst"); // Affiche la bande passante alloué au serveur
        $backup_gen = $ovh->get("/dedicated/server/".$ded."/features/backupFTP"); // Accede au information principal des sauvegarde ftp affecté au serveur
        $ipblock = $ovh->get("/dedicated/server/".$ded."/features/backupFTP/access"); //Liste les adresses ip authoriser à acceder au backup ftp (doit faire appel au /ipBlock en foreach)
        $intervention = $ovh->get("/dedicated/server/".$ded."/intervention"); //(liste) Affiche la liste des identifiant d'intervention à faire apparaitre dans un foreach /interventionId
        $monitoring = $ovh->get("/dedicated/server/".$ded."/serviceMonitoring"); //(liste) Affiche la liste des identifiant de monitoring à faire apparaitre dans un foreach /{monitoringId}
        $hardware = $ovh->get("/dedicated/server/".$ded."/specifications/hardware"); //Affiche les spécificité matériel du serveur
        $network = $ovh->get("/dedicated/server/".$ded."/specifications/network"); // Affiche les spécificité réseau du serveur

        $cpu = $ovh->get("/dedicated/server/".$ded."/statistics/cpu"); //Affiche les information du processeur du serveur
        $os = $ovh->get("/dedicated/server/".$ded."/statistics/os"); //Affiche les informations d'exploitation du serveur
        $stat = $ovh->get("/dedicated/server/".$ded."/statistics"); // Affiche le kernel de monitoring
        ob_start();
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <h1><strong><?= $ded; ?></strong></h1>
                                <h5 class="text-muted"><?= $ded; ?></h5>
                            </div>
                            <div class="col-md-6">
                                Ip: <?= $dedie['ip']; ?> <button class="btn btn-xs btn-default"><i class="fa fa-cog"></i> Gérer</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a class="btn btn-default btn-block" id="reboot-server" href="<?= $constante->getUrl(array(), false, false); ?>controller/ovh/dedie.ajax.php?action=reboot_now&ded=<?= $ded; ?>">Redemarrer le serveur</a>
                    </div>
                </div>
                <div class="row">
                    <div class="panel nav-tabs3">
                        <div class="panel-content">
                            <div class="nav-tabs3">
                                <ul id="myTab6" class="nav nav-tabs">
                                    <li class="active"><a href="#etat" data-toggle="tab">Etat du Serveur</a></li>
                                    <li><a href="#backup" data-toggle="tab">Backup Storage</a></li>
                                    <li><a href="#intervention" data-toggle="tab">Intervention</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade  active in" id="etat">
                                        <div class="panel">
                                            <div class="panel-header">
                                                <h3>Informations Générales</h3>
                                            </div>
                                            <div class="panel-content">
                                                <table style="width: 100%;">
                                                    <tr>
                                                        <td style="width: 25%; font-weight: bold; text-align: right; padding-right: 5px;">Statut</td>
                                                        <td style="width: 75%; padding-left: 5px;">
                                                            <?= $dedie_cls->search_state($dedie['state']); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 25%; font-weight: bold; text-align: right; padding-right: 5px;">Système d'exploitation (OS)</td>
                                                        <td style="width: 75%; padding-left: 5px;">
                                                            <?= $dedie_cls->search_os($dedie['os']); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 25%; font-weight: bold; text-align: right; padding-right: 5px;">Boot</td>
                                                        <td style="width: 75%; padding-left: 5px;">
                                                            <?= $dedie_cls->search_boot($dedie['bootId']); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 25%; font-weight: bold; text-align: right; padding-right: 5px;">Expire le</td>
                                                        <td style="width: 75%; padding-left: 5px;">
                                                            <?php
                                                            $date_str = $date_format->format_strt($service['expiration']);
                                                            echo $date_format->formatage("d/m/Y", $date_str);
                                                            ?>
                                                            <?php if($date_str <= $date_format->ech_7($date_format->date_jour_strt())): ?>
                                                                <span class="label label-warning">Bientôt Expiré</span>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="panel">
                                            <div class="panel-header">
                                                <h3>Bande Passante</h3>
                                            </div>
                                            <div class="panel-content">
                                                <table style="width: 100%;">
                                                    <tr>
                                                        <td style="width: 25%; font-weight: bold; text-align: right; padding-right: 5px;">Type</td>
                                                        <td style="width: 75%; padding-left: 5px;">
                                                            <?= $dedie_cls->search_bp($network['bandwidth']['type']); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 25%; font-weight: bold; text-align: right; padding-right: 5px;">Connexion Réseau</td>
                                                        <td style="width: 75%; padding-left: 5px;">
                                                            <?= $network['connection']['value']; ?> <?= $network['connection']['unit']; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 25%; font-weight: bold; text-align: right; padding-right: 5px;">BP OVH <-> OVH</td>
                                                        <td style="width: 75%; padding-left: 5px;">
                                                            <?= $network['bandwidth']['OvhToOvh']['value']; ?> <?= $network['bandwidth']['OvhToOvh']['unit']; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 25%; font-weight: bold; text-align: right; padding-right: 5px;">BP OVH <-> INTERNET</td>
                                                        <td style="width: 75%; padding-left: 5px;">
                                                            <?= $network['bandwidth']['OvhToInternet']['value']; ?> <?= $network['bandwidth']['OvhToInternet']['unit']; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 25%; font-weight: bold; text-align: right; padding-right: 5px;">BP INTERNET <-> OVH</td>
                                                        <td style="width: 75%; padding-left: 5px;">
                                                            <?= $network['bandwidth']['InternetToOvh']['value']; ?> <?= $network['bandwidth']['InternetToOvh']['unit']; ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="panel">
                                            <div class="panel-header">
                                                <h3>Etat des Services</h3>
                                            </div>
                                            <div class="panel-content">
                                                <table style="width: 100%;">
                                                    <tr>
                                                        <td style="width: 25%; font-weight: bold; text-align: right; padding-right: 5px;">Monitoring</td>
                                                        <td style="width: 75%; padding-left: 5px;">
                                                            <?php if($dedie['monitoring'] == true): ?>
                                                            <span class="label label-success">Activé</span> <button type="button" id="desactive_monitoring" class="btn btn-xs btn-default">Désactiver</button>
                                                            <?php else: ?>
                                                            <span class="label label-danger">Désactivé</span> <button type="button" id="active_monitoring" class="btn btn-xs btn-default">Activer</button>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <?php if($dedie['monitoring'] == true): ?>
                                                        <tr>
                                                            <td style="width: 25%; font-weight: bold; text-align: right; padding-right: 5px;">Services monitorés</td>
                                                            <td style="width: 75%; padding-left: 5px;">
                                                                <?php foreach ($monitoring as $moniteur): ?>
                                                                <?php
                                                                $idmod = $ovh->get("/dedicated/server/".$ded."/serviceMonitoring/".$moniteur);
                                                                ?>
                                                                    <span class="label label-success"><?= $idmod['protocol']; ?></span>
                                                                <?php endforeach; ?>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="panel">
                                            <div class="panel-header">
                                                <h3>Profil de la machine</h3>
                                            </div>
                                            <div class="panel-content">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <img src="<?= $dedie_cls->search_img_data($dedie['datacenter']); ?>" />
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <td style="width: 100%; font-weight: bold;">Datacentre</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 100%; padding-left: 10px;"><?= $dedie_cls->search_datacenter($dedie['datacenter']); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 100%; font-weight: bold;">Baie</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 100%; padding-left: 10px;"><?= $dedie['rack']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 100%; font-weight: bold;">Serveur ID</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 100%; padding-left: 10px;"><?= $dedie['serverId']; ?></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <td style="width: 100%; font-weight: bold;">CPU</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 100%; padding-left: 10px;">
                                                                    <?= $cpu['name']; ?><br>
                                                                    Core: <?= $cpu['core']; ?><br>
                                                                    Cache: <?= $cpu['cache']['value']; ?> <?= $cpu['cache']['unit']; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 100%; font-weight: bold;">RAM</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 100%; padding-left: 10px;">
                                                                    <?= $hardware['memorySize']['value']; ?> <?= $hardware['memorySize']['unit']; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 100%; font-weight: bold;">Disques</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 100%; padding-left: 10px;">
                                                                    <?= $hardware['diskGroups'][0]['numberOfDisks']; ?> X <?= $hardware['diskGroups'][0]['diskSize']['value']; ?> <?= $hardware['diskGroups'][0]['diskSize']['unit']; ?> <?= $hardware['diskGroups'][0]['diskType']; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 100%; font-weight: bold;">Carte Mère</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 100%; padding-left: 10px;">
                                                                    <?= $hardware['motherboard']; ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <td style="width: 100%; font-weight: bold;">Version Real Time Monitoring</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 100%; padding-left: 10px;">
                                                                    <?= $stat['installedVersion']; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 100%; font-weight: bold;">Kernel version</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 100%; padding-left: 10px;">
                                                                    <?= $os['kernelRelease']; ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="backup">
                                        <div class="panel">
                                            <div class="panel-content">
                                                <table style="width: 100%;">
                                                    <tr>
                                                        <td style="width: 50%; font-weight: bold; padding-bottom: 10px;">Nom</td>
                                                        <td style="width: 50%; padding-bottom: 10px;"><?= $backup_gen['ftpBackupName']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 50%; font-weight: bold; padding-bottom: 10px;">Identifiant</td>
                                                        <td style="width: 50%; padding-bottom: 10px;"><?= $ded; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 50%; font-weight: bold; padding-bottom: 10px;">Utilisation</td>
                                                        <td style="width: 50%; padding-bottom: 10px;">
                                                            <div class="progress progress-bar-large">
                                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                                                    <span class="sr-only">60% Complete (warning)</span>
                                                                    60%
                                                                </div>
                                                            </div> <?= $backup_gen['usage']; ?> Go utilisées sur <?= $backup_gen['quota']['value']; ?> <?= $backup_gen['quota']['unit']; ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="panel">
                                            <div class="panel-content">
                                                <table class="table dataTable" id="ftp_backup_cpt">
                                                    <thead>
                                                        <tr>
                                                            <th>Ip</th>
                                                            <th>CIFS</th>
                                                            <th>FTP</th>
                                                            <th>NFS</th>
                                                            <th>Statut</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $back_access = $ovh->get("/dedicated/server/".$ded."/features/backupFTP/access");
                                                    foreach ($back_access as $access):
                                                        $search = str_replace("/", "%2F", $access);
                                                        $access_full = $search;
                                                        $ip_backup = $ovh->get("/dedicated/server/".$ded."/features/backupFTP/access/".$access_full);
                                                    ?>
                                                        <tr>
                                                            <td><?= $access; ?></td>
                                                            <td><?php if($ip_backup['cifs'] == false){echo "<i class='fa fa-remove text-danger'></i>";}else{echo "<i class='fa fa-check text-success'></i>";} ?></td>
                                                            <td><?php if($ip_backup['ftp'] == false){echo "<i class='fa fa-remove text-danger'></i>";}else{echo "<i class='fa fa-check text-success'></i>";} ?></td>
                                                            <td><?php if($ip_backup['nfs'] == false){echo "<i class='fa fa-remove text-danger'></i>";}else{echo "<i class='fa fa-check text-success'></i>";} ?></td>
                                                            <td><?php if($ip_backup['isApplied'] == false){echo "<span class='label label-danger'>Non Appliquer</span>";}else{echo "<span class='label label-success'>Activé</span>";} ?></td>
                                                            <td>
                                                                <button type="button" class="btn btn-icon btn-xs btn-rounded"><i class="icon-pencil"></i></button>
                                                                <button type="button" class="btn btn-icon btn-xs btn-rounded"><i class="icon-trash"></i></button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="intervention">
                                        <div class="panel">
                                            <div class="panel-content">
                                                <table class="table dataTable" id="ovh_intervention">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Type</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($intervention as $inter): ?>
                                                        <?php
                                                        $info = $ovh->get("/dedicated/server/".$ded."/intervention/".$inter)
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?php
                                                                $date_str = $date_format->format_strt($info['date']);
                                                                echo $date_format->formatage("d/m/Y à H:i", $date_str);
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?= $info['type']; ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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