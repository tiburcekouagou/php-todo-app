<?php
namespace Database;

use \PDO;
use \PDOException;

class Database {
    private static ?PDO $instance = null;
    
    // Configuration de la Base de Données
    private const DB_HOST = '127.0.0.1';
    private const DB_NAME = 'todos_db';
    private const DB_USER = 'root';
    private const DB_PASSWORD = '';
    
    /**
     * Empêcher l'instanciation de la classe
     */
    private function __construct() {}
    private function __clone() {}

    public static function getInstance() {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO(
                    'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=utf8mb4',
                    self::DB_USER,
                    self::DB_PASSWORD,
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