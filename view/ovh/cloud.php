<?php if(!isset($_GET['sub'])){ ?>
    <?php
    $cloud = $ovh->get("/cloud");
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h1><i class="ovh-computer" style="font-size: 25px;"></i> CLOUD</h1>
                </div>
            </div>
        </div>
    </div>
    <?php if($cloud == null): ?>
        <div class="row">
            <div class="col-md-12">
                <h2 class="alert bg-info"><strong><i class="fa fa-info"></i> Information !</strong> Aucun Système Cloud pour le compte</h2>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-header md-panel-controls">
                        <h3>From the <strong>Left...</strong></h3>
                    </div>
                    <div class="panel-content">
                        <div class="tab_left">
                            <ul  class="nav nav-tabs nav-red">
                                <li><a href="#tab3_1" data-toggle="tab"><i class="icon-home"></i> Home</a></li>
                                <li class="active"><a href="#tab3_2" data-toggle="tab"><i class="icon-user"></i> Profile</a></li>
                                <li><a href="#tab3_3" data-toggle="tab"><i class="icon-cloud-download"></i> Other Tab</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade" id="tab3_1">
                                    <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                                </div>
                                <div class="tab-pane fade active in" id="tab3_2">
                                    <h4>"SOONER OR LATER, THOSE WHO WIN ARE THOSE WHO THINK THEY CAN."</h4>
                                    <p>Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                                </div>
                                <div class="tab-pane fade" id="tab3_3">
                                    <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php } ?>
