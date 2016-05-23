<?php


namespace App\ovh;


use App\api\ovh;
use Ovh\Api;

class cloud extends Api
{
    public $cloud;

    public function construct(){
        $depspace = new ovh();
        $ovh = new Api($depspace->appKey, $depspace->appSecret, $depspace->endpoint, $depspace->consumerKey);
        $result = $ovh->get("/cloud");
        $this->cloud = $result;
    }
}