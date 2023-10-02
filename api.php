<?php
include_once 'db.php';
include_once 'Task.php';

$database = new Database();
$db = $database->getConnection();
$task = new Task($db);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $task_id = $_GET['id'];
        $task_data = $task->getTaskById($task_id);
        echo json_encode($task_data);
    } else {
        $tasks = $task->getAllTasks();
        echo json_encode($tasks);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    // Change the following line to pass an object with properties to createTask
    $result = $task->createTask($data);

    echo json_encode(['success' => $result]);
}

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"));

    // Change the following line to pass an object with properties to updateTask
    $result = $task->updateTask($data);

    echo json_encode(['success' => $result]);
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"));

    // Change the following line to pass only the ID to deleteTask
    $result = $task->deleteTask($data->id);

    echo json_encode(['success' => $result]);
}
?>
