<?php
$sql_notif = $DB->execute("UPDATE notif SET vu = 1");
?>
<div class="row">
    <div class="col-lg-12">
        <div class="well text-right">
            <a href="controller/notif.ajax.php?action=supp-notif" id="notif-suppression" class="btn btn-primary"><i class="fa fa-remove"></i> Supprimer les logs</a>
        </div>
        <!-- BEGIN TIMELINE CONTENT -->
        <div class="timeline-btn-day"> <i class="icon-custom-left"></i>
            <button type="button" class="btn btn-primary f-16"><strong>Aujourd'hui</strong></button>
        </div>
        <?php
        $sql_notif = $DB->query("SELECT * FROM notif ORDER BY date_notification ASC LIMIT 10");
        foreach($sql_notif as $notif):
        ?>
        <section id="timeline">
            <div class="timeline-block">
                <?php if($notif->type == 1): ?>
                    <div class="timeline-icon bg-success">
                        <i class="fa fa-plus"></i>
                    </div>
                <?php elseif($notif->type == 2): ?>
                    <div class="timeline-icon bg-orange">
                        <i class="fa fa-edit"></i>
                    </div>
                <?php else: ?>
                    <div class="timeline-icon bg-red">
                        <i class="fa fa-remove"></i>
                    </div>
                <?php endif; ?>
                <div class="timeline-content">
                    <div class="timeline-heading clearfix">
                        <h2 class="pull-left">
                            <?php if($notif->type == 1): ?>
                                AJOUT
                            <?php elseif($notif->type == 2): ?>
                                EDITION
                            <?php else: ?>
                                SUPPRESSION
                            <?php endif; ?>
                        </h2>
                        <div class="pull-right">
                            <div class="pull-left">
                                <div class="timeline-day-number"><?= date("d", $notif->date_notification); ?></div>
                            </div>
                            <div class="pull-left">
                                <div class="timeline-day"><?= $date_format->formatage_sequenciel("d", $notif->date_notification); ?></div>
                                <div class="timeline-month c-gray"><?= $date_format->formatage_sequenciel("m", $notif->date_notification) ?> <?= date("Y", $notif->date_notification); ?></div>
                            </div>
                        </div>
                    </div>
                    <p><?= html_entity_decode($notif->notification); ?></p>
                </div>
            </div>
        </section>
        <?php endforeach; ?>
        <!-- END TIMELINE CONTENT -->
    </div>
</div>