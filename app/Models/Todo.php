<?php
namespace App\Models;

class Todo extends Model
{
    /**
     * Récupère toutes les tâches dans la BDD
     * @return array
     */
    public function getAll()
    {

        // Récupérer les tâches depuis la BDD
        $query = $this->db->query("SELECT * FROM todos;"); // prépare la requête
        return $query->fetchAll(); // retourne le résultat de l'exécution de la requête
    }

    /**
     * Ajoute une nouvelle tâche dans la BDD
     * @param string $task La tâche à ajouter
     * @return bool
     */
    public function add(string $task)
    {
        // Prépare la requête SQL pour insérer une nouvelle tâche dans la table "todos".
        // Les placeholders `:task` et `:done` sont utilisés pour éviter les injections SQL.
        // Cela sécurise les données entrés par l'utilisateur.
        $stmt = $this->db->prepare("INSERT INTO todos (task, done) VALUES (:task, :done);");

        // Exécute la requête préparée avec les valeurs spécifiques fournies dans un tableau associatif
        // - `:task` contient la description de la tâche saisie par l'utilisateur
        // - `:done` est initialisé à 0 (indiquand que la tâche n'est pas encore terminée).
        return $stmt->execute([":task" => $task, ":done" => 0]);
        // $stmt->execute(["task" => $task, "done" => 0]); // on peut retirer les ":" des placeholders. C'est pareil !
    }

    /**
     * Change le status d'une tâche (comme terminée|pas terminée)
     * @param int $id L'identifiant de la tâche à supprimer
     * @return bool
     */
    public function toggle(int $id)
    {
        $stmt = $this->db->prepare("UPDATE todos SET done = NOT done WHERE id = :id");
        return $stmt->execute(["id" => (int) $id]);
    }

    /**
     * Supprime une tâche
     * @param int $id L'identifiant de la tâche à supprimer
     * @return bool
     */
    public function delete(int $id)
    {
        $stmt = $this->db->prepare("DELETE FROM todos WHERE id = :id;"); // $stmt pour "prepared statement" en anglais, "requête préparé" en fr donc stmt ==> statement
        return $stmt->execute(["id" => (int) $id]);
    }
}