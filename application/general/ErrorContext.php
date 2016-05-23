<?php
/**
 * Created by PhpStorm.
 * User: SWD
 * Date: 26/02/2016
 * Time: 19:17
 */

namespace App\general;


class ErrorContext
{
    public function getError($code){
        $db = new DB();
        $error_q = $db->query("SELECT * FROM error WHERE code = :code", array("code" => $code));
        $table_error = array(
            "Code" => $error_q[0]->code,
            "Type" => $error_q[0]->type,
            "Msg"  => $error_q[0]->msg
        );
        return $table_error;
    }
}