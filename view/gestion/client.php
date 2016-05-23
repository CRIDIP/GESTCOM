<?php if(!isset($_GET['sub'])): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h1><i class="fa fa-users"></i> CLIENT</h1>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-rounded btn-lg btn-primary pull-right" data-toggle="modal" data-target="#add-client"><i class="fa fa-plus-circle fa-2x"></i> Nouveau Client</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-header">
                    <h3>Journal de V</h3>
                </div>
                <div class="panel-content">
                    <div class="table-responsive">
                        <table class="table table-hover dataTable" id="client">
                            <thead>
                            <tr>
                                <th>Numéro Client</th>
                                <th>Identité</th>
                                <th>Adresse</th>
                                <th>Coordonnée</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql_client = $DB->query("SELECT * FROM client ORDER BY nom_client ASC");
                            foreach($sql_client as $client):
                                ?>
                                <tr>
                                    <td><?= $client->num_client; ?></td>
                                    <td><?= $client->nom_client; ?> <?= $client->prenom_client; ?></td>
                                    <td>
                                        <?= html_entity_decode($client->adresse_client); ?><br>
                                        <?= $client->code_postal; ?> <?= html_entity_decode($client->ville_client); ?>
                                    </td>
                                    <td>
                                        <strong><i class="fa fa-phone-square"></i></strong>: 0<?= $client->tel_client; ?><br>
                                        <strong><i class="fa fa-envelope"></i></strong>: <?= $client->mail_client; ?>
                                    </td>
                                    <td>
                                        <button data-rel="tooltip" type="button" class="btn btn-sm btn-primary m-b-10 f-left btn-icon" data-toggle="tooltip" data-placement="top" onclick="window.location='index.php?view=client&sub=view&num_client=<?= $client->num_client; ?>'" title="Voir la fiche"><i class="fa fa-eye"></i> </button>
                                        <a data-rel="tooltip" href="../../controller/gestion/client.ajax.php?action=call_customer&tel=0033<?= substr($client->tel_client,2); ?>" class="btn btn-sm btn-default m-b-10 f-left btn-icon" data-toggle="tooltip" data-placement="top" title="Téléphoner au client" id="call_customer"><i class="fa fa-phone"></i> </a>
                                        <a data-rel="tooltip" id="supp-client" class="btn btn-sm btn-danger m-b-10 f-left btn-icon" data-toggle="tooltip" data-placement="top" title="Supprimer le client" href="<?= $constante->getUrl(array(), false, false); ?>controller/gestion/client.ajax.php?action=supp-client&idclient=<?= $client->idclient; ?>"><i class="fa fa-trash"></i> </a>
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
    <div class="modal fade" id="add-client" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-blue">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Nouveau Client</h4>
                </div>
                <form class="form-horizontal" action="../../controller/gestion/client.php" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-md-3" for="client">Société</label>
                            <div class="col-md-9">
                                <input type="text" id="client" class="form-control" name="societe">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="client">Nom</label>
                            <div class="col-md-3">
                                <input type="text" id="client" class="form-control" name="nom_client">
                            </div>
                            <label class="control-label col-md-3" for="client">Prénom</label>
                            <div class="col-md-3">
                                <input type="text" id="client" class="form-control" name="prenom_client">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="client">Adresse</label>
                            <div class="col-md-9">
                                <input type="text" id="client" class="form-control" name="adresse_client">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="client">Code Postal</label>
                            <div class="col-md-2">
                                <input type="text" id="client" class="form-control" name="code_postal">
                            </div>
                            <label class="control-label col-md-3" for="client">Ville</label>
                            <div class="col-md-4">
                                <input type="text" id="client" class="form-control" name="ville_client">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="client">Numéro de Téléphone</label>
                            <div class="col-md-9 prepend-icon">
                                <input type="text" data-mask="+3300999999999" id="client" class="form-control" name="tel_client">
                                <i class="fa fa-phone-square"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="client">Adresse Mail</label>
                            <div class="col-md-9 prepend-icon">
                                <input type="text" id="client" class="form-control" name="mail_client">
                                <i class="fa fa-envelope"></i>
                            </div>
                        </div>
                        <hr />
                        <h2>Information Avancé</h2>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="client">Catégorie de Client</label>
                            <div class="col-md-9">
                                <select id="client" class="form-group" data-search="true" name="cat_client" data-placeholder="Selection la catégorie du client">
                                    <?php
                                    $sql_cat = $DB->query("SELECT * FROM conf_annuaire_cat_client");
                                    foreach($sql_cat as $cat):
                                        ?>
                                        <option value="<?= $cat->idcatclient; ?>"><?= $cat->libelle_cat_client; ?> | Encours: <?= $fonction->number_decimal($cat->encours); ?> | Délai Réglement: <?= $cat->delai_rglt; ?> Jours </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="client">Type de facturation</label>
                            <div class="col-md-9">
                                <select id="client" class="form-group" data-search="true" name="type_facturation" data-placeholder="Selection la type de facturation">
                                    <option value=""></option>
                                    <option value="1">Immédiate</option>
                                    <option value="2">Quotidien</option>
                                    <option value="3">Hebdomadaire</option>
                                    <option value="4">Bimensuel</option>
                                    <option value="5">Mensuel</option>
                                    <option value="6">Trimestriel</option>
                                    <option value="7">Semestriel</option>
                                    <option value="8">Annuel</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="client">Type de facturation</label>
                            <div class="col-md-9">
                                <select id="client" class="form-group" data-search="true" name="type_reglement" data-placeholder="Selection la type de Réglement par défault">
                                    <option value=""></option>
                                    <option value="1">Espèce</option>
                                    <option value="2">Chèque</option>
                                    <option value="3">Carte Bancaire</option>
                                    <option value="4">Virement Bancaire</option>
                                    <option value="5">Traite Non Acceptée</option>
                                    <option value="6">Prélèvement bancaire</option>
                                    <option value="7">Traite Acceptée</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-sm-9 col-sm-offset-3">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-success" name="action" value="add_client">Création du nouveau client</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(isset($_GET['sub']) && $_GET['sub'] == 'view'): ?>
    <?php
    $num_client = $_GET['num_client'];
    $sql_client = $DB->query("SELECT * FROM client, conf_annuaire_cat_client WHERE client.cat_client = conf_annuaire_cat_client.idcatclient AND num_client = :num_client", array("num_client"  => $num_client));
    $client = $sql_client[0];
    $sql_user_c = $DB->query("SELECT * FROM users WHERE idclient = :idclient", array("idclient" => $client->idclient));
    $user_c = $sql_user_c[0];
    $sql_info = $DB->query("SELECT * FROM client_info_default WHERE idclient = :idclient", array("idclient" => $client->idclient));
    $info = $sql_info[0];
    ?>
    <!--<div class="well">
        <?php var_dump($client_cls->total_reglement($client->idclient)); ?>
    </div>-->
    <div class="header">
        <h2>Client - <strong><?= $client->nom_client; ?> <?= $client->prenom_client; ?></strong></h2>
        <?= $insert->breadcumb("client", $client->nom_client.' '.$client->prenom_client, ""); ?>
    </div>
    <div class="row">
        <div class="col-md-12 well">
            <div class="pull-right">
                <a class="btn btn-primary btn-sm" href="index.php?view=client"><i class="fa fa-arrow-circle-left"></i> Retour à la liste des clients</a>
                <a class="btn btn-default btn-sm" href="<?= $constante->getUrl(array(), false, false); ?>pdf/gestion/client.php?num_client=<?= $client->num_client; ?>"><i class="fa fa-print"></i> Imprimer la fiche client</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-content">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#info" data-toggle="tab">Information général</a></li>
                        <li class=""><a href="#client_info" data-toggle="tab">Client</a></li>
                        <li><a href="#communication" data-toggle="tab">Communication</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="info">
                            <div class="row">
                                <div class="col-md-8">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <strong>Nom:</strong> <?= $client->nom_client; ?> <?= $client->prenom_client; ?>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <hr />
                                    <table class="table dataTable" id="document_client">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Document</th>
                                            <th>Etat</th>
                                            <th>Montant</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sql_devis = $DB->query("SELECT * FROM devis WHERE idclient = :idclient ORDER BY date_devis ASC", array("idclient" => $client->idclient));
                                        foreach($sql_devis as $devis):
                                            ?>
                                            <tr>
                                                <td><?= $date_format->formatage("d-m-Y", $devis->date_devis); ?></td>
                                                <td>Devis Client - <?= $devis->num_devis; ?></td>
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
                                                    <?= $fonction->number_decimal($devis->total_devis); ?>
                                                </td>
                                                <td>
                                                    <a href="<?= $constante->getUrl(array(), false, false); ?>pdf/gestion/devis.php?num_devis=<?= $devis->num_devis; ?>"><i class="fa fa-file-pdf-o"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <?php
                                        $sql_commande = $DB->query("SELECT * FROM commande WHERE idclient = :idclient ORDER BY date_commande ASC", array("idclient" => $client->idclient));
                                        foreach($sql_commande as $commande):
                                            ?>
                                            <tr>
                                                <td><?= $date_format->formatage("d-m-Y", $commande->date_commande); ?></td>
                                                <td>Commande Client - <?= $commande->num_commande; ?></td>
                                                <td>
                                                    <?php
                                                    switch($commande->etat_commande){
                                                        case 0:
                                                            echo '<span class="label label-default"><i class="fa fa-pencil"></i> Saisie en cours</span>';
                                                            break;
                                                        case 1:
                                                            echo '<span class="label label-warning"><i class="fa fa-spinner fa-spin"></i> En attente de réponse</span>';
                                                            break;
                                                        case 2:
                                                            echo '<span class="label label-success"><i class="fa fa-check"></i>A Valider</span>';
                                                            break;
                                                        case 3:
                                                            echo '<span class="label label-primary"><i class="fa fa-exchange"></i> Transférer</span>';
                                                            break;
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?= $fonction->number_decimal($commande->total_commande); ?>
                                                </td>
                                                <td>
                                                    <a href="<?= $constante->getUrl(array(), false, false); ?>pdf/gestion/commande.php?num_commande=<?= $commande->num_commande; ?>"><i class="fa fa-file-pdf-o"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <?php
                                        $sql_facture = $DB->query("SELECT * FROM facture WHERE idclient = :idclient ORDER BY date_facture ASC", array("idclient" => $client->idclient));
                                        foreach($sql_facture as $facture):
                                            ?>
                                            <tr>
                                                <td><?= $date_format->formatage("d-m-Y", $facture->date_facture); ?></td>
                                                <td>Facture Client - <?= $facture->num_facture; ?></td>
                                                <td>
                                                    <?php
                                                    switch($facture->etat_facture){
                                                        case 0:
                                                            echo '<span class="label label-default"><i class="fa fa-pencil"></i> Saisie en cours</span>';
                                                            break;
                                                        case 1:
                                                            echo '<span class="label label-warning"><i class="fa fa-spinner fa-spin"></i> En attente de Réglement</span>';
                                                            break;
                                                        case 2:
                                                            echo '<span class="label label-warning"><i class="fa fa-money"></i> Partiellement Payer</span>';
                                                            break;
                                                        case 3:
                                                            echo '<span class="label label-success"><i class="fa fa-check"></i> Facture Payé</span>';
                                                            break;
                                                        case 4:
                                                            echo '<span class="label label-warning"><i class="fa fa-exclamation-triangle"></i> En retard</span>';
                                                            break;
                                                        case 5:
                                                            echo '<span class="label label-danger"><i class="fa fa-exclamation-triangle"></i> Contentieux</span>';
                                                            break;
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?= $fonction->number_decimal($facture->total_facture); ?>
                                                </td>
                                                <td>
                                                    <a href="<?= $constante->getUrl(array(), false, false); ?>pdf/gestion/facture.php?num_facture=<?= $facture->num_facture; ?>"><i class="fa fa-file-pdf-o"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-4 bg-gray-light">
                                    <h2>Coordonnée</h2>
                                    <div class="well">
                                        <table style="width: 100%; margin-bottom: 25px;">
                                            <tr>
                                                <td style="font-weight: bold; width: 50%;"><i class="fa fa-phone"></i> Téléphone</td>
                                                <td style="width: 50%;">0<?= $client->tel_client; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: bold; width: 50%;"><i class="fa fa-envelope"></i> E-mail</td>
                                                <td style="width: 50%;"><?= $client->mail_client; ?></td>
                                            </tr>
                                        </table>
                                        <a class="btn btn-primary" href="<?= $constante->getUrl(array(), false, false); ?>controller/gestion/client.ajax.php?action=call_customer&tel=0033<?= substr($client->tel_client,2); ?>"><i class="fa fa-phone"></i> Appeller le client</a>
                                    </div>
                                    <h2>Adresse</h2>
                                    <div class="well">
                                        <table style="width: 100%; margin-bottom: 25px;">
                                            <tr>
                                                <td style="font-weight: bold; width: 50%;">Adresse</td>
                                                <td style="width: 50%;"><?= $client->adresse_client; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: bold; width: 50%;">Code Postal</td>
                                                <td style="width: 50%;"><?= $client->code_postal; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: bold; width: 50%;">Ville</td>
                                                <td style="width: 50%;"><?= $client->ville_client; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <h2>Espace Web</h2>
                                    <div class="well">
                                        <table style="width: 100%; margin-bottom: 25px;">
                                            <tr>
                                                <td style="font-weight: bold; width: 50%;">Login</td>
                                                <td style="width: 50%;"><?= $user_c->username ?></td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: bold; width: 50%;">Etat</td>
                                                <td style="width: 50%;">
                                                    <?php if($user_c->connect == 0): ?>
                                                        <i class="fa fa-circle text-danger"></i> Hors Ligne
                                                    <?php elseif($user_c->connect == 1): ?>
                                                        <i class="fa fa-circle text-warning"></i> Absent
                                                    <?php else: ?>
                                                        <i class="fa fa-circle text-success"></i> En ligne
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: bold; width: 50%;">Date dernière connexion</td>
                                                <td style="width: 50%;">
                                                    <?php if(!empty($user_c->last_connect))
                                                    {
                                                        echo $date_format->formatage("d/m/Y à H:i", $user_c->last_connect);
                                                    }else{
                                                        echo "Aucune connexion avec son compte.";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: bold; width: 50%;">Totp</td>
                                                <td style="width: 50%;">
                                                    <?php if($user_c->totp == 0): ?>
                                                        <span class="label label-danger"><i class="fa fa-remove"></i> Désactivé</span>
                                                    <?php else: ?>
                                                        <span class="label label-success"><i class="fa fa-check"></i> Activé</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="client_info">
                            <div class="row">
                                <div class="col-md-8">
                                    <table style="width: 100%;">
                                        <tbody>
                                        <tr>
                                            <td style="font-weight: bold;width: 50%;">Catégorie Client</td>
                                            <td style="width: 50%;"><?= $client->libelle_cat_client; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold;width: 50%;">Type de facturation</td>
                                            <td style="width: 50%;">
                                                <?php
                                                switch($info->type_facturation){
                                                    case 1:
                                                        echo "Immédiate";
                                                        break;
                                                    case 2:
                                                        echo "Quotidien";
                                                        break;
                                                    case 3:
                                                        echo "Hebdomadaire";
                                                        break;
                                                    case 4:
                                                        echo "Bimensuel";
                                                        break;
                                                    case 5:
                                                        echo "Mensuel";
                                                        break;
                                                    case 6:
                                                        echo "Trimestriel";
                                                        break;
                                                    case 7:
                                                        echo "Semestriel";
                                                        break;
                                                    case 8:
                                                        echo "Annuel";
                                                        break;
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold;width: 50%;">Délai de réglement</td>
                                            <td style="width: 50%;"><?= $info->delai_reglement; ?> Jours</td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold;width: 50%;">Réglement par défault:</td>
                                            <td style="width: 50%;">
                                                <?php
                                                switch($info->type_reglement){
                                                    case 1:
                                                        echo "Espèce";
                                                        break;
                                                    case 2:
                                                        echo "Chèque";
                                                        break;
                                                    case 3:
                                                        echo "Carte bancaire - PAYPAL";
                                                        break;
                                                    case 4:
                                                        echo "Virement bancaire";
                                                        break;
                                                    case 5:
                                                        echo "Traite Non Acceptée";
                                                        break;
                                                    case 6:
                                                        echo "Prélèvement Bancaire";
                                                        break;
                                                    case 7:
                                                        echo "Traite Acceptée";
                                                        break;
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold;width: 50%;">Encours</td>
                                            <td style="width: 50%;"><?= $fonction->number_decimal($info->encours); ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <h2>Document en cours:</h2>
                                    <h3>Devis en cours</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table dataTable" id="devis_cours">
                                                <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Document</th>
                                                    <th>Etat</th>
                                                    <th>Prix</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $sql_devis = $DB->query("SELECT * FROM devis WHERE etat_devis = 0 OR etat_devis = 1 AND idclient = :idclient", array("idclient" => $client->idclient));
                                                foreach($sql_devis as $devis):
                                                    ?>
                                                    <tr>
                                                        <td><?= $date_format->formatage("d/m/Y", $devis->date_devis); ?></td>
                                                        <td><?= $devis->num_devis; ?></td>
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
                                                        <td><?= $fonction->number_decimal($devis->total_devis); ?></td>
                                                        <td><a href="<?= $constante->getUrl(array(), false, false); ?>pdf/gestion/devis.php?num_devis=<?= $devis->num_devis; ?>"><i class="fa fa-file-pdf-o"></i></a></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <h3>Commande en cours</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table dataTable" id="commande_cours">
                                                <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Document</th>
                                                    <th>Etat</th>
                                                    <th>Prix</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $sql_commande = $DB->query("SELECT * FROM commande WHERE etat_commande = 0 AND idclient = :idclient", array("idclient" => $client->idclient));
                                                foreach($sql_commande as $commande):
                                                    ?>
                                                    <tr>
                                                        <td><?= $date_format->formatage("d/m/Y", $commande->date_commande); ?></td>
                                                        <td><?= $commande->num_commande; ?></td>
                                                        <td>
                                                            <?php
                                                            switch($commande->etat_commande){
                                                                case 0:
                                                                    echo '<span class="label label-default"><i class="fa fa-pencil"></i> Saisie en cours</span>';
                                                                    break;
                                                                case 1:
                                                                    echo '<span class="label label-warning"><i class="fa fa-spinner fa-spin"></i> En attente de réponse</span>';
                                                                    break;
                                                                case 2:
                                                                    echo '<span class="label label-success"><i class="fa fa-check"></i>A Valider</span>';
                                                                    break;
                                                                case 3:
                                                                    echo '<span class="label label-primary"><i class="fa fa-exchange"></i> Transférer</span>';
                                                                    break;
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?= $fonction->number_decimal($commande->total_commande); ?></td>
                                                        <td><a href=""><i class="fa fa-file-pdf-o"></i></a></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <h3>Facture en cours</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table dataTable" id="facture_cours">
                                                <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Document</th>
                                                    <th>Etat</th>
                                                    <th>Prix</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $sql_facture = $DB->query("SELECT * FROM facture WHERE etat_facture = 0 AND idclient = :idclient", array("idclient" => $client->idclient));
                                                foreach($sql_facture as $facture):
                                                    ?>
                                                    <tr>
                                                        <td><?= $date_format->formatage("d/m/Y", $facture->date_facture); ?></td>
                                                        <td><?= $facture->num_facture; ?></td>
                                                        <td>
                                                            <?php
                                                            switch($facture->etat_facture){
                                                                case 0:
                                                                    echo '<span class="label label-default"><i class="fa fa-pencil"></i> Saisie en cours</span>';
                                                                    break;
                                                                case 1:
                                                                    echo '<span class="label label-warning"><i class="fa fa-spinner fa-spin"></i> En attente de Réglement</span>';
                                                                    break;
                                                                case 2:
                                                                    echo '<span class="label label-warning"><i class="fa fa-money"></i> Partiellement Payer</span>';
                                                                    break;
                                                                case 3:
                                                                    echo '<span class="label label-success"><i class="fa fa-check"></i> Facture Payé</span>';
                                                                    break;
                                                                case 4:
                                                                    echo '<span class="label label-warning"><i class="fa fa-exclamation-triangle"></i> En retard</span>';
                                                                    break;
                                                                case 5:
                                                                    echo '<span class="label label-danger"><i class="fa fa-exclamation-triangle"></i> Contentieux</span>';
                                                                    break;
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?= $fonction->number_decimal($facture->total_facture); ?></td>
                                                        <td><a href=""><i class="fa fa-file-pdf-o"></i></a></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 bg-gray-light">
                                    <h2>Comptabilité</h2>
                                    <div class="well">
                                        <table style="width: 100%;">
                                            <tr>
                                                <td style="font-weight: bold;width: 50%;">Total facturation:</td>
                                                <td class="text-right">
                                                    <?php
                                                    $total_facture = $client_cls->total_facture($client->idclient);
                                                    echo $fonction->number_decimal($total_facture->total_facture);
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: bold;width: 50%;">Total Encaissement:</td>
                                                <td class="text-right">
                                                    <?php
                                                    $total_rglt = $client_cls->total_reglement($client->idclient);
                                                    if($total_rglt->total_reglement == 0){echo "0,00 €";}else{echo $fonction->number_decimal($total_rglt->total_reglement);}
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: bold;width: 50%;">Encours Possible:</td>
                                                <td class="text-right">
                                                    <?= $fonction->number_decimal($info->encours); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <hr>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: bold;width: 50%;">Total Encaissement:</td>
                                                <td class="text-right">
                                                    <?php if($client_cls->total_compta($client->idclient, $info->encours) <= 0): ?>
                                                        <span style="font-weight: bold; color: #FF0000;"><?= $fonction->number_decimal($client_cls->total_compta($client->idclient, $info->encours)); ?></span>
                                                    <?php else: ?>
                                                        <span style="font-weight: bold; color: #00AA00;"><?= $fonction->number_decimal($client_cls->total_compta($client->idclient, $info->encours)); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="communication">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2>Communication</h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="pull-right">
                                        <a class="btn btn-lg bg-success btn-rounded" data-toggle="modal" data-target="#add-courrier"><i class="fa fa-plus"></i> Nouveau Courrier</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="panel">
                                    <div class="panel-header">
                                        <h3>Listing des Correspondances</h3>
                                    </div>
                                    <div class="panel-content">
                                        <div class="table-responsive">
                                            <table class="table dataTable" id="correspondance">
                                                <thead>
                                                <tr>
                                                    <th>Objet</th>
                                                    <th>Expéditeur</th>
                                                    <th>Date d'envoie</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $sql_comm = $DB->query("SELECT * FROM client_communication, users WHERE client_communication.iduser = users.iduser AND client_communication.idclient = :idclient ORDER BY date_expedition ASC", array("idclient" => $client->idclient));
                                                foreach($sql_comm as $comm):
                                                    ?>
                                                    <tr>
                                                        <td><?= html_entity_decode($comm->objet); ?></td>
                                                        <td><?= $comm->nom_user; ?> <?= $comm->prenom_user; ?></td>
                                                        <td><?= $date_format->formatage("d-m-Y à H:i:s", $comm->date_expedition); ?></td>
                                                        <td>
                                                            <a href="<?= $constante->getUrl(array(), false,false); ?>pdf/gestion/communicator.php?idclientmessage=<?= $comm->idclientmessage; ?>" class="btn btn-icon bg-grey"><i class="icon-eye"></i></a>
                                                            <a href="<?= $constante->getUrl(array(), false,false); ?>view/gestion/index.php?view=client&sub=edit-correspondance&idclientmessage=<?= $comm->idclientmessage; ?>" class="btn btn-icon bg-blue"><i class="icon-pencil"></i></a>
                                                            <a href="<?= $constante->getUrl(array(), false,false); ?>controller/gestion/client.ajax.php?action=supp-comm&idclientmessage=<?= $comm->idclientmessage; ?>" class="btn btn-icon bg-red" id="supp-correspondance"><i class="icon-trash"></i></a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add-courrier" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Nouveau Courrier</h4>
                </div>
                <form action="<?= $constante->getUrl(array(), false,false); ?>controller/gestion/client.php" method="POST" class="form-horizontal">
                    <div class="modal-body">
                        <input type="hidden" name="iduser" value="<?= $user->iduser; ?>" />
                        <input type="hidden" name="idclient" value="<?= $client->idclient ?>" />
                        <div class="form-group">
                            <label class="control-label col-md-3">Sujet:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="sujet">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Message:</label>
                            <div class="col-md-9">
                                <textarea name="message" cols="80" rows="10" class="cke-editor"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-3 col-md-offset-9">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-success" name="action" value="add_courrier">Valider</button>
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
<script src="<?= $constante->getUrl(array('plugins/')); ?>custom/js/pages/gestion/client.js"></script>
