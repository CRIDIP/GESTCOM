<?php if(!isset($_GET['sub'])): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h1><i class="fa fa-cubes"></i> ARTICLES</h1>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-rounded btn-lg btn-primary pull-right" data-toggle="modal" data-target="#add-famille"><i class="fa fa-plus-circle fa-2x"></i> Nouvelle Famille</a>
                    <a class="btn btn-rounded btn-lg btn-primary pull-right" href="index.php?view=article&sub=add_article"><i class="fa fa-plus-circle fa-2x"></i> Nouvelle Article</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-header">
                    <h3>Liste des familles d'article</h3>
                </div>
                <div class="panel-content">
                    <div class="table-responsive">
                        <table class="table dataTable table-hover" id="famille">
                            <thead>
                                <tr>
                                    <th>Désignation</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql_famille = $DB->query("SELECT * FROM famille_article ORDER BY designation_famille ASC");
                            foreach($sql_famille as $famille):
                            ?>
                                <tr>
                                    <td><?= html_entity_decode($famille->designation_famille); ?></td>
                                    <td>
                                        <a class="btn btn-icon btn-danger" href="<?= $constante->getUrl(array(), false, false); ?>controller/gestion/article.ajax.php?action=supp-famille&idfamille=<?= $famille->idfamille; ?>" id="supp-famille"><i class="icon-trash"></i></a>
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
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-header">
                    <h3>Liste des articles</h3>
                </div>
                <div class="panel-content">
                    <div class="table-responsive">
                        <table class="table dataTable table-hover" id="article">
                            <thead>
                                <tr>
                                    <th>Numéro article</th>
                                    <th>Famille</th>
                                    <th>Désignation</th>
                                    <th>Prix</th>
                                    <th>Stock</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql_article = $DB->query("SELECT * FROM article, famille_article WHERE article.idfamille = famille_article.idfamille ORDER BY designation_article ASC");
                            foreach($sql_article as $article):
                            ?>
                                <tr>
                                    <td><?= $article->num_article; ?></td>
                                    <td><?= html_entity_decode($article->designation_famille); ?></td>
                                    <td><?= html_entity_decode($article->designation_article); ?></td>
                                    <td><?= $fonction->number_decimal($article->prix_ht); ?></td>
                                    <td>
                                        <?php if($article->stock == 1): ?>
                                            <?php if($article->nb_stock <= 0): ?>
                                                <span class="label label-danger">Hors stock</span>
                                            <?php else: ?>
                                                <span class="label label-success">Ok (<?= $article->nb_stock; ?>)</span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="label label-default">Non gérer</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-icon btn-danger" href="<?= $constante->getUrl(array(), false, false); ?>controller/gestion/article.ajax.php?action=supp-article&idarticle=<?= $article->idarticle; ?>" id="supp-article"><i class="icon-trash"></i></a>
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
    <div class="modal fade" id="add-famille" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Nouvelle Famille</h4>
                </div>
                <form class="form-horizontal" action="<?= $constante->getUrl(array(), false, false); ?>controller/gestion/article.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Désignation de la famille</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="designation_famille" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-3 col-md-offset-9">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-success" name="action" value="add_famille">Valider</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(isset($_GET['sub']) && $_GET['sub'] == "add_article"): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                    <a class="btn btn-rounded btn-lg btn-primary pull-right" href="index.php?view=article"><i class="fa fa-arrow-circle-left fa-2x"></i> Retour</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-header bg-dark">
                    <h3><i class="fa fa-plus"></i> Nouvelle Article</h3>
                </div>
                <form class="form-horizontal" action="<?= $constante->getUrl(array(), false, false); ?>controller/gestion/article.php" method="POST">
                    <div class="panel-content">
                        <div class="form-group">
                            <label class="control-label col-md-3">
                                Famille
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <select class="form-group" data-search="true" name="idfamille" data-placeholder="Selection la famille d'article" required data-msg-required="La famille d'article est requise">
                                    <option value=""></option>
                                    <?php
                                    $sql_famille = $DB->query("SELECT * FROM famille_article ORDER BY designation_famille ASC");
                                    foreach($sql_famille as $famille):
                                    ?>
                                    <option value="<?= $famille->idfamille; ?>"><?= html_entity_decode($famille->designation_famille); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">
                                Désignation
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="designation_article" required data-msg-required="La désignation est requise" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Gestion de Stock</label>
                            <div class="col-md-9">
                                <div class="onoffswitch2">
                                    <input type="checkbox" name="stock" class="onoffswitch-checkbox" id="myonoffswitch3" onclick="checkStock(this)">
                                    <label class="onoffswitch-label" for="myonoffswitch3">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="nb_stock"></div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Prix Unitaire HT</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="prix_ht" />
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-9">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-success btn-rounded" name="action" value="add_article"><i class="fa fa-check"></i> Valider</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

<script src="<?= $constante->getUrl(array('plugins/')); ?>datatables/jquery.dataTables.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>switchery/switchery.min.js"></script> <!-- IOS Switch -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>bootstrap-tags-input/bootstrap-tagsinput.min.js"></script> <!-- Select Inputs -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>dropzone/dropzone.min.js"></script>  <!-- Upload Image & File in dropzone -->
<script src="<?= $constante->getUrl(array('js/')); ?>pages/form_icheck.js"></script>  <!-- Change Icheck Color - DEMO PURPOSE - OPTIONAL -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>jquery-validation/jquery.validate.js"></script> <!-- Form Validation -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>jquery-validation/additional-methods.min.js"></script> <!-- Form Validation Additional Methods - OPTIONAL -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>custom/js/pages/gestion/article.js"></script>
<script type="text/javascript">
    function checkStock(checkbox){
        if(checkbox.checked){
            $('#nb_stock').html("" +
                "<label class='control-label col-md-3'>Quantité en Stock</label>" +
                "<div class='col-md-4'>" +
                "<input type='text' class='form-control' name='nb_stock'/>" +
                "</div>" +
                "");
        }else{
            $('#nb_stock').html("" +
                "<!--<label class='control-label col-md-3'>Quantité en Stock</label>" +
                "<div class='col-md-4'>" +
                "<input type='text' class='form-control' name='nb_stock'/>" +
                "</div>-->" +
                "");
        }
    }
</script>

