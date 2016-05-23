<?php


namespace App\ovh;


use App\api\ovh;
use Ovh\Api;

class domaine extends Api
{
    public $domaine;

    public function call(){
        $depspace = new ovh();
        $ovh = new Api($depspace->appKey, $depspace->appSecret, $depspace->endpoint, $depspace->consumerKey);
        $result = $ovh->get("/domain");
        $this->domaine = $result;
    }
}