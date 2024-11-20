<?php
namespace App\Controllers;

use App\Models\Todo;
use Database\Database;

class TodoController
{
    private Todo $todoModel;

    public function __construct() {
        // Injection du model
        $this->todoModel = new Todo();
    }

    public function index()
    {
        
        // Récupérer les tâches depuis la BDD
        $todos = $this->todoModel->getAll();
        
        require dirname(__DIR__) . "/Views/index.php";
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $task = trim($_POST['task']);

            if ($task) {
                // Utiliser le modèle pour créer une tâche
                $this->todoModel->create($task);
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
            // Utiliser le modèle pour supprimer une tâche
            $this->todoModel->delete((int) $id);
        }

        header('Location: /');
        exit;
    }

    public function toggle()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            //
            $this->todoModel->updateStatus((int) $id, null);
        }

        header('Location: /');
        exit;
    }
}