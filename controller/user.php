<?php
use App\noctus\decrypt;
use App\noctus\encrypt;
use Base32\Base32;
use Otp\Otp;

if(isset($_POST['action']) && $_POST['action'] == 'login')
{

    if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])){
        require "../application/classe.php";
        $username = $_POST['username'];
        $password = $_POST['password'];
        if(isset($_POST['remember'])){
            $remember = $_POST['remember'];
        }
        $encrypt = new encrypt($username, $password);
        $pass_en = $encrypt->encrypt();
        $decrypt = new decrypt($pass_en, $username, $password);
        $pass_de = $decrypt->decrypt();

        $user_co = $DB->count("SELECT COUNT(iduser) FROM users WHERE username = :username AND password = :password", array(
            "username" => $username,
            "password" => $pass_en
        ));

        if($user_co == 1){
            $user_q = $DB->query("SELECT * FROM users WHERE username = :username", array("username" => $username));
            if($user_q[0]->totp_token != ''){
                session_start();
                $_SESSION['user']['user_id'] = $user_q[0]->iduser;
                $fonction->redirect("login", "totp", "", "","","");
            }else{
                session_start();
                $_SESSION['account']['active'] = 1;
                $_SESSION['account']['username'] = $username;
                $user_u = $DB->execute("UPDATE users SET connect = 2, last_connect = :last_connect WHERE username = :username", array(
                    "username"      => $username,
                    "last_connect"  => $date_format->format_strt(date("d-m-Y H:i:s"))
                ));
                if($user_u == 1){
                    $fonction->redirect("dashboard");
                }else{
                    echo "error";
                    var_dump($user_u);
                    die();
                }

            }
        }elseif($user_co == 0){
            $text = "Aucun couple Nom d'utilisateur / Mot de Passe correspondant.";
            $fonction->redirect("login", "","","error", "login", $text);
        }else{
            $fonction->redirect("error", "","","code", "USR1", "");
        }
    }else{
        $text = "Au moins un des champs requis n'est pas remplie !";
        $fonction->redirect("login", "", "", "warning", "login", $text);
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'login_totp')
{
    session_start();
    require "../application/classe.php";
    $iduser = $_SESSION['user']['user_id'];
    $user_q = $DB->query("SELECT * FROM users WHERE iduser = :iduser", array("iduser" => $iduser));

    $otp = new Otp();
    if($otp->checkTotp(Base32::decode($user_q[0]->totp_token), $_POST['code'])){
        $_SESSION['account']['active'] = 1;
        $_SESSION['account']['username'] = $user_q[0]->username;
        $user_u = $DB->execute("UPDATE users SET connect = 2, last_connect = :last_connect WHERE username = :username", array(
            "username"      => $user_q[0]->username,
            "last_connect"  => $date_format->format_strt(date("d-m-Y H:i:s"))
        ));
        if($user_u == 1){
            $fonction->redirect("dashboard");
        }
    }else{
        $fonction->redirect("login", "totp", "", "error", "active_totp", "Ce code ne correspond pas !!!");
    }
}
if(isset($_GET['action']) && $_GET['action'] == 'lock')
{
    session_start();
    require "../application/classe.php";
    $iduser = $user->iduser;

    $user_u = $DB->execute("UPDATE users SET connect = 1 WHERE iduser = :iduser", array("iduser" => $iduser));
    $_SESSION['account']['connect'] = 0;

    $_SESSION['account']['away']['username'] = $user->username;
    $_SESSION['account']['away']['prenom_user'] = $user->prenom_user;

    if($user_u == 1){
        $fonction->redirect("lockscreen");
    }else{
        $fonction->redirect("error", "", "", "code", "USR2", "");
    }


}
if(isset($_POST['action']) && $_POST['action'] == 'deverrouille')
{
    session_start();
    require "../application/classe.php";
    $username = $_POST['username'];
    $password = $_POST['password'];
    $encrypt = new encrypt($username, $password);
    $pass_en = $encrypt->encrypt();
    $decrypt = new decrypt($pass_en, $username, $password);
    $pass_de = $decrypt->decrypt();



    $user_co = $DB->count("SELECT COUNT(iduser) FROM users WHERE username = :username AND password = :password", array(
        "username" => $username,
        "password" => $pass_en
    ));

    if($user_co == 1)
    {
        $_SESSION['account']['connect'] = 1;
        $_SESSION['account']['away']['username'] = $user->username;
        $user_u = $DB->execute("UPDATE users SET connect = 2, last_connect = :last_connect WHERE username = :username", array(
            "username"      => $username,
            "last_connect"  => $date_format->format_strt(date("d-m-Y H:i:s"))
        ));
        if($user_u == 1){
            $fonction->redirect("dashboard");
        }

    }elseif($user_co == 0){
        $text = "Aucun couple Nom d'utilisateur / Mot de Passe correspondant.";
        $fonction->redirect("lockscreen", "","","error", "deverouille", $text);
    }else{
        $fonction->redirect("error", "","","code", "USR3", "");
    }

}
if(isset($_GET['action']) && $_GET['action'] == 'logout')
{
    session_start();
    require "../application/classe.php";
    $iduser = $user->iduser;

    $user_u = $DB->execute("UPDATE users SET connect = 1 WHERE iduser = :iduser", array("iduser" => $iduser));
    $_SESSION['account']['connect'] = 0;

    if($user_u == 1){
        session_unset();
        session_destroy();
        $fonction->redirect("login");
    }else{
        $fonction->redirect("error", "", "", "code", "USR2", "");
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'edit-profil')
{
    session_start();
    require "../application/classe.php";
    $iduser = $user->iduser;
    $nom_user = $_POST['nom_user'];
    $prenom_user = $_POST['prenom_user'];
    $poste_user = $_POST['poste_user'];
    $date_naissance = $date_format->format_strt($_POST['date_naissance']);
    $num_tel_poste = $_POST['num_tel_poste'];

    $user_u = $DB->execute("UPDATE users SET nom_user = :nom_user, prenom_user = :prenom_user, poste_user = :poste_user, date_naissance = :date_naissance, num_tel_poste = :num_tel_poste WHERE iduser = :iduser", array(
        "nom_user"      => $nom_user,
        "prenom_user"   => $prenom_user,
        "poste_user"    => $poste_user,
        "date_naissance"=> $date_naissance,
        "num_tel_poste" => $num_tel_poste,
        "iduser"        => $iduser
    ));

    if($user_u == 1){
        $text = "L'utilisateur <strong>".$nom_user." ".$prenom_user."</strong> à été modifier avec succès";
        $addNotif = $DB->execute("INSERT INTO notif(idnotif, iduser, type, notification, date_notification, vu) VALUES (NULL , :iduser, :type, :notification, :date_notification, :vu)", array(
            "iduser"                => $iduser,
            "type"                  => 2,
            "notification"          => $user->prenom_user." à modifier le profil de <strong>".$nom_user." ".$prenom_user."</strong>.",
            "date_notification"     => $date_format->format_strt(date("d-m-Y H:i:s")),
            "vu"                    => 0
        ));
        $fonction->redirect("profil", "", "", "success", "edit-profil", $text);
    }else{
        $fonction->redirect("error", "", "", "code", "USR3", "");
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'edit-password')
{
    session_start();
    require "../application/classe.php";
    $actual_password = $_POST['actual_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    //Import des informations utilisateurs
    $iduser = $user->iduser;
    $username = $user->username;
    $password = $user->password;
    //Vérification que le mot de passe actuel soit différent que le nouveau

    if($new_password == $actual_password)
    {
        $fonction->redirect("profil", "", "", "warning", "edit-password", "L'ancien mot de passe et le nouveau correspondent, Veuillez en saisir un nouveau !");
    }

    //Vérification de la confirmation
    if($new_password != $confirm_new_password)
    {
        $fonction->redirect("profil", "", "", "warning", "edit-password", "Veuillez saisir le même mot de passe dans le champs de confirmation de mot de passe !");
    }

    //Encrypter
    $encrypt = new encrypt($username, $new_password);
    $en_pass = $encrypt->encrypt();

    $user_u = $DB->execute("UPDATE users SET password = :password WHERE iduser = :iduser", array(
        "iduser"    => $iduser,
        "password"  => $en_pass
    ));

    if($user_u == 1){
        $text = "Le mot de passe de l'utilisateur <strong>".$username."</strong> à été changer avec succès !";
        $addNotif = $DB->execute("INSERT INTO notif(idnotif, iduser, type, notification, date_notification, vu) VALUES (NULL , :iduser, :type, :notification, :date_notification, :vu)", array(
            "iduser"                => $iduser,
            "type"                  => 2,
            "notification"          => $user->prenom_user." à modifier le mot de passe de sont Espace.",
            "date_notification"     => $date_format->format_strt(date("d-m-Y H:i:s")),
            "vu"                    => 0
        ));
        $fonction->redirect("profil", "", "", "success", "edit-password", $text);
    }else{
        $fonction->redirect("error", "", "", "code", "USR4", "");
    }


    
}
if(isset($_POST['action']) && $_POST['action'] == 'active_totp')
{
    session_start();
    require "../application/classe.php";
    $iduser = $user->iduser;
    $username = $user->username;
    $otp = new Otp();
    if($otp->checkTotp(Base32::decode($_SESSION['user']['totp_secret']), $_POST['code'])){
        $user_u = $DB->execute("UPDATE users SET totp = 1, totp_token = :totp_token WHERE iduser = :iduser", array(
            "totp_token" => $_SESSION['user']['totp_secret'],
            "iduser"     => $iduser
        ));
        $_SESSION['user']['totp_secret'] = "";

        if($user_u == 1){
            $text = "L'authentificateur 2 Facteur à été activé pour l'utilisateur <strong>".$username."</strong>.";
            $addNotif = $DB->execute("INSERT INTO notif(idnotif, iduser, type, notification, date_notification, vu) VALUES (NULL , :iduser, :type, :notification, :date_notification, :vu)", array(
                "iduser"                => $iduser,
                "type"                  => 1,
                "notification"          => $user->prenom_user." à activé l'authentification à 2 facteur.",
                "date_notification"     => $date_format->format_strt(date("d-m-Y H:i:s")),
                "vu"                    => 0
            ));
            $fonction->redirect("profil", "", "", "success", "active_totp", $text);
        }else{
            $fonction->redirect("error", "", "", "code", "USR5", "");
        }
    }else{
        $fonction->redirect("profil", "", "", "error", "active_totp", "Ce code ne correspond pas !!!");
    }

}
if(isset($_GET['action']) && $_GET['action'] == 'desactive_totp')
{
    session_start();
    require "../application/classe.php";
    $iduser = $user->iduser;
    $username = $user->username;

    $user_u = $DB->execute("UPDATE users SET totp = 0, totp_token = NULL WHERE iduser = :iduser", array("iduser" => $iduser));

    if($user_u == 1){
        $text = "L'authentificateur 2 Facteur à été désactivé pour l'utilisateur <strong>".$username."</strong>.";
        $addNotif = $DB->execute("INSERT INTO notif(idnotif, iduser, type, notification, date_notification, vu) VALUES (NULL , :iduser, :type, :notification, :date_notification, :vu)", array(
            "iduser"                => $iduser,
            "type"                  => 3,
            "notification"          => $user->prenom_user." à désactivé l'authentification à 2 facteur.",
            "date_notification"     => $date_format->format_strt(date("d-m-Y H:i:s")),
            "vu"                    => 0
        ));
        $fonction->redirect("profil", "", "", "success", "desactive_totp", $text);
    }else{
        $fonction->redirect("error", "", "", "code", "USR5", "");
    }
}