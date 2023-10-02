<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    $task_id = $data->id; // Get task ID from the request

    // Include your database connection and Task class here

    $database = new Database();
    $db = $database->getConnection();
    $task = new Task($db);

    // Attempt to delete the task
    $result = $task->deleteTask($task_id);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting task']);
    }
}
?>
