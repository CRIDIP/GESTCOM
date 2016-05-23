<?php
/**
 * Created by PhpStorm.
 * User: Maxime
 * Date: 29/02/2016
 * Time: 23:22
 */

namespace App\general;


class ssh
{
    protected $server   = "vps221243.ovh.net";
    protected $port     = "5678";
    protected $user     = "sysdev";
    protected $pass     = "sysdev";
    public $connect     = "";

    protected $error_connect = "Système de Connexion SSH2 inopérant !<br>Impossible de ce connecter au serveur distant.";

    /**
     * @param null $server -> Serveur SSH
     * @param null $port -> Port de connexion
     * @param null $user -> Nom d'utilisateur
     * @param null $pass -> Mot de Passe
     * @param bool $external -> Utilisation du systeme Externe par systeme de connexion par pont
     * @return resource
     */
    public function connexion($server = null, $port = null, $user = null, $pass = null, $external = false)
    {
        if($external == false)
        {
            $connect = ssh2_connect($this->server, $this->port);
            $login = ssh2_auth_password($connect, $this->user, $this->pass);

            if(!$login)
            {
                $text = "Erreur SSH2: Connexion echoué, veuillez vérifier les paramêtre de l'application app/app.php <i>(CLASS)</i>.";
                header("Location: ../index.php?view=admin_sha&sub=error&text=$text");
            }else{
                return $connect;
            }
        }else{
            $connect = ssh2_connect($server, $port);
            $login = ssh2_auth_password($connect, $user, $pass);

            if(!$login)
            {
                $text = "Erreur SSH2: Connexion echoué, veuillez vérifier les paramêtre de l'application app/app.php <i>(CLASS)</i>.";
                header("Location: ../index.php?view=admin_sha&sub=error&text=$text");
            }else{
                return $connect;
            }
        }
    }
}