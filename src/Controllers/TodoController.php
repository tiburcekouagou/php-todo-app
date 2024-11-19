<?php
namespace App\Controllers;

class TodoController {

    public function index() {
        // Récupérer les tâches depuis la session
        if (!isset($_SESSION)) {
            session_start(); // récupérer la session existente
        }

        $todos = $_SESSION["todos"] ?? []; // ?? opérateur de coalescence des nulls
        // if (isset($_SESSION["todos"])) {
        //     $todos = $_SESSION["todos"];
        // } else {
        //     $todos = [];
        // }
        
        // Charger la Vue "Views/index.php"
        // require __DIR__ . "/../Views/index.php";
        require dirname(__DIR__) . "/Views/index.php";
    }

    public function add() {

    }

    public function delete() {

    }

    public function toggle() {

    }
}