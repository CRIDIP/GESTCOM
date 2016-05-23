<div class="col-lg-10 col-md-9">
    <div class="row profil-header" >
        <div class="col-lg-12 col-md-12">
            <div class="row">
                <div class="col-xs-4 profil-img">
                    <img src="<?= $constante->getUrl(array(), false, true); ?>avatar/<?= $user->username; ?>.png" alt="profil">
                </div>
                <div class="col-xs-8 p-l-0 col-map">
                    <div class="map" id="profil-map"></div>
                </div>
            </div>
            <div class="row header-name">
                <div class="col-xs-12">
                    <div class="name"><?= $user->nom_user; ?> <?= $user->prenom_user; ?>
                        <?php if($user->connect == 0): ?>
                            <i class="fa fa-circle text-danger"></i>
                        <?php elseif($user->connect == 1): ?>
                            <i class="fa fa-circle text-warning"></i>
                        <?php else: ?>
                            <i class="fa fa-circle text-success"></i>
                        <?php endif; ?>
                    </div>
                    <div class="profil-info"><i class="icon-present"></i><?= $date_format->formatage_long($user->date_naissance); ?></div>
                    <div class="profil-info"><i class="icon-call-end"></i><?= $user->num_tel_poste; ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="profil-content">
        <div class="row">
            <div class="col-md-12 portlets">
                <div class="panel">
                    <div class="panel-content">
                        <ul class="nav nav-tabs nav-primary">
                            <li class="active"><a href="#mytimeline" data-toggle="tab"><i class="fa fa-clock-o"></i> Ma TimeLine</a></li>
                            <li><a href="#info" data-toggle="tab"><i class="fa fa-user"></i> Changer mes informations</a></li>
                            <li><a href="#password" data-toggle="tab"><i class="fa fa-key"></i> Changer mon mot de passe</a></li>
                            <li><a href="#plugins" data-toggle="tab"><i class="fa fa-cogs"></i> Plugins</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="mytimeline">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="timeline-btn-day"> <i class="icon-custom-left"></i>
                                            <button type="button" class="btn btn-primary f-16"><strong>TimeLine</strong></button>
                                        </div>
                                        <section id="timeline">
                                            <?php
                                            $sql_notif = $DB->query("SELECT * FROM notif WHERE iduser = :iduser ORDER BY date_notification ASC LIMIT 10", array("iduser" => $user->iduser));
                                            foreach($sql_notif as $notif):
                                            ?>
                                            <div class="timeline-block">
                                                <div class="timeline-icon bg-primary">
                                                    <i class="icon-picture"></i>
                                                </div>
                                                <?php if($notif->type == 1): ?>
                                                    <div class="timeline-icon bg-success">
                                                        <i class="fa fa-plus-circle"></i>
                                                    </div>
                                                <?php elseif($notif->type == 2): ?>
                                                    <div class="timeline-icon bg-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="timeline-icon bg-danger">
                                                        <i class="fa fa-times-circle"></i>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="timeline-content">
                                                    <div class="timeline-heading clearfix">
                                                        <h2 class="pull-left"><?= html_entity_decode($notif->notification); ?></h2>
                                                        <div class="pull-right">
                                                            <div class="pull-left">
                                                                <div class="timeline-day-number"><?= date("d", $notif->date_notification); ?></div>
                                                            </div>
                                                            <div class="pull-left">
                                                                <div class="timeline-day"><?= $date_format->formatage_sequenciel("d", $notif->date_notification); ?></div>
                                                                <div class="timeline-month c-gray"><?= $date_format->formatage_sequenciel("m", $notif->date_notification) ?> <?= date("Y", $notif->date_notification); ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </section>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="info">
                                <form id="edit-profil" action="controller/user.php" method="post" role="form">
                                    <div class="form-group">
                                        <label class="control-label" for="nom_user">Votre nom</label>
                                        <input id="nom_user" type="text" name="nom_user" class="form-control" value="<?= $user->nom_user; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="prenom_user">Votre Prénom</label>
                                        <input id="prenom_user" type="text" name="prenom_user" class="form-control" value="<?= $user->prenom_user; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="poste_user">Votre poste</label>
                                        <input id="poste_user" type="text" name="poste_user" class="form-control" value="<?= $user->poste_user; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Votre date de naissance</label>
                                        <div class="prepend-icon">
                                            <input type="text" name="date_naissance" class="b-datepicker form-control" value="<?= $date_format->formatage("d-m-Y", $user->date_naissance); ?>">
                                            <i class="icon-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="num_tel_poste">Votre Numéro de Poste</label>
                                        <input id="num_tel_poste" data-mask="+0033999999999" type="text" name="num_tel_poste" class="form-control" value="<?= $user->num_tel_poste; ?>">
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success btn-embossed" name="action" value="edit-profil"><i class="fa fa-check"></i> Valider</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="password">
                                <form class="form-horizontal" action="controller/user.php" method="post" role="form">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="user">Mot de passe Actuel</label>
                                        <div class="col-md-9">
                                            <input id="user" type="password" name="actual_password" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="user">Nouveau Mot de Passe</label>
                                        <div class="col-md-9">
                                            <input id="user" type="password" name="new_password" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="user">Confirmer Le nouveau mot de passe</label>
                                        <div class="col-md-9">
                                            <input id="user" type="password" name="confirm_new_password" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-9 col-sm-offset-3">
                                            <div class="pull-right">
                                                <button type="submit" class="btn btn-success" name="action" value="edit-password">Modifier le mot de passe</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="plugins">
                                <div class="row">
                                    <div class="col-md-12 table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Module</th>
                                                    <th>Etat</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Authentification double facteur (TOTP)</td>
                                                    <?php if($user->totp == 0): ?>
                                                    <td><span class="label label-danger">Désactiver</span></td>
                                                    <td><a data-toggle="modal" data-target="#active-totp" class="btn btn-primary">Activer</a></td>
                                                    <?php else: ?>
                                                    <td><span class="label label-success">Activer</span></td>
                                                    <td><a href="controller/user.php?action=desactive_totp" class="btn btn-primary">Désactiver</a></td>
                                                    <?php endif; ?>

                                                </tr>
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
<div class="col-lg-2 col-md-3 hidden-sm hidden-xs profil-right">
    <div class="profil-sidebar-element">
        <h3><strong>A Propos de moi</strong></h3>
        <?= html_entity_decode($user->commentaire); ?>
    </div>
    <div class="profil-sidebar-element m-t-20">
        <h3><strong>Statistique Personnel</strong></h3>
        <?php if($user->connect == 0): ?>
        <p class="c-gray m-t-0"><i>Dernière Connexion: <?= $date_format->format(date("d-m-Y H:i:s", $user->last_connect)); ?></i></p>
        <?php elseif($user->connect == 1): ?>
        <p class="c-gray m-t-0"><i class="away"></i> Absent</p>
        <?php else: ?>
        <p class="c-gray m-t-0"><i class="online"></i> En Ligne</p>
        <?php endif; ?>
    </div>
    <div class="m-t-60" style="width:100%">
        <canvas id="profil-chart" height="450"></canvas>
    </div>
