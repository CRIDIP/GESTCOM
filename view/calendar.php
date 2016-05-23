<div class="header">
    <h2>Votre <strong>Calendrier</strong></h2>
    <?= $insert->breadcumb("Calendier", "test", "test"); ?>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-content">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#today" data-toggle="tab">Aujoud'hui</a></li>
                    <li class=""><a href="#week" data-toggle="tab">Semaine</a></li>
                    <li><a href="#month" data-toggle="tab">Mois</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="today">
                        <div class="table-responsive">
                            <div class="panel">
                                <div class="panel-header">
                                    <h3><?= $date_format->formatage_long(time()); ?></h3>
                                    <div class="row">
                                        <div class="col-sm-3 col-sm-offset-9">
                                            <div class="pull-right">
                                                <a class="btn btn-success" data-toggle="modal" data-target="#add-event"><i class="fa fa-plus"></i> Ajouter un évènement</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-content">
                                    <table class="table dataTable" id="today2">
                                        <thead>
                                            <tr>
                                                <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 279px;">
                                                    Heure
                                                </th>
                                                <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 350px;">
                                                    Evénement
                                                </th>
                                                <th tabindex="0" rowspan="1" colspan="1">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                                        <?php
                                        $sql_event = $DB->query("SELECT * FROM collab_event WHERE iduser = :iduser AND start_event >= :start_event AND end_event <= :end_event", array(
                                            "iduser"        => $user->iduser,
                                            "start_event"   => $date_format->format_strt(date("d-m-Y 00:00:00")),
                                            "end_event"     => $date_format->format_strt(date("d-m-Y 23:59:59"))
                                        ));
                                        foreach($sql_event as $event):
                                        ?>
                                            <tr class="<?php if($event->start_event < time() AND $event->end_event < time()){echo 'danger';} ?> <?php if($event->start_event <= time()-900){echo 'info';} ?>">
                                                <td class=""><?= $date_format->formatage("H:i", $event->start_event); ?> / <?= $date_format->formatage("H:i", $event->end_event); ?></td>
                                                <td class=""><?= html_entity_decode($event->titre_event); ?></td>
                                                <td class="">
                                                    <a class="btn btn-sm btn-rounded btn-danger" href="controller/calendar.ajax.php?action=supp-event&idevent=<?= $event->idevent; ?>"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="week">
                        <div class="table-responsive">
                            <div class="panel">
                                <div class="panel-header">
                                    <h3>Semaine <?= date("W"); ?> | <?= $date_format->semaine(date("Y"), date("W")); ?></h3>
                                    <div class="row">
                                        <div class="col-sm-3 col-sm-offset-9">
                                            <div class="pull-right">
                                                <a class="btn btn-success" data-toggle="modal" data-target="#add-event"><i class="fa fa-plus"></i> Ajouter un évènement</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-content">
                                    <table class="table dataTable" id="month2">
                                        <thead>
                                        <tr>
                                            <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 10%">
                                                Jours
                                            </th>
                                            <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 10%">
                                                Heure
                                            </th>
                                            <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 70%">
                                                Evenement
                                            </th>
                                            <th tabindex="0" rowspan="1" colspan="1" style="width: 10%;">
                                                Action
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                                        <?php
                                        $strt = $date_format->semaine_strt(date("Y"), date("W"));
                                        $sql_event = $DB->query("SELECT * FROM collab_event WHERE iduser = :iduser AND start_event >= :start_event AND end_event <= :end_event", array(
                                            "iduser"        => $user->iduser,
                                            "start_event"   => $strt['strt_lundi'],
                                            "end_event"     => $strt['strt_vendredi']
                                        ));
                                        foreach($sql_event as $event):
                                            ?>
                                            <tr class="<?php if($event->start_event < time() AND $event->end_event < time()){echo 'danger';} ?> <?php if($event->start_event <= time()-900){echo 'info';} ?>">
                                                <td><?= $date_format->formatage_sequenciel("d", $event->start_event); ?> <?= date("d", $event->start_event); ?></td>
                                                <td><?= $date_format->formatage("H:i", $event->start_event); ?> / <?= $date_format->formatage("H:i", $event->end_event); ?></td>
                                                <td><?= html_entity_decode($event->titre_event); ?></td>
                                                <td>
                                                    <a class="btn btn-sm btn-rounded btn-danger" href="controller/calendar.ajax.php?action=supp-event&idevent=<?= $event->idevent; ?>"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="month">
                        <div class="table-responsive">
                            <div class="panel">
                                <div class="panel-header">
                                    <h3>Mois de <?= $date_format->formatage_sequenciel_no_str("m")." ".date("Y"); ?> </h3>
                                    <div class="row">
                                        <div class="col-sm-3 col-sm-offset-9">
                                            <div class="pull-right">
                                                <a class="btn btn-success" data-toggle="modal" data-target="#add-event"><i class="fa fa-plus"></i> Ajouter un évènement</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-content">
                                    <table class="table dataTable" id="week2">
                                        <thead>
                                        <tr>
                                            <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 10%">
                                                Jours
                                            </th>
                                            <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 10%">
                                                Heure
                                            </th>
                                            <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 70%">
                                                Evenement
                                            </th>
                                            <th tabindex="0" rowspan="1" colspan="1" style="width: 10%;">
                                                Action
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                                        <?php
                                        $strt = $date_format->month_strt();
                                        $sql_event = $DB->query("SELECT * FROM collab_event WHERE iduser = :iduser AND start_event >= :start_event AND end_event <= :end_event ORDER BY start_event ASC", array(
                                            "iduser"        => $user->iduser,
                                            "start_event"   => $strt['debut_mois'],
                                            "end_event"     => $strt['fin_mois']
                                        ));
                                        foreach($sql_event as $event):
                                            ?>
                                            <tr class="<?php if($event->start_event < time() AND $event->end_event < time()){echo 'danger';} ?> <?php if($event->start_event <= time()-900){echo 'info';} ?>">
                                                <td><?= $date_format->formatage_sequenciel("d", $event->start_event); ?> <?= date("d", $event->start_event); ?></td>
                                                <td><?= $date_format->formatage("H:i", $event->start_event); ?> / <?= $date_format->formatage("H:i", $event->end_event); ?></td>
                                                <td><?= html_entity_decode($event->titre_event); ?></td>
                                                <td>
                                                    <a class="btn btn-sm btn-rounded btn-danger" href="controller/calendar.ajax.php?action=supp-event&idevent=<?= $event->idevent; ?>"><i class="fa fa-trash-o"></i></a>
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
<div class="modal fade" id="add-event" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> Ajouter un évènement</h4>
            </div>
            <form class="form-horizontal" id="add-user-form" action="controller/calendar.php" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" class="form-control input-lg bg-aero" placeholder="Titre de l'évènement..." name="titre_event" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="agenda">Agenda</label>
                                <div class="col-md-9">
                                    <select id="agenda" class="form-control" data-search="true" name="iduser" data-placeholder="Selectionner l'agenda de l'utilisateur concerner">
                                        <option value=""></option>
                                        <option value="all">Tous</option>
                                        <?php
                                        $sql_user = $DB->query("SELECT * FROM users WHERE groupe != 4 ORDER BY nom_user ASC");
                                        foreach($sql_user as $userq):
                                            ?>
                                            <option value="<?= $userq->iduser; ?>"><?= $userq->nom_user; ?> <?= $userq->prenom_user; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="agenda">Lieu</label>
                                <div class="col-md-9 prepend-icon">
                                    <input type="text" class="form-control" name="lieu_event" placeholder="Lieu ou va se dérouler l'évènement...">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Début de l'évènement</label>
                                <div class="col-md-9">
                                    <input type="text" name="start_event" class="datetimepicker form-control" placeholder="Selectionner la date et l'heure de l'évènement...">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Fin de l'évènement</label>
                                <div class="col-md-9">
                                    <input type="text" name="end_event" class="datetimepicker form-control" placeholder="Selectionner la date et l'heure de l'évènement...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label" for="agenda">Description de l'évènement:</label>
                            <textarea id="agenda" cols="80" rows="10" class="cke-editor" name="desc_event"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-embossed" name="action" value="add-event">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= $constante->getUrl(array('plugins/')); ?>datatables/jquery.dataTables.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>summernote/summernote.min.js"></script> <!-- Simple HTML Editor -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>cke-editor/ckeditor.js"></script> <!-- Advanced HTML Editor -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>cke-editor/adapters/adapters.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>typed/typed.min.js"></script> <!-- Animated Typing -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>timepicker/jquery-ui-timepicker-addon.js"></script> <!-- Time Picker -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>multidatepicker/multidatespicker.min.js"></script> <!-- Multi dates Picker -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>bootstrap-datepicker/js/bootstrap-datepicker.js"></script> <!-- >Bootstrap Date Picker -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>custom/js/pages/calendar.js"></script>