<?php if(!isset($_GET['sub'])): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h1><i class="fa fa-file-pdf-o"></i> COMMANDE</h1>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-rounded btn-lg btn-primary pull-right" data-toggle="modal" data-target="#add-commande"><i class="fa fa-plus-circle fa-2x"></i> Nouvelle Commande</a>
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
                            <span class="c-primary pull-left" id="commande_saisie">0</span>
                        </div>
                        <div class="txt">Commande En cours de saisie</div>
                    </div>
                </div>
                <div class="infobox">
                    <div class="left">
                        <i class="fa fa-file-pdf-o bg-yellow"></i>
                    </div>
                    <div class="right">
                        <div>
                            <span class="c-primary pull-left" id="commande_attente">0</span>
                        </div>
                        <div class="txt">Commande en Attente</div>
                    </div>
                </div>
                <div class="infobox">
                    <div class="left">
                        <i class="fa fa-file-pdf-o bg-green"></i>
                    </div>
                    <div class="right">
                        <div>
                            <span class="c-primary pull-left" id="commande_valide">0</span>
                        </div>
                        <div class="txt">Commande Valider</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3>Liste des Commandes</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table dataTable" id="liste_commande">
                            <thead>
                            <tr>
                                <th>Numéro de la commande</th>
                                <th>Client</th>
                                <th>Date de la commande</th>
                                <th>Total de la commande</th>
                                <th>Etat de la commande</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql_commande = $DB->query("SELECT * FROM commande, client WHERE commande.idclient = client.idclient");
                            foreach ($sql_commande as $commande):
                                ?>
                                <tr>
                                    <td><?= $commande->num_commande; ?></td>
                                    <td>
                                        <?php if(!empty($commande->societe)): ?>
                                            <strong><?= $commande->societe; ?></strong><br>
                                            <i><?= $commande->nom_client; ?> <?= $commande->prenom_client; ?></i>
                                        <?php else: ?>
                                            <?= $commande->nom_client; ?> <?= $commande->prenom_client; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?= $date_format->formatage("d-m-Y", $commande->date_commande); ?>
                                    </td>
                                    <td><?= $fonction->number_decimal($tva->calc_ttc($commande->total_commande)); ?></td>
                                    <td>
                                        <?php
                                        switch($commande->etat_commande){
                                            case 0:
                                                echo '<span class="label label-default"><i class="fa fa-pencil"></i> Saisie en cours</span>';
                                                break;
                                            case 1:
                                                echo '<span class="label label-warning"><i class="fa fa-spinner fa-spin"></i> En attente</span>';
                                                break;
                                            case 2:
                                                echo '<span class="label label-success"><i class="fa fa-check"></i> Valider</span>';
                                                break;
                                            case 3:
                                                echo '<span class="label label-primary"><i class="fa fa-exchange"></i> Transférer</span>';
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-icon btn-primary btn-rounded" href="index.php?view=commande&sub=view&num_commande=<?= $commande->num_commande; ?>"><i class="icon-eye"></i></a>
                                        <a class="btn btn-icon btn-default btn-rounded" href="<?= $constante->getUrl(array(), false, false); ?>pdf/gestion/commande.php?num_commande=<?= $commande->num_commande; ?>"><i class="icon-flag"></i></a>
                                        <a class="btn btn-icon btn-danger btn-rounded" href="<?= $constante->getUrl(array(), false, false); ?>controller/gestion/commande.ajax.php?action=supp_commande&num_commande=<?= $commande->num_commande; ?>" id="supp_commande"><i class="icon-trash"</a>
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
    <div class="modal fade" id="add-commande" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title">Nouvelle commande</h4>
                </div>
                <form class="form-horizontal" action="<?= $constante->getUrl(array(), false, false); ?>controller/gestion/commande.php" method="post">
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
                            <label class="control-label col-md-3">Date de la commande</label>
                            <div class="col-md-5 prepend-icon">
                                <input type="text" name="date_commande" class="b-datepicker form-control" data-lang="fr" placeholder="Date de la commande...">
                                <i class="icon-calendar"></i>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="submit" class="btn btn-primary btn-embossed bnt-square" name="action" value="add_commande"><i class="fa fa-check"></i> Envoie de la commande</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(isset($_GET['sub']) && $_GET['sub'] == 'view'): ?>
    <?php
    $num_commande = $_GET['num_commande'];
    $sql_commande = $DB->query("SELECT * FROM commande, client WHERE commande.idclient = client.idclient AND num_commande = :num_commande", array("num_commande" => $num_commande));
    $commande = $sql_commande[0];
    ?>
    <div class="header">
        <h2>Commande - <strong><?= $commande->num_commande; ?></strong></h2>
        <?= $insert->breadcumb("Commande", $commande->num_commande, ""); ?>
    </div>
    <div class="row">
        <div class="col-md-12 well">
            <div class="pull-right">
                <a class="btn btn-primary btn-sm" href="index.php?view=commande"><i class="fa fa-arrow-circle-left"></i> Retour à la liste des commandes</a>
                <a class="btn btn-default btn-sm" href="<?= $constante->getUrl(array(''), false, false); ?>pdf/gestion/commande.php?num_commande=<?= $num_commande; ?>"><i class="fa fa-print"></i> Imprimer la commande</a>
                <?php
                switch($commande->etat_commande){
                    case 0:
                        echo '<a class="btn btn-warning btn-sm" href="'.$constante->getUrl(array(''), false, false).'controller/gestion/commande.ajax.php?action=edit_status&etat=1&num_commande='.$num_commande.'" id="btn_valide_commande"><i class="fa fa-spinner"></i> Mettre la commande en attente</a>
                            <a class="btn btn-success btn-sm" href="'.$constante->getUrl(array(''), false, false).'controller/gestion/commande.ajax.php?action=edit_status&etat=2&num_commande='.$num_commande.'" id="btn_valide_commande"><i class="fa fa-check"></i> Valider la commande</a>
                            <a class="btn btn-primary btn-sm" href="'.$constante->getUrl(array(''), false, false).'controller/gestion/commande.ajax.php?action=edit_status&etat=3&num_commande='.$num_commande.'" id="btn_valide_commande"><i class="fa fa-exchange"></i> Tansformer en facture</a>
                        ';
                        break;
                    case 1:
                        echo '<a class="btn btn-success btn-sm" href="'.$constante->getUrl(array(''), false, false).'controller/gestion/commande.ajax.php?action=edit_status&etat=2&num_commande='.$num_commande.'" id="btn_valide_commande"><i class="fa fa-check"></i> Valider la commande</a>
                            <a class="btn btn-primary btn-sm" href="'.$constante->getUrl(array(''), false, false).'controller/gestion/commande.ajax.php?action=edit_status&etat=3&num_commande='.$num_commande.'" id="btn_valide_commande"><i class="fa fa-exchange"></i> Tansformer en facture</a>
                        ';
                        break;
                    case 2:
                        echo '<a class="btn btn-primary btn-sm" href="'.$constante->getUrl(array(''), false, false).'controller/gestion/commande.ajax.php?action=edit_status&etat=3&num_commande='.$num_commande.'" id="btn_valide_commande"><i class="fa fa-exchange"></i> Tansformer en facture</a>';
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
                                    <td style="font-weight: bold; width: 25%; padding-top: 10px; padding-bottom: 10px;">Numéro de la commande:</td>
                                    <td style="width: 75%; padding-top: 10px; padding-bottom: 10px;">
                                        <?= $commande->num_commande; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; width: 25%; padding-top: 10px; padding-bottom: 10px;">Date:</td>
                                    <td style="width: 75%; padding-top: 10px; padding-bottom: 10px;">
                                        <?= $date_format->formatage_long($commande->date_commande); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; width: 25%; padding-top: 10px; padding-bottom: 10px;">Client:</td>
                                    <td style="width: 75%; padding-top: 10px; padding-bottom: 10px;">
                                        <a href="index.php?view=client&sub=view&num_client=<?= $commande->num_client; ?>"><?= $commande->nom_client; ?> <?= $commande->prenom_client; ?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; width: 25%; padding-top: 10px; padding-bottom: 10px;">Montant Total:</td>
                                    <td style="width: 75%; padding-top: 10px; padding-bottom: 10px;">
                                        <?= $fonction->number_decimal($tva->calc_ttc($commande->total_commande)); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; width: 25%; padding-top: 10px; padding-bottom: 10px;">TVA (20%):</td>
                                    <td style="width: 75%; padding-top: 10px; padding-bottom: 10px;">
                                        <?= $fonction->number_decimal($tva->calc_tva($commande->total_commande)); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; width: 25%; padding-top: 10px; padding-bottom: 10px;">NB articles:</td>
                                    <td style="width: 75%; padding-top: 10px; padding-bottom: 10px;">
                                        <?= $commande_cls->nb_article_commande($commande->num_commande); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; width: 25%; padding-top: 10px; padding-bottom: 10px;">Statut du devis:</td>
                                    <td style="width: 75%; padding-top: 10px; padding-bottom: 10px;">
                                        <?php
                                        switch($commande->etat_commande){
                                            case 0:
                                                echo '<span class="label label-default"><i class="fa fa-pencil"></i> Saisie en cours</span>';
                                                break;
                                            case 1:
                                                echo '<span class="label label-warning"><i class="fa fa-spinner fa-spin"></i> En attente</span>';
                                                break;
                                            case 2:
                                                echo '<span class="label label-success"><i class="fa fa-check"></i> Valider</span>';
                                                break;
                                            case 3:
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
                                        <?php if($commande_cls->etat_article_commande($num_commande) == 0): ?>
                                            <span class="text-danger"><strong><?= $commande_cls->etat_article_commande($num_commande); ?> Article(s) sont en rupture de Stock</strong></span>
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
                    <div class="row">
                        <div class="col-md-3 col-md-offset-9">
                            <a class="btn btn-primary" data-toggle="modal" data-target="#add_article"><i class="fa fa-plus"></i> Ajouter un produit</a>
                        </div>
                    </div>
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
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql_article = $DB->query("SELECT * FROM commande_article, article, famille_article WHERE commande_article.idarticle = article.idarticle AND article.idfamille = famille_article.idfamille AND commande_article.num_commande = :num_commande", array("num_commande" => $num_commande));
                            foreach ($sql_article as $article):
                                ?>
                                <tr>
                                    <td><?= $article->idcommandearticle; ?></td>
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
                                    <td>
                                        <a id="supp_article" href="<?= $constante->getUrl(array(), false, false); ?>controller/gestion/commande.ajax.php?action=supp_article&idcommandearticle=<?= $article->idcommandearticle; ?>&num_commande=<?= $num_commande; ?>" class="btn btn-icon btn-danger"><i class="icon-trash"></i></a>
                                    </td>
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
                                        <div class="col-md-4 w-500" style="text-align: right;"> <?= $fonction->number_decimal($commande->total_commande); ?></div>
                                    </div>
                                    <div class="row align-right m-b-10">
                                        <div class="col-md-7">TVA:</div>
                                        <div class="col-md-4 w-500" style="text-align: right;"> <?= $fonction->number_decimal($tva->calc_tva($commande->total_commande)); ?></div>
                                    </div>
                                    <div class="row align-right m-b-10" style="font-weight: bold; font-size: 20px;">
                                        <div class="col-md-7">Total TTC:</div>
                                        <div class="col-md-4 w-500" style="text-align: right;"> <?= $fonction->number_decimal($tva->calc_ttc($commande->total_commande)); ?></div>
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
                <form class="form-horizontal" action="<?= $constante->getUrl(array(), false, false); ?>controller/gestion/commande.php" method="post">
                    <input type="hidden" name="num_commande" value="<?= $num_commande; ?>">
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
<script src="<?= $constante->getUrl(array('plugins/')); ?>custom/js/pages/gestion/commande.js"></script>