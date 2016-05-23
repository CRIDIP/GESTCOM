<?php if(!isset($_GET['sub'])): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h1><i class="fa fa-users"></i> SITUATION CLIENT</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="panel">
                <div class="panel-content">
                    <form class="form-horizontal" action="<?= $constante->getUrl(array(), false,false); ?>controller/compta/situation.ajax.php" method="post" id="check_client">
                        <div class="form-group">
                            <label class="control-label col-md-3">Choix du Compte client:</label>
                            <div class="col-md-8">
                                <select name="code_tiers" onchange="check_client();" class="form-control" id="select_client" data-search="true">
                                    <option value=""></option>
                                    <?php
                                    $sql_sousClasse = $DB->query("SELECT * FROM compta_classe, compta_sousclasse WHERE compta_sousclasse.code_classe = compta_classe.code_classe AND compta_sousclasse.code_sousclasse = 410 ORDER BY libelle_classe ASC");
                                    foreach ($sql_sousClasse as $sousclasse):
                                        ?>
                                        <optgroup label="<?= html_entity_decode($sousclasse->libelle_classe); ?> | <?= $sousclasse->code_sousclasse; ?> - <?= html_entity_decode($sousclasse->libelle_sousclasse); ?>">
                                            <?php
                                            $sql_compte = $DB->query("SELECT * FROM compta_compte WHERE code_sousclasse = :code ORDER BY code_compte ASC", array(
                                                "code"  => $sousclasse->code_sousclasse
                                            ));
                                            foreach ($sql_compte as $compte):
                                                ?>
                                                <option value="<?= $compte->code_compte; ?>"><?= $compte->code_compte; ?> - <?= html_entity_decode($compte->libelle_compte); ?></option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3" id="situation_result">

        </div>
    </div>
    <!--<div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-header">
                    <h3>Journal des ACHATS (TTC)</h3>
                </div>
                <div class="panel-content">
                    <div class="table-responsive">
                        <table class="table table-hover dataTable" id="achat">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Compte</th>
                                <th>Libelle</th>
                                <th>Montant</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql_achat = $DB->query("SELECT * FROM compta_achat, compta_compte WHERE compta_achat.code_compte = compta_compte.code_compte ORDER BY date_mouvement ASC");
                            foreach ($sql_achat as $achat):
                                ?>
                                <tr>
                                    <td><?= $date_format->formatage("d/m/Y", $achat->date_mouvement); ?></td>
                                    <td><?= $achat->code_compte; ?> - <?= html_entity_decode($achat->libelle_compte); ?></td>
                                    <td><?= html_entity_decode($achat->libelle_mouvement); ?></td>
                                    <td><?= $fonction->number_decimal($achat->debit); ?></td>
                                    <td></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
<?php endif; ?>


<script src="<?= $constante->getUrl(array('plugins/')); ?>summernote/summernote.min.js"></script> <!-- Simple HTML Editor -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>cke-editor/ckeditor.js"></script> <!-- Advanced HTML Editor -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>cke-editor/adapters/adapters.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>typed/typed.min.js"></script> <!-- Animated Typing -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>datatables/jquery.dataTables.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>bootstrap/js/jasny-bootstrap.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>bootstrap-datepicker/js/bootstrap-datepicker.js"></script> <!-- >Bootstrap Date Picker -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>bootstrap-datepicker/locales/bootstrap-datepicker.fr.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>custom/js/pages/compta/situation.js"></script>