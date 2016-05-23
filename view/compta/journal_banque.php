<?php if(!isset($_GET['sub'])): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h1><i class="fa fa-euro"></i> JOURNAL DE BANQUE</h1>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-rounded btn-lg btn-danger pull-right" data-toggle="modal" data-target="#add-banque-credit"><i class="fa fa-plus-circle fa-2x"></i> Ajouter un crédit (Achat)</a>
                    <a class="btn btn-rounded btn-lg btn-success pull-right" data-toggle="modal" data-target="#add-banque-debit"><i class="fa fa-plus-circle fa-2x"></i> Ajouter un Débit (Vente)</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-header">
                    <h3>Journal de Banque</h3>
                </div>
                <div class="panel-content">
                    <div class="table-responsive">
                        <table class="table table-hover dataTable" id="banque">
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
                            $sql_banque = $DB->query("SELECT * FROM compta_banque, compta_compte WHERE compta_banque.code_compte = compta_compte.code_compte ORDER BY date_mouvement ASC");
                            foreach ($sql_banque as $banque):
                                ?>
                                <tr>
                                    <td><?= $date_format->formatage("d/m/Y", $banque->date_mouvement); ?></td>
                                    <td><?= $banque->code_compte; ?> - <?= html_entity_decode($banque->libelle_compte); ?></td>
                                    <td><?= html_entity_decode($banque->libelle_mouvement); ?></td>
                                    <td>
                                        <?php if(!empty($banque->debit)): ?>
                                            -<?= $fonction->number_decimal($banque->debit); ?>
                                        <?php else: ?>
                                            <?= $fonction->number_decimal($banque->credit); ?>
                                        <?php endif; ?>
                                    </td>
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
    <div class="modal fade" id="add-banque-credit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-red">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Ajout d'un Crédit</h4>
                </div>
                <form action="<?= $constante->getUrl(array(), false,false); ?>controller/compta/banque.php" method="POST" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Date de l'opération</label>
                            <div class="col-md-5 prepend-icon">
                                <input type="text" name="date_mouvement" class="b-datepicker form-control" data-lang="fr" placeholder="Date de l'opération...">
                                <i class="icon-calendar"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Compte de Banque:</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="code_banque" class="form-control" data-search="true">
                                        <?php
                                        $sql_sousClasse = $DB->query("SELECT * FROM compta_classe, compta_sousclasse WHERE compta_sousclasse.code_classe = compta_classe.code_classe AND compta_classe.code_classe = 5 ORDER BY libelle_classe ASC");
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
                            <label class="control-label col-md-3">Compte de Tiers:</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="code_tiers" class="form-control" data-search="true">
                                        <?php
                                        $sql_sousClasse = $DB->query("SELExCT * FROM compta_classe, compta_sousclasse WHERE compta_sousclasse.code_classe = compta_classe.code_classe AND compta_sousclasse.code_sousclasse = 400 ORDER BY libelle_classe ASC");
                                        foreach ($sql_sousClasse as $sousclasse):
                                            ?>
                                            <optgroup label="<?= html_entity_decode($sousclasse->libelle_classe); ?> | <?= $sousclasse->code_sousclasse; ?> - <?= html_entity_decode($sousclasse->libelle_sousclasse); ?>">
                                                <?php
                                                $sql_compte = $DB->query("SELECT * FROM compta_compte WHERE code_sousclasse = :code ORDER BY code_compte ASC", array(
                                                    "code"  => $sousclasse->code_sousclasse
                                                ));
                                                foreach ($sql_compte as $compte):
                                                    ?>
                                                    <option value="<?= $compte->code_compte; ?>"><?= $compte->code_compte; ?> - <?= html_entity_decode($compte->libelle_compte); ?> | Solde: <?= $fonction->number_decimal($compte->total_compte); ?></option>
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
                                <input type="text" class="form-control" name="credit">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-3 col-md-offset-9">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-success" name="action" value="add_banque_credit">Valider</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add-banque-debit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Ajout d'un Débit</h4>
                </div>
                <form action="<?= $constante->getUrl(array(), false,false); ?>controller/compta/banque.php" method="POST" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Date de l'opération</label>
                            <div class="col-md-5 prepend-icon">
                                <input type="text" name="date_mouvement" class="b-datepicker form-control" data-lang="fr" placeholder="Date de l'opération...">
                                <i class="icon-calendar"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Compte de Banque:</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="code_charge" class="form-control" data-search="true">
                                        <?php
                                        $sql_sousClasse = $DB->query("SELECT * FROM compta_classe, compta_sousclasse WHERE compta_sousclasse.code_classe = compta_classe.code_classe AND compta_classe.code_classe = 5 ORDER BY libelle_classe ASC");
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
                            <label class="control-label col-md-3">Compte de Tiers:</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="code_tiers" class="form-control" data-search="true">
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
                                                    <option value="<?= $compte->code_compte; ?>"><?= $compte->code_compte; ?> - <?= html_entity_decode($compte->libelle_compte); ?> | Solde: <?= $fonction->number_decimal($compte->total_compte); ?></option>
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
                                <button type="submit" class="btn btn-success" name="action" value="add_banque_debit">Valider</button>
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
<script src="<?= $constante->getUrl(array('plugins/')); ?>custom/js/pages/compta/banque.js"></script>