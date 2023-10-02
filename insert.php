<?php
require_once 'Task.php';

$db = new mysqli('localhost', 'root', '', 'task_management');
$task = new Task($db);

$title = $_POST['title'];
$description = $_POST['description'];
$due_date = $_POST['due_date'];
$status = $_POST['status'];

$result = $task->createTask($title, $description, $due_date, $status);

echo json_encode(['success' => $result]);
?>
