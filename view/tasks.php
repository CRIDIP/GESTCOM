<div class="header">
    <h2>Gestionnaire de Taches</h2>
    <?= $insert->breadcumb("TACHES", "Accueil", ""); ?>
</div>
<div class="row">
    <div class="col-md-5">
        <div class="panel">
            <div class="panel-header">
                <div class="row">
                    <div class="col-md-10">
                        <div style="display: inline">
                            <div style="font-size: 25px; font-weight: bold;">Liste des Taches</div>
                            <div class="text-muted"><span id="count_task"></span> Taches en attentes</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-icon btn-rounded btn-primary" data-toggle="modal" data-target="#add-task"><i class="icon-plus"></i></button>
                    </div>
                </div>
            </div>
            <div class="panel-content">
                <ul class="todo-list">
                    <?php
                    $sql_task = $DB->query("SELECT * FROM collab_task, users WHERE collab_task.iduser = users.iduser AND users.iduser = :iduser ORDER BY date_limit AND etat DESC ", array("iduser" => $iduser));
                    foreach ($sql_task as $task):
                    ?>
                    <li class="<?php if($task->urgence == 1){echo 'low';}elseif($task->urgence == 2){echo 'medium';}else{echo 'high';} ?>">
                        <a href="<?= $constante->getUrl(array(), false, false); ?>controller/tasks.ajax.php?action=view_task&idtask=<?= $task->idtask; ?>" id="ajax_cross">
                            <span style="font-weight: bold; font-size: 15px;"><?= $task->titre_tache; ?></span><br>
                            <span style="font-style: italic; font-size: 7px;">Pour le <?= $date_format->formatage_long($task->date_limit); ?></span>
                        </a>
                        <div style="text-align: right">
                            <button type="button" class="btn btn-icon btn-rounded btn-danger" id="supp-task" data-href="<?= $constante->getUrl(array(), false, false); ?>controller/tasks.ajax.php?action=supp-task&idtask=<?= $task->idtask; ?>"><i class="icon-trash"></i></button>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-7" id="ajax_content_task">
    
    </div>
</div>
<div class="modal fade" id="add-task" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Nouvelle Tache</h4>
            </div>
            <form class="form-horizontal" action="<?= $constante->getUrl(array(), false, false); ?>controller/tasks.php" method="post">
                <div class="modal-body">
                    <input type="hidden" name="iduser" value="<?= $iduser; ?>">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" class="form-control input-lg" name="titre_tache" placeholder="Titre de la tache...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Description de la tache</label>
                                <div class="col-md-9">
                                    <textarea id="desc_tache" class="cke-editor" name="desc_tache"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Limite de la tache</label>
                                <div class="col-md-9">
                                    <input type="text" name="date_limit" class="datetimepicker form-control" placeholder="Selectionner la date et l'heure limite...">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Urgence</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="urgence" data-search="true" data-placeholder="Selectionner l'urgence de la tache ...">
                                        <option value=""></option>
                                        <option value="1">Basse</option>
                                        <option value="2">Moyenne</option>
                                        <option value="3">Haute</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-embossed btn-success" name="action" value="add-task">Valider <i class="fa fa-arrow-circle-o-right"></i> </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?= $constante->getUrl(array('plugins/')); ?>cke-editor/ckeditor.js"></script> <!-- Advanced HTML Editor -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>cke-editor/adapters/adapters.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>timepicker/jquery-ui-timepicker-addon.js"></script> <!-- Time Picker -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>multidatepicker/multidatespicker.min.js"></script> <!-- Multi dates Picker -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>custom/js/pages/tasks.js"></script>