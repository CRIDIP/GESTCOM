<?php if(!isset($_GET['sub'])): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h1><i class="fa fa-euro"></i> JOURNAL DES ACHATS</h1>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-rounded btn-lg btn-primary pull-right" data-toggle="modal" data-target="#add-achat"><i class="fa fa-plus-circle fa-2x"></i> Nouvelle Achat</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
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
    </div>
    <div class="modal fade" id="add-achat" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Nouvelle Achat</h4>
                </div>
                <form action="<?= $constante->getUrl(array(), false,false); ?>controller/compta/achat.php" method="POST" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Date de l'opération</label>
                            <div class="col-md-5 prepend-icon">
                                <input type="text" name="date_mouvement" class="b-datepicker form-control" data-lang="fr" placeholder="Date de l'opération...">
                                <i class="icon-calendar"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Compte de charge:</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="code_charge" class="form-control" data-search="true">
                                        <?php
                                        $sql_sousClasse = $DB->query("SELECT * FROM compta_classe, compta_sousclasse WHERE compta_sousclasse.code_classe = compta_classe.code_classe AND compta_classe.code_classe = 6 ORDER BY libelle_classe ASC");
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
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Compte de client:</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="code_tiers" class="form-control" data-search="true">
                                        <?php
                                        $sql_sousClasse = $DB->query("SELECT * FROM compta_classe, compta_sousclasse WHERE compta_sousclasse.code_classe = compta_classe.code_classe AND compta_sousclasse.code_sousclasse = 400 ORDER BY libelle_classe ASC");
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
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Libellé de l'opération</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="libelle_mouvement">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Montant de l'opération</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="debit">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-3 col-md-offset-9">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-success" name="action" value="add_achat">Valider</button>
                            </div>
                        </div>
                    </div>
                </form>
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