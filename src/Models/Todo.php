<?php
namespace App\Models;

class Todo extends Model
{
    public function getAll()
    {
        $query = $this->db->query("SELECT * FROM todos");
        return $query->fetchAll();
    }

    public function create(string $task)
    {
        $stmt = $this->db->prepare("INSERT INTO todos (task, done) VALUES (:task, :done)");
       return $stmt->execute(["task" => $task, "done" => 0]);
    }

    public function updateStatus(int $id, ?bool $done)
    {
        if ($done === null) {
            // Switcher le status
            $stmt = $this->db->prepare("UPDATE todos SET done = NOT done WHERE id = :id");
        } else {
            // Definir le status explicitement
            $stmt = $this->db->prepare("UPDATE todos SET done = :done WHERE id = :id");
            return $stmt->execute(["id" => $id, "done" => $done ? 1 : 0]);
        }

        return $stmt->execute(["id" => $id]);
    }

    public function delete(int $id)
    {
        $stmt = $this->db->prepare("DELETE FROM todos WHERE id = :id");
        return $stmt->execute(["id" => $id]);
    }
}