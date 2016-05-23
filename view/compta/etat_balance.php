<?php if(!isset($_GET['sub'])): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h1> BALANCE</h1>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-rounded btn-lg btn-primary pull-right" data-toggle="modal" data-target="#add-achat"><i class="fa fa-print fa-2x"></i> Imprimer la Balance</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-content bg-red">
                    <div style="font-size: 30px; text-align: right; padding-bottom: 5px">18 900,89 €</div>
                    <div style="font-size: 15px; text-align: right;">au débit de la balance</div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-content bg-green">
                    <div style="font-size: 30px; text-align: right; padding-bottom: 5px">18 900,89 €</div>
                    <div style="font-size: 15px; text-align: right;">au crédit de la balance</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-content">
                    <table class="table table-bordered">
                        <thead style="font-weight: bold;">
                            <tr>
                                <td rowspan="2" style="text-align: center;">Numéro et nom des comptes</td>
                                <td colspan="2" style="text-align: center;">Sommes</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">Débit</td>
                                <td style="text-align: center;">Crédit</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql_balance = $DB->query("SELECT * FROM compta_compte ORDER BY code_compte ASC");
                        foreach ($sql_balance as $balance):
                        ?>
                            <tr>
                                <td><?= $balance->code_compte; ?> - <?= html_entity_decode($balance->libelle_compte); ?></td>
                                <td>
                                    <?php if($balance->total_compte <= 0): ?>
                                        <?= $fonction->number_decimal($balance->total_compte); ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($balance->total_compte > 0): ?>
                                        <?= $fonction->number_decimal($balance->total_compte); ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


<script src="<?= $constante->getUrl(array('plugins/')); ?>summernote/summernote.min.js"></script> <!-- Simple HTML Editor -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>cke-editor/ckeditor.js"></script> <!-- Advanced HTML Editor -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>cke-editor/adapters/adapters.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>typed/typed.min.js"></script> <!-- Animated Typing -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>datatables/jquery.dataTables.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>bootstrap/js/jasny-bootstrap.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>bootstrap-datepicker/js/bootstrap-datepicker.js"></script> <!-- >Bootstrap Date Picker -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>bootstrap-datepicker/locales/bootstrap-datepicker.fr.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>custom/js/pages/compta/achat.js"></script>