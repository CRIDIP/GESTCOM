<?php if(!isset($_GET['sub'])): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h1><i class="fa fa-euro"></i> JOURNAL DE VENTE</h1>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-rounded btn-lg btn-primary pull-right" data-toggle="modal" data-target="#add-vente"><i class="fa fa-plus-circle fa-2x"></i> Nouvelle Vente</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-header">
                    <h3>Journal de Vente (HT)</h3>
                </div>
                <div class="panel-content">
                    <div class="table-responsive">
                        <table class="table table-hover dataTable" id="vente">
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
                            $sql_vente = $DB->query("SELECT * FROM compta_vente, compta_compte WHERE compta_vente.code_compte = compta_compte.code_compte ORDER BY date_mouvement ASC");
                            foreach ($sql_vente as $vente):
                                ?>
                                <tr>
                                    <td><?= $date_format->formatage("d/m/Y", $vente->date_mouvement); ?></td>
                                    <td><?= $vente->code_compte; ?> - <?= html_entity_decode($vente->libelle_compte); ?></td>
                                    <td><?= html_entity_decode($vente->libelle_mouvement); ?></td>
                                    <td><?= $fonction->number_decimal($vente->credit); ?></td>
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
    <div class="modal fade" id="add-vente" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Nouvelle vente</h4>
                </div>
                <form action="<?= $constante->getUrl(array(), false,false); ?>controller/compta/vente.php" method="POST" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Type:</label>
                            <div class="col-md-9">
                                <div class="icheck-inline">
                                    <label><input type="radio" name="type" value="7" data-radio="iradio_flat-blue"> Vente de Marchandise</label>
                                    <label><input type="radio" name="type" value="6" checked data-radio="iradio_flat-blue"> Service</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Date de l'opération</label>
                            <div class="col-md-5 prepend-icon">
                                <input type="text" name="date_mouvement" class="b-datepicker form-control" data-lang="fr" placeholder="Date de l'opération...">
                                <i class="icon-calendar"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Compte de produit:</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="code_produit" class="form-control" data-search="true">
                                        <?php
                                        $sql_sousClasse = $DB->query("SELECT * FROM compta_classe, compta_sousclasse WHERE compta_sousclasse.code_classe = compta_classe.code_classe AND compta_classe.code_classe = 7 ORDER BY libelle_classe ASC");
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
                                <button type="submit" class="btn btn-success" name="action" value="add_vente">Valider</button>
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
<script src="<?= $constante->getUrl(array('plugins/')); ?>custom/js/pages/compta/vente.js"></script>