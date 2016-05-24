<?php
/**
 * Created by PhpStorm.
 * User: Maxime
 * Date: 29/02/2016
 * Time: 23:21
 */

namespace App\general;


use PDO;
use PDOException;

class db
{
    protected $host = "localhost";
    protected $username = "root";
    protected $password = "1992_Maxime";
    protected $database = "gestcom";
    private $db;

    public function __construct($host = null, $username = null, $password = null, $database = null)
    {
        if($host != null)
        {
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;
        }

        try{
            $this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->username, $this->password, array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
            ));
        }catch(PDOException $e)
        {
            echo $e->getCode().": ".$e->getMessage();
        }
    }

    /**
     * @param $sql // Requete demander au système (UNIQUEMENT SELECT FROM)
     * @param null $data // Tableau des variables à rechercher avec la requete demander
     * @return array // Retourne Tableau de la requete (OBJECT)
     */
    public function query($sql, $data = null)
    {
        $req = $this->db->prepare($sql);
        $req->execute($data);
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @param $sql // Requete demander au système (UNIQUEMENT SELECT Count() FROM)
     * @param null $data // Tableau des variables à rechercher avec la requete demander
     * @return string // Retourne un nombre associatif à la requete
     */
    public function count($sql, $data = null)
    {
        try {
            $req = $this->db->prepare($sql);
            $req->execute($data);
            return $req->fetchColumn();
        }catch(PDOException $e)
        {
            return $e->getCode().": ".$e->getMessage();
        }
    }

    /**
     * @param $sql // Requete demander au systeme (UPDATE, DELETE, INSERT)
     * @param null $data // Tableau des variables à inserer avec la requete demander
     * @return int|string retourne le nombre de ligne affecter par la requte
     */
    public function execute($sql, $data = null)
    {
        try {
            $req = $this->db->prepare($sql);
            $req->execute($data);
            return $req->rowCount();
        }catch(PDOException $e)
        {
            return $e->getCode().": ".$e->getMessage();
        }

    }
}
