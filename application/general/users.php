<?php
/**
 * Created by PhpStorm.
 * User: Maxime
 * Date: 27/02/2016
 * Time: 01:44
 */

namespace App\general;


use Otp\GoogleAuthenticator;

class users
{

    private $username;

    public function __construct($username)
    {
        $this->username = $username;
    }

    public function info_user()
    {
        $DB = new DB();
        $sql = $DB->query("SELECT * FROM users WHERE username = :username", array("username" => $this->username));
        return $sql[0];
    }

    public function totp()
    {
        $secret = GoogleAuthenticator::generateRandom();
        $_SESSION['user']['totp_secret'] = $secret;
        $username = $this->username;
        $qrCode = GoogleAuthenticator::getQrCodeUrl('totp', 'GESTCOM CRIDIP '.$username, $secret);
        return $qrCode;
    }
}