<?php

namespace Core\Database;
use PDO;
use PDOException;

/**
 * Connexion PDO
 */
class PDOSingleton
{
    static $pdo;


    private function  __construct()
    {
        require ROOT . '/config/bdd.php';

        $dsn = 'mysql:host='.DB_HOST.';dbname=' . DB_NAME;
        try{
            $pdo= new PDO($dsn, DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$pdo = $pdo;
        }catch(PDOException $e){
            http_response_code(500);
            if(DEBUG){
                die('Probleme de connexion : ' . $e->getMessage());
            }else{
                die('Une erreur serveur est survenue');
            }
        }
        
    }

    static public function getInstance()
    {
        if(is_null(self::$pdo)){
            new self();
        }

        return self::$pdo;
    }
}