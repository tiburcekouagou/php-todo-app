<?php
namespace App\Controllers;

use Database\Database;

class TodoController
{

    public function index()
    {
        // Récupérer l'instance de connexion à la BDD 
        $db = Database::getInstance();

        
        // Récupérer les tâches depuis la BDD
        $query = $db->query("SELECT * FROM todos ORDER BY id DESC");
        $todos = $query->fetchAll();
        
        require dirname(__DIR__) . "/Views/index.php";
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $task = trim($_POST['task']);

            if ($task) {
                $db = Database::getInstance();
                $stmt = $db->prepare("INSERT INTO todos (task, done) VALUES (:task, :done)");
                $stmt->execute(["task" => $task, "done" => 0]);
            }

            header('Location: /');
            exit;
        }

        // Charger la vue add.php
        require dirname(__DIR__) . "/Views/add.php";
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $db = Database::getInstance();
            $stmt = $db->prepare("DELETE FROM todos WHERE id = :id");
            $stmt->execute(["id" => $id]);
        }

        header('Location: /');
        exit;
    }

    public function toggle()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $db = Database::getInstance();
            $stmt = $db->prepare("UPDATE todos SET done = NOT done WHERE id = :id");
            $stmt->execute(["id" => $id]);
        }

        header('Location: /');
        exit;
    }
}