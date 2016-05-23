<?php
use App\general\constante;

ini_set("display_errors", 1);
if(!isset($_SESSION['account']['active']) && $_SESSION['account']['active'] == 0)
{
    $text = "Vous avez été déconnecter du service.";
    $fonction->redirect("login");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="admin-themes-lab">
    <meta name="author" content="themes-lab">
    <link rel="shortcut icon" href="<?= $constante->getUrl(array('images/')); ?>favicon.png" type="image/png">
    <title><?= constante::NOM_SITE; ?></title>
    <link href="<?= $constante->getUrl(array('css/')); ?>style.css" rel="stylesheet">
    <link href="<?= $constante->getUrl(array('css/')); ?>theme.css" rel="stylesheet">
    <link href="<?= $constante->getUrl(array('css/')); ?>ui.css" rel="stylesheet">
    <script src="<?= $constante->getUrl(array('plugins', 'modernizr/')); ?>modernizr-2.6.2-respond-1.1.0.min.js"></script>

    <!-- SCRIPT JS -->
    <script src="<?= $constante->getUrl(array('plugins/')); ?>jquery/jquery-1.11.1.min.js"></script>
    <script src="<?= $constante->getUrl(array('plugins/')); ?>jquery/jquery-migrate-1.2.1.min.js"></script>
    <script src="<?= $constante->getUrl(array('plugins/')); ?>jquery-ui/jquery-ui-1.11.2.min.js"></script>

    <!-- AUTRE CSS -->
    <link href="<?= $constante->getUrl(array('plugins/')); ?>bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link href="<?= $constante->getUrl(array('plugins/')); ?>fullcalendar/fullcalendar.min.css" rel="stylesheet">
    <link href="<?= $constante->getUrl(array('plugins/')); ?>datatables/dataTables.min.css" rel="stylesheet">
    <link href="<?= $constante->getUrl(array('plugins/')); ?>dropzone/dropzone.min.css" rel="stylesheet">
    <link href="<?= $constante->getUrl(array('plugins/')); ?>input-text/style.min.css" rel="stylesheet">
    <link href="<?= $constante->getUrl(array('plugins/')); ?>summernote/summernote.min.css" rel="stylesheet">
    <style type="text/css">
        .cke_dialog
        {
            z-index: 10055 !important;
        }
    </style>
    <!--<script type="text/javascript">
        $.fn.modal.Constructor.prototype.enforceFocus = function () {
            var $modalElement = this.$element;
            $(document).on('focusin.modal', function (e) {
                var $parent = $(e.target.parentNode);
                if ($modalElement[0] !== e.target && !$modalElement.has(e.target).length
                        // add whatever conditions you need here:
                    &&
                    !$parent.hasClass('cke_dialog_ui_input_select') && !$parent.hasClass('cke_dialog_ui_input_text')) {
                    $modalElement.focus()
                }
            })
        };
    </script>-->
</head>
<!-- LAYOUT: Apply "submenu-hover" class to body element to have sidebar submenu show on mouse hover -->
<!-- LAYOUT: Apply "sidebar-collapsed" class to body element to have collapsed sidebar -->
<!-- LAYOUT: Apply "sidebar-top" class to body element to have sidebar on top of the page -->
<!-- LAYOUT: Apply "sidebar-hover" class to body element to show sidebar only when your mouse is on left / right corner -->
<!-- LAYOUT: Apply "submenu-hover" class to body element to show sidebar submenu on mouse hover -->
<!-- LAYOUT: Apply "fixed-sidebar" class to body to have fixed sidebar -->
<!-- LAYOUT: Apply "fixed-topbar" class to body to have fixed topbar -->
<!-- LAYOUT: Apply "rtl" class to body to put the sidebar on the right side -->
<!-- LAYOUT: Apply "boxed" class to body to have your page with 1200px max width -->

<!-- THEME STYLE: Apply "theme-sdtl" for Sidebar Dark / Topbar Light -->
<!-- THEME STYLE: Apply  "theme sdtd" for Sidebar Dark / Topbar Dark -->
<!-- THEME STYLE: Apply "theme sltd" for Sidebar Light / Topbar Dark -->
<!-- THEME STYLE: Apply "theme sltl" for Sidebar Light / Topbar Light -->

<!-- THEME COLOR: Apply "color-default" for dark color: #2B2E33 -->
<!-- THEME COLOR: Apply "color-primary" for primary color: #319DB5 -->
<!-- THEME COLOR: Apply "color-red" for red color: #C9625F -->
<!-- THEME COLOR: Apply "color-green" for green color: #18A689 -->
<!-- THEME COLOR: Apply "color-orange" for orange color: #B66D39 -->
<!-- THEME COLOR: Apply "color-purple" for purple color: #6E62B5 -->
<!-- THEME COLOR: Apply "color-blue" for blue color: #4A89DC -->
<!-- BEGIN BODY -->
<body class="fixed-topbar fixed-sidebar theme-sdtl color-blue">
<section>
    <!-- BEGIN SIDEBAR -->
    <div class="sidebar">
        <div class="logopanel">
            <h1>
                <a href="<?= $constante->getUrl(array(), false); ?>index.php?view=dashboard"></a>
            </h1>
        </div>
        <div class="sidebar-inner">
            <div class="sidebar-top">
                <div class="userlogged clearfix">
                    <i class="icon icons-faces-users-01"></i>
                    <div class="user-details">
                        <h4><?= $user->nom_user; ?> <?= $user->prenom_user; ?></h4>
                        <div class="dropdown user-login">
                            <button class="btn btn-xs dropdown-toggle btn-rounded" type="button" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" data-delay="300">
                                <?php if($user->connect == 0): ?>
                                    <span id="stap"><i class="busy"></i><span>Hors Ligne</span><i class="fa fa-angle-down"></i></span>
                                <?php else: ?>
                                    <span id="stap"><i class="online"></i><span>En Ligne</span><i class="fa fa-angle-down"></i></span>
                                <?php endif; ?>
                            </button>
                            <ul class="dropdown-menu">
                                <?php if($user->connect == 0): ?>
                                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>controller/user.ajax.php?action=connector&connect=2" id="connector"><i class="online"></i><span>En Ligne</span></a></li>
                                <?php else: ?>
                                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>controller/user.ajax.php?action=connector&connect=0" id="connector"><i class="busy"></i><span>Hors Ligne</span></a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(isset($_GET['view']) && $_GET['view'] == 'mailbox'): ?>
                    <ul class="nav nav-sidebar">
                        <li class="tm nav-active active">
                            <a href="<?= $constante->getUrl(array(), false, false); ?>index.php?view=mailbox">
                                <span class="pull-right badge badge-primary"></span>
                                <i class="icons-office-28"></i>
                                <span data-translate="inbpx">Boite de réception</span>
                            </a>
                        </li>
                        <li class="tm">
                            <a href="<?= $constante->getUrl(array(), false, false); ?>index.php?view=mailbox&sub=sentbox">
                                <i class="icons-chat-messages-14"></i>
                                <span data-translate="portlets">Boite d'envoie </span>
                            </a>
                        </li>
                    </ul>

                    <!--<div class="sidebar-charts">
                        <div id="chart-legend"></div>
                        <div id="morris-chart-network" class="morris-full-content"></div>
                    </div>-->
            <?php endif; ?>
            <?php if($_SESSION['lieu'] == 'gestion'): ?>
                <div class="menu-title">
                    Gestion
                </div>
                <ul class="nav nav-sidebar">
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/gestion/index.php?view=dashboard"><i class="fa fa-home"></i> Accueil</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/gestion/index.php?view=client"><i class="fa fa-users"></i> Client</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/gestion/index.php?view=article"><i class="fa fa-cubes"></i> Articles & Services</a></li>
                    <li class="nav-parent">
                        <a href="#"><i class="fa fa-file-pdf-o"></i> Ventes <span class="fa arrow"></span></a>
                        <ul class="children collapse">
                            <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/gestion/index.php?view=devis">Devis</a></li>
                            <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/gestion/index.php?view=commande">Commande</a></li>
                            <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/gestion/index.php?view=facture">Facture</a></li>
                            <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/gestion/index.php?view=avoir">Avoir</a></li>
                        </ul>
                    </li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/gestion/index.php?view=service"><i class="fa fa-file"></i> Services</a></li>
                </ul>
            <?php endif; ?>
            <?php if($_SESSION['lieu'] == 'compta'): ?>
                <div class="menu-title">
                    Comptabilité
                </div>
                <ul class="nav nav-sidebar">
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/compta/index.php?view=dashboard"><i class="fa fa-home"></i> Accueil</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/compta/index.php?view=journal_vente"><i class="fa fa-euro"></i> Journal de Vente</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/compta/index.php?view=journal_achat"><i class="fa fa-truck"></i> Journal des Achats</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/compta/index.php?view=journal_banque"><i class="fa fa-bank"></i> Journal de Banque</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/compta/index.php?view=situation_client"><i class="fa fa-users"></i> Situation Client</a></li>
                    <li class="nav-parent">
                        <a href="#"><i class="fa fa-file-pdf-o"></i> Etats <span class="fa arrow"></span></a>
                        <ul class="children collapse">
                            <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/compta/index.php?view=etat_balance">Balance</a></li>
                            <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/compta/index.php?view=etat_bilan">Bilan</a></li>
                            <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/compta/index.php?view=etat_resultat">Compte de Résultat</a></li>
                        </ul>
                    </li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/compta/index.php?view=compte"><i class="fa fa-cogs"></i> Plan Comptable</a></li>
                </ul>
            <?php endif; ?>
            <?php if($_SESSION['lieu'] == 'ovh'): ?>
                <div class="menu-title">
                    OVH
                </div>
                <ul class="nav nav-sidebar">
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/ovh/index.php?view=dashboard"><i class="fa fa-home"></i> Accueil</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/ovh/index.php?view=cloud"><i class="ovh-computer"></i> CLOUD</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/ovh/index.php?view=dedie"><i class="ovh-technology"></i> DEDIE</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/ovh/index.php?view=domaine"><i class="ovh-web"></i> DOMAINE</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/ovh/index.php?view=email"><i class="ovh-web-1"></i> MAIL</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/ovh/index.php?view=fax"><i class="ovh-technology-1"></i> FAX</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/ovh/index.php?view=hebergement"><i class="ovh-technology-2"></i> HEBERGEMENT</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/ovh/index.php?view=license"><i class="ovh-business"></i> LICENSE</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/ovh/index.php?view=me"><i class="ovh-avatar"></i> MON COMPTE</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/ovh/index.php?view=order"><i class="ovh-business-1"></i> MES COMMANDES</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/ovh/index.php?view=sms"><i class="ovh-technology-7"></i> SMS</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/ovh/index.php?view=support"><i class="ovh-people"></i> ASSISTANCE</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/ovh/index.php?view=telephonie"><i class="ovh-technology-4"></i> TELEPHONIE</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/ovh/index.php?view=vps"><i class="ovh-technology-8"></i> VPS</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/ovh/index.php?view=travaux"><i class="ovh-technology"></i> TRAVAUX OVH</a></li>

                </ul>
            <?php endif; ?>
            <?php if($_SESSION['lieu'] == 'projet'): ?>
                <div class="menu-title">
                    PROJET
                </div>
                <ul class="nav nav-sidebar">
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/projet/index.php?view=dashboard"><i class="fa fa-home"></i> Accueil</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/projet/index.php?view=projet"><i class="fa fa-code-fork"></i> Projets</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/projet/index.php?view=bugs"><i class="fa fa-bug"></i> Bugs</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/projet/index.php?view=statut"><i class="fa fa-area-chart"></i> Statut</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/projet/index.php?view=tickets"><i class="fa fa-ticket"></i> Ticket</a></li>
                </ul>
            <?php endif; ?>
            <?php if($_SESSION['lieu'] == 'intervention'): ?>
                <div class="menu-title">
                    INTERVENTION
                </div>
                <ul class="nav nav-sidebar">
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/intervention/index.php?view=dashboard"><i class="fa fa-home"></i> Accueil</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/intervention/index.php?view=atelier"><i class="fa fa-wrench"></i> Atelier</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/intervention/index.php?view=deplacement"><i class="fa fa-map-marker"></i> Déplacement</a></li>
                    <li><a href="<?= $constante->getUrl(array(), false, false); ?>view/intervention/index.php?view=mobile"><i class="fa fa-mobile-phone"></i> Mobile</a></li>
                </ul>
            <?php endif; ?>
            <!--<div class="menu-title">
                Navigation
                <div class="pull-right menu-settings">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" data-delay="300">
                        <i class="icon-settings"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#" id="reorder-menu" data-translate="reorder-menu" class="reorder-menu">Reorder menu</a></li>
                        <li><a href="#" id="remove-menu" data-translate="remove-menu" class="remove-menu">Remove elements</a></li>
                        <li><a href="#" id="hide-top-sidebar" data-translate="hide-top-sidebar" class="hide-top-sidebar">Hide user &amp; search</a></li>
                    </ul>
                </div>
            </div>
            <ul class="nav nav-sidebar">
                <li><a href="dashboard.html"><i class="icon-home"></i><span data-translate="dashboard">Dashboard</span></a></li>
                <li class="nav-parent">
                    <a href="#"><i class="icon-puzzle"></i><span data-translate="builder">Builder</span> <span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li><a target="_blank" href="../builder/admin-builder/index.html"> Admin</a></li>
                        <li><a href="../builder/page-builder/index.html"> Page</a></li>
                        <li><a href="ecommerce-pricing-table.html"> Pricing Table</a></li>
                    </ul>
                </li>
                <li class=""><a href="../frontend/one-page.html" target="_blank"><i class="fa fa-laptop"></i><span class="pull-right badge badge-primary hidden-st">New</span><span data-translate="Frontend">Frontend</span></a></li>
                <li class="nav-parent">
                    <a href="#"><i class="icon-bulb"></i><span data-translate="Mailbox">Mailbox</span> <span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li><a href="mailbox.html"> Inbox</a></li>
                        <li><a href="mailbox-send.html"> Send Email</a></li>
                        <li><a href="mailbox-emails.html"><span class="pull-right badge badge-danger">Hot</span> Email Templates</a></li>
                    </ul>
                </li>
                <li class="nav-parent">
                    <a href=""><i class="icon-screen-desktop"></i><span data-translate="ui elements">UI Elements</span> <span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li><a href="ui-buttons.html"  data-translate="buttons"> Buttons</a></li>
                        <li><a href="ui-components.html" data-translate="components"> Components</a></li>
                        <li><a href="ui-tabs.html" data-translate="tabs"> Tabs</a></li>
                        <li><a href="ui-animations.html" data-translate="animations css3"> Animations CSS3</a></li>
                        <li><a href="ui-icons.html" data-translate="icons"> Icons</a></li>
                        <li><a href="ui-portlets.html" data-translate="portlets"> Portlets</a></li>
                        <li><a href="ui-nestable-list.html"  data-translate="nestable list"> Nestable List</a></li>
                        <li><a href="ui-tree-view.html" data-translate="tree view"> Tree View</a></li>
                        <li><a href="ui-modals.html" data-translate="modals"> Modals</a></li>
                        <li><a href="ui-notifications.html" data-translate="notifications"> Notifications</a></li>
                        <li><a href="ui-typography.html" data-translate="typography"> Typography</a></li>
                        <li><a href="ui-helper.html" data-translate="helper"> Helper Classes</a></li>
                    </ul>
                </li>
                <li class="nav-parent">
                    <a href=""><i class="icon-layers"></i><span data-translate="layouts">Layouts</span><span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li><a href="layouts-api.html" data-translate=""> Layout API</a></li>
                        <li><a href="layout-topbar-menu.html" data-translate=""> Topbar Menu</a></li>
                        <li><a href="layout-topbar-mega-menu.html" data-translate=""> Topbar Mega Menu</a></li>
                        <li><a href="layout-topbar-mega-menu-dark.html" data-translate=""> Topbar Mega Dark</a></li>
                        <li><a href="layout-sidebar-top.html" data-translate=""> Sidebar on Top</a></li>
                        <li><a href="layout-sidebar-hover.html" data-translate=""> Sidebar on Hover</a></li>
                        <li><a href="layout-submenu-hover.html" data-translate=""> Sidebar Submenu Hover</a></li>
                        <li><a href="layout-sidebar-condensed.html" data-translate=""> Sidebar Condensed</a></li>
                        <li><a href="layout-sidebar-light.html" data-translate=""> Sidebar Light</a></li>
                        <li><a href="layout-right-sidebar.html" data-translate=""> Right Sidebar</a></li>
                        <li><a href="layout-boxed.html" data-translate=""> Boxed Layout</a></li>
                        <li><a href="layout-collapsed-sidebar.html" data-translate=""> Collapsed Sidebar</a></li>
                    </ul>
                </li>
                <li class="nav-parent">
                    <a href=""><i class="icon-note"></i><span data-translate="forms">Forms </span><span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li><a href="forms.html"> Forms Elements</a></li>
                        <li><a href="forms-validation.html"> Forms Validation</a></li>
                        <li><a href="forms-plugins.html"> Advanced Plugins</a></li>
                        <li><a href="forms-wizard.html"> <span class="pull-right badge badge-danger">low</span> <span data-translate="form-wizard">Form Wizard</span></a></li>
                        <li><a href="forms-sliders.html" data-translate="sliders"> Sliders</a></li>
                        <li><a href="forms-editors.html" data-translate="text editors"> Text Editors</a></li>
                        <li><a href="forms-input-masks.html" data-translate="input masks"> Input Masks</a></li>
                    </ul>
                </li>
                <li class="nav-parent">
                    <a href=""><i class="fa fa-table"></i><span data-translate="medias manager">Tables</span><span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li><a href="tables.html" data-translate="tables styling"> Tables Styling</a></li>
                        <li><a href="tables-dynamic.html" data-translate="tables dynamic"> Tables Dynamic</a></li>
                        <li><a href="tables-filter.html" data-translate="tables filter"> Tables Filter</a></li>
                        <li><a href="tables-editable.html" data-translate="tables editable"> Tables Editable</a></li>
                    </ul>
                </li>
                <li class="nav-parent">
                    <a href=""><i class="icon-bar-chart"></i><span data-translate="charts">Charts </span><span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li><a href="charts.html" data-translate="image croping"> Charts</a></li>
                        <li><a href="charts-finance.html" data-translate="gallery sortable"> Financial Charts</a></li>
                    </ul>
                </li>
                <li class="nav-parent">
                    <a href=""><i class="icon-picture"></i><span data-translate="medias manager">Medias</span><span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li><a href="medias-image-croping.html" data-translate="image croping"> Images Croping</a></li>
                        <li><a href="medias-gallery-sortable.html" data-translate="gallery sortable"> Gallery Sortable</a></li>
                        <li><a href="medias-hover-effects.html" data-translate="hover effects"> <span class="pull-right badge badge-primary">12</span> Hover Effects</a></li>
                    </ul>
                </li>
                <li class="nav-parent nav-active active">
                    <a href=""><i class="icon-docs"></i><span data-translate="pages">Pages </span><span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li><a href="page-timeline.html"> Timeline</a></li>
                        <li><a href="page-404.html"> Error 404</a></li>
                        <li><a href="page-500.html"> Error 500</a></li>
                        <li class="active"><a href="page-blank.html"> Blank Page</a></li>
                        <li><a href="page-contact.html"> Contact</a></li>
                    </ul>
                </li>
                <li class="nav-parent">
                    <a href=""><i class="icon-user"></i><span data-translate="pages">User </span><span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li><a href="user-profil.html"> <span class="pull-right badge badge-danger">Hot</span> Profil</a></li>
                        <li><a href="user-lockscreen.html"> Lockscreen</a></li>
                        <li><a href="user-login-v1.html"> Login / Register</a></li>
                        <li><a href="user-login-v2.html"> Login / Register v2</a></li>
                        <li><a href="user-session-timeout.html"> Session Timeout</a></li>
                    </ul>
                </li>
                <li class="nav-parent">
                    <a href=""><i class="icon-basket"></i><span data-translate="pages">eCommerce </span><span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li><a href="ecommerce-cart.html"> Shopping Cart</a></li>
                        <li><a href="ecommerce-invoice.html"> Invoice</a></li>
                        <li><a href="ecommerce-pricing-table.html"><span class="pull-right badge badge-success">5</span> Pricing Table</a></li>
                    </ul>
                </li>
                <li class="nav-parent">
                    <a href=""><i class="icon-cup"></i><span>Extra </span><span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li><a href="extra-fullcalendar.html"><span class="pull-right badge badge-primary">New</span> Fullcalendar</a></li>
                        <li><a href="extra-widgets.html"> Widgets</a></li>
                        <li><a href="page-coming-soon.html"> Coming Soon</a></li>
                        <li><a href="extra-sliders.html"> Sliders</a></li>
                        <li><a href="maps-google.html"> Google Maps</a></li>
                        <li><a href="maps-vector.html"> Vector Maps</a></li>
                    </ul>
                </li>
            </ul>-->
            <!-- SIDEBAR WIDGET FOLDERS -->
            <!--<div class="sidebar-widgets">
                <p class="menu-title widget-title">Folders <span class="pull-right"><a href="#" class="new-folder"> <i class="icon-plus"></i></a></span></p>
                <ul class="folders">
                    <li>
                        <a href="#"><i class="icon-doc c-primary"></i>My documents</a>
                    </li>
                    <li>
                        <a href="#"><i class="icon-picture"></i>My images</a>
                    </li>
                    <li><a href="#"><i class="icon-lock"></i>Secure data</a>
                    </li>
                    <li class="add-folder">
                        <input type="text" placeholder="Folder's name..." class="form-control input-sm">
                    </li>
                </ul>
            </div>-->
            <div class="sidebar-footer clearfix">
                <a class="pull-left footer-settings" href="#" data-rel="tooltip" data-placement="top" data-original-title="Settings">
                    <i class="icon-settings"></i></a>
                <a class="pull-left toggle_fullscreen" href="#" data-rel="tooltip" data-placement="top" data-original-title="Fullscreen">
                    <i class="icon-size-fullscreen"></i></a>
                <a class="pull-left" href="#" data-rel="tooltip" data-placement="top" data-original-title="Lockscreen">
                    <i class="icon-lock"></i></a>
                <a class="pull-left btn-effect" href="#" data-modal="modal-1" data-rel="tooltip" data-placement="top" data-original-title="Logout">
                    <i class="icon-power"></i></a>
            </div>
        </div>
    </div>
    <!-- END SIDEBAR -->
    <div class="main-content">
        <!-- BEGIN TOPBAR -->
        <div class="topbar">
            <div class="header-left">
                <div class="topnav">
                    <a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span class="menu__handle"><span>Menu</span></span></a>
                    <?php if($user->groupe == 4): ?>
                        <ul class="nav nav-horizontal">
                            <li<?php if($view === 'service'){echo ' class="active"';} ?>><a href="index.php?view=client&sub=service"><i class="fa fa-code-fork"></i><span>Mes Services</span></a></li>
                            <li<?php if($view === 'facture'){echo ' class="active"';} ?>><a href="index.php?view=client&sub=facture"><i class="fa fa-euro"></i><span>Mes Factures</span></a></li>
                        </ul>
                    <?php else: ?>
                        <ul class="nav nav-horizontal">
                            <li<?php if($view === 'gestion'){echo ' class="active"';} ?>><a href="<?= $constante->getUrl(array(), false, false); ?>view/gestion/index.php?view=dashboard"><i class="fa fa-cube"></i><span>Gestion</span></a></li>
                            <li<?php if($view === 'compta'){echo ' class="active"';} ?>><a href="<?= $constante->getUrl(array(), false, false); ?>view/compta/index.php?view=dashboard"><i class="fa fa-euro"></i><span>Comptabilité</span></a></li>
                            <li<?php if($view === 'ovh'){echo ' class="active"';} ?>><a href="<?= $constante->getUrl(array(), false, false); ?>view/ovh/index.php?view=dashboard"><i class="fa fa-globe"></i><span>OVH</span></a></li>
                            <li<?php if($view === 'projet'){echo ' class="active"';} ?>><a href="<?= $constante->getUrl(array(), false, false); ?>view/projet/index.php?view=dashboard"><i class="fa fa-code-fork"></i><span>Projet</span></a></li>
                            <li<?php if($view === 'intervention'){echo ' class="active"';} ?>><a href="<?= $constante->getUrl(array(), false, false); ?>view/intervention/index.php?view=dashboard"><i class="fa fa-wrench"></i><span>Intervention</span></a></li>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
            <div class="header-right">
                <ul class="header-menu nav navbar-nav">
                    <!-- BEGIN USER DROPDOWN -->
                    <!-- END USER DROPDOWN -->
                    <?php if($user->groupe != 4): ?>
                        <!-- BEGIN NOTIFICATION DROPDOWN -->
                        <li class="dropdown" id="notifications-header">
                            <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="icon-bell"></i>
                                <span id="count_notif" class="badge badge-danger badge-header"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header clearfix">
                                    <p class="pull-left" id="count_notif_title">Aucune nouvelle notification</p>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list withScroll" data-height="220">
                                        <?php
                                        $sql_notif = $DB->query("SELECT * FROM notif WHERE iduser = :iduser AND vu = 0", array(
                                            "iduser" => $user->iduser
                                        ));
                                        foreach($sql_notif as $notif):
                                            ?>
                                            <li>
                                                <a href="#">
                                                    <?php if($notif->type == 1): ?>
                                                        <i class="fa fa-plus p-r-10 f-18 c-green"></i>
                                                    <?php elseif($notif->type == 2): ?>
                                                        <i class="fa fa-edit p-r-10 f-18 c-orange"></i>
                                                    <?php else: ?>
                                                        <i class="fa fa-remove p-r-10 f-18 c-red"></i>
                                                    <?php endif; ?>
                                                    <?= substr(html_entity_decode($notif->notification), 0, 15); ?>
                                                    <span class="dropdown-time"><?= $date_format->format(date("d-m-Y h:i", $notif->date_notification)); ?></span>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                                <li class="dropdown-footer clearfix">
                                    <a href="<?= $constante->getUrl(array(), false, false); ?>index.php?view=notification" class="pull-left">Voir toutes les notifications</a>
                                </li>
                            </ul>
                        </li>
                        <!-- END NOTIFICATION DROPDOWN -->
                        <!-- BEGIN MESSAGES DROPDOWN -->
                        <li class="dropdown" id="messages-header">
                            <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="icon-paper-plane"></i>
                                <span id="count_mail" class="badge badge-primary badge-header"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header clearfix">
                                    <p class="pull-left" id="count_mail_title">
                                        Aucun nouveau mail
                                    </p>
                                </li>
                                <li class="dropdown-body">
                                    <ul class="dropdown-menu-list withScroll" data-height="220">
                                        <?php
                                        $sql_mail = $DB->query("SELECT * FROM collab_inbox, users WHERE collab_inbox.expediteur = users.iduser AND destinataire = :destinataire AND lu = 0", array("destinataire" => $user->iduser));
                                        foreach($sql_mail as $mail):
                                            ?>
                                            <li class="clearfix">
                                        <span class="pull-left p-r-5">
                                        <img src="<?= $constante->getUrl(array(), false, true); ?>avatar/<?= $mail->username; ?>.png" alt="avatar 3">
                                        </span>
                                                <div class="clearfix">
                                                    <div>
                                                        <strong><?= $mail->prenom_user; ?> <?= $mail->nom_user; ?></strong>
                                                        <small class="pull-right text-muted">
                                                            <span class="glyphicon glyphicon-time p-r-5"></span><?= $date_format->format(date("d-m-Y H:i:s", $mail->date_message)); ?>
                                                        </small>
                                                    </div>
                                                    <p><?= html_entity_decode($mail->sujet); ?></p>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                                <li class="dropdown-footer clearfix">
                                    <a href="<?= $constante->getUrl(array(), false, false); ?>index.php?view=mailbox" class="pull-left">Voir tous vos messages</a>
                                </li>
                            </ul>
                        </li>
                        <!-- END MESSAGES DROPDOWN -->
                    <?php endif; ?>
                    <!-- BEGIN USER DROPDOWN -->
                    <li class="dropdown" id="user-header">
                        <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img src="<?= $constante->getUrl(array(), false, true); ?>avatar/<?= $user->username; ?>.png" alt="user image">
                            <span class="username"><?= $user->nom_user; ?> <?= $user->prenom_user; ?></span>
                        </a>
                        <?php if($user->groupe != 4): ?>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?= $constante->getUrl(array(), false, false); ?>index.php?view=profil"><i class="fa fa-user"></i><span>Mon Profil</span></a>
                                </li>
                                <li>
                                    <a href="<?= $constante->getUrl(array(), false, false); ?>index.php?view=calendar"><i class="fa fa-calendar"></i><span>Mon Calendrier</span></a>
                                </li>
                                <li>
                                    <a href="<?= $constante->getUrl(array(), false, false); ?>index.php?view=mailbox"><i class="fa fa-envelope"></i><span>Mes Messages</span></a>
                                </li>
                                <li>
                                    <a href="<?= $constante->getUrl(array(), false, false); ?>index.php?view=tasks"><i class="fa fa-tasks"></i><span>Mes Taches</span></a>
                                </li>
                                <li>
                                    <a href="<?= $constante->getUrl(array(), false, false); ?>controller/user.php?action=lock"><i class="fa fa-lock"></i><span>Verrouiller l'application</span></a>
                                </li>
                                <li>
                                    <a href="<?= $constante->getUrl(array(), false, false); ?>controller/user.php?action=logout"><i class="fa fa-sign-out"></i><span>Déconnexion</span></a>
                                </li>
                            </ul>
                        <?php else: ?>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?= $constante->getUrl(array(), false, false); ?>index.php?view=profil"><i class="fa fa-user"></i><span>Mon Profil</span></a>
                                </li>
                                <li>
                                    <a href="<?= $constante->getUrl(array(), false, false); ?>controller/user.php?action=logout"><i class="fa fa-sign-out"></i><span>Déconnexion</span></a>
                                </li>
                            </ul>
                        <?php endif; ?>
                    </li>
                    <!-- END USER DROPDOWN -->
                    <!-- CHAT BAR ICON -->
                    <li id="quickview-toggle"><a href="#"><i class="icon-bubbles"></i></a></li>
                </ul>
            </div>
            <!-- header-right -->
        </div>
        <!-- END TOPBAR -->
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
            <div id="debug"></div>
            <?= $content; ?>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
    <!-- END MAIN CONTENT -->
</section>
<!-- BEGIN QUICKVIEW SIDEBAR -->
<?php require dirname(__DIR__)."/view/include/right_bar.php" ?>
<!-- END QUICKVIEW SIDEBAR -->
<!-- BEGIN PRELOADER -->
<div class="loader-overlay">
    <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>
<!-- END PRELOADER -->
<a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a>
<?php include (dirname(__DIR__)."/view/include/footer.php"); ?>
<script src="<?= $constante->getUrl(array('js/')); ?>pages/timeline.js"></script>
<?php if(isset($_GET['success']) && $_GET['success'] == $_GET['success']){ ?>
    <script type="text/javascript">
        $(document).ready(function(){
            toastr.success("<?= $_GET['text']; ?>", "SUCCES");
        });
    </script>
<?php } ?>
<?php if(isset($_GET['warning']) && $_GET['warning'] == $_GET['warning']){ ?>
    <script type="text/javascript">
        $(document).ready(function(){
            toastr.warning("<?= $_GET['text']; ?>", "ATTENTION");
        })
    </script>
<?php } ?>
<?php if(isset($_GET['error']) && $_GET['error'] == $_GET['error']){ ?>
    <script type="text/javascript">
        $(document).ready(function(){
            toastr.error("<?= $_GET['text']; ?>", "ERREUR");
        })
    </script>
<?php } ?>
<?php if(isset($_GET['info']) && $_GET['info'] == $_GET['info']){ ?>
    <script type="text/javascript">
        $(document).ready(function(){
            toastr.error("<?= $_GET['text']; ?>", "INFORMATION");
        })
    </script>
<?php } ?>
</body>
</html>