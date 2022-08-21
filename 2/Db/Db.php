<?php

namespace App\Db;

// on importe PDO
use PDO;
use PDOException;

class Db extends PDO
{
//   instance unique de la classe
    private static $instance;


// information de connexion pour la base de données
    private const DBHOST = 'localhost';
    private const DBUSER = 'root';
    private const DBPASS = '';
    private const DBNAME = 'demo_poo'; 

    /**
     * Constructeur de la classe Db
     */
    private function __construct()
    // dsn de connexion pour la base de données
    {
        $dsn = 'mysql:dbname=' . self::DBNAME . ';host=' . self::DBHOST;

        // on appelle le constructeur de la classe PDO

        try{
            parent::__construct($dsn, self::DBUSER, self::DBPASS);
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            die('Erreur : ' . $e->getMessage());
        }
    }

public static function getInstance()
{
    if(self::$instance === null){
        self::$instance = new self();
    }
    return self::$instance;
}
// méthode static qui nous permet de récupérer l'instance de la classe Db ou d'en créer une nouvelle si elle n'exite pas.
// pour le récuperer nous ferons un db::getInstance()
}