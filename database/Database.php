<?php
namespace DB;

use Dotenv\Dotenv;
use \PDO;
use \PDOException;
class Database
{
    // Design Pattern: Singleton

    public static ?PDO $instanceDb = null;


    /**
     * Empêche l'instanciation de la classe
     */
    private function __construct()
    {
    }
    private function __clone()
    {
    }

    public static function getInstance()
    {
        // Charger les variables d'nevironnement
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();

        // Configuration de la Base De Données
        $dbHost = $_ENV["DB_HOST"];
        $dbName = $_ENV["DB_NAME"];
        $dbUser = $_ENV["DB_USER"];
        $dbPassword = $_ENV["DB_PASSWORD"];
        $dbCharset = $_ENV["DB_CHARSET"];

        // si l'instance est nulle, on la cré
        if (self::$instanceDb === null) {
            try {
                self::$instanceDb = new PDO(
                    "mysql:host=$dbHost;dbname=$dbName;charset=$dbCharset",
                    $dbUser,
                    $dbPassword,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // lever des exeptions quand il y a des erreurs
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // renvoyer les données sous forme de tableau associatif
                    ]
                );
            } catch (PDOException $e) {
                exit("Echec de connexion à la BDD: " . $e->getMessage());
                // die("Echec de connexion à la BDD: " . $e->getMessage());
            }
        }

        // sinon, on la renvoie directement
        return self::$instanceDb;

    }
}