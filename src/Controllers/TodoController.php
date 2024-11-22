<?php
namespace App\Controllers;

use DB\Database;
use App\Models\Todo;

class TodoController extends Controller
{
    private Todo $todoModel;

    public function __construct() {
        $this->todoModel = new Todo();
    }

    public function index()
    {
        $todos = $this->todoModel->getAll();
        // Charger la Vue "Views/index.php"
        $this->view("index", ["todos" => $todos]);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $task = trim($_POST['task']);

            if ($task) {
                $this->todoModel->add($task);
            }

            $this->redirect("/");
        }

        // Charger la vue add.php
        $this->view("add");
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->todoModel->delete((int) $id);
        }

        $this->redirect("/");
    }

    public function toggle()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->todoModel->toggle((int) $id);
        }

        $this->redirect("/");
    }
}