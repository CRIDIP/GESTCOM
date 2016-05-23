<?php if(!isset($_GET['sub'])): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h1><i class="fa fa-cogs"></i> Configuration des Comptes</h1>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-rounded btn-lg btn-primary pull-right" data-toggle="modal" data-target="#add-compte"><i class="fa fa-plus-circle fa-2x"></i> Ajout d'un Compte</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-header">
                    <h3>Configuration du plan comptable</h3>
                </div>
                <div class="panel-content">
                    <div class="table-responsive">
                        <table class="table table-hover dataTable" id="compte_classe">
                            <thead>
                            <tr>
                                <th>Numéro Classe</th>
                                <th>Libellée</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql_classe = $DB->query("SELECT * FROM compta_classe ORDER BY idcomptaclasse ASC");
                            foreach ($sql_classe as $classe):
                            ?>
                                <tr>
                                    <td><?= $classe->code_classe; ?></td>
                                    <td><?= html_entity_decode($classe->libelle_classe); ?></td>
                                    <td>
                                        <a class="btn btn-icon btn-primary btn-rounded" href="index.php?view=compte&sub=sousclasse&code_classe=<?= $classe->code_classe; ?>"><i class="icon-eye"></i></a>
                                        <a id="supp-classe" class="btn btn-icon btn-danger btn-rounded" href="<?= $constante->getUrl(array(), false, false); ?>controller/compta/config.ajax.php?action=supp_classe&code_classe=<?= $classe->code_classe; ?>"><i class="icon-trash"></i></a>
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
    <div class="modal fade" id="add-compte" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Nouvelle Classe</h4>
                </div>
                <form action="<?= $constante->getUrl(array(), false,false); ?>controller/compta/config.php" method="POST" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Code:</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="code_classe" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Libellé:</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="libelle_classe" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-3 col-md-offset-9">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-success" name="action" value="add_classe">Valider</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(isset($_GET['sub']) && $_GET['sub'] == 'sousclasse'): ?>
    <?php
    $code_classe = $_GET['code_classe'];
    $sql_classe = $DB->query("SELECT * FROM compta_classe WHERE code_classe = :code", array("code" => $code_classe));
    $classe = $sql_classe[0];
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h1><i class="fa fa-cogs"></i> Configuration des Comptes</h1>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-rounded btn-lg btn-primary pull-right" data-toggle="modal" data-target="#add-sousclasse"><i class="fa fa-plus-circle fa-2x"></i> Ajout d'une sous classe</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-header">
                    <h3>Configuration du plan comptable - <strong>CLASSE:</strong> <?= html_entity_decode($classe->libelle_classe); ?></h3>
                </div>
                <div class="panel-content">
                    <div class="table-responsive">
                        <table class="table table-hover dataTable" id="compte_sousclasse">
                            <thead>
                            <tr>
                                <th>Numéro sous classe</th>
                                <th>Libellée</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql_sousclasse = $DB->query("SELECT * FROM compta_sousclasse WHERE code_classe = :code ORDER BY idsousclasse ASC", array("code" => $code_classe));
                            foreach ($sql_sousclasse as $sousclasse):
                                ?>
                                <tr>
                                    <td><?= $sousclasse->code_sousclasse; ?></td>
                                    <td><?= html_entity_decode($sousclasse->libelle_sousclasse); ?></td>
                                    <td>
                                        <a class="btn btn-icon btn-primary btn-rounded" href="index.php?view=compte&sub=compte&code_sousclasse=<?= $sousclasse->code_sousclasse; ?>"><i class="icon-eye"></i></a>
                                        <a id="supp-sousclasse" class="btn btn-icon btn-danger btn-rounded" href="<?= $constante->getUrl(array(), false, false); ?>controller/compta/config.ajax.php?action=supp_sousclasse&code_sousclasse=<?= $sousclasse->code_sousclasse; ?>"><i class="icon-trash"></i></a>
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
    <div class="modal fade" id="add-sousclasse" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Nouvelle Sous Classe</h4>
                </div>
                <form action="<?= $constante->getUrl(array(), false,false); ?>controller/compta/config.php" method="POST" class="form-horizontal">
                    <input type="hidden" name="code_classe" value="<?= $classe->code_classe; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Code:</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="code_sousclasse" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Libellé:</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="libelle_sousclasse" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-3 col-md-offset-9">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-success" name="action" value="add_sousclasse">Valider</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php endif; ?>
<?php if(isset($_GET['sub']) && $_GET['sub'] == 'compte'): ?>
    <?php
    $code_sousclasse = $_GET['code_sousclasse'];
    $sql_sousclasse = $DB->query("SELECT * FROM compta_sousclasse WHERE code_sousclasse = :code", array("code" => $code_sousclasse));
    $sousclasse = $sql_sousclasse[0];
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h1><i class="fa fa-cogs"></i> Configuration des Comptes</h1>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-rounded btn-lg btn-primary pull-right" data-toggle="modal" data-target="#add-compte"><i class="fa fa-plus-circle fa-2x"></i> Ajout d'un compte</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-header">
                    <h3>Configuration du plan comptable - <strong>SOUS CLASSE:</strong> <?= html_entity_decode($sousclasse->libelle_sousclasse); ?></h3>
                </div>
                <div class="panel-content">
                    <div class="table-responsive">
                        <table class="table table-hover dataTable" id="compte">
                            <thead>
                            <tr>
                                <th>Numéro Compte</th>
                                <th>Libellée</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql_compte = $DB->query("SELECT * FROM compta_compte WHERE code_sousclasse = :code ORDER BY idcompte ASC", array("code" => $code_sousclasse));
                            foreach ($sql_compte as $compte):
                                ?>
                                <tr>
                                    <td><?= $compte->code_compte; ?></td>
                                    <td><?= html_entity_decode($compte->libelle_compte); ?></td>
                                    <td>
                                        <a id="supp-compte" class="btn btn-icon btn-danger btn-rounded" href="<?= $constante->getUrl(array(), false, false); ?>controller/compta/config.ajax.php?action=supp_compte&code_compte=<?= $compte->code_compte; ?>"><i class="icon-trash"></i></a>
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
    <div class="modal fade" id="add-compte" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Nouveau Compte</h4>
                </div>
                <form action="<?= $constante->getUrl(array(), false,false); ?>controller/compta/config.php" method="POST" class="form-horizontal">
                    <input type="hidden" name="code_sousclasse" value="<?= $sousclasse->code_sousclasse; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Code:</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="code_compte" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Libellé:</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="libelle_compte" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-3 col-md-offset-9">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-success" name="action" value="add_compte">Valider</button>
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
<script src="<?= $constante->getUrl(array('plugins/')); ?>custom/js/pages/compta/config.js"></script>