</div>
<div class="footer">
    <div class="copyright">
        <p class="pull-left sm-pull-reset">
            <span>Copyright <span class="copyright">©</span> 2015 </span>
            <span>THEMES LAB</span>.
            <span>All rights reserved. </span>
        </p>
        <p class="pull-right sm-pull-reset">
            <span><a href="#" class="m-r-10">Support</a> | <a href="#" class="m-l-10 m-r-10">Terms of use</a> | <a href="#" class="m-l-10">Privacy Policy</a></span>
        </p>
    </div>
</div>
<div class="modal fade" id="active-totp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                <h4 class="modal-title">Activation du TOTP</h4>
            </div>
            <form class="form-horizontal" action="controller/user.php" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Veuillez scanner le QR CODE:</p>
                            <div class="text-center">
                                <img src="<?= $user_cls->totp(); ?>" alt="TOTP" class="img-responsive"/>
                            </div>
                        </div>
                        <div class="col-md-6" style="border-left: solid 1px #6E6E6E">
                            <p>Veuillez suivre la procédure afin d'accéder à l'autentification à double facteur.</p>
                            <div class="well">
                                <p>
                                    1. Télécharger l'application <strong>Google Authentificator</strong> sur Play store (Android), App Store (Apple) ou Windows Store (Windows Phone).<br>
                                    2. Scanner le <strong>QRcode</strong> à gauche.<br>
                                    3. Saisisser le code reçu dans le champ suivant:
                                </p>
                            </div>
                            <div class="form-group">
                                <label for="totp" class="col-md-3 control-label">Code:</label>
                                <div class="col-md-9">
                                    <input type="text" id="totp" class="form-control" name="code">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-3">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-success" name="action" value="active_totp">Activer l'authentificateur</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- BEGIN PAGE SCRIPT -->
<script src="assets/plugins/gsap/main-gsap.min.js"></script> <!-- HTML Animations -->
<script src="assets/plugins/slick/slick.min.js"></script> <!-- Slider -->
<script src="assets/plugins/countup/countUp.min.js"></script> <!-- Animated Counter Number -->
<script src="assets/plugins/autosize/autosize.min.js"></script> <!-- Textarea autoresize -->
<script src="//maps.google.com/maps/api/js?sensor=true"></script> <!-- Google Maps -->
<script src="assets/plugins/google-maps/gmaps.min.js"></script>  <!-- Google Maps Easy -->
<script src="assets/js/pages/profil.js"></script>

<script src="assets/plugins/custom/js/pages/profil.js"></script>
<script src="assets/plugins/jquery-validation/jquery.validate.js"></script> <!-- Form Validation -->
<script src="assets/plugins/jquery-validation/additional-methods.min.js"></script> <!-- Form Validation Additional Methods - OPTIONAL -->

<script src="assets/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script> <!-- A mobile and touch friendly input spinner component for Bootstrap -->
<script src="assets/plugins/timepicker/jquery-ui-timepicker-addon.min.js"></script> <!-- Time Picker -->
<script src="assets/plugins/multidatepicker/multidatespicker.min.js"></script> <!-- Multi dates Picker -->
<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> <!-- >Bootstrap Date Picker -->
<script src="assets/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.fr.min.js"></script> <!-- >Bootstrap Date Picker in Spanish (can be removed if not use) -->
<script src="assets/plugins/colorpicker/spectrum.min.js"></script> <!-- Color Picker -->
<script src="assets/plugins/rateit/jquery.rateit.min.js"></script> <!-- Rating star plugin -->
<script src="assets/js/pages/form_plugins.js"></script>

<script src="assets/plugins/bootstrap/js/jasny-bootstrap.min.js"></script>
<!-- END PAGE SCRIPT -->