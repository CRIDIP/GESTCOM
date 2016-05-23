<?php if(!isset($_GET['sub'])): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h1><i class="fa fa-file"></i> SERVICE</h1>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-rounded btn-lg btn-primary pull-right" data-toggle="modal" data-target="#add-service"><i class="fa fa-plus-circle fa-2x"></i> Nouveau Service</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="panel">
            <div class="panel-header">
                <h3>Listing des Accès de Service</h3>
            </div>
            <div class="panel-content">
                <table class="table dataTable" id="liste_service">
                    <thead>
                        <tr>
                            <th>Nom du Service</th>
                            <th>Client</th>
                            <th>Date de license</th>
                            <th>Etat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql_service = $DB->query("SELECt * FROM client_service, client WHERE client_service.idclient = client.idclient");
                    foreach ($sql_service as $service):
                    ?>
                        <tr>
                            <td><?= html_entity_decode($service->nom_service); ?></td>
                            <td>
                                <?php if(!empty($service->societe)): ?>
                                    <strong><?= html_entity_decode($service->societe); ?></strong><br>
                                    <i><?= html_entity_decode($service->nom_client); ?> <?= html_entity_decode($service->prenom_client); ?></i>
                                <?php else: ?>
                                    <?= html_entity_decode($service->nom_client); ?> <?= html_entity_decode($service->prenom_client); ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong>Date de début:</strong> <?= $date_format->formatage("d/m/Y", $service->date_debut); ?><br>
                                <?php if($service->date_fin > $date_format->date_jour_strt()+2505600): ?>
                                    <strong>Date de Fin:</strong> <span class="label label-success"><?= date("d/m/Y", $service->date_fin); ?></span><br>Il reste <?= $date_format->reste($service->date_fin); ?> jours
                                <?php elseif($service->date_fin >= $date_format->date_jour_strt() + 86400 AND $service->date_fin <= $date_format->date_jour_strt()+2505600): ?>
                                    <strong>Date de Fin:</strong> <span class="label label-warning"><?= date("d/m/Y", $service->date_fin); ?></span><br>Il reste <?= $date_format->reste($service->date_fin); ?> jours
                                <?php elseif($service->date_fin == $date_format->date_jour_strt()): ?>
                                    <strong>Date de Fin:</strong> <span class="label label-warning">Aujourd'hui</span>
                                <?php else: ?>
                                    <strong>Date de Fin:</strong> <span class="label label-danger">Dépasser</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($service->etat_service == 0): ?>
                                    <span class="label label-default">Inactif</span>
                                <?php elseif($service->etat_service == 1): ?>
                                    <span class="label label-success">Actif</span>
                                <?php elseif($service->etat_service == 2): ?>
                                    <span class="label label-warning">maintenance en cours...</span>
                                <?php elseif($service->etat_service == 3): ?>
                                    <span class="label label-danger">Bloqué</span>
                                <?php else: ?>
                                    <span class="label label-danger">Expiré</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a class="btn btn-icon btn-primary btn-rounded" href="<?= $constante->getUrl(array(), false, false); ?>pdf/gestion/service.php?idclientservice=<?= $service->idclientservice; ?>"><i class="icon-printer"></i></a>
                                <?php if($service->etat_service == 4): ?>
                                <a class="btn btn-icon btn-warning btn-rounded" href="<?= $constante->getUrl(array(), false, false); ?>controller/gestion/service.ajax.php?action=renew_service&idclientservice=<?= $service->idclientservice; ?>" id="renew_service"><i class="icon-refresh"></i></a>
                                <?php endif; ?>
                                <a class="btn btn-icon btn-danger btn-rounded" href="<?= $constante->getUrl(array(), false, false); ?>controller/gestion/service.ajax.php?action=supp_service&idclientservice=<?= $service->idclientservice; ?>" id="supp_service"><i class="icon-trash"</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add-service" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title">Nouvelle Déclaration de service</h4>
                </div>
                <form class="form-horizontal" action="<?= $constante->getUrl(array(), false, false); ?>controller/gestion/service.php" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Client</label>
                            <div class="col-md-9">
                                <select class="form-control" data-search="true" name="idclient" data-placeholder="Selectionner un client...">
                                    <option value=""></option>
                                    <?php
                                    $sql_client = $DB->query("SELECt * FROM client ORDER BY nom_client ASC");
                                    foreach ($sql_client as $client):
                                        ?>
                                        <option value="<?= $client->idclient; ?>"><?= $client->nom_client; ?> <?= $client->prenom_client; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nom du Service</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="nom_service" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Descriptif du service</label>
                            <div class="col-md-9">
                                <textarea cols="80" rows="10" class="cke-editor" name="desc_service"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Numéro de Série</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="num_serie" data-mask="SRK99999-aaa-a9a-999"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Clé d'activation</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="serial_key" data-mask="wwww-wwww-wwww-wwww-9999"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Date de Début</label>
                            <div class="col-md-3 prepend-icon">
                                <input type="text" name="date_debut" class="b-datepicker form-control" data-lang="fr" placeholder="Date de début de la license">
                                <i class="icon-calendar"></i>
                            </div>
                            <label class="control-label col-md-3">Date de Fin</label>
                            <div class="col-md-3 prepend-icon">
                                <input type="text" name="date_fin" class="b-datepicker form-control" data-lang="fr" placeholder="Date de fin de la license">
                                <i class="icon-calendar"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Etat du Service</label>
                            <div class="col-md-9">
                                <select class="form-control" data-search="false" name="etat_service" data-placeholder="Etat du Service">
                                    <option value=""></option>
                                    <option value="0">Inactif</option>
                                    <option value="1">Actif</option>
                                    <option value="2">Maintenance</option>
                                    <option value="3">Bloqué</option>
                                    <option value="4">Expiré</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="submit" class="btn btn-primary btn-embossed bnt-square" name="action" value="add_service"><i class="fa fa-check"></i> Création du Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

<script src="<?= $constante->getUrl(array('plugins/')); ?>datatables/jquery.dataTables.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>summernote/summernote.min.js"></script> <!-- Simple HTML Editor -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>cke-editor/ckeditor.js"></script> <!-- Advanced HTML Editor -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>cke-editor/adapters/adapters.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>typed/typed.min.js"></script> <!-- Animated Typing -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>bootstrap-datepicker/js/bootstrap-datepicker.js"></script> <!-- >Bootstrap Date Picker -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>bootstrap-datepicker/locales/bootstrap-datepicker.fr.min.js"></script> <!-- >Bootstrap Date Picker in Spanish (can be removed if not use) -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>bootstrap/js/jasny-bootstrap.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>custom/js/pages/gestion/service.js"></script>
