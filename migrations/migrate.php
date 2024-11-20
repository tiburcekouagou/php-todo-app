<?php

require dirname(__DIR__) . "/vendor/autoload.php";

use Database\Database;

$pdo = Database::getInstance();

$dbName = "todos_db";

$queries = [
    "CREATE TABLE IF NOT EXISTS todos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task VARCHAR(255) NOT NULL,
    done TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )"
];

foreach ($queries as $query) {
    $pdo->exec($query);
    echo "Migration exécutée: {$query}\n";
}

echo "Migrations exécutée avec succès !";