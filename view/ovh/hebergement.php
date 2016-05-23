<?php if(!isset($_GET['sub'])){ ?>
    <?php
    $hebergement = $ovh->get("/hosting/web");
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h1>HEBERGEMENT</h1>
                </div>
            </div>
        </div>
    </div>
    <?php if($hebergement == null): ?>
        <div class="row">
            <div class="col-md-12">
                <h2 class="alert bg-info"><strong><i class="fa fa-info"></i> Information !</strong> Aucun Hebergement pour le compte</h2>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-header md-panel-controls">
                        <h3>Liste de vos <strong>Hebergement</strong></h3>
                    </div>
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-md-4">
                                <ul class="nav">
                                    <?php foreach ($hebergement as $item): ?>
                                        <li><a href="<?= $constante->getUrl(array(), false, false); ?>controller/ovh/hebergement.ajax.php?action=view_hebergement&hb=<?= $item; ?>" id="ajax_cross"><i class="fa fa-circle"></i> <?= $item; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="col-md-8">
                                <div id="ajax_hebergement"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php } ?>
<script src="<?= $constante->getUrl(array('plugins/')); ?>custom/js/pages/ovh/hebergement.js"></script>
