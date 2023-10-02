<?php
class Task {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllTasks() {
        $result = $this->db->query("SELECT * FROM tasks");
        $tasks = array(); 
    
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $tasks[] = $row; 
        }
    
        return $tasks;
    }
    

    public function getTaskById($id) {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createTask($title, $description, $due_date, $status) {
        $stmt = $this->db->prepare("INSERT INTO tasks (title, description, due_date, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $title, $description, $due_date, $status);
        return $stmt->execute();
    }

    public function updateTask($id, $title, $description, $due_date, $status) {
        $stmt = $this->db->prepare("UPDATE tasks SET title = ?, description = ?, due_date = ?, status = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $title, $description, $due_date, $status, $id);
        return $stmt->execute();
    }

    public function deleteTask($id) {
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>