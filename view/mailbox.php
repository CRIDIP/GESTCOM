<?php if(!isset($_GET['sub'])): ?>
    <section class="app">
        <div class="row">
            <div class="col-md-12">
                <div class="well text-right">
                    <a class="btn btn-rounded btn-primary" href="index.php?view=mailbox&sub=compose"><i class="fa fa-plus"></i> Nouveau Mail</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-content">
                        <h1 id="titre_mailbox"><strong>BOITE DE RECEPTION (1)</strong></h1>
                        <div class="table-responsive">
                            <table class="table dataTable table-hover" id="mailbox">
                                <thead>
                                    <tr>
                                        <th>Expéditeur</th>
                                        <th>Sujet</th>
                                        <th>Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql_mail = $DB->query("SELECT * FROM collab_inbox, users WHERE collab_inbox.expediteur = users.iduser AND destinataire = :iduser", array("iduser" => $user->iduser));
                                foreach($sql_mail as $mail):
                                ?>
                                    <tr <?php if($mail->lu == 0){echo 'style="font-weight: bolder;"';}?> id="message">
                                        <td style="display: inline-flex;"><img src="<?= $constante->getUrl(array(), false, true); ?>avatar/<?= $mail->username; ?>.png" class="img-responsive img-circle" width="25"/>  &nbsp;<?= $mail->nom_user; ?> <?= $mail->prenom_user; ?></td>
                                        <td onclick="window.location='index.php?view=mailbox&sub=message&idinbox=<?= $mail->idinbox; ?>'"><?= html_entity_decode($mail->sujet); ?></td>
                                        <td>
                                            <?php
                                            $date = $date_format->formatage("d-m-Y H:i:s", $mail->date_message);
                                            echo $date_format->format($date);
                                            ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-rounded btn-danger" id="supp-mail" href="controller/mailbox.ajax.php?action=supp-mail&idinbox=<?= $mail->idinbox; ?>"><i class="fa fa-trash-o"></i></a>
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
    </section>
<?php endif; ?>
<?php if(isset($_GET['sub']) && $_GET['sub'] == 'compose'): ?>
<div class="row">
    <div class="col-md-12">
        <div class="well">
            <div class="row">
                <div class="col-md-6">
                    <h1>NOUVEAU MESSAGE</h1>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-rounded btn-lg btn-primary pull-right" href="index.php?view=mailbox"><i class="fa fa-arrow-circle-left fa-2x"></i> Retour</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <form id="form-sent-mail" class="form-horizontal" action="controller/mailbox.php" method="post">
                <input type="hidden" name="expediteur" value="<?= $user->iduser; ?>">
                <div class="panel-content">
                    <div class="form-group">
                        <label class="col-md-3 control-label text-right" for="agenda">A:</label>
                        <div class="col-md-9">
                            <select id="agenda" class="form-control" data-search="true" name="destinataire">
                                <option value=""></option>
                                <?php
                                $sql_user = $DB->query("SELECT * FROM users, conf_annuaire_groupe WHERE users.groupe = conf_annuaire_groupe.idgroupe AND iduser != :expediteur ORDER BY nom_user ASC", array("expediteur" => $user->iduser));
                                foreach($sql_user as $userq):
                                    ?>
                                    <option value="<?= $userq->iduser; ?>"><?= $userq->nom_groupe; ?> - <?= $userq->nom_user; ?> <?= $userq->prenom_user; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="message">Sujet:</label>
                        <div class="col-md-9">
                            <input id="message" type="text" class="form-control input-lg" name="sujet" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="message">Message:</label>
                        <textarea id="message" cols="80" rows="10" class="cke-editor" name="message"></textarea>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-3 col-md-offset-9">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-success" name="action" value="sent-mail">Envoyer <i class="fa fa-arrow-circle-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(isset($_GET['sub']) && $_GET['sub'] == 'sentbox'): ?>
    <section class="app">
        <div class="row">
            <div class="col-md-12">
                <div class="well text-right">
                    <a class="btn btn-rounded btn-primary" href="index.php?view=mailbox&sub=compose"><i class="fa fa-plus"></i> Nouveau Mail</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-content">
                        <h1 id="titre_mailbox"><strong>BOITE D'ENVOIE</strong></h1>
                        <div class="table-responsive">
                            <table class="table dataTable table-hover" id="sentbox">
                                <thead>
                                <tr>
                                    <th>Destinataire</th>
                                    <th>Sujet</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql_mail = $DB->query("SELECT * FROM collab_sentbox, users WHERE collab_sentbox.destinataire = users.iduser AND expediteur = :iduser", array("iduser" => $user->iduser));
                                foreach($sql_mail as $mail):
                                    ?>
                                    <tr id="message">
                                        <td style="display: inline-flex;"><img src="<?= $constante->getUrl(array(), false, true); ?>avatar/<?= $mail->username; ?>.png" class="img-responsive img-circle" width="25"/>  &nbsp;<?= $mail->nom_user; ?> <?= $mail->prenom_user; ?></td>
                                        <td onclick="window.location='index.php?view=mailbox&sub=message&idsentbox=<?= $mail->idsentbox; ?>'"><?= html_entity_decode($mail->sujet); ?></td>
                                        <td>
                                            <?php
                                            $date = $date_format->formatage("d-m-Y H:i:s", $mail->date_message);
                                            echo $date_format->format($date);
                                            ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-rounded btn-danger" id="supp-mail-sent" href="controller/mailbox.ajax.php?action=supp-mail-sent&idsentbox=<?= $mail->idsentbox; ?>"><i class="fa fa-trash-o"></i></a>
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
    </section>
