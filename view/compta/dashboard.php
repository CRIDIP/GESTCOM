<div class="row">
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-content widget-info">
                <div class="row">
                    <div class="left">
                        <i class="fa fa-dollar bg-green"></i>
                    </div>
                    <div class="right" id="sum_bq">
                        <p data-to="52000" data-from="0" class="number countup">52,000</p>
                        <p class="text">CA Annuel</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-content widget-info">
                <div class="row">
                    <div class="left">
                        <i class="fa fa-dollar bg-green"></i>
                    </div>
                    <div class="right" id="sum_rslt">
                        <p data-to="52000" data-from="0" class="number countup">52,000</p>
                        <p class="text">Résultat</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <ul class="jquery-clock small" data-jquery-clock="">
                    <li class="jquery-clock-pin"></li>
                    <li class="jquery-clock-sec"></li>
                    <li class="jquery-clock-min"></li>
                    <li class="jquery-clock-hour"></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="<?= $constante->getUrl(array('plugins/')); ?>countup/countUp.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>custom/js/pages/gestion/dashboard.js"></script>