<?php if(!isset($_GET['sub'])): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h1><i class="fa fa-file-pdf-o"></i> FACTURE</h1>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-rounded btn-lg btn-primary pull-right" data-toggle="modal" data-target="#add-facture"><i class="fa fa-plus-circle fa-2x"></i> Nouvelle Facture</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="widget-infobox">
                <div class="infobox">
                    <div class="left">
                        <i class="fa fa-file-pdf-o bg-grey"></i>
                    </div>
                    <div class="right">
                        <div>
                            <span class="c-primary pull-left" id="facture_saisie">0</span>
                        </div>
                        <div class="txt">Facture En cours de saisie</div>
                    </div>
                </div>
                <div class="infobox">
                    <div class="left">
                        <i class="fa fa-file-pdf-o bg-yellow"></i>
                    </div>
                    <div class="right">
                        <div>
                            <span class="c-primary pull-left" id="facture_attente">0</span>
                        </div>
                        <div class="txt">Facture en Attente de reglement</div>
                    </div>
                </div>
                <div class="infobox">
                    <div class="left">
                        <i class="fa fa-file-pdf-o bg-yellow"></i>
                    </div>
                    <div class="right">
                        <div>
                            <span class="c-primary pull-left" id="facture_partiel_paye">0</span>
                        </div>
                        <div class="txt">Facture Partiellement payer</div>
                    </div>
                </div>
                <div class="infobox">
                    <div class="left">
                        <i class="fa fa-file-pdf-o bg-green"></i>
                    </div>
                    <div class="right">
                        <div>
                            <span class="c-primary pull-left" id="facture_paye">0</span>
                        </div>
                        <div class="txt">Facture Payer</div>
                    </div>
                </div>
                <div class="infobox">
                    <div class="left">
                        <i class="fa fa-file-pdf-o bg-yellow"></i>
                    </div>
                    <div class="right">
                        <div>
                            <span class="c-primary pull-left" id="facture_retard">0</span>
                        </div>
                        <div class="txt">Facture en retard de Paiement</div>
                    </div>
                </div>
                <div class="infobox">
                    <div class="left">
                        <i class="fa fa-file-pdf-o bg-red"></i>
                    </div>
                    <div class="right">
                        <div>
                            <span class="c-primary pull-left" id="facture_contentieux">0</span>
                        </div>
                        <div class="txt">Dossier de contentieux</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3>Liste des Factures</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table dataTable" id="liste_facture">
                            <thead>
                            <tr>
                                <th>Numéro de la facture</th>
                                <th>Client</th>
                                <th>Date de la facture</th>
                                <th>Total de la facture</th>
                                <th>Etat de la facture</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql_facture = $DB->query("SELECT * FROM facture, client WHERE facture.idclient = client.idclient");
                            foreach ($sql_facture as $facture):
                                ?>
                                <tr>
                                    <td><?= $facture->num_facture; ?></td>
                                    <td>
                                        <?php if(!empty($facture->societe)): ?>
                                            <strong><?= $facture->societe; ?></strong><br>
                                            <i><?= $facture->nom_client; ?> <?= $facture->prenom_client; ?></i>
                                        <?php else: ?>
                                            <?= $facture->nom_client; ?> <?= $facture->prenom_client; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?= $date_format->formatage("d-m-Y", $facture->date_facture); ?>
                                    </td>
                                    <td><?= $fonction->number_decimal($tva->calc_ttc($facture->total_facture)); ?></td>
                                    <td>
                                        <?php
                                        switch($facture->etat_facture){
                                            case 0:
                                                echo '<span class="label label-default"><i class="fa fa-pencil"></i> Saisie en cours</span>';
                                                break;
                                            case 1:
                                                echo '<span class="label label-warning"><i class="fa fa-spinner fa-spin"></i> En attente de reglement</span>';
                                                break;
                                            case 2:
                                                echo '<span class="label label-warning"><i class="fa fa-spinner fa-spin"></i> Partiellement Payer</span>';
                                                break;
                                            case 3:
                                                echo '<span class="label label-success"><i class="fa fa-check"></i> Payer</span>';
                                                break;
                                            case 4:
                                                echo '<span class="label label-warning"><i class="fa fa-warning"></i> Retard</span>';
                                                break;
                                            case 5:
                                                echo '<span class="label label-danger"><i class="fa fa-warning"></i> Contentieux</span>';
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-icon btn-primary btn-rounded" href="index.php?view=facture&sub=view&num_facture=<?= $facture->num_facture; ?>"><i class="icon-eye"></i></a>
                                        <a class="btn btn-icon btn-default btn-rounded" href="<?= $constante->getUrl(array(), false, false); ?>pdf/gestion/facture.php?num_facture=<?= $facture->num_facture; ?>"><i class="icon-flag"></i></a>
                                        <a class="btn btn-icon btn-danger btn-rounded" href="<?= $constante->getUrl(array(), false, false); ?>controller/gestion/facture.ajax.php?action=supp_facture&num_facture=<?= $facture->num_facture; ?>" id="supp_facture"><i class="icon-trash"</a>
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
    <div class="modal fade" id="add-facture" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title">Nouvelle facture</h4>
                </div>
                <form class="form-horizontal" action="<?= $constante->getUrl(array(), false, false); ?>controller/gestion/facture.php" method="post">
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
                            <label class="control-label col-md-3">Date de la facture</label>
                            <div class="col-md-5 prepend-icon">
                                <input type="text" name="date_facture" class="b-datepicker form-control" data-lang="fr" placeholder="Date de la facture...">
                                <i class="icon-calendar"></i>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="submit" class="btn btn-primary btn-embossed bnt-square" name="action" value="add_facture"><i class="fa fa-check"></i> Création de la facture</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(isset($_GET['sub']) && $_GET['sub'] == 'view'): ?>
    <?php
    $num_facture = $_GET['num_facture'];
    $sql_facture = $DB->query("SELECT * FROM facture, client WHERE facture.idclient = client.idclient AND num_facture = :num_facture", array("num_facture" => $num_facture));
    $facture = $sql_facture[0];
    ?>
    <div class="header">
        <h2>Facture - <strong><?= $facture->num_facture; ?></strong></h2>
        <?= $insert->breadcumb("Facture", $facture->num_facture, ""); ?>
    </div>
    <div class="row">
        <div class="col-md-12 well">
            <div class="pull-right">
                <a class="btn btn-primary btn-sm" href="index.php?view=facture"><i class="fa fa-arrow-circle-left"></i> Retour à la liste des factures</a>
                <a class="btn btn-default btn-sm" href="<?= $constante->getUrl(array(''), false, false); ?>pdf/gestion/facture.php?num_facture=<?= $num_facture; ?>"><i class="fa fa-print"></i> Imprimer la facture</a>
                <?php
                switch($facture->etat_facture){
                    case 0:
                        echo '
                            <a class="btn btn-success btn-sm" href="'.$constante->getUrl(array(''), false, false).'controller/gestion/facture.ajax.php?action=edit_status&etat=1&num_facture='.$num_facture.'" id="btn_valide_facture"><i class="fa fa-check"></i> Valider la facture</a>
                        ';
                        break;
                    case 1:
                        echo '
                            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add-reglement"><i class="fa fa-plus"></i> Ajouter un reglement</a>
                            <a class="btn btn-danger btn-sm" href="'.$constante->getUrl(array(''), false, false).'controller/gestion/facture.ajax.php?action=edit_status&etat=5&num_facture='.$num_facture.'" id="btn_valide_facture"><i class="fa fa-warning"></i> Envoyer en contentieux</a>
                        ';
                        break;
                    case 2:
                        echo '
                            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add-reglement"><i class="fa fa-plus"></i> Ajouter un reglement</a>
                            <a class="btn btn-danger btn-sm" href="'.$constante->getUrl(array(''), false, false).'controller/gestion/facture.ajax.php?action=edit_status&etat=5&num_facture='.$num_facture.'" id="btn_valide_facture"><i class="fa fa-warning"></i> Envoyer en contentieux</a>
                        ';
                        break;
                    case 4:
                        echo '
                            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add-reglement"><i class="fa fa-plus"></i> Ajouter un reglement</a>
                            <a class="btn btn-danger btn-sm" href="'.$constante->getUrl(array(''), false, false).'controller/gestion/facture.ajax.php?action=edit_status&etat=5&num_facture='.$num_facture.'" id="btn_valide_facture"><i class="fa fa-warning"></i> Envoyer en contentieux</a>
                        ';
                        break;
                    case 5:
                        echo '
                            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add-reglement"><i class="fa fa-plus"></i> Ajouter un reglement</a>
                        ';
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
                <li class=""><a href="#reglement" data-toggle="tab">Reglement</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="apercu">
                    <h1>INFORMATION GLOBAL</h1>
                    <div class="row column-seperation" style="padding-top: 15px;">
                        <div class="col-md-6 line-separator">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="font-weight: bold; width: 25%; padding-top: 10px; padding-bottom: 10px;">Numéro de la facture:</td>
                                    <td style="width: 75%; padding-top: 10px; padding-bottom: 10px;">
                                        <?= $facture->num_facture; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; width: 25%; padding-top: 10px; padding-bottom: 10px;">Date:</td>
                                    <td style="width: 75%; padding-top: 10px; padding-bottom: 10px;">
                                        <?= $date_format->formatage_long($facture->date_facture); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; width: 25%; padding-top: 10px; padding-bottom: 10px;">Client:</td>
                                    <td style="width: 75%; padding-top: 10px; padding-bottom: 10px;">
                                        <a href="index.php?view=client&sub=view&num_client=<?= $facture->num_client; ?>"><?= $facture->nom_client; ?> <?= $facture->prenom_client; ?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; width: 25%; padding-top: 10px; padding-bottom: 10px;">Montant Total:</td>
                                    <td style="width: 75%; padding-top: 10px; padding-bottom: 10px;">
                                        <?= $fonction->number_decimal($tva->calc_ttc($facture->total_facture)); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; width: 25%; padding-top: 10px; padding-bottom: 10px;">TVA (20%):</td>
                                    <td style="width: 75%; padding-top: 10px; padding-bottom: 10px;">
                                        <?= $fonction->number_decimal($tva->calc_tva($facture->total_facture)); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; width: 25%; padding-top: 10px; padding-bottom: 10px;">NB articles:</td>
                                    <td style="width: 75%; padding-top: 10px; padding-bottom: 10px;">
                                        <?= $facture_cls->nb_article_facture($facture->num_facture); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; width: 25%; padding-top: 10px; padding-bottom: 10px;">Statut de la facture:</td>
                                    <td style="width: 75%; padding-top: 10px; padding-bottom: 10px;">
                                        <?php
                                        switch($facture->etat_facture){
                                            case 0:
                                                echo '<span class="label label-default"><i class="fa fa-pencil"></i> Saisie en cours</span>';
                                                break;
                                            case 1:
                                                echo '<span class="label label-warning"><i class="fa fa-spinner fa-spin"></i> En attente de reglement</span>';
                                                break;
                                            case 2:
                                                echo '<span class="label label-warning"><i class="fa fa-spinner fa-spin"></i> Partiellement Payer</span>';
                                                break;
                                            case 3:
                                                echo '<span class="label label-success"><i class="fa fa-check"></i> Payer</span>';
                                                break;
                                            case 4:
                                                echo '<span class="label label-warning"><i class="fa fa-warning"></i> Retard</span>';
                                                break;
                                            case 5:
                                                echo '<span class="label label-danger"><i class="fa fa-warning"></i> Contentieux</span>';
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
                                        <?php if($facture_cls->etat_article_facture($num_facture) == 0): ?>
                                            <span class="text-danger"><strong><?= $facture_cls->etat_article_facture($num_facture); ?> Article(s) sont en rupture de Stock</strong></span>
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
                    <?php if($facture->etat_facture == 0): ?>
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
                                <?php if($facture->etat_facture == 0): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql_article = $DB->query("SELECT * FROM facture_article, article, famille_article WHERE facture_article.idarticle = article.idarticle AND article.idfamille = famille_article.idfamille AND facture_article.num_facture = :num_facture", array("num_facture" => $num_facture));
                            foreach ($sql_article as $article):
                                ?>
                                <tr>
                                    <td><?= $article->idfacturearticle; ?></td>
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
                                    <?php if($facture->etat_facture == 0): ?>
                                    <td>
                                        <a id="supp_article" href="<?= $constante->getUrl(array(), false, false); ?>controller/gestion/facture.ajax.php?action=supp_article&idfacturearticle=<?= $article->idfacturearticle; ?>&num_facture=<?= $num_facture; ?>" class="btn btn-icon btn-danger"><i class="icon-trash"></i></a>
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
                                        <div class="col-md-4 w-500" style="text-align: right;"> <?= $fonction->number_decimal($facture->total_facture); ?></div>
                                    </div>
                                    <div class="row align-right m-b-10">
                                        <div class="col-md-7">TVA:</div>
                                        <div class="col-md-4 w-500" style="text-align: right;"> <?= $fonction->number_decimal($tva->calc_tva($facture->total_facture)); ?></div>
                                    </div>
                                    <div class="row align-right m-b-10" style="font-weight: bold; font-size: 20px;">
                                        <div class="col-md-7">Total TTC:</div>
                                        <div class="col-md-4 w-500" style="text-align: right;"> <?= $fonction->number_decimal($tva->calc_ttc($facture->total_facture)); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="reglement">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Reférence</th>
                                <th>Date du Réglement</th>
                                <th>Type de Réglement</th>
                                <th>Montant</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql_rglt= $DB->query("SELECT * FROM reglement_facture, facture WHERE reglement_facture.num_facture = facture.num_facture AND reglement_facture.num_facture = :num_facture", array("num_facture" => $num_facture));
                            foreach ($sql_rglt as $rglt):
                                ?>
                                <tr>
                                    <td><?= $rglt->num_reglement; ?></td>
                                    <td><?= $date_format->formatage("d/m/Y", $rglt->date_reglement); ?></td>
                                    <td>
                                        <?php if($rglt->type_reglement == 2): ?>
                                            <strong>Chèque bancaire</strong><br>
                                            <strong>Numéro du Chèque:</strong> <?= $rglt->num_chq; ?><br>
                                            <strong>Banque du Chèque:</strong> <?= $rglt->banque_chq; ?>
                                        <?php else: ?>
                                            <?php
                                            switch($rglt->type_reglement){
                                                case 1:
                                                    echo "Espèce";
                                                    break;
                                                case 3:
                                                    echo "CB - PAYPAL EUROPE";
                                                    break;
                                                case 4:
                                                    echo "Virement bancaire";
                                                    break;
                                                case 5:
                                                    echo "Traite Non Accepter";
                                                    break;
                                                case 6:
                                                    echo "Prélèvement Bancaire";
                                                    break;
                                                case 7:
                                                    echo "Traite Accepter";
                                                    break;
                                            }
                                            ?>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $fonction->number_decimal($rglt->montant); ?></td>
                                    <td>
                                        <a id="supp_rglt" href="<?= $constante->getUrl(array(), false, false); ?>controller/gestion/reglement.ajax.php?action=supp_rglt&idreglementfacture=<?= $rglt->idreglementfacture; ?>&num_facture=<?= $num_facture; ?>" class="btn btn-icon btn-danger"><i class="icon-trash"></i></a>
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
                                    <?php if($reglement_cls->total_rglt_facture($num_facture) != $facture->total_facture+$tva->calc_tva($facture->total_facture) AND $reglement_cls->total_rglt_facture($num_facture) != 0){ ?>
                                        <i class="fa fa-warning fa-4x text-warning"></i>
                                    <?php }elseif($reglement_cls->total_rglt_facture($num_facture) == 0){ ?>
                                        <i class="fa fa-remove fa-4x text-danger"></i>
                                    <?php }else{ ?>
                                        <i class="fa fa-check-circle fa-4x text-success"></i>
                                    <?php } ?>
                                </div>
                                <div class="col-md-6">
                                    <?php if($reglement_cls->total_rglt_facture($num_facture) != $facture->total_facture+$tva->calc_tva($facture->total_facture) AND $reglement_cls->total_rglt_facture($num_facture) != 0){ ?>
                                        <span class="h3 text-warning">Facture Partiellement Régler</span>
                                    <?php }elseif($reglement_cls->total_rglt_facture($num_facture) == 0){ ?>
                                        <span class="h3 text-danger">Facture Impayer</span>
                                    <?php }else{ ?>
                                        <span class="h3 text-success">Facture Régler</span>
                                    <?php } ?>
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
                <form class="form-horizontal" action="<?= $constante->getUrl(array(), false, false); ?>controller/gestion/facture.php" method="post">
                    <input type="hidden" name="num_facture" value="<?= $num_facture; ?>">
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
                        <div class="form-group">
                            <label class="control-label col-md-3">Description Supplémentaire</label>
                            <div class="col-md-9">
                                <textarea cols="80" rows="10" class="cke-editor" name="description_sup"></textarea>
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
    <div class="modal fade" id="add-reglement" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title">Ajout d'un Règlement</h4>
                </div>
                <form class="form-horizontal" action="<?= $constante->getUrl(array(), false, false); ?>controller/gestion/reglement.php" method="post">
                    <input type="hidden" name="num_facture" value="<?= $num_facture; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Montant du reglement</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="montant" value="<?= $tva->calc_ttc($facture->total_facture); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Date du reglement</label>
                            <div class="col-md-5 prepend-icon">
                                <input type="text" name="date_reglement" class="b-datepicker form-control" data-lang="fr" placeholder="Date du reglement...">
                                <i class="icon-calendar"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Type de reglement</label>
                            <div class="col-md-9">
                                <select class="form-control" onchange="changeType();" id="type_reglement" data-search="true" name="type_reglement" data-placeholder="Selectionner un type de reglement...">
                                    <option value=""></option>
                                    <option value="1">Espèce</option>
                                    <option value="2">Chèque</option>
                                    <option value="3">CB - PAYPAL</option>
                                    <option value="4">Virement Bancaire</option>
                                    <option value="5">Traite Non accepter</option>
                                    <option value="6">Prélèvement</option>
                                    <option value="7">Traite accepter</option>
                                </select>
                            </div>
                        </div>
                        <div id="affiche_cheque">
                            <h3>Information du Chèque</h3>
                            <div class="form-group" id="num_chq">
                                <label class="control-label col-md-3">Numéro du Chèque</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="num_chq">
                                </div>
                            </div>
                            <div class="form-group" id="num_chq">
                                <label class="control-label col-md-3">Banque du Chèque</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="banque_chq">
                                </div>
                            </div>
                            <input type="hidden" name="porteur_chq" value="<?= $facture->idclient; ?>">
                        </div>
                        <div id="affiche_paypal">
                            <h3>Information CB</h3>
                            <div class="form-group" id="num_chq">
                                <label class="control-label col-md-3">Type de Carte Bancaire</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                            <label><input type="radio" name="type_carte" value="visa" data-radio="iradio_flat-blue"> Visa</label>
                                            <label><input type="radio" name="type_carte" value="mastercard" data-radio="iradio_flat-blue"> Mastercard</label>
                                            <label><input type="radio" name="type_carte" value="discover" data-radio="iradio_flat-blue"> Discover</label>
                                            <label><input type="radio" name="type_carte" value="amex" data-radio="iradio_flat-blue"> Amex</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Numéro de Carte bancaire</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="num_cb" data-mask="9999-9999-9999-9999">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Date d'expiration</label>
                                <div class="col-md-1">
                                    <input type="text" class="form-control" name="expire_month" data-mask="99" placeholder="MM">
                                </div>
                                <div class="col-md-1">
                                    <input type="text" class="form-control" name="expire_year" data-mask="99" placeholder="AA">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Cryptogramme</label>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="cvv2">
                                    <p>Disponible au dos de la carte de paiement</p>
                                </div>
                            </div>
                            <input type="hidden" name="porteur_chq" value="<?= $facture->idclient; ?>">
                            <input type="hidden" name="firstName" value="<?= $facture->prenom_client; ?>">
                            <input type="hidden" name="lastName" value="<?= $facture->nom_client; ?>">

                        </div>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="submit" class="btn btn-primary btn-embossed bnt-square" name="action" value="add_reglement"><i class="fa fa-check"></i> Ajout du reglement</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
<script src="<?= $constante->getUrl(array('plugins/')); ?>bootstrap-datepicker/js/bootstrap-datepicker.js"></script> <!-- >Bootstrap Date Picker -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>bootstrap-datepicker/locales/bootstrap-datepicker.fr.min.js"></script> <!-- >Bootstrap Date Picker in Spanish (can be removed if not use) -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>datatables/jquery.dataTables.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>bootstrap/js/jasny-bootstrap.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>cke-editor/ckeditor.js"></script> <!-- Advanced HTML Editor -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>cke-editor/adapters/adapters.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>custom/js/pages/gestion/facture.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>custom/js/pages/gestion/reglement.js"></script>