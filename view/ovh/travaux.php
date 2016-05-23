<?php
$flux_domaine = "http://travaux.ovh.net/rss.php?proj=1";
$rss_domaine = simplexml_load_file($flux_domaine);

$flux_dedie = "http://travaux.ovh.net/rss.php?proj=5";
$rss_dedie = simplexml_load_file($flux_dedie);

$flux_manager = "http://travaux.ovh.net/rss.php?proj=10";
$rss_manager = simplexml_load_file($flux_manager);

$flux_support = "http://travaux.ovh.net/rss.php?proj=12";
$rss_support = simplexml_load_file($flux_support);

$flux_cloud = "http://travaux.ovh.net/rss.php?proj=18";
$rss_cloud = simplexml_load_file($flux_cloud);

$flux_adsl = "http://travaux.ovh.net/rss.php?proj=20";
$rss_adsl = simplexml_load_file($flux_adsl);

$flux_vps = "http://travaux.ovh.net/rss.php?proj=22";
$rss_vps = simplexml_load_file($flux_vps);

$flux_web = "http://travaux.ovh.net/rss.php?proj=27";
$rss_web = simplexml_load_file($flux_web);
?>

<!-- PANEL DOMAINE -->
<div class="row">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-header"><h3>TRAVAUX <strong>DOMAINE</strong></h3></div>
            <div class="panel-content">
                <div class="panel-group panel-accordion" id="accordion">
                    <?php foreach ($rss_domaine->channel->item as $item): ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#<?= $date_format->format_strt($item->pubDate); ?>">
                                    <?= $item->title; ?>
                                    <span class="text-muted h6">
                                        <?php
                                        $str = $date_format->format_strt($item->pubDate);
                                        echo $date_format->formatage("d/m/Y à H:i:s", $str);
                                        ?>
                                    </span>
                                </a>
                            </h4>
                        </div>
                        <div id="<?= $date_format->format_strt($item->pubDate); ?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div style="">
                                    <?= html_entity_decode($item->description); ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-md-offset-8">
                                        <button type="button" class="btn btn-primary" onclick="window.location='<?= $item->link; ?>'">En savoir plus <i class="fa fa-arrow-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-header"><h3>TRAVAUX <strong>DEDIE</strong></h3></div>
            <div class="panel-content">
                <div class="panel-group panel-accordion" id="accordion">
                    <?php foreach ($rss_dedie->channel->item as $item): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#<?= $date_format->format_strt($item->pubDate); ?>">
                                        <?= $item->title; ?>
                                        <span class="text-muted h6">
                                        <?php
                                        $str = $date_format->format_strt($item->pubDate);
                                        echo $date_format->formatage("d/m/Y à H:i:s", $str);
                                        ?>
                                    </span>
                                    </a>
                                </h4>
                            </div>
                            <div id="<?= $date_format->format_strt($item->pubDate); ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div style="">
                                        <?= html_entity_decode($item->description); ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-8">
                                            <button type="button" class="btn btn-primary" onclick="window.location='<?= $item->link; ?>'">En savoir plus <i class="fa fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-header"><h3>TRAVAUX <strong>MANAGER</strong></h3></div>
            <div class="panel-content">
                <div class="panel-group panel-accordion" id="accordion">
                    <?php foreach ($rss_manager->channel->item as $item): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#<?= $date_format->format_strt($item->pubDate); ?>">
                                        <?= $item->title; ?>
                                        <span class="text-muted h6">
                                        <?php
                                        $str = $date_format->format_strt($item->pubDate);
                                        echo $date_format->formatage("d/m/Y à H:i:s", $str);
                                        ?>
                                    </span>
                                    </a>
                                </h4>
                            </div>
                            <div id="<?= $date_format->format_strt($item->pubDate); ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div style="">
                                        <?= html_entity_decode($item->description); ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-8">
                                            <button type="button" class="btn btn-primary" onclick="window.location='<?= $item->link; ?>'">En savoir plus <i class="fa fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-header"><h3>TRAVAUX <strong>SUPPORT</strong></h3></div>
            <div class="panel-content">
                <div class="panel-group panel-accordion" id="accordion">
                    <?php foreach ($rss_support->channel->item as $item): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#<?= $date_format->format_strt($item->pubDate); ?>">
                                        <?= $item->title; ?>
                                        <span class="text-muted h6">
                                        <?php
                                        $str = $date_format->format_strt($item->pubDate);
                                        echo $date_format->formatage("d/m/Y à H:i:s", $str);
                                        ?>
                                    </span>
                                    </a>
                                </h4>
                            </div>
                            <div id="<?= $date_format->format_strt($item->pubDate); ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div style="">
                                        <?= html_entity_decode($item->description); ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-8">
                                            <button type="button" class="btn btn-primary" onclick="window.location='<?= $item->link; ?>'">En savoir plus <i class="fa fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-header"><h3>TRAVAUX <strong>CLOUD</strong></h3></div>
            <div class="panel-content">
                <div class="panel-group panel-accordion" id="accordion">
                    <?php foreach ($rss_cloud->channel->item as $item): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#<?= $date_format->format_strt($item->pubDate); ?>">
                                        <?= $item->title; ?>
                                        <span class="text-muted h6">
                                        <?php
                                        $str = $date_format->format_strt($item->pubDate);
                                        echo $date_format->formatage("d/m/Y à H:i:s", $str);
                                        ?>
                                    </span>
                                    </a>
                                </h4>
                            </div>
                            <div id="<?= $date_format->format_strt($item->pubDate); ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div style="">
                                        <?= html_entity_decode($item->description); ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-8">
                                            <button type="button" class="btn btn-primary" onclick="window.location='<?= $item->link; ?>'">En savoir plus <i class="fa fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-header"><h3>TRAVAUX <strong>ADSL</strong></h3></div>
            <div class="panel-content">
                <div class="panel-group panel-accordion" id="accordion">
                    <?php foreach ($rss_adsl->channel->item as $item): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#<?= $date_format->format_strt($item->pubDate); ?>">
                                        <?= $item->title; ?>
                                        <span class="text-muted h6">
                                        <?php
                                        $str = $date_format->format_strt($item->pubDate);
                                        echo $date_format->formatage("d/m/Y à H:i:s", $str);
                                        ?>
                                    </span>
                                    </a>
                                </h4>
                            </div>
                            <div id="<?= $date_format->format_strt($item->pubDate); ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div style="">
                                        <?= html_entity_decode($item->description); ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-8">
                                            <button type="button" class="btn btn-primary" onclick="window.location='<?= $item->link; ?>'">En savoir plus <i class="fa fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-header"><h3>TRAVAUX <strong>VPS</strong></h3></div>
            <div class="panel-content">
                <div class="panel-group panel-accordion" id="accordion">
                    <?php foreach ($rss_vps->channel->item as $item): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#<?= $date_format->format_strt($item->pubDate); ?>">
                                        <?= $item->title; ?>
                                        <span class="text-muted h6">
                                        <?php
                                        $str = $date_format->format_strt($item->pubDate);
                                        echo $date_format->formatage("d/m/Y à H:i:s", $str);
                                        ?>
                                    </span>
                                    </a>
                                </h4>
                            </div>
                            <div id="<?= $date_format->format_strt($item->pubDate); ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div style="">
                                        <?= html_entity_decode($item->description); ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-8">
                                            <button type="button" class="btn btn-primary" onclick="window.location='<?= $item->link; ?>'">En savoir plus <i class="fa fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-header"><h3>TRAVAUX <strong>SITE WEB</strong></h3></div>
            <div class="panel-content">
                <div class="panel-group panel-accordion" id="accordion">
                    <?php foreach ($rss_web->channel->item as $item): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#<?= $date_format->format_strt($item->pubDate); ?>">
                                        <?= $item->title; ?>
                                        <span class="text-muted h6">
                                        <?php
                                        $str = $date_format->format_strt($item->pubDate);
                                        echo $date_format->formatage("d/m/Y à H:i:s", $str);
                                        ?>
                                    </span>
                                    </a>
                                </h4>
                            </div>
                            <div id="<?= $date_format->format_strt($item->pubDate); ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div style="">
                                        <?= html_entity_decode($item->description); ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-8">
                                            <button type="button" class="btn btn-primary" onclick="window.location='<?= $item->link; ?>'">En savoir plus <i class="fa fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>