<?php endif; ?>
<?php if(isset($_GET['sub']) && $_GET['sub'] == 'message_inbox'): ?>
    <?php
    $idinbox = $_GET['idinbox'];
    $mail_u = $DB->execute("UPDATE collab_inbox SET lu = 1 WHERE idinbox = :idinbox", array("idinbox" => $idinbox));
    $mail = $DB->query("SELECT * FROM collab_inbox, users WHERE collab_inbox.expediteur = users.iduser AND idinbox = :idinbox", array("idinbox" => $idinbox));
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="well">
                <div class="row">
                    <div class="col-md-6">
                        <h1>MESSAGE</h1>
                    </div>
                    <div class="col-md-6">
                        <a class="btn btn-rounded btn-lg btn-primary pull-right" href="index.php?view=mailbox"><i class="fa fa-arrow-circle-left fa-2x"></i> Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel" id="mail">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <h3><?= html_entity_decode($mail[0]->sujet); ?></h3>
                        </div>
                        <div class="col-md-6">
                            <button type="button" id="print_mail" class="btn btn-icon btn-default pull-right"><i class="fa fa-print"></i></button>
                        </div>
                    </div>
                </div>
                <div class="panel-content">
                    <div class="row">
                        <div class="col-md-6" style="display: inline-flex;">
                            <img src="<?= $constante->getUrl(array(), false, true); ?>avatar/<?= $mail[0]->username; ?>.png" class="img-responsive img-circle" width="50" />
                            <?= $mail[0]->nom_user; ?> <?= $mail[0]->prenom_user; ?>, le <?= $date_format->formatage("d/m/Y à H:i", $mail[0]->date_message); ?>
                        </div>
                        <div class="col-md-6">
                            <a href="index.php?view=mailbox&sub=compose_reply&destinataire=<?= $mail[0]->expediteur; ?>&expediteur=<?= $mail[0]->destinataire; ?>&sujet=<?= $mail[0]->sujet; ?>&message=<?= $mail[0]->message; ?>" class="btn btn-success pull-right"><i class="fa fa-forward"></i> Répondre</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= html_entity_decode($mail[0]->message); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<script src="<?= $constante->getUrl(array('plugins/')); ?>charts-morris/raphael.min.js"></script> <!-- Morris Charts -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>charts-morris/morris.min.js"></script> <!-- Morris Charts -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>summernote/summernote.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>datatables/jquery.dataTables.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>cke-editor/ckeditor.js"></script> <!-- Advanced HTML Editor -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>cke-editor/adapters/adapters.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>custom/js/pages/mailbox.js"></script>