<?php
namespace Database;

use Dotenv\Dotenv;
use \PDO;
use \PDOException;

class Database {
    private static ?PDO $instance = null;
    
    /**
     * Empêcher l'instanciation de la classe
     */
    private function __construct() {}
    private function __clone() {}

    public static function getInstance() {
        if (self::$instance === null) {
            // charger les variables d'environnement
            $dotenv = Dotenv::createImmutable(__DIR__ . "/..");
            $dotenv->load();

            $dbHost = $_ENV["DB_HOST"];
            $dbName = $_ENV["DB_NAME"];
            $dbUser = $_ENV["DB_USER"];
            $dbPassword = $_ENV["DB_PASSWORD"];
            $dbCharset = $_ENV["DB_CHARSET"];
            
            try {
                self::$instance = new PDO(
                    "mysql:host=$dbHost;dbname=$dbName;charset=$dbCharset",
                    $dbUser,
                    $dbPassword,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_PERSISTENT => true
                    ]
                );
            } catch (PDOException $e) {
                die("Echec de connection à la BDD: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}