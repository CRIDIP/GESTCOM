<?php
/**
 * Created by PhpStorm.
 * User: SWD
 * Date: 29/02/2016
 * Time: 14:46
 */

namespace App\noctus;


class decrypt
{
    private $encrypt;
    private $username;
    private $password;

    public function __construct($encrypt, $username, $password)
    {
        $this->encrypt = $encrypt;
        $this->username = $username;
        $this->password = $password;
    }

    private function dec_username()
    {
        $string = strlen($this->username);
        $encrypt = sha1($string.$this->username);
        return $encrypt;
    }

    private function dec_password()
    {
        $encrypt = sha1($this->password);
        return $encrypt;
    }

    public function decrypt()
    {
        $hash_user = $this->dec_username();
        $hash_pass = $this->dec_password();
        $lend = $hash_user.$hash_pass;
        $decrypt = sha1($lend);

        if($decrypt == $this->encrypt){
            return true;
        }else{
            return false;
        }

    }

    public function decrypt_token($token){
        $tab = explode("_", $token);

        if($tab[3] <= $tab[3] -1800 ){
            return false;
        }else{
            if($tab[0] == $this->username AND $tab[2] == $this->password){
                return true;
            }else{
                return false;
            }
        }

    }
}