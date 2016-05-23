<?php
/**
 * Created by PhpStorm.
 * User: SWD
 * Date: 29/02/2016
 * Time: 14:44
 */

namespace App\noctus;

use App\general\date;

class encrypt
{
    private $username;
    private $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    private function enc_username()
    {
        $string = strlen($this->username);
        $encrypt = sha1($string.$this->username);
        return $encrypt;
    }

    private function enc_password()
    {
        $encrypt = sha1($this->password);
        return $encrypt;
    }

    public function encrypt()
    {
        $hash_user = $this->enc_username();
        $hash_pass = $this->enc_password();
        $lend = $hash_user.$hash_pass;
        $encrypt = sha1($lend);
        return $encrypt;
    }

    public function new_token()
    {
        $date_format = new date();

        $date = $date_format->format_strt("d-m-Y H:i:s");
        $username = $this->username;
        $password = $this->password;

        $chaine = "azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN&0123456789_@";
        $shuff = str_shuffle($chaine);

        $key = substr($shuff, 0, 15);

        $token = $username."_".$key."_".$password."_".time();
        return $token;
    }
}
