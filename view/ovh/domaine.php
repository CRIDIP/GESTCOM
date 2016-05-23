<?php if(!isset($_GET['sub'])){ ?>
    <?php
    $domaine = $ovh->get("/domain");
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h1><i class="ovh-web" style="font-size: 25px;"></i> DOMAINE</h1>
                </div>
            </div>
        </div>
    </div>
    <?php if($domaine == null): ?>
        <div class="row">
            <div class="col-md-12">
                <h2 class="alert bg-info"><strong><i class="fa fa-info"></i> Information !</strong> Aucun domaine pour le compte</h2>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-header md-panel-controls">
                        <h3>Liste de vos <strong>Domaines</strong></h3>
                    </div>
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-md-4">
                                <ul class="nav">
                                    <?php foreach ($domaine as $dom): ?>
                                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>controller/ovh/domaine.ajax.php?action=view_domaine&dm=<?= $dom; ?>" id="ajax_cross"><i class="fa fa-circle"></i> <?= $dom; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="col-md-8">
                                <div id="ajax_domaine"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php } ?>
<script src="<?= $constante->getUrl(array('plugins/')); ?>custom/js/pages/ovh/domaine.js"></script>
