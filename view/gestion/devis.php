<?php if(!isset($_GET['sub'])): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h1><i class="fa fa-file-pdf-o"></i> DEVIS</h1>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-rounded btn-lg btn-primary pull-right" data-toggle="modal" data-target="#add-devis"><i class="fa fa-plus-circle fa-2x"></i> Nouveau Devis</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="widget-infobox">
                <div class="infobox">
                    <div class="left">
                        <i class="fa fa-file-pdf-o bg-blue"></i>
                    </div>
                    <div class="right">
                        <div>
                            <span class="c-primary pull-left" id="devis_saisie">0</span>
                        </div>
                        <div class="txt">Devis En cours de saisie</div>
                    </div>
                </div>
                <div class="infobox">
                    <div class="left">
                        <i class="fa fa-file-pdf-o bg-yellow"></i>
                    </div>
                    <div class="right">
                        <div>
                            <span class="c-primary pull-left" id="devis_reponse">0</span>
                        </div>
                        <div class="txt">Devis en attente de réponse</div>
                    </div>
                </div>
                <div class="infobox">
                    <div class="left">
                        <i class="fa fa-file-pdf-o bg-green"></i>
                    </div>
                    <div class="right">
                        <div>
                            <span class="c-primary pull-left" id="devis_valide">0</span>
                        </div>
                        <div class="txt">Devis Accepté</div>
                    </div>
                </div>
                <div class="infobox">
                    <div class="left">
                        <i class="fa fa-file-pdf-o bg-red"></i>
                    </div>
                    <div class="right">
                        <div>
                            <span class="c-primary pull-left" id="devis_refuse">0</span>
                        </div>
                        <div class="txt">Devis Refusé</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3>Liste des devis</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table dataTable" id="liste_devis">
                            <thead>
                            <tr>
                                <th>Numéro du devis</th>
                                <th>Client</th>
                                <th>Date du Devis</th>
                                <th>Total du devis</th>
                                <th>Etat du devis</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql_devis = $DB->query("SELECT * FROM devis, client WHERE devis.idclient = client.idclient");
                            foreach ($sql_devis as $devis):
                                ?>
                                <tr>
                                    <td><?= $devis->num_devis; ?></td>
                                    <td>
                                        <?php if(!empty($devis->societe)): ?>
                                            <strong><?= $devis->societe; ?></strong><br>
                                            <i><?= $devis->nom_client; ?> <?= $devis->prenom_client; ?></i>
                                        <?php else: ?>
                                            <?= $devis->nom_client; ?> <?= $devis->prenom_client; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <strong>Date du Devis</strong>: <?= $date_format->formatage("d-m-Y", $devis->date_devis); ?><br>
                                        <strong>Date d'échéance:</strong>:
                                        <?php
                                        $echeance = $date_format->ech_15($devis->date_devis);
                                        if($echeance <= $devis->date_devis):
                                            ?>
                                            <span class="text-danger"><i class="fa fa-warning"></i> <?= $date_format->formatage("d-m-Y", $echeance); ?></span>
                                        <?php else: ?>
                                            <span class="text-success"><?= $date_format->formatage("d-m-Y", $echeance); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $fonction->number_decimal($devis->total_devis); ?></td>
                                    <td>
                                        <?php
                                        switch($devis->etat_devis){
                                            case 0:
                                                echo '<span class="label label-default"><i class="fa fa-pencil"></i> Saisie en cours</span>';
                                                break;
                                            case 1:
                                                echo '<span class="label label-warning"><i class="fa fa-spinner fa-spin"></i> En attente de réponse</span>';
                                                break;
                                            case 2:
                                                echo '<span class="label label-success"><i class="fa fa-check"></i> Valider</span>';
                                                break;
                                            case 3:
                                                echo '<span class="label label-danger"><i class="fa fa-remove"></i> Refuser</span>';
                                                break;
                                            case 4:
                                                echo '<span class="label label-primary"><i class="fa fa-exchange"></i> Transférer</span>';
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-icon btn-primary btn-rounded" href="index.php?view=devis&sub=view&num_devis=<?= $devis->num_devis; ?>"><i class="icon-eye"></i></a>
                                        <a class="btn btn-icon btn-default btn-rounded" href="<?= $constante->getUrl(array(), false, false); ?>pdf/gestion/devis.php?num_devis=<?= $devis->num_devis; ?>"><i class="icon-flag"></i></a>
                                        <a class="btn btn-icon btn-danger btn-rounded" href="<?= $constante->getUrl(array(), false, false); ?>controller/gestion/devis.ajax.php?action=supp_devis&num_devis=<?= $devis->num_devis; ?>" id="supp_devis"><i class="icon-trash"</a>
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
    <div class="modal fade" id="add-devis" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title">Nouveau Devis</h4>
                </div>
                <form class="form-horizontal" action="<?= $constante->getUrl(array(), false, false); ?>controller/gestion/devis.php" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Client</label>
                            <div class="col-md-9">
                                <select class="form-control" data-search="true" name="idclient" data-placeholder="Selectionner un client...">
                                    <option value=""></option>
                                    <?php
                                    $sql_client = $DB->query("SELECt * FROM client ORDER BY nom_client ASC");
                                    foreach ($sql_client as $client):
                                    ?>
                                    <option value="<?= $client->idclient; ?>"><?= $client->nom_client; ?> <?= $client->prenom_client; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Date du Devis</label>
                            <div class="col-md-5 prepend-icon">
                                <input type="text" name="date_devis" class="b-datepicker form-control" data-lang="fr" placeholder="Date du devis...">
                                <i class="icon-calendar"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Explication du devis:</label>
                            <div class="col-md-9">
                                <textarea cols="80" rows="10" class="cke-editor" name="explication"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="submit" class="btn btn-primary btn-embossed bnt-square" name="action" value="add_devis"><i class="fa fa-check"></i> Envoie du devis</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(isset($_GET['sub']) && $_GET['sub'] == 'view'): ?>
    <?php
    $num_devis = $_GET['num_devis'];
    $sql_devis = $DB->query("SELECT * FROM devis, client WHERE devis.idclient = client.idclient AND num_devis = :num_devis", array("num_devis" => $num_devis));
    $devis = $sql_devis[0];
    ?>
    <div class="header">
        <h2>Devis - <strong><?= $devis->num_devis; ?></strong></h2>
        <?= $insert->breadcumb("Devis", $devis->num_devis, ""); ?>
    </div>
    <div class="row">
        <div class="col-md-12 well">
            <div class="pull-right">
                <a class="btn btn-primary btn-sm" href="index.php?view=devis"><i class="fa fa-arrow-circle-left"></i> Retour à la liste des devis</a>
                <a class="btn btn-default btn-sm" href="<?= $constante->getUrl(array(''), false, false); ?>pdf/gestion/devis.php?num_devis=<?= $num_devis; ?>"><i class="fa fa-print"></i> Imprimer le devis</a>
                <?php
                switch($devis->etat_devis){
                    case 0:
                        echo '<a class="btn btn-success btn-sm" href="'.$constante->getUrl(array(''), false, false).'controller/gestion/devis.ajax.php?action=edit_status&etat=1&num_devis='.$num_devis.'" id="btn_valide_devis"><i class="fa fa-check"></i> Valider & envoyer le devis</a>';
                        break;
                    case 1:
                        echo '<a class="btn btn-success btn-sm" href="'.$constante->getUrl(array(''), false, false).'controller/gestion/devis.ajax.php?action=edit_status&etat=2&num_devis='.$num_devis.'" id="btn_valide_devis" id="btn_accepte_devis"><i class="fa fa-check"></i> Accepter</a> <a class="btn btn-danger btn-sm" href="'.$constante->getUrl(array(''), false, false).'controller/gestion/devis.ajax.php?action=edit_status&etat=3&num_devis='.$num_devis.'" id="btn_valide_devis" id="btn_refuse_devis"><i class="fa fa-remove"></i> Refuser</a>';
                        break;
                    case 2:
                        echo '<a class="btn btn-success btn-sm" href="'.$constante->getUrl(array(''), false, false).'controller/gestion/devis.ajax.php?action=edit_status&etat=4&num_devis='.$num_devis.'" id="btn_valide_devis" id="btn_transform_devis"><i class="fa fa-check"></i> Transformer en commande</a>';
                        break;
                }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs nav-primary">
                <li class="active"><a href="#apercu" data-toggle="tab">Aperçu</a></li>
                <li class=""><a href="#article" data-toggle="tab">Articles</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="apercu">
                    <h1>INFORMATION GLOBAL</h1>
                    <div class="row column-seperation" style="padding-top: 15px;">
                        <div class="col-md-6 line-separator">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="font-weight: bold; width: 25%; padding-top: 10px; padding-bottom: 10px;">Numéro du devis:</td>
                                    <td style="width: 75%; padding-top: 10px; padding-bottom: 10px;">
                                        <?= $devis->num_devis; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; width: 25%; padding-top: 10px; padding-bottom: 10px;">Date:</td>
                                    <td style="width: 75%; padding-top: 10px; padding-bottom: 10px;">
                                        <?= $date_format->formatage_long($devis->date_devis); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; width: 25%; padding-top: 10px; padding-bottom: 10px;">Client:</td>
                                    <td style="width: 75%; padding-top: 10px; padding-bottom: 10px;">
                                        <a href="index.php?view=client&sub=view&num_client=<?= $devis->num_client; ?>"><?= $devis->nom_client; ?> <?= $devis->prenom_client; ?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; width: 25%; padding-top: 10px; padding-bottom: 10px;">Montant Total:</td>
                                    <td style="width: 75%; padding-top: 10px; padding-bottom: 10px;">
                                        <?= $fonction->number_decimal($tva->calc_ttc($devis->total_devis)); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; width: 25%; padding-top: 10px; padding-bottom: 10px;">TVA (20%):</td>
                                    <td style="width: 75%; padding-top: 10px; padding-bottom: 10px;">
                                        <?= $fonction->number_decimal($tva->calc_tva($devis->total_devis)); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; width: 25%; padding-top: 10px; padding-bottom: 10px;">NB articles:</td>
                                    <td style="width: 75%; padding-top: 10px; padding-bottom: 10px;">
                                        <?= $devis_cls->nb_article_devis($devis->num_devis); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; width: 25%; padding-top: 10px; padding-bottom: 10px;">Statut du devis:</td>
                                    <td style="width: 75%; padding-top: 10px; padding-bottom: 10px;">
                                        <?php
                                        switch($devis->etat_devis){
                                            case 0:
                                                echo '<span class="label label-default"><i class="fa fa-pencil"></i> Saisie en cours</span>';
                                                break;
                                            case 1:
                                                echo '<span class="label label-warning"><i class="fa fa-spinner fa-spin"></i> En attente de réponse</span>';
                                                break;
                                            case 2:
                                                echo '<span class="label label-success"><i class="fa fa-check"></i> Valider</span>';
                                                break;
                                            case 3:
                                                echo '<span class="label label-danger"><i class="fa fa-remove"></i> Refuser</span>';
                                                break;
                                            case 4:
                                                echo '<span class="label label-primary"><i class="fa fa-exchange"></i> Transférer</span>';
                                                break;
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="font-weight: bold; width: 25%; padding-top: 10px; padding-bottom: 10px;">Etat des Articles:</td>
                                    <td style="width: 75%; padding-top: 10px; padding-bottom: 10px;">
                                        <?php if($devis_cls->etat_article_devis($num_devis) == 0): ?>
                                            <span class="text-danger"><strong><?= $devis_cls->etat_article_devis($num_devis); ?> Article(s) sont en rupture de Stock</strong></span>
                                        <?php else: ?>
                                            <span class="text-success"><strong>Tous les articles sont en stock</strong></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="article">
                    <?php if($devis->etat_devis == 0): ?>
                    <div class="row">
                        <div class="col-md-3 col-md-offset-9">
                            <a class="btn btn-primary" data-toggle="modal" data-target="#add_article"><i class="fa fa-plus"></i> Ajouter un produit</a>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Produit</th>
                                    <th>Référence</th>
                                    <th>Catégorie</th>
                                    <th>PUHT</th>
                                    <th>Qte</th>
                                    <th>PHT</th>
                                    <th>Statut</th>
                                    <?php if($devis->etat_devis == 0): ?>
                                    <th>Action</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql_article = $DB->query("SELECT * FROM devis_article, article, famille_article WHERE devis_article.idarticle = article.idarticle AND article.idfamille = famille_article.idfamille AND devis_article.num_devis = :num_devis", array("num_devis" => $num_devis));
                            foreach ($sql_article as $article):
                            ?>
                                <tr>
                                    <td><?= $article->iddevisarticle; ?></td>
                                    <td><?= html_entity_decode($article->designation_article); ?></td>
                                    <td><?= $article->num_article; ?></td>
                                    <td><?= html_entity_decode($article->designation_famille); ?></td>
                                    <td><?= $fonction->number_decimal($article->prix_ht); ?></td>
                                    <td><?= $article->qte; ?></td>
                                    <td><?= $fonction->number_decimal($article->total_ligne); ?></td>
                                    <td>
                                        <?php if($article->stock == 0): ?>
                                            <span class="label label-default">Hors Stock (Service)</span>
                                        <?php else: ?>
                                            <?php if($article->nb_stock <= 0): ?>
                                                <span class="label label-danger">Hors stock</span>
                                            <?php else: ?>
                                                <span class="label label-success">Ok (<?= $article->nb_stock; ?>)</span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                    <?php if($devis->etat_devis == 0): ?>
                                    <td>
                                        <a id="supp_article" href="<?= $constante->getUrl(array(), false, false); ?>controller/gestion/devis.ajax.php?action=supp_article&iddevisarticle=<?= $article->iddevisarticle; ?>&num_devis=<?= $num_devis; ?>" class="btn btn-icon btn-danger"><i class="icon-trash"></i></a>
                                    </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach;; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-5 well">
                            <div class="row">
                                <div class="col-md-6">
                                    <i class="fa fa-shopping-cart fa-4x"></i>
                                </div>
                                <div class="col-md-6">
                                    <div class="row align-right m-b-10">
                                        <div class="col-md-7">Sous Total HT:</div>
                                        <div class="col-md-4 w-500" style="text-align: right;"> <?= $fonction->number_decimal($devis->total_devis); ?></div>
                                    </div>
                                    <div class="row align-right m-b-10">
                                        <div class="col-md-7">TVA:</div>
                                        <div class="col-md-4 w-500" style="text-align: right;"> <?= $fonction->number_decimal($tva->calc_tva($devis->total_devis)); ?></div>
                                    </div>
                                    <div class="row align-right m-b-10" style="font-weight: bold; font-size: 20px;">
                                        <div class="col-md-7">Total TTC:</div>
                                        <div class="col-md-4 w-500" style="text-align: right;"> <?= $fonction->number_decimal($tva->calc_ttc($devis->total_devis)); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_article" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title">Ajout d'un article</h4>
                </div>
                <form class="form-horizontal" action="<?= $constante->getUrl(array(), false, false); ?>controller/gestion/devis.php" method="post">
                    <input type="hidden" name="num_devis" value="<?= $num_devis; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Article</label>
                            <div class="col-md-9">
                                <select class="form-control" data-search="true" name="idarticle" data-placeholder="Selectionner un article...">
                                    <option value=""></option>
                                    <?php
                                    $sql_cat = $DB->query("SELECT * FROM famille_article");
                                    foreach ($sql_cat as $cat):
                                    ?>
                                    <optgroup label="<?= html_entity_decode($cat->designation_famille); ?>">
                                        <?php
                                        $sql_article = $DB->query("SELECT * FROM article WHERE idfamille = :idfamille", array("idfamille" => $cat->idfamille));
                                        foreach ($sql_article as $article):
                                        ?>
                                        <option value="<?= $article->idarticle; ?>"><?= html_entity_decode($article->designation_article); ?> | Prix Unitaire: <?= $fonction->number_decimal($article->prix_ht); ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Quantité</label>
                            <div class="col-md-1">
                                <input type="text" class="form-control" name="qte">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="submit" class="btn btn-primary btn-embossed bnt-square" name="action" value="add_article"><i class="fa fa-check"></i> Ajout de l'article</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
<script src="<?= $constante->getUrl(array('plugins/')); ?>bootstrap-datepicker/js/bootstrap-datepicker.js"></script> <!-- >Bootstrap Date Picker -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>bootstrap-datepicker/locales/bootstrap-datepicker.fr.min.js"></script> <!-- >Bootstrap Date Picker in Spanish (can be removed if not use) -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>datatables/jquery.dataTables.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>cke-editor/ckeditor.js"></script> <!-- Advanced HTML Editor -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>cke-editor/adapters/adapters.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>custom/js/pages/gestion/devis.js"></script>