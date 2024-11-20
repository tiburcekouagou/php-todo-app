<?php
namespace App\Models;

use Database\Database;
use \PDO;

abstract class Model {
    protected PDO $db; 

    public function __construct() {
        $this->db = Database::getInstance();
    }
}