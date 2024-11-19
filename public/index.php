<?php
use App\Controllers\TodoController;
use App\Router;

// require __DIR__ . "/../vendor/autoload.php";
require dirname(__DIR__) . "/vendor/autoload.php";

// Démarrer la session
if (!isset($_SESSION)) {
    session_start();
}

// Créer une instance du routeur
$router = new Router();

// Créer une instance du controlleur
$todoController = new TodoController();

// Définir les routes de l'application
$router->get("/", [$todoController, 'index']);
$router->get("/add", [$todoController, 'add']);
$router->post("/add", [$todoController, 'add']);
$router->get("/toggle", [$todoController, 'toggle']);
$router->get("/delete", [$todoController, 'delete']);

// Résoudre la route correspondante
$router->resolve();