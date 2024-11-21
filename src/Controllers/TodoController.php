<?php
namespace App\Controllers;

use DB\Database;
use App\Models\Todo;

class TodoController
{
    private Todo $todoModel;

    public function __construct() {
        $this->todoModel = new Todo();
    }

    public function index()
    {
        $todos = $this->todoModel->getAll();

        // Charger la Vue "Views/index.php"
        // require __DIR__ . "/../Views/index.php";
        require dirname(__DIR__) . "/Views/index.php";
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $task = trim($_POST['task']);

            if ($task) {
                $this->todoModel->add($task);
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
            $this->todoModel->delete((int) $id);
        }

        header('Location: /');
        exit;
    }

    public function toggle()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->todoModel->toggle((int) $id);
        }

        header('Location: /');
        exit;
    }
}