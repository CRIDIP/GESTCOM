<?php
use App\general\constante;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= constante::NOM_SITE; ?> - Connexion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="" name="description" />
    <meta content="themes-lab" name="author" />
    <link rel="shortcut icon" href="<?= $constante->getUrl(array('img/')); ?>favicon.png">
    <link href="<?= $constante->getUrl(array('css/')); ?>style.css" rel="stylesheet">
    <link href="<?= $constante->getUrl(array('css/')); ?>theme.css" rel="stylesheet">
    <link href="<?= $constante->getUrl(array('css/')); ?>ui.css" rel="stylesheet">
    <link href="<?= $constante->getUrl(array('plugins/')); ?>input-text/style.min.css" rel="stylesheet">
    <link href="<?= $constante->getUrl(array('plugins/')); ?>bootstrap-loading/lada.min.css" rel="stylesheet">
</head>
<body class="account2" data-page="login">
<!-- BEGIN LOGIN BOX -->
<?php if(!isset($_GET['sub'])): ?>
    <div class="container" id="login-block">
        <i class="user-img icons-faces-users-03"></i>
        <div class="account-info">
            <a href="" class="logo"></a>
            <h3>Système d'administration de la SAS CRIDIP</h3>
            <ul>
                <li><i class="icon-circle"></i> Gestion Commercial</li>
                <li><i class="icon-circle"></i> Gestion Comptable</li>
                <li><i class="icon-circle"></i> Panel OVH</li>
                <li><i class="icon-circle"></i> Gestionnaire de projet</li>
            </ul>
        </div>
        <div class="account-form">
            <form class="form-signin" role="form" action="controller/user.php" method="post">
                <h3><strong>Connectez-vous</strong> à votre compte</h3>
                <div class="append-icon">
                    <input type="text" name="username" id="name" class="form-control form-white username" placeholder="Nom d'utilisateur" required>
                    <i class="icon-user"></i>
                </div>
                <div class="append-icon m-b-20">
                    <input type="password" name="password" class="form-control form-white password" placeholder="Mot de Passe" required>
                    <i class="icon-lock"></i>
                </div>
                <div class="form-group">
                    <label><input type="checkbox" data-checkbox="icheckbox_minimal-blue" name="remember"> Se souvenir de moi</label>
                </div>
                <button type="submit" id="submit-form" class="btn btn-lg btn-dark btn-rounded ladda-button" data-style="expand-left" name="action" value="login">Connexion</button>
            </form>
        </div>
    </div>
<?php endif; ?>
<?php if(isset($_GET['sub']) && $_GET['sub'] == 'totp'): ?>
    <div class="container" id="login-block">
        <i class="user-img icons-faces-users-03"></i>
        <div class="account-info">
            <a href="" class="logo"></a>
            <h3>Système d'administration de la SAS CRIDIP</h3>
            <ul>
                <li><i class="icon-circle"></i> Gestion Commercial</li>
                <li><i class="icon-circle"></i> Gestion Comptable</li>
                <li><i class="icon-circle"></i> Panel OVH</li>
                <li><i class="icon-circle"></i> Gestionnaire de projet</li>
            </ul>
        </div>
        <div class="account-form">
            <form class="form-signin" role="form" action="controller/user.php" method="post">
                <h3>Connexion <strong>TOTP</strong></h3>
                <p>Ce compte est dépositaire d'un TOKEN TOTP (Authentificateur 2 Facteur), <br>Veuillez saisir le code obtenue grace à l'authentificateur</p>
                <div class="append-icon">
                    <input type="text" name="code" autocomplete="off" id="name" class="form-control form-white username" placeholder="Code de l'authentificateur" required>
                    <i class="icon-key"></i>
                </div>
                <button type="submit" id="submit-form" class="btn btn-lg btn-dark btn-rounded ladda-button" data-style="expand-left" name="action" value="login_totp">Connexion</button>
            </form>
        </div>
    </div>
<?php endif; ?>

<!-- END LOCKSCREEN BOX -->
<p class="account-copyright">
    <span>Copyright © 2015 </span><span>SAS CRIDIP</span>.<span>Tous droit réserver.</span>
</p>
<script src="<?= $constante->getUrl(array('plugins/')); ?>jquery/jquery-1.11.1.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>jquery/jquery-migrate-1.2.1.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>gsap/main-gsap.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>backstretch/backstretch.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>bootstrap-loading/lada.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>icheck/icheck.min.js"></script>
<script src="<?= $constante->getUrl(array('js/')); ?>pages/login-v2.js"></script>
<!-- BEGIN PAGE SCRIPT -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>toastr/toastr.js"></script>
<script src="<?= $constante->getUrl(array('js/')); ?>pages/form_icheck.js"></script>
<!-- END PAGE SCRIPT -->
<?php if(isset($_GET['warning']) && $_GET['warning'] == $_GET['warning']){ ?>
    <script type="text/javascript">
        $(document).ready(function(){
            toastr.warning("<?= $_GET['text']; ?>", "ATTENTION", {
                positionClass: "toast-top-full-width",
                showDuration: 1000,
                hideDuration: 1000,
                timeOut: 50000,
                closeButton: true
            });
        });
    </script>
<?php } ?>
<?php if(isset($_GET['error']) && $_GET['error'] == $_GET['error']){ ?>
    <script type="text/javascript">
        $(document).ready(function(){
            toastr.error("<?= $_GET['text']; ?>", "ERREUR", {
                positionClass: "toast-top-full-width",
                showDuration: 1000,
                hideDuration: 1000,
                timeOut: 50000,
                closeButton: true
            });
        });
    </script>
<?php } ?>
</body>
</html>

