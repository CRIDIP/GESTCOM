<?php
/**
 * Created by PhpStorm.
 * User: Maxime
 * Date: 29/02/2016
 * Time: 23:21
 */

namespace App\general;


class fonction
{
    /**
     * @param $idclient // identifiant du client appeler
     * @return string // Retourne une clé [TOKEN] permettant l'identification d'une action
     */
    public function gen_token($idclient)
    {
        $ip_client = sha1($_SERVER['REMOTE_ADDR']);
        $heure = strtotime(date("H:i"));
        $salt = "_";
        $caractere = "azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN0123456789";
        $shuffle = str_shuffle($caractere);
        $lenght = substr($shuffle, 0, 10);
        $gen = $heure.$salt.sha1($lenght).$salt.$ip_client.$salt.$idclient;
        return $gen;

    }

    /**
     * @param $nom_client // Nom du client
     * @param $prenom_client // Prénom du client
     * @return string // Retour au format exemple: jdoe (John Doe)
     */
    public function gen_username($nom_client, $prenom_client){
        return $prenom_client[0].$nom_client;
    }

    /**
     * @return string // Génère un mot de passe aléatoire sur 6 caractères alphanumérique
     */
    public function gen_password()
    {
        $caractere = "AZERTUIOPQSDFGHJLMWXCVBNazertyuiopqsdfghjklmwxcvbn0123456789";
        $shuffle = str_shuffle($caractere);
        $lenght = substr($shuffle, 0, 6);
        return $lenght;
    }

    /**
     * @param $chiffre // chiffre au format standard (0.00)
     * @return string // Retourne le montant au formatage number_format (0,00 €)
     */
    public function number_decimal($chiffre)
    {
        return number_format($chiffre, 2, ',', ' ')." €";
    }

    /**
     * @param $nom // Nom du fichier à télécharger
     * @param $read_file // lien direct vers le fichier
     */
    public function download_file($nom, $read_file)
    {
        header("Content-Type: application/octet-stream");
        header("Content-disposition: attachment; filename=".$nom);
        header('Pragma: no-cache');
        header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        readfile($read_file);
        exit();
    }

    /**
     * @param $view // premiere Incrémentation (view/)
     * @param $sub // Deuxième Incrémentation (view->sub)
     * @param $data // Troisème Incrémentation (sub->data)
     * @param $type // Type Possible: success, warning, error, info
     * @param $service // Service appeler exemple: add-user
     * @param $text // Le texte renvoyer par la fonction
     */
    public function redirect($view = null, $sub = null, $data = null, $type = null, $service = null, $text = null){
        $constante = new constante();

        if(!empty($view)){$redirect = "index.php?view=".$view;}
        if(!empty($sub)){$redirect .= "&sub=".$sub;}
        if(!empty($data)){$redirect .= "&data=".$data;}
        if(!empty($type)){$redirect .= "&".$type."=".$service."&text=".$text;}

        header("Location: ".$constante->getUrl(array(), false).$redirect);

    }


    public function is_ajax(){
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
}

class number extends fonction{

    public function convertisseur_binaire($convert_mode, $nombre)
    {
        switch ($convert_mode){
            case "mo":
                return $this->conv_mo($nombre);
                break;
            case "ko":
                return $this->conv_ko($nombre);
                break;
            case "go":
                return $this->conv_go($nombre);
                break;

            case "oct":
                return $this->conv_oct($nombre);
                break;

            default:
                return $nombre;
                break;
        }
    }

    private function conv_oct($nombre){
        return $nombre * 1000000;
    }

    private function conv_mo($nombre){
        return $nombre / 1000000;
    }

    private function conv_ko($nombre){
        return $nombre / 1000;
    }

    private function conv_go($nombre){
        return $nombre / 1000000000;
    }

}