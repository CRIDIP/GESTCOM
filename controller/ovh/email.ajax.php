<?php
function is_ajax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
if(is_ajax()){
    if(isset($_GET['action']) && $_GET['action'] == 'view_email'){
        require "../../application/classe.php";
        if(isset($_GET['dm'])){
            $dm = $_GET['dm'];

            $email = $ovh->get("/email/domain/".$dm);
            $service = $ovh->get("/email/domain/".$dm."/serviceInfos");
            $quota = $ovh->get("/email/domain/".$dm."/quota");
            $account = $ovh->get("/email/domain/".$dm."/account");
        }

        if(isset($_GET['dmex'])){
            $dm = $_GET['dmex'];

            $email = $ovh->get("/email/exchange/".$dm."/service");

        }
        ob_start();
        ?>
        <div class="row">
            <div class="col-md-12">
                <?php if(isset($_GET['dm'])): ?>
                    <div class="panel">
                        <div class="panel-header">
                            <h3><?= $dm; ?></h3>
                        </div>
                        <div class="panel-content">
                            <table style="width: 100%;">
                                <tbody>
                                    <tr>
                                        <td style="width: 50%;font-weight: bold;">Domaine</td>
                                        <td style="width: 50%;"><?= $service['domain']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;font-weight: bold;">Date de Création</td>
                                        <td style="width: 50%;">
                                            <?php
                                            $date_str = $date_format->format_strt($service['creation']);
                                            echo $date_format->formatage("d-m-Y", $date_str);
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;font-weight: bold;">Date d'Expiration</td>
                                        <td style="width: 50%;">
                                            <?php
                                            $date_str = $date_format->format_strt($service['expiration']);
                                            echo $date_format->formatage("d-m-Y", $date_str);
                                            if($date_str <= $date_format->date_jour_strt()){
                                                echo "&nbsp;<span class='label label-danger'>Expirer</span>";
                                            }else{
                                                echo "&nbsp; Il reste ".$date_format->reste($date_str)." Jours !";
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="panel">
                                <div class="panel-header">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <h3>Liste des Comptes Email: <strong><?= $dm; ?></strong></h3>
                                        </div>
                                        <div class="col-md-5">
                                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add-email-account"><i class="fa fa-plus-circle"></i> Ajouter un compte E-Mail</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-content">
                                    <table class="table table-bordered" id="compte_email">
                                        <thead>
                                            <tr>
                                                <th>Compte</th>
                                                <th>Quota</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($account as $ac): ?>
                                            <?php
                                            $info = $ovh->get("/email/domain/".$dm."/account/".$ac);
                                            ?>
                                            <tr>
                                                <td>
                                                    <strong><?= $info['email']; ?></strong><br>
                                                    <i><?= html_entity_decode($info['description']); ?></i>
                                                </td>
                                                <td><?= $number->convertisseur_binaire("mo", $info['size']); ?> Mo</td>
                                                <td>
                                                    <button rel="tooltip" data-toggle="tooltip" data-placement="top" title="Editer le compte" class="btn btn-xs btn-primary btn-rounded btn-icon" onclick="window.location='index.php?view=email&sub=edit_account&account=<?= $ac; ?>&domain=<?= $dm; ?>'"><i class="icon-pencil"></i></button>
                                                    <button rel="tooltip" data-toggle="tooltip" data-placement="top" title="Editer le mot de passe" class="btn btn-xs btn-warning btn-rounded btn-icon" onclick="window.location='index.php?view=email&sub=edit_pass_account&account=<?= $ac; ?>&domain=<?= $dm; ?>'"><i class="icon-key"></i></button>
                                                    <a rel="tooltip" data-toggle="tooltip" data-placement="top" title="Supprimer le compte" class="btn btn-xs btn-danger btn-rounded btn-icon" id="supp-email-account" href="<?= $constante->getUrl(array(), false, false); ?>controller/ovh/email.ajax.php?action=supp-email-account&accountName=<?= $ac; ?>&domain=<?= $dm; ?>"><i class="icon-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="add-email-account" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                                    <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Ajouter une nouvelle adresse Mail</h4>
                                </div>
                                <form class="form-horizontal" id="add-email-form" action="<?= $constante->getUrl(array(), false, false); ?>controller/ovh/email.php" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="domain" value="<?= $dm; ?>">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Nom d'utilisateur</label>
                                            <div class="col-md-9 prepend-icon">
                                                <input type="text" name="accountName" class="form-control" required>
                                                <i class="icon-user"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Description</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="description_input" maxlength="100" name="description" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Mot de Passe</label>
                                            <div class="col-md-7 prepend-icon">
                                                <input type="password" name="new_password" id="password" class="form-control" placeholder="Entre 9 et 30 caractères Alphanumérique sans espace et accent" minlength="9" maxlength="30" required>
                                                <i class="icon-lock"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Confirmer le mot de passe</label>
                                            <div class="prepend-icon col-md-7">
                                                <input type="password" name="comfirm_password" id="password2" class="form-control" placeholder="Doit être égal au mot de passe taper ci-dessus..." minlength="9" maxlength="30" required>
                                                <i class="icon-lock"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Taille de la boite</label>
                                            <div class="col-md-5">
                                                <input type="text" data-step="1" data-max="100" class="numeric-stepper form-control" name="size"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-info">
                                        <button type="submit" class="btn btn-primary btn-embossed" name="action" value="add-email-account">Créer le compte <i class="fa fa-arrow-circle-right"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(isset($_GET['dmex'])): ?>
                    <div class="panel">
                        <div class="panel-header">
                            <h3><?= $dm; ?></h3>
                        </div>
                        <div class="panel-content">
                            <table style="width: 100%;">
                                <tbody>
                                <tr>
                                    <td>Domaine</td>
                                    <td><?= $service['domain']; ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
        $json_html = ob_get_clean();
        echo json_encode($json_html);
    }
    if(isset($_GET['action']) && $_GET['action'] == 'supp-email-account'){
        require "../../application/classe.php";
        $accountName = $_GET['accountName'];
        $domain = $_GET['domain'];

        $ovh_del = $ovh->delete("/email/domain/".$domain."/account/".$accountName);

        if($ovh_del){echo json_encode(200);}else{echo json_encode(300);}
    }
}