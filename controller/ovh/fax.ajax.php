<?php
function is_ajax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
if(is_ajax()){
    if(isset($_GET['action']) && $_GET['action'] == 'view_fax'){
        require "../../application/classe.php";
        $fax = $_GET['fax'];
        $freefax = $ovh->get("/freefax");
        ob_start();
        ?>
        <div class="row">
            <div class="col-md-12">
                
            </div>
        </div>
        <?php
        $json_html = ob_get_clean();
        echo json_encode($json_html);
    }
}