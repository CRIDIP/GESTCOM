<?php
function is_ajax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
if(is_ajax()){
    if(isset($_GET['action']) && $_GET['action'] == 'view_task'){
        require "../application/classe.php";
        $idtask = $_GET['idtask'];
        $sql_task = $DB->query("SELECT * FROM collab_task WHERE idtask = :idtask", array("idtask" => $idtask));
        $task = $sql_task[0];
        ob_start();
        ?>
        <div class="panel">
            <div class="panel-header <?php if($task->urgence == 1){echo 'bg-green';}elseif($task->urgence == 2){echo 'bg-yellow';}else{echo 'bg-red';} ?>">
                <div class="row">
                    <div class="col-md-9">
                        <h3>
                            <?= html_entity_decode($task->titre_tache); ?>
                            <?php if($task->etat == 0): ?>
                            <span class="label label-danger">Inachever</span>
                            <?php else: ?>
                            <span class="label label-success">Achever</span>
                            <?php endif; ?>
                        </h3>
                    </div>
                    <div class="col-md-3">
                        <?php if($task->etat == 0): ?>
                        <a href="<?= $constante->getUrl(array(), false, false); ?>controller/tasks.php?action=complete-task&idtask=<?= $idtask; ?>" class="btn btn-rounded btn-default">Complete</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="panel-content">
                <?= html_entity_decode($task->desc_tache); ?>
            </div>
            <div class="panel-footer <?php if($task->urgence == 1){echo 'bg-green';}elseif($task->urgence == 2){echo 'bg-yellow';}else{echo 'bg-red';} ?>">
                <div class="row">
                    <div class="col-md-6">Créer le <?= $date_format->formatage("d/m/Y à H:i:s", $task->date_created); ?></div>
                    <div class="col-md-6" style="text-align: right;">Echéance le <?= $date_format->formatage("d/m/Y à H:i:s", $task->date_limit); ?></div>
                </div>
            </div>
        </div>
        <?php
        $json_html = ob_get_clean();
        echo json_encode($json_html);
    }
    if(isset($_GET['action']) && $_GET['action'] == 'supp-task'){
        require "../application/classe.php";
        $idtask = $_GET['idtask'];

        $task_del = $DB->execute("DELETE FROM collab_task WHERE idtask = :idtask", array("idtask" => $idtask));

        if($task_del == 1){
            echo json_encode(200);
        }else{
            echo json_encode(300);
        }
    }
    if(isset($_GET['action']) && $_GET['action'] == 'complete-task'){
        require "../application/classe.php";
        $idtask = $_GET['idtask'];

        $task_up = $DB->execute("UPDATE collab_task SET etat = 1 WHERE idtask = :idtask", array("idtask" => $idtask));

        if($task_up == 1){
            echo json_encode(200);
        }else{
            echo json_encode(300);
        }
    }
    if(isset($_GET['action']) && $_GET['action'] == 'count_task'){
        require "../application/classe.php";

        $task_count = $DB->count("SELECT COUNT(idtask) FROM collab_task WHERE etat = 0");
        $count = $task_count[0];

        echo json_encode($count);
    }
}