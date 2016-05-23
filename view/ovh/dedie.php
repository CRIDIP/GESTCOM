<?php if(!isset($_GET['sub'])){ ?>
    <?php
    $dedie = $ovh->get("/dedicated/server");
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h1><i class="ovh-technology" style="font-size: 25px;"></i> DEDI&Eacute;</h1>
                </div>
            </div>
        </div>
    </div>
    <?php if($dedie == null): ?>
        <div class="row">
            <div class="col-md-12">
                <h2 class="alert bg-info"><strong><i class="fa fa-info"></i> Information !</strong> Aucun Serveur Dédié pour le compte</h2>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-header md-panel-controls">
                        <h3>Liste de vos <strong>Serveur Dédié</strong></h3>
                    </div>
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-md-4">
                                <ul class="nav">
                                    <?php foreach ($dedie as $ded): ?>
                                        <li><a href="<?= $constante->getUrl(array(), false, false); ?>controller/ovh/dedie.ajax.php?action=view_dedie&ded=<?= $ded; ?>" id="ajax_cross"><i class="fa fa-circle"></i> <?= $ded; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="col-md-8">
                                <div id="ajax_dedie"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php } ?>
<script src="<?= $constante->getUrl(array('plugins/')); ?>datatables/jquery.dataTables.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>custom/js/pages/ovh/dedie.js"></script>