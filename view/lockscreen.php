<!DOCTYPE html>
<html>
<head>
    <!-- BEGIN META SECTION -->
    <meta charset="utf-8">
    <title><?= \App\constante::NOM_SITE; ?> - Verrouillage du système</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="" name="description" />
    <meta content="themes-lab" name="author" />
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <!-- END META SECTION -->
    <!-- BEGIN MANDATORY STYLE -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/ui.css" rel="stylesheet">
    <link href="assets/plugins/bootstrap-loading/lada.min.css" rel="stylesheet">
    <!-- END  MANDATORY STYLE -->
</head>
<body class="account" data-page="lockscreen">
<!-- BEGIN LOGIN BOX -->
<div class="container" id="lockscreen-block">
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <div class="account-wall">
                <div class="user-image">
                    <img src="assets/images/profil_page/friend8.jpg" class="img-responsive img-circle" alt="friend 8">
                    <div id="loader"></div>
                    <div id="probleme" style="position: relative; left: 150px;"></div>
                </div>
                <form class="form-signin" action="controller/user.php" role="form" method="post">
                    <h2>Vous êtes de retour, <strong><?= $_SESSION['account']['away']['prenom_user']; ?></strong> ?</h2>
                    <p>Entrez votre Mot de Passe afin d'accedez au interface.</p>
                    <input type="hidden" name="username" value="<?= $_SESSION['account']['away']['username']; ?>">
                    <div class="input-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Mot de Passe">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary" name="action" value="deverrouille">Connexion</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="loader-overlay loaded">
    <div class="loader-inner">
        <div class="loader2"></div>
    </div>
</div>
<script src="assets/plugins/jquery/jquery-1.11.1.min.js"></script>
<script src="assets/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
<script src="assets/plugins/gsap/main-gsap.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/plugins/backstretch/backstretch.min.js"></script>
<script src="assets/plugins/bootstrap-loading/lada.min.js"></script>
<script src="assets/plugins/progressbar/progressbar.min.js"></script>
<script src="assets/js/pages/lockscreen.js"></script>
<!-- BEGIN PAGE SCRIPT -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>toastr/toastr.js"></script>
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
