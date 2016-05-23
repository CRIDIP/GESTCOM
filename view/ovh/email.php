<?php if(!isset($_GET['sub'])){ ?>
    <?php
    $email = $ovh->get("/email/domain");
    $email_exchange = $ovh->get("/email/exchange");
    ?>
    <div class="alert alert-info">
        <i class="fa fa-info"></i> <strong>Information !</strong> Les modification apporter sont lié au domaine et à l'hebergement qui lui est associé.<br>Vérifier que le domaine est bien associé à un hebergement avant de faire toute modification.
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h1><i class="ovh-web" style="font-size: 25px;"></i> EMAIL</h1>
                </div>
            </div>
        </div>
    </div>
    <?php if($email == null): ?>
        <div class="row">
            <div class="col-md-12">
                <h2 class="alert bg-info"><strong><i class="fa fa-info"></i> Information !</strong> Aucun domaine pour le compte</h2>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-header md-panel-controls">
                        <h3>Liste de vos <strong>Email</strong></h3>
                    </div>
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-md-4">
                                <ul class="nav">
                                    <?php foreach ($email as $em): ?>
                                        <li><a href="<?= $constante->getUrl(array(), false, false); ?>controller/ovh/email.ajax.php?action=view_email&dm=<?= $em; ?>" id="ajax_cross"><i class="fa fa-circle"></i> <?= $em; ?></a></li>
                                    <?php endforeach; ?>
                                    <?php foreach ($email_exchange as $emex): ?>
                                        <li><a href="<?= $constante->getUrl(array(), false, false); ?>controller/ovh/email.ajax.php?action=view_email&dmex=<?= $emex; ?>" id="ajax_cross"><i class="fa fa-circle"></i> <?= $emex; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="col-md-8">
                                <div id="ajax_email"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php } ?>
<?php if(isset($_GET['sub']) && $_GET['sub'] == 'edit_account'): ?>
    <?php
    $account = $_GET['account'];
    $domain = $_GET['domain'];
    $data_account = $ovh->get("/email/domain/".$domain."/account/".$account);
    ?>

    <pre><?php var_dump($data_account); ?></pre>
    <div class="header">
        <h2>Editer les Informations du compte Email</h2>
        <?= $insert->breadcumb("OVH", "MAIL", "Editer le compte"); ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-header">
                    <h3>Edition du compte: <strong><?= $account; ?></strong></h3>
                </div>
                <form class="form-horizontal" action="<?= $constante->getUrl(array(), false, false); ?>controller/ovh/email.php" method="post">
                    <div class="panel-content">
                        <input type="hidden" name="domain" value="<?= $domain; ?>" />
                        <input type="hidden" name="accountName" value="<?= $account; ?>" />
                        <div class="form-group">
                            <label class="control-label col-md-3">Description</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="description_input" maxlength="100" name="description" value="<?= html_entity_decode($data_account['description']); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Taille de la boite</label>
                            <div class="col-md-5">
                                <input type="text" value="<?= $number->convertisseur_binaire('mo', $data_account['size']); ?>" data-step="1" data-max="100" class="numeric-stepper form-control" name="size"/>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer bg-dark">
                        <button type="submit" class="btn btn-success" name="action" value="edit-email-account">Valider <i class="fa fa-arrow-circle-o-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(isset($_GET['sub']) && $_GET['sub'] == 'edit_pass_account'): ?>
    <?php
    $account = $_GET['account'];
    $domain = $_GET['domain'];
    $data_account = $ovh->get("/email/domain/".$domain."/account/".$account);
    ?>
    <pre><?php var_dump($data_account); ?></pre>
    <div class="header">
        <h2>Editer le mot de passe</h2>
        <?= $insert->breadcumb("OVH", "MAIL", "Editer le mot de passe"); ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-header"><h3>Edition du mot de passe du compte: <strong><?= $account; ?></strong></h3></div>
                <form class="form-horizontal" id="edit-password-email" action="<?= $constante->getUrl(array(), false, false); ?>controller/ovh/email.php" method="POST">
                    <div class="panel-content">
                        <input type="hidden" name="accountName" value="<?= $account; ?>">
                        <input type="hidden" name="domain" value="<?= $domain; ?>">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nouveau Mot de Passe</label>
                            <div class="col-md-7 append-icon">
                                <input type="password" name="new_password" id="password" class="form-control" placeholder="Entre 9 et 30 caractères Alphanumérique sans espace et accent" minlength="9" maxlength="30" required>
                                <i class="icon-lock"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Confirmer le nouveau mot de passe</label>
                            <div class="append-icon col-md-7">
                                <input type="password" name="comfirm_password" id="password2" class="form-control" placeholder="Doit être égal au mot de passe taper ci-dessus..." minlength="9" maxlength="30" required>
                                <i class="icon-lock"></i>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer bg-dark">
                        <button type="submit" class="btn btn-success" name="action" value="edit-pass-account">Valider <i class="fa fa-arrow-circle-o-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
<script src="<?= $constante->getUrl(array('plugins/')); ?>bootstrap-maxlength/bootstrap-maxlength.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>jquery-validation/jquery.validate.js"></script> <!-- Form Validation -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>jquery-validation/additional-methods.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>custom/js/pages/ovh/email.js"></script>
