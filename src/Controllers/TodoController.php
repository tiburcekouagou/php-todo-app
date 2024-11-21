<?php
namespace App\Controllers;

use DB\Database;

class TodoController
{

    public function index()
    {
        // Récupérer l'instance de connexion à la BDD
        $db = Database::getInstance();

        // Récupérer les tâches depuis la BDD
        $query = $db->query("SELECT * FROM todos;"); // prépare la requête
        $todos = $query->fetchAll(); // retourne le résultat de l'exécution de la requête

        // Charger la Vue "Views/index.php"
        // require __DIR__ . "/../Views/index.php";
        require dirname(__DIR__) . "/Views/index.php";
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $task = trim($_POST['task']);

            if ($task) {
                // Récupérer l'instance de connexion à la BDD
                $db = Database::getInstance();
                // Prépare la requête SQL pour insérer une nouvelle tâche dans la table "todos".
                // Les placeholders `:task` et `:done` sont utilisés pour éviter les injections SQL.
                // Cela sécurise les données entrés par l'utilisateur.
                $stmt = $db->prepare("INSERT INTO todos (task, done) VALUES (:task, :done);");

                // Exécute la requête préparée avec les valeurs spécifiques fournies dans un tableau associatif
                // - `:task` contient la description de la tâche saisie par l'utilisateur
                // - `:done` est initialisé à 0 (indiquand que la tâche n'est pas encore terminée).
                $stmt->execute([":task" => $task, ":done" => 0]);
                // $stmt->execute(["task" => $task, "done" => 0]); // on peut retirer les ":" des placeholders. C'est pareil !
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
            // Récupérer l'instance de connexion à la BDD
            $db = Database::getInstance();
            $stmt = $db->prepare("DELETE FROM todos WHERE id = :id;"); // $stmt pour "prepared statement" en anglais, "requête préparé" en fr donc stmt ==> statement
            $stmt->execute(["id" => (int) $id]);
        }

        header('Location: /');
        exit;
    }

    public function toggle()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            // Récupérer l'instance de connexion à la BDD
            $db = Database::getInstance();
            $stmt = $db->prepare("UPDATE todos SET done = NOT done WHERE id = :id");
            $stmt->execute(["id" => (int) $id]);
        }

        header('Location: /');
        exit;
    }